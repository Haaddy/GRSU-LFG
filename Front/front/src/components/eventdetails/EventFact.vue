<script setup lang="ts">
defineProps<{
    label: string;
    value: string;
}>();
</script>

<template>
    <div class="event-fact">
        <span class="event-fact__label">{{ label }}</span>
        <strong>{{ value }}</strong>
    </div>
</template>

<style scoped>
.event-fact {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.event-fact__label {
    color: #929292;
    font-family: var(--font-main);
    font-size: 0.75rem;
}

.event-fact strong {
    font-family: var(--font-main);
    font-size: 0.88rem;
    font-weight: 700;
}
</style>


