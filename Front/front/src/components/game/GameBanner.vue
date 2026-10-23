<script setup lang="ts">
defineProps<{
  title: string
  description: string
  fakeClose: boolean
}>()

const emit = defineEmits<{
  close: []
  damage: []
}>()
</script>

<template>
  <article class="threat-card threat-card--banner" data-threat="banner">
    <button
      v-if="fakeClose"
      type="button"
      class="threat-card__real-close"
      data-threat-action="banner-close"
      aria-label="Закрыть баннер"
    >
      ×
    </button>
    <div class="threat-card__topline">
      <span class="threat-card__badge">POP-UP</span>
      <span class="threat-card__signal">UNTRUSTED</span>
    </div>

    <h3>{{ title }}</h3>
    <p>{{ description }}</p>

    <div class="threat-card__actions">
      <button type="button" class="threat-card__fake-action" data-threat-action="banner-damage">
        Скачать бесплатно
      </button>
      <button
        type="button"
        class="threat-card__close"
        :data-threat-action="fakeClose ? 'banner-damage' : 'banner-close'"
        aria-label="Закрыть баннер"
      >
        ×
      </button>
    </div>
  </article>
</template>

<style scoped>
.threat-card {
  position: relative;
  width: min(100%, 320px);
  padding: 20px;
  color: #f5f7ff;
  background: linear-gradient(145deg, #1d2450, #10142d);
  border: 1px solid rgba(255, 108, 129, 0.55);
  border-radius: 18px;
  box-shadow: 0 18px 40px rgba(4, 6, 19, 0.35);
  animation: threat-in 320ms ease-out both;
}

.threat-card--banner {
  cursor: crosshair;
}

.threat-card__topline,
.threat-card__actions {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}

.threat-card__badge,
.threat-card__signal {
  font: 700 0.68rem/1 var(--main-font);
  letter-spacing: 0.12em;
}

.threat-card__badge {
  color: #ff6c81;
}

.threat-card__signal {
  color: #aab4dd;
}

h3 {
  margin: 24px 0 8px;
  font: 700 1.2rem/1.2 var(--main-font);
}

p {
  min-height: 48px;
  color: #c0c7e7;
  font: 400 0.88rem/1.5 var(--main-font);
}

.threat-card__actions {
  margin-top: 24px;
}

button {
  border: 0;
  font: 700 0.78rem var(--main-font);
  cursor: pointer;
}

.threat-card__fake-action {
  padding: 10px 12px;
  color: #14182f;
  background: #ffcb57;
  border-radius: 10px;
}

.threat-card__close {
  width: 34px;
  height: 34px;
  color: #fff;
  background: #d64761;
  border-radius: 50%;
  font-size: 1.5rem;
  line-height: 1;
}

.threat-card__real-close {
  position: absolute;
  top: 8px;
  right: 10px;
  width: 24px;
  height: 24px;
  padding: 0;
  color: #aab4bb;
  background: transparent;
  border: 0;
  font-size: 1.2rem;
  line-height: 1;
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
