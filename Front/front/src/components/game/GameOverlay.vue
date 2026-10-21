<script setup lang="ts">
import { computed, onBeforeUnmount, onMounted, ref } from 'vue'
import GameBanner from './GameBanner.vue'
import TrojanFile from './TrojanFile.vue'
import ToastNotification from './ToastNotification.vue'
import GrowingThreat from './GrowingThreat.vue'
import CaptchaModal from './CaptchaModal.vue'
import { useGameStorage, type GameTheme } from '../../composables/useGameStorage'

const props = withDefaults(defineProps<{
  autoStart?: boolean
}>(), {
  autoStart: false,
})

const isOpen = ref(true)
const isStarted = ref(props.autoStart)
const showBanner = ref(true)
const showTrojan = ref(true)
const showToast = ref(true)
const showVideo = ref(true)
const showCaptcha = ref(false)
const videoProgress = ref(0)
const adSpeed = ref(1)
const isGameOver = ref(false)
const isBannerCloseFake = ref(Math.random() < 0.5)
const bannerPosition = ref(0)
const trojanPosition = ref(1)
const caught = ref(0)
const statusMessage = ref('Система готова к запуску.')
const isQuarantineActive = ref(false)
const isSettingsOpen = ref(false)
const settingsName = ref('')
const settingsTheme = ref<GameTheme>('night')
const storage = useGameStorage()
const { health, traffic, playerName, theme, isVip } = storage

const healthLabel = computed(() => `${health.value}%`)
let captchaTimer: ReturnType<typeof setInterval> | undefined
let videoTimer: ReturnType<typeof setInterval> | undefined
let waveTimer: ReturnType<typeof setTimeout> | undefined
let captchaTrafficTimer: ReturnType<typeof setInterval> | undefined

onMounted(() => {
  storage.initialize()
  settingsName.value = playerName.value
  settingsTheme.value = theme.value
  if (props.autoStart) startGame()
  captchaTimer = setInterval(() => {
    if (!isStarted.value || isGameOver.value) return
    showCaptcha.value = true
  }, 60_000)
  captchaTrafficTimer = setInterval(() => {
    if (!showCaptcha.value || isGameOver.value) return
    storage.setStats(health.value, traffic.value + 5)
    statusMessage.value = 'CAPTCHA активна: вредоносный трафик растёт.'
  }, 1000)
  videoTimer = setInterval(() => {
    if (!isStarted.value || isGameOver.value || !showVideo.value) return
    videoProgress.value = Math.min(100, videoProgress.value + 3 * adSpeed.value)
    if (videoProgress.value >= 100) {
      showVideo.value = false
      damage(15, 'Видеореклама заполнила экран и заразила систему.')
    }
  }, 1000)
})

onBeforeUnmount(() => {
  if (captchaTimer) clearInterval(captchaTimer)
  if (videoTimer) clearInterval(videoTimer)
  if (waveTimer) clearTimeout(waveTimer)
  if (captchaTrafficTimer) clearInterval(captchaTrafficTimer)
})

function startGame() {
  isStarted.value = true
  isGameOver.value = false
  if (health.value <= 0) storage.setStats(100, 0)
  storage.activateVip()
  statusMessage.value = 'Угрозы обнаружены. Защищайте систему.'
  startThreatLoop()
}

function closeBanner() {
  showBanner.value = false
  caught.value += 1
  void storage.recordThreat({ type: 'banner', caughtAt: new Date().toISOString() }).catch(() => {
    statusMessage.value = 'Баннер закрыт, но запись в базу угроз не удалась.'
  })
  statusMessage.value = 'Баннер нейтрализован. Сигнатура добавлена в базу.'
}

function damage(amount = 10, message = 'Промах! Система получила повреждение.') {
  storage.setStats(Math.max(0, health.value - amount), traffic.value + amount)
  statusMessage.value = message
  if (health.value <= 0) finishGame()
}

