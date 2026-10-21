<script setup lang="ts">
import { computed, onBeforeUnmount, onMounted, ref } from 'vue'

const props = defineProps<{
  title: string
  duration?: number
}>()

const emit = defineEmits<{
  quarantined: []
  damage: []
  expired: []
}>()

const remaining = ref(props.duration ?? 12)
const isDragging = ref(false)
let timer: ReturnType<typeof setInterval> | undefined

const progress = computed(() => `${(remaining.value / (props.duration ?? 12)) * 100}%`)

onMounted(() => {
  timer = setInterval(() => {
    remaining.value -= 1
    if (remaining.value <= 0) {
      if (timer) clearInterval(timer)
      emit('expired')
    }
  }, 1000)
})

onBeforeUnmount(() => {
  if (timer) clearInterval(timer)
})

function handleDragStart(event: DragEvent) {
  isDragging.value = true
  event.dataTransfer?.setData('text/plain', 'trojan-file')
  if (event.dataTransfer) event.dataTransfer.effectAllowed = 'move'
}

function handleDragEnd() {
  isDragging.value = false
}
</script>

<template>
  <article
    class="trojan-card"
    :class="{ 'trojan-card--dragging': isDragging }"
    draggable="true"
    data-threat="trojan"
    @dragstart="handleDragStart"
    @dragend="handleDragEnd"
  >
    <div class="trojan-card__icon" aria-hidden="true">ZIP</div>
    <div class="trojan-card__content">
      <span class="trojan-card__label">ЗАРАЖЁННЫЙ ФАЙЛ</span>
      <h3>{{ title }}</h3>
      <p>Перетащите файл в карантин до истечения таймера.</p>
      <div class="trojan-card__timer">
        <span :style="{ width: progress }"></span>
      </div>
      <strong>{{ remaining }} сек.</strong>
    </div>
  </article>
</template>

<style scoped>
.trojan-card {
  display: flex;
  width: min(100%, 360px);
  gap: 16px;
  padding: 18px;
  color: #fff;
  background: linear-gradient(145deg, #392742, #1c172f);
  border: 1px solid rgba(255, 203, 87, 0.65);
  border-radius: 18px;
  box-shadow: 0 18px 40px rgba(4, 6, 19, 0.35);
  cursor: grab;
  animation: threat-in 320ms ease-out both;
}

.trojan-card:active {
  cursor: grabbing;
}

.trojan-card--dragging {
  opacity: 0.88;
  border-color: #b9f3c5;
  box-shadow: 0 0 0 4px rgba(122, 231, 141, 0.2), 0 20px 44px rgba(0, 0, 0, 0.42);
  transform: rotate(2deg) scale(1.04);
}

.trojan-card__icon {
  display: grid;
  flex: 0 0 54px;
  place-items: center;
  align-self: flex-start;
  height: 62px;
  color: #2b2034;
  background: #ffcb57;
  border-radius: 12px;
  font: 700 0.75rem var(--main-font);
}

.trojan-card__content {
  min-width: 0;
}

.trojan-card__label {
  color: #ffcb57;
  font: 700 0.65rem var(--main-font);
  letter-spacing: 0.1em;
}

h3 {
  margin: 8px 0 5px;
  font: 700 1rem var(--main-font);
}

p {
  color: #d8cfe4;
  font: 400 0.78rem/1.4 var(--main-font);
}

.trojan-card__timer {
  height: 5px;
  margin-top: 14px;
  overflow: hidden;
  background: rgba(255, 255, 255, 0.14);
  border-radius: 99px;
}

.trojan-card__timer span {
  display: block;
  height: 100%;
  background: #ffcb57;
  transition: width 1s linear;
}

strong {
  display: block;
  margin-top: 6px;
  color: #ffcb57;
  font: 700 0.72rem var(--main-font);
}

@keyframes threat-in {
  from {
    opacity: 0;
    transform: translateY(12px) scale(0.96);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}
</style>
