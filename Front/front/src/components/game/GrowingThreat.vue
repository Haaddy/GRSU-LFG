<script setup lang="ts">
defineProps<{
  progress: number
  duration: number
}>()

const emit = defineEmits<{
  close: []
}>()
</script>

<template>
  <article class="video-threat" :style="{ '--ad-progress': `${progress}%`, animationDuration: `${duration}s` }" data-threat="video">
    <span class="video-threat__badge">VIDEO AD</span>
    <div class="video-threat__screen">
      <span>ВЫ выиграли приз</span>
      <strong>Нажмите, пока окно не заполнило экран</strong>
    </div>
    <button type="button" data-threat-action="video-close" aria-label="Закрыть видео">
      Закрыть угрозу
    </button>
  </article>
</template>

<style scoped>
.video-threat {
  position: relative;
  width: min(100%, 340px);
  min-height: 180px;
  padding: 16px;
  overflow: hidden;
  color: #fff;
  background: #311b40;
  border: 1px solid #ff6c81;
  border-radius: 18px;
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
  animation: video-grow linear both;
}

.video-threat__screen::after {
  position: absolute;
  right: 16px;
  bottom: 48px;
  left: 16px;
  height: 4px;
  background: linear-gradient(90deg, #ffcb57 var(--ad-progress), rgba(255, 255, 255, 0.18) var(--ad-progress));
  border-radius: 99px;
  content: '';
}

.video-threat__badge {
  position: relative;
  z-index: 1;
  color: #ff8fa0;
  font: 700 0.65rem var(--main-font);
  letter-spacing: 0.12em;
}

.video-threat__screen {
  display: grid;
  min-height: 100px;
  place-items: center;
  text-align: center;
}

.video-threat__screen span {
  color: #ffcb57;
  font: 700 1rem var(--main-font);
}

.video-threat__screen strong {
  max-width: 220px;
  font: 400 0.75rem/1.4 var(--main-font);
}

button {
  position: relative;
  z-index: 1;
  padding: 8px 10px;
  color: #25172d;
  background: #ffcb57;
  border: 0;
  border-radius: 8px;
  font: 700 0.7rem var(--main-font);
  cursor: pointer;
}

@keyframes video-grow {
  from { transform: scale(0.82); }
  to { transform: scale(1.15); }
}
</style>
