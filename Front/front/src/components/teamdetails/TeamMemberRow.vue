<script setup lang="ts">
defineProps<{
    initial: string;
    name: string;
    role: string;
    color?: 'green' | 'pink';
    canKick?: boolean;
}>();
</script>

<template>
    <div class="member-row">
        <span class="member-row__avatar" :class="color ? `member-row__avatar--${color}` : ''">{{ initial }}</span>
        <div class="member-row__identity">
            <strong>{{ name }}</strong>
            <span>{{ role }}</span>
        </div>
        
        <button v-if="canKick" class="member-row__kick" type="button">Kick</button>
    </div>
</template>

<style scoped>
.member-row {
    display: flex;
    align-items: center;
    gap: 12px;
    width: min(100%, 1100px);
    margin: 0 auto;
    padding: 16px;
    border: 1px solid var(--color-border-light);
    border-radius: var(--radius-md);
}

.member-row__avatar {
    display: grid;
    place-items: center;
    width: 38px;
    height: 38px;
    flex-shrink: 0;
    border-radius: 50%;
    background: var(--color-primary-light);
    color: var(--color-primary);
    font-family: var(--font-main);
    font-size: 0.8rem;
    font-weight: 700;
}

.member-row__avatar--green {
    background: #e3f4e8;
    color: #248a3d;
}

.member-row__avatar--pink {
    background: #fbe6ee;
    color: #bd4d76;
}

.member-row__identity {
    display: flex;
    flex-direction: column;
    gap: 3px;
    min-width: 0;
}

.member-row__identity strong,
.member-row__identity span {
    font-family: var(--font-main);
}

.member-row__identity strong {
    color: var(--color-text);
    font-size: 0.86rem;
}

.member-row__identity span {
    color: var(--color-text-secondary);
    font-size: 0.74rem;
}

.member-row__kick {
    margin-left: auto;
    flex-shrink: 0;
    padding: 6px 10px;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-sm);
    background: var(--color-white);
    color: var(--color-error);
    cursor: pointer;
    font-family: var(--font-main);
    font-size: 0.72rem;
    font-weight: 700;
}

.member-row__kick:hover {
    border-color: var(--color-error);
    background: #fff5f5;
}

.member-row__kick:focus-visible {
    outline: 3px solid rgba(255, 0, 0, 0.18);
    outline-offset: 2px;
}

@media (max-width: 560px) {
    .member-row {
        align-items: flex-start;
        flex-wrap: wrap;
    }

}
</style>
