<script setup lang="ts">
import Header from './components/Header.vue';
import Hero from './components/Hero.vue';
import bottomLogos from './assets/imgs/Bottom Logos.png';

</script>

<template>
    <Header/>
    <Hero/>
    <img :src="bottomLogos" alt="">
</template>

<style scoped>
img{
    width: 100%;
    height: 12vh;
    background-size: cover;
    
}
</style>
