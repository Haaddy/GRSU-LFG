<script setup lang="ts">
defineProps<{
    label: string;
    value: string;
}>();
</script>

<template>
    <div class="summary-item">
        <span class="summary-item__icon">
            <slot name="icon" />
        </span>
        <div>
            <span class="summary-item__label">{{ label }}</span>
            <strong>{{ value }}</strong>
        </div>
    </div>
</template>

<style scoped>
.summary-item {
    display: flex;
    align-items: center;
    gap: 13px;
}

.summary-item__icon {
    display: grid;
    place-items: center;
    width: 38px;
    height: 38px;
    border-radius: var(--radius-md);
    background: rgba(255, 255, 255, 0.12);
}

.summary-item__icon :deep(svg) {
    width: 18px;
    height: 18px;
    fill: none;
    stroke: #fff;
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-width: 1.8;
}

.summary-item__label {
    display: block;
    margin-bottom: 3px;
    color: rgba(255, 255, 255, 0.56);
    font-family: var(--font-main);
    font-size: 0.72rem;
}

.summary-item strong {
    font-family: var(--font-main);
    font-size: 0.88rem;
    font-weight: 500;
}
</style>


