<script setup lang="ts">
defineProps<{
  title: string
  message: string
}>()

const emit = defineEmits<{
  block: []
  allow: []
}>()
</script>

<template>
  <article class="toast-threat" data-threat="toast">
    <span class="toast-threat__icon">!</span>
    <div>
      <strong>{{ title }}</strong>
      <p>{{ message }}</p>
      <div class="toast-threat__actions">
        <button type="button" data-threat-action="toast-block">Блокировать</button>
        <button type="button" data-threat-action="toast-allow">Разрешить</button>
      </div>
    </div>
  </article>
</template>

<style scoped>
.toast-threat {
  display: flex;
  width: min(100%, 360px);
  gap: 12px;
  padding: 16px;
  color: #fff;
  background: #252d61;
  border: 1px solid #ffcb57;
  border-radius: 14px;
  animation: toast-in 300ms ease-out both;
}

.toast-threat__icon {
  display: grid;
  flex: 0 0 30px;
  place-items: center;
  height: 30px;
  color: #2b2034;
  background: #ffcb57;
  border-radius: 50%;
  font-weight: 700;
}

strong {
  font: 700 0.85rem var(--main-font);
}

p {
  margin-top: 4px;
  color: #cbd1ed;
  font: 400 0.75rem/1.4 var(--main-font);
}

.toast-threat__actions {
  display: flex;
  gap: 8px;
  margin-top: 12px;
}

button {
  padding: 7px 9px;
  color: #161a38;
  background: #aeb9ff;
  border: 0;
  border-radius: 7px;
  font: 700 0.68rem var(--main-font);
  cursor: pointer;
}

button + button {
  color: #e8ebff;
  background: rgba(255, 255, 255, 0.1);
}

@keyframes toast-in {
  from { opacity: 0; transform: translateX(18px); }
  to { opacity: 1; transform: translateX(0); }
}
</style>