function handleTrojanQuarantined() {
  showTrojan.value = false
  isQuarantineActive.value = false
  caught.value += 1
  void storage.recordThreat({ type: 'trojan', caughtAt: new Date().toISOString() }).catch(() => {
    statusMessage.value = 'Троян обезврежен, но запись в базу угроз не удалась.'
  })
  statusMessage.value = 'Файл-троян перемещён в карантин.'
}

function handleTrojanExpired() {
  showTrojan.value = false
  damage(20, 'Файл-троян успел заразить систему.')
}

function allowDrop(event: DragEvent) {
  event.preventDefault()
  isQuarantineActive.value = true
}

function leaveQuarantine() {
  isQuarantineActive.value = false
}

function dropToQuarantine(event: DragEvent) {
  event.preventDefault()
  if (event.dataTransfer?.getData('text/plain') !== 'trojan-file') return
  handleTrojanQuarantined()
}

function spawnThreats() {
  if (isGameOver.value) return
  showBanner.value = true
  showTrojan.value = true
  showToast.value = true
  showVideo.value = true
  videoProgress.value = 0
  isBannerCloseFake.value = Math.random() < 0.5
  bannerPosition.value = Math.floor(Math.random() * 3)
  trojanPosition.value = Math.floor(Math.random() * 3)
  statusMessage.value = 'Новые угрозы появились в зоне наблюдения.'
}

function startThreatLoop() {
  if (waveTimer) clearTimeout(waveTimer)
  scheduleThreatWave()
}

function scheduleThreatWave() {
  const delay = 6_000 + Math.floor(Math.random() * 9_000)
  waveTimer = setTimeout(() => {
    if (isGameOver.value || !isStarted.value) return
    spawnThreats()
    scheduleThreatWave()
  }, delay)
}

function finishGame() {
  isGameOver.value = true
  showCaptcha.value = false
  statusMessage.value = 'Система заражена. Защита завершена.'
  if (waveTimer) clearTimeout(waveTimer)
}

function restartGame() {
  storage.setStats(100, 0)
  caught.value = 0
  showBanner.value = true
  showTrojan.value = true
  showToast.value = true
  showVideo.value = true
  videoProgress.value = 0
  adSpeed.value = 1
  isBannerCloseFake.value = Math.random() < 0.5
  bannerPosition.value = 0
  trojanPosition.value = 1
  isGameOver.value = false
  statusMessage.value = 'Новая сессия защиты запущена.'
  startThreatLoop()
}

function handleThreatClick(event: MouseEvent) {
  if (showCaptcha.value || isGameOver.value) return
  const target = event.target
  if (!(target instanceof HTMLElement)) return
  const action = target.closest<HTMLElement>('[data-threat-action]')?.dataset.threatAction
  const threat = target.closest<HTMLElement>('[data-threat]')?.dataset.threat

  if (action === 'banner-close') closeBanner()
  else if (action === 'banner-damage') damage()
  else if (action === 'toast-block') {
    showToast.value = false
    caught.value += 1
    statusMessage.value = 'Browser notification заблокировано.'
  } else if (action === 'toast-allow') {
    showToast.value = false
    adSpeed.value = 2
    statusMessage.value = 'Разрешение получено: скорость рекламы удвоена.'
  } else if (action === 'video-close') {
    showVideo.value = false
    caught.value += 1
    statusMessage.value = 'Видеореклама остановлена.'
  } else if (threat === 'banner' || threat === 'trojan') {
    damage(threat === 'trojan' ? 15 : 10)
  }
}

function verifyCaptcha() {
  showCaptcha.value = false
  statusMessage.value = 'CAPTCHA пройдена. Угрозы снова доступны для кликов.'
}

function saveSettings() {
  storage.saveSettings(settingsName.value, settingsTheme.value)
  isSettingsOpen.value = false
  statusMessage.value = 'Настройки интерфейса сохранены.'
}
</script>

