<script setup lang="ts">
import { computed, ref } from 'vue'

const code = ref(randomCode())
const value = ref('')
const error = ref('')
const emit = defineEmits<{ verified: [] }>()
const maskedCode = computed(() => code.value.split('').join(' '))

function randomCode() {
  return Math.random().toString(36).slice(2, 7).toUpperCase()
}

function verify() {
  if (value.value.trim().toUpperCase() !== code.value) {
    error.value = 'Код не совпадает. Попробуйте ещё раз.'
    value.value = ''
    return
  }
  emit('verified')
}
</script>

<template>
  <div class="captcha-backdrop">
    <section class="captcha-modal" role="dialog" aria-modal="true" aria-labelledby="captcha-title">
      <span class="game-start__eyebrow">POP-UNDER ATTACK</span>
      <h3 id="captcha-title">Подтвердите, что вы оператор</h3>
      <p>Пока CAPTCHA не пройдена, остальные угрозы неуязвимы для кликов.</p>
      <strong class="captcha-code">{{ maskedCode }}</strong>
      <input v-model="value" type="text" autocomplete="off" placeholder="Введите код" @keyup.enter="verify" />
      <p v-if="error" class="captcha-error">{{ error }}</p>
      <button type="button" @click="verify">Разблокировать систему</button>
    </section>
  </div>
</template>

<style scoped>
.captcha-backdrop {
  position: absolute;
  z-index: 5;
  inset: 0;
  display: grid;
  place-items: center;
  background: rgba(8, 10, 29, 0.82);
}

.captcha-modal {
  width: min(100% - 36px, 390px);
  padding: 26px;
  text-align: center;
  background: #1a2043;
  border: 1px solid #aeb9ff;
  border-radius: 18px;
}

h3 {
  margin: 12px 0 8px;
  color: #fff;
  font: 700 1.25rem var(--main-font);
}

p {
  color: #c3cae7;
  font: 400 0.8rem/1.5 var(--main-font);
}

.captcha-code {
  display: block;
  margin: 20px 0;
  color: #ffcb57;
  font: 700 1.5rem var(--main-font);
  letter-spacing: 0.25em;
}

input {
  width: 100%;
  padding: 12px;
  color: #fff;
  text-align: center;
  background: #10142d;
  border: 1px solid #555f9c;
  border-radius: 8px;
  font: 700 1rem var(--main-font);
}

button {
  margin-top: 14px;
  padding: 11px 14px;
  color: #14182f;
  background: #aeb9ff;
  border: 0;
  border-radius: 8px;
  font: 700 0.75rem var(--main-font);
  cursor: pointer;
}

.captcha-error {
  margin-top: 8px;
  color: #ff8fa0;
}

.game-start__eyebrow {
  color: #9ca8e4;
  font: 700 0.7rem var(--main-font);
  letter-spacing: 0.16em;
}
</style>
