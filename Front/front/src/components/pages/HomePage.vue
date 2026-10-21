<script setup lang="ts">
import { ref } from 'vue';
import Header from '../Header.vue';
import Hero from '../Hero.vue';
import Sponsors from '../Sponsors.vue';
import GameOverlay from '../game/GameOverlay.vue';

const isGameVisible = ref(false)

function openGame() {
    isGameVisible.value = true
}
</script>
<template>
    <Header @start-game="openGame"/>
    <Hero/>
    <Sponsors/>
    <GameOverlay v-if="isGameVisible" auto-start/>
</template>