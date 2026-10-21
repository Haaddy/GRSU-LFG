import { onBeforeUnmount, ref, watch } from 'vue'

export type GameTheme = 'night' | 'signal'

interface ThreatLog {
  type: 'banner' | 'trojan'
  caughtAt: string
}

const HEALTH_KEY = 'web-watch-health'
const TRAFFIC_KEY = 'web-watch-traffic'
const PLAYER_NAME_KEY = 'web-watch-player-name'
const THEME_KEY = 'web-watch-theme'
const VIP_COOKIE = 'web-watch-vip'
const DATABASE_NAME = 'web-watch-database'
const DATABASE_VERSION = 2
const THREAT_STORE = 'threat_logs'
const INVENTORY_STORE = 'inventory'
const CYBER_THREATS_STORE = 'cyber_threats'

function readNumber(key: string, fallback: number) {
  const value = Number(sessionStorage.getItem(key))
  return Number.isFinite(value) ? value : fallback
}

function setCookie(name: string, value: string, maxAgeSeconds: number) {
  document.cookie = `${name}=${encodeURIComponent(value)}; max-age=${maxAgeSeconds}; path=/; SameSite=Lax`
}

function hasCookie(name: string) {
  return document.cookie.split('; ').some((cookie) => cookie.startsWith(`${name}=`))
}

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

export function useGameStorage() {
  const health = ref(100)
  const traffic = ref(0)
  const playerName = ref('Оператор')
  const theme = ref<GameTheme>('night')
  const isVip = ref(false)

  function applyTheme(nextTheme: GameTheme) {
    document.body.classList.remove('theme-night', 'theme-signal')
    document.body.classList.add(`theme-${nextTheme}`)
  }

  function initialize() {
    health.value = readNumber(HEALTH_KEY, 100)
    traffic.value = readNumber(TRAFFIC_KEY, 0)
    playerName.value = localStorage.getItem(PLAYER_NAME_KEY) || 'Оператор'

    const savedTheme = localStorage.getItem(THEME_KEY)
    theme.value = savedTheme === 'signal' ? 'signal' : 'night'
    isVip.value = hasCookie(VIP_COOKIE)
    applyTheme(theme.value)
  }

  function saveStats() {
    sessionStorage.setItem(HEALTH_KEY, String(health.value))
    sessionStorage.setItem(TRAFFIC_KEY, String(traffic.value))
  }

  function setStats(nextHealth: number, nextTraffic: number) {
    health.value = nextHealth
    traffic.value = nextTraffic
    saveStats()
  }

  function saveSettings(nextName: string, nextTheme: GameTheme) {
    const normalizedName = nextName.trim() || 'Оператор'
    playerName.value = normalizedName
    theme.value = nextTheme
    localStorage.setItem(PLAYER_NAME_KEY, normalizedName)
    localStorage.setItem(THEME_KEY, nextTheme)
    applyTheme(nextTheme)
  }

  function activateVip() {
    setCookie(VIP_COOKIE, 'active', 5 * 60)
    isVip.value = true
  }

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

  watch([health, traffic], saveStats)
  watch(theme, applyTheme)
  onBeforeUnmount(() => {
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