<template>
  <div v-if="isOpen" class="game-overlay">
    <section class="game-shell" aria-label="Веб-Дозор">
      <button class="game-shell__exit" type="button" aria-label="Закрыть игру" @click="isOpen = false">
        ×
      </button>

      <div v-if="!isStarted" class="game-start">
        <span class="game-start__eyebrow">EXPERIMENTAL DEFENDER / 01</span>
        <h2>Веб-Дозор</h2>
        <p>
          Защитите систему от вредоносных баннеров и перетащите заражённые файлы в карантин.
        </p>
        <button class="game-button game-button--primary" type="button" @click="startGame">
          Запустить защиту
        </button>
      </div>

      <div v-else class="game-content">
        <header class="game-header">
          <div>
            <span class="game-start__eyebrow">LIVE PROTECTION</span>
            <h2>Веб-Дозор <small v-if="isVip">VIP</small></h2>
            <p class="game-player">Оператор: {{ playerName }}</p>
          </div>
          <div class="game-stats">
            <div><span>XP</span><strong>{{ healthLabel }}</strong></div>
            <div><span>ТРАФИК</span><strong>{{ traffic }} MB</strong></div>
            <div><span>ПОЙМАНО</span><strong>{{ caught }}</strong></div>
          </div>
        </header>

        <div class="game-status">{{ statusMessage }}</div>

        <section v-if="isSettingsOpen" class="game-settings">
          <label>
            Имя оператора
            <input v-model="settingsName" type="text" maxlength="24" />
          </label>
          <label>
            Тема
            <select v-model="settingsTheme">
              <option value="night">Ночная</option>
              <option value="signal">Светлая</option>
            </select>
          </label>
          <button class="game-button" type="button" @click="saveSettings">Сохранить</button>
        </section>

        <main class="threat-zone" @click="handleThreatClick">
          <GameBanner
            v-if="showBanner"
            title="Ваш приз уже внутри!"
            description="Нажмите правильную кнопку, чтобы подтвердить получение награды."
            :fake-close="isBannerCloseFake"
            :class="`threat-zone__item threat-zone__item--${bannerPosition}`"
          />
          <TrojanFile
            v-if="showTrojan"
            title="system_update.zip"
            :class="`threat-zone__item threat-zone__item--${trojanPosition}`"
            @expired="handleTrojanExpired"
          />
          <ToastNotification
            v-if="showToast"
            title="Запрос на уведомления"
            message="Сайт хочет отправлять вам опасные уведомления."
          />
          <GrowingThreat
            v-if="showVideo"
            :progress="videoProgress"
            :duration="adSpeed === 2 ? 9 : 18"
          />
          <p v-if="!showBanner && !showTrojan" class="threat-zone__empty">
            Зона чиста. Можно вызвать новую волну угроз.
          </p>
        </main>

        <footer class="game-footer">
          <div
            class="quarantine"
            :class="{ 'quarantine--active': isQuarantineActive }"
            @dragover="allowDrop"
            @dragleave="leaveQuarantine"
            @drop="dropToQuarantine"
          >
            <span class="quarantine__icon">↓</span>
            <span>
              <strong>Карантин</strong>
              <small>Перетащите файл-троян сюда</small>
            </span>
          </div>
          <div class="game-footer__actions">
            <button class="game-button" type="button" @click="isSettingsOpen = !isSettingsOpen">
              Настройки
            </button>
            <button class="game-button" type="button" @click="spawnThreats">Вызвать угрозы</button>
          </div>
        </footer>
        <CaptchaModal v-if="showCaptcha" @verified="verifyCaptcha" />
        <div v-if="isGameOver" class="game-over">
          <span class="game-start__eyebrow">SYSTEM FAILURE</span>
          <h3>Система заражена</h3>
          <p>Все очки здоровья потеряны. Запустите новую защитную сессию.</p>
          <button class="game-button game-button--primary" type="button" @click="restartGame">
            Начать заново
          </button>
        </div>
      </div>
    </section>
  </div>
</template>

<style scoped>
.game-overlay {
  position: fixed;
  z-index: 1000;
  inset: 0;
  pointer-events: none;
  background: transparent;
}

