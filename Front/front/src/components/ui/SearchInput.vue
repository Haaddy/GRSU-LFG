<script setup lang="ts"></script>

<template>
    <div class="search">
        <svg class="search__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <circle cx="11" cy="11" r="8" />
            <line x1="21" y1="21" x2="16.65" y2="16.65" />
        </svg>
        <input type="text" class="search__input" placeholder="Поиск по названию мероприятия" />
    </div>
</template>

<style scoped>
    .search {
        position: relative;
        flex: 1;
    }

    .search__icon {
        position: absolute;
        top: 50%;
        left: 14px;
        transform: translateY(-50%);

        width: 18px;
        height: 18px;
        color: var(--color-placeholder);
        pointer-events: none;
    }

    .search__input {
        width: 100%;
        height: 48px;
        padding: 0 14px 0 40px;
        border: solid 1px var(--color-border);
        outline: none;
        background-color: var(--color-input-background);
        border-radius: var(--radius-sm);

        font-family: var(--font-main);
        font-weight: 400;
        font-size: 15px;
        color: #000;
    }

    .search__input::placeholder {
        color: var(--color-placeholder);
        font-family: var(--font-main);
        font-weight: 400;
        font-size: 15px;
    }

    .search__input:focus {
        border-color: var(--color-input-focus);
    }
</style>


