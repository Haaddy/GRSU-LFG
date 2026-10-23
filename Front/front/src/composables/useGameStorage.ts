import { onBeforeUnmount, ref, watch } from 'vue'

export type GameTheme = 'night' | 'signal'

//! Формат записи пойманной угрозы.
interface ThreatLog {
  type: 'banner' | 'trojan'
  caughtAt: string
}

//! Ключ для сохранения здоровья в sessionStorage.
const HEALTH_KEY = 'web-watch-health'
//! Ключ для сохранения трафика в sessionStorage.
const TRAFFIC_KEY = 'web-watch-traffic'
//! Ключ для сохранения имени игрока.
const PLAYER_NAME_KEY = 'web-watch-player-name'
//! Ключ для сохранения темы интерфейса.
const THEME_KEY = 'web-watch-theme'
//! Имя cookie VIP-режима.
const VIP_COOKIE = 'web-watch-vip'
//! Срок действия VIP-режима в секундах.
const VIP_DURATION_SECONDS = 5 * 60
//! Имя базы IndexedDB.
const DATABASE_NAME = 'web-watch-database'
//! Версия базы IndexedDB.
const DATABASE_VERSION = 2
//! Хранилище журнала угроз.
const THREAT_STORE = 'threat_logs'
//! Хранилище собранных угроз.
const INVENTORY_STORE = 'inventory'
//! Хранилище последних пойманных угроз.
const CYBER_THREATS_STORE = 'cyber_threats'

//! Читает число из sessionStorage или возвращает значение по умолчанию.
function readNumber(key: string, fallback: number) {
  const value = Number(sessionStorage.getItem(key))
  return Number.isFinite(value) ? value : fallback
}

//! Создаёт cookie с указанным сроком действия.
function setCookie(name: string, value: string, maxAgeSeconds: number) {
  document.cookie = `${name}=${encodeURIComponent(value)}; max-age=${maxAgeSeconds}; path=/; SameSite=Lax`
}

//! Проверяет наличие cookie.
//! Проверяет, не истёк ли срок VIP-cookie.
function hasActiveVipCookie() {
  const cookie = document.cookie.split('; ').find((item) => item.startsWith(`${VIP_COOKIE}=`))
  if (!cookie) return false
  const expiresAt = Number(decodeURIComponent(cookie.split('=')[1] ?? ''))
  return Number.isFinite(expiresAt) && expiresAt > Date.now()
}

//! Открывает IndexedDB и создаёт нужные хранилища.
function openDatabase() {
  return new Promise<IDBDatabase>((resolve, reject) => {
    const request = indexedDB.open(DATABASE_NAME, DATABASE_VERSION)

    request.onupgradeneeded = () => {
      const database = request.result
      if (!database.objectStoreNames.contains(THREAT_STORE)) {
        database.createObjectStore(THREAT_STORE, { autoIncrement: true })
      }
      if (!database.objectStoreNames.contains(INVENTORY_STORE)) {
        database.createObjectStore(INVENTORY_STORE, { autoIncrement: true })
      }
      if (!database.objectStoreNames.contains(CYBER_THREATS_STORE)) {
        database.createObjectStore(CYBER_THREATS_STORE, { keyPath: 'type' })
      }
    }
    request.onsuccess = () => resolve(request.result)
    request.onerror = () => reject(request.error ?? new Error('Не удалось открыть IndexedDB.'))
  })
}

//! Создаёт состояние хранилища игры.
export function useGameStorage() {
  const health = ref(100) //! Здоровье системы.
  const traffic = ref(0) //! Объём вредоносного трафика.
  const playerName = ref('Оператор') //! Имя игрока.
  const theme = ref<GameTheme>('night') //! Тема интерфейса.
  const isVip = ref(false) //! Активен ли VIP-режим.
  let vipTimer: ReturnType<typeof setTimeout> | undefined //! Таймер окончания VIP.

  //! Применяет тему к body страницы.
  function applyTheme(nextTheme: GameTheme) {
    document.body.classList.remove('theme-night', 'theme-signal')
    document.body.classList.add(`theme-${nextTheme}`)
  }

  //! Загружает здоровье, трафик, имя, тему и VIP-статус.
  function initialize() {
    health.value = readNumber(HEALTH_KEY, 100)
    traffic.value = readNumber(TRAFFIC_KEY, 0)
    playerName.value = localStorage.getItem(PLAYER_NAME_KEY) || 'Оператор'

    const savedTheme = localStorage.getItem(THEME_KEY)
    theme.value = savedTheme === 'signal' ? 'signal' : 'night'
    isVip.value = hasActiveVipCookie()
    applyTheme(theme.value)
  }

  //! Сохраняет здоровье и трафик в sessionStorage.
  function saveStats() {
    sessionStorage.setItem(HEALTH_KEY, String(health.value))
    sessionStorage.setItem(TRAFFIC_KEY, String(traffic.value))
  }

  //! Обновляет и сохраняет здоровье с трафиком.
  function setStats(nextHealth: number, nextTraffic: number) {
    health.value = nextHealth
    traffic.value = nextTraffic
    saveStats()
  }

  //! Сохраняет имя игрока и тему в localStorage.
  function saveSettings(nextName: string, nextTheme: GameTheme) {
    const normalizedName = nextName.trim() || 'Оператор'
    playerName.value = normalizedName
    theme.value = nextTheme
    localStorage.setItem(PLAYER_NAME_KEY, normalizedName)
    localStorage.setItem(THEME_KEY, nextTheme)
    applyTheme(nextTheme)
  }

  //! Сохраняет VIP-cookie на пять минут.
  function activateVip() {
    const expiresAt = Date.now() + VIP_DURATION_SECONDS * 1000
    setCookie(VIP_COOKIE, String(expiresAt), VIP_DURATION_SECONDS)
    isVip.value = true
    if (vipTimer) clearTimeout(vipTimer)
    vipTimer = setTimeout(() => {
      isVip.value = false
    }, VIP_DURATION_SECONDS * 1000)
  }

  //! Сохраняет угрозу, инвентарь и дату последнего обнаружения в IndexedDB.
  async function recordThreat(log: ThreatLog) {
    try {
      const database = await openDatabase()
      await new Promise<void>((resolve, reject) => {
        const transaction = database.transaction(
          [THREAT_STORE, INVENTORY_STORE, CYBER_THREATS_STORE],
          'readwrite',
        )
        transaction.objectStore(THREAT_STORE).add(log)
        transaction.objectStore(INVENTORY_STORE).add({
          type: log.type,
          collectedAt: log.caughtAt,
        })
        transaction.objectStore(CYBER_THREATS_STORE).put({
          type: log.type,
          lastCaughtAt: log.caughtAt,
        })
        transaction.oncomplete = () => resolve()
        transaction.onerror = () => reject(transaction.error ?? new Error('Не удалось записать угрозу.'))
      })
      database.close()
    } catch (error) {
      console.error('IndexedDB threat log error:', error)
      throw error
    }
  }

  //! Автоматически сохраняет изменения здоровья и трафика.
  watch([health, traffic], saveStats)
  //! Автоматически применяет новую тему.
  watch(theme, applyTheme)
  //! Убирает классы тем при удалении компонента.
  onBeforeUnmount(() => {
    if (vipTimer) clearTimeout(vipTimer)
    document.body.classList.remove('theme-night', 'theme-signal')
  })

  return {
    health,
    traffic,
    playerName,
    theme,
    isVip,
    initialize,
    setStats,
    saveSettings,
    activateVip,
    recordThreat,
  }
}