.game-shell {
  position: relative;
  width: 100%;
  min-height: 0;
  max-height: 100vh;
  padding: 14px clamp(16px, 3vw, 42px) 18px;
  overflow: auto;
  color: #f5f7ff;
  background: rgba(16, 20, 45, 0.94);
  border: 1px solid rgba(155, 166, 231, 0.25);
  border-radius: 0 0 22px 22px;
  box-shadow: 0 14px 36px rgba(0, 0, 0, 0.3);
  pointer-events: auto;
}

.game-shell::before {
  position: absolute;
  inset: 0;
  z-index: 0;
  background: radial-gradient(circle at 90% 0%, rgba(101, 89, 215, 0.35), transparent 32%);
  content: '';
  pointer-events: none;
}

:global(body.theme-signal) .game-shell {
  color: #172044;
  background: rgba(247, 249, 255, 0.94);
  border-color: rgba(49, 59, 155, 0.2);
}

:global(body.theme-signal) .game-shell::before {
  background: radial-gradient(circle at 90% 0%, rgba(174, 185, 255, 0.45), transparent 32%);
}

:global(body.theme-signal) .game-status,
:global(body.theme-signal) .game-settings,
:global(body.theme-signal) .game-stats div {
  background: rgba(49, 59, 155, 0.08);
}

:global(body.theme-signal) .game-status {
  color: #34395e;
}

:global(body.theme-signal) .game-player,
:global(body.theme-signal) .game-stats span,
:global(body.theme-signal) .game-start p {
  color: #555f87;
}

:global(body.theme-signal) .game-settings input,
:global(body.theme-signal) .game-settings select {
  color: #172044;
  background: #fff;
  border-color: rgba(49, 59, 155, 0.25);
}

:global(body.theme-signal) .game-shell__exit {
  color: #34395e;
  border-color: rgba(49, 59, 155, 0.25);
}

.game-start,
.game-content {
  position: relative;
  z-index: 1;
}

.game-start {
  display: grid;
  place-items: center;
  min-height: 180px;
  text-align: center;
}

.game-start > * {
  max-width: 560px;
}

.game-start__eyebrow {
  color: #9ca8e4;
  font: 700 0.7rem var(--main-font);
  letter-spacing: 0.16em;
}

h2 {
  margin: 12px 0;
  font: 700 clamp(2rem, 5vw, 4rem)/1 var(--main-font);
}

.game-start p {
  margin-bottom: 30px;
  color: #c3cae7;
  font: 400 1rem/1.6 var(--main-font);
}

.game-shell__exit {
  position: absolute;
  z-index: 2;
  top: 20px;
  right: 24px;
  width: 34px;
  height: 34px;
  color: #c3cae7;
  background: transparent;
  border: 1px solid rgba(195, 202, 231, 0.25);
  border-radius: 50%;
  font-size: 1.4rem;
  cursor: pointer;
}

.game-header,
.game-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 24px;
}

.game-header h2 {
  margin: 8px 0 0;
  font-size: clamp(1.8rem, 4vw, 3rem);
}

.game-header h2 small {
  display: inline-block;
  padding: 5px 8px;
  color: #14182f;
  background: #ffcb57;
  border-radius: 6px;
  font-size: 0.6rem;
  vertical-align: middle;
}

.game-player {
  margin-top: 6px;
  color: #aeb6d7;
  font: 400 0.78rem var(--main-font);
}

.game-stats {
  display: flex;
  gap: 12px;
}

.game-stats div {
  min-width: 92px;
  padding: 12px;
  background: rgba(255, 255, 255, 0.06);
  border-radius: 12px;
}

.game-stats span,
.game-stats strong {
  display: block;
  font-family: var(--main-font);
}

.game-stats span {
  color: #9ca8e4;
  font-size: 0.62rem;
}

.game-stats strong {
  margin-top: 5px;
  font-size: 0.9rem;
}

.game-status {
  margin-top: 30px;
  padding: 12px 16px;
  color: #d8dcf2;
  background: rgba(114, 125, 202, 0.14);
  border-left: 3px solid #8e9bea;
  border-radius: 8px;
  font: 500 0.85rem var(--main-font);
}

