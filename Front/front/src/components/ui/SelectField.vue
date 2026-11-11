<script setup lang="ts"></script>

<template>
    <select class="select-field" aria-label="Sort">
        <option class="select-field__option" value="date-nearest">By date (nearest first)</option>
        <option class="select-field__option" value="date-latest">By date (latest first)</option>
        <option class="select-field__option" value="participants">By participants</option>
        <option class="select-field__option" value="name">By name (A–Z)</option>
    </select>
</template>

<style scoped>
    .select-field {
        height: 48px;
        padding: 0 14px;
        border: solid 1px var(--color-border);
        outline: none;
        background-color: var(--color-input-background);
        border-radius: var(--radius-sm);

        max-width: 240px;
        width: 100%;
        flex-shrink: 0;

        font-family: var(--font-main);
        font-weight: 400;
        font-size: 15px;
        color: #000;
    }

    .select-field:focus {
        border-color: var(--color-input-focus);
    }

    @media (max-width: 960px) {
        .select-field {
            max-width: none;
        }
    }
</style>


