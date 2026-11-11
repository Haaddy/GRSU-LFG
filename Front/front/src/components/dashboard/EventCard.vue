<script setup lang="ts">
import type { EventItem } from '@/types/event';

defineProps<{
    event: EventItem;
}>();
</script>

<template>
    <article class="event-card">
        <div class="event-card__top">
            <h3 class="event-card__name">{{ event.name }}</h3>
            <span
                class="event-card__status"
                :class="`event-card__status--${event.status.toLowerCase()}`"
            >{{ event.status }}</span>
        </div>

        <p class="event-card__description">{{ event.description }}</p>

        <div class="event-card__meta">
            <div class="event-card__meta-item">
                <svg class="event-card__meta-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                </svg>
                {{ event.date }}
            </div>

            <div class="event-card__meta-item">
                <svg class="event-card__meta-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                {{ event.organizer }}
            </div>

            <div class="event-card__meta-item">
                <svg class="event-card__meta-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
                {{ event.participants }} участников
            </div>
        </div>

        <div class="event-card__footer">
            <span
                class="event-card__team"
                :class="{ 'event-card__team--required': event.teamRequired }"
            >{{ event.teamRequired ? 'Team required' : 'Individual' }}</span>
        </div>
    </article>
</template>

<style scoped>
    .event-card {
        display: flex;
        flex-direction: column;
        gap: 14px;

        height: 100%;
        padding: 24px;

        background-color: #fff;
        border: solid 1px var(--input-border);
        border-radius: 18px;
    }

    .event-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        transform: translateY(-3px);
        transition: 0.3s;
    }

    .event-card__top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
    }

    .event-card__name {
        font-family: var(--main-font);
        font-weight: 700;
        font-size: 1.15rem;
        color: #000;
        line-height: 1.3;
    }

    .event-card__status {
        flex-shrink: 0;

        padding: 6px 12px;
        border-radius: 999px;

        font-family: var(--main-font);
        font-weight: 500;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .event-card__status--upcoming {
        background-color: rgba(0, 122, 255, 0.12);
        color: #007AFF;
    }

    .event-card__status--ongoing {
        background-color: rgba(52, 199, 89, 0.14);
        color: #248A3D;
    }

    .event-card__status--completed {
        background-color: var(--input-bg);
        color: var(--input-focus);
    }

    .event-card__description {
        font-family: var(--main-font);
        font-weight: 400;
        font-size: 0.92rem;
        line-height: 1.5;
        color: var(--input-placeholder);

        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .event-card__meta {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: auto;
    }

    .event-card__meta-item {
        display: flex;
        align-items: center;
        gap: 10px;

        font-family: var(--main-font);
        font-weight: 500;
        font-size: 0.88rem;
        color: #000;
    }

    .event-card__meta-icon {
        width: 16px;
        height: 16px;
        color: #121B68;
        flex-shrink: 0;
    }

    .event-card__footer {
        display: flex;
        padding-top: 14px;
        border-top: dashed 1px var(--input-border);
    }

    .event-card__team {
        padding: 6px 12px;
        border-radius: 6px;

        background-color: var(--input-bg);
        color: var(--input-focus);

        font-family: var(--main-font);
        font-weight: 500;
        font-size: 0.75rem;
    }

    .event-card__team--required {
        background-color: rgba(18, 27, 104, 0.08);
        color: #121B68;
    }
</style>