.game-over {
  position: absolute;
  z-index: 6;
  inset: 0;
  display: grid;
  place-items: center;
  align-content: center;
  padding: 30px;
  text-align: center;
  background: rgba(8, 10, 29, 0.9);
}

.game-over h3 {
  margin: 12px 0 8px;
  color: #ff8fa0;
  font: 700 2rem var(--main-font);
}

.game-over p {
  max-width: 360px;
  margin-bottom: 24px;
  color: #c3cae7;
  font: 400 0.9rem/1.5 var(--main-font);
}

.threat-zone {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  gap: 20px;
  min-height: 290px;
  padding: 30px 0;
}

.threat-zone__item--0 {
  transform: translate(-18px, -10px);
}

.threat-zone__item--1 {
  transform: translate(0, 12px);
}

.threat-zone__item--2 {
  transform: translate(18px, -6px);
}

.threat-zone__empty {
  color: #9ca8e4;
  font: 500 0.9rem var(--main-font);
}

.game-footer {
  align-items: stretch;
}

.game-footer__actions {
  display: flex;
  gap: 10px;
}

.game-settings {
  display: flex;
  align-items: end;
  gap: 14px;
  margin-top: 18px;
  padding: 16px;
  background: rgba(255, 255, 255, 0.06);
  border-radius: 14px;
}

.game-settings label {
  display: grid;
  flex: 1;
  gap: 6px;
  color: #aeb6d7;
  font: 700 0.7rem var(--main-font);
}

.game-settings input,
.game-settings select {
  width: 100%;
  padding: 10px 12px;
  color: #f5f7ff;
  background: #1b2144;
  border: 1px solid rgba(195, 202, 231, 0.25);
  border-radius: 8px;
  font: 400 0.8rem var(--main-font);
}

.quarantine {
  display: flex;
  flex: 1;
  align-items: center;
  gap: 14px;
  padding: 12px 16px;
  color: #d9ffe0;
  background: rgba(46, 132, 65, 0.28);
  border: 2px dashed #78dc8a;
  border-radius: 14px;
  box-shadow: inset 0 0 0 1px rgba(168, 255, 180, 0.08);
  transition: 180ms ease;
}

.quarantine--active {
  color: #103919;
  background: #a9f4b6;
  border-color: #55c96d;
  box-shadow: 0 0 0 5px rgba(105, 226, 126, 0.2), 0 0 28px rgba(105, 226, 126, 0.45);
  transform: scale(1.02);
}

.quarantine__icon {
  display: grid;
  width: 34px;
  height: 34px;
  place-items: center;
  color: #103919;
  background: #8ce99b;
  border-radius: 50%;
  font-size: 1.2rem;
}

.quarantine strong,
.quarantine small {
  display: block;
  font-family: var(--main-font);
}

.quarantine small {
  color: #b8efc1;
}

.quarantine strong {
  font-size: 0.85rem;
}

.quarantine small {
  margin-top: 4px;
  color: #aeb6d7;
  font-size: 0.7rem;
}

.quarantine--active small {
  color: #295d34;
}

.game-button {
  padding: 12px 18px;
  color: #f5f7ff;
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(195, 202, 231, 0.25);
  border-radius: 12px;
  font: 700 0.8rem var(--main-font);
  cursor: pointer;
}

.game-button--primary {
  padding: 15px 24px;
  color: #14182f;
  background: #aeb9ff;
  border: 0;
}

.game-button:hover,
.game-shell__exit:hover {
  border-color: #aeb9ff;
}

@media (max-width: 680px) {
  .game-overlay {
    padding: 10px;
  }

  .game-shell {
    min-height: calc(100vh - 20px);
    border-radius: 20px;
  }

  .game-header,
  .game-footer {
    align-items: stretch;
    flex-direction: column;
  }

  .game-settings {
    align-items: stretch;
    flex-direction: column;
  }

  .game-footer__actions {
    flex-direction: column;
  }

  .game-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
  }

  .game-stats div {
    min-width: 0;
  }

  .game-button {
    width: 100%;
  }
}
</style>
