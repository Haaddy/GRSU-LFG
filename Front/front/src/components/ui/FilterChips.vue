<script setup lang="ts"></script>

<template>
    <div class="filter-chips">
        <button type="button" class="filter-chips__chip filter-chips__chip--active">Upcoming</button>
        <button type="button" class="filter-chips__chip">Ongoing</button>
        <button type="button" class="filter-chips__chip">Completed</button>
        <button type="button" class="filter-chips__chip">Team required</button>
    </div>
</template>

<style scoped>
    .filter-chips {
        display: flex;
        gap: 10px;
        margin-bottom: 32px;
        flex-wrap: wrap;
    }

    .filter-chips__chip {
        padding: 10px 20px;
        border: solid 1px var(--input-border);
        border-radius: 18px;
        background: none;

        font-family: var(--main-font);
        font-weight: 500;
        font-size: 14px;
        color: #000;
        white-space: nowrap;
    }

    .filter-chips__chip--active {
        background-color: #000;
        border-color: #000;
        color: #fff;
    }

    .filter-chips__chip:hover {
        border-color: #000;
        transition: 0.3s;
    }

    @media (max-width: 768px) {
        .filter-chips {
            overflow-x: auto;
            padding-bottom: 4px;
        }
    }

    @media (max-width: 480px) {
        .filter-chips__chip {
            padding: 8px 14px;
            font-size: 13px;
        }
    }
</style>
