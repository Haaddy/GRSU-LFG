<script setup lang="ts">
import EventSummaryItem from './EventSummaryItem.vue';
</script>

<template>
    <section class="event-hero" aria-labelledby="event-title">
        <div class="event-hero__content">
            <div class="event-hero__eyebrow">
                <span class="status status--upcoming">Upcoming</span>
                <span class="event-type">Team event</span>
            </div>
            <h1 id="event-title">GRSU Hackathon 2026</h1>
            <p class="event-hero__lead">
                48-часовой хакатон по разработке игр и веб-приложений.
                Соберите команду, создайте прототип и поборитесь за главный приз.
            </p>
            <div class="event-hero__actions">
                <button class="button button--primary" type="button">Create team</button>
                <button class="button button--secondary" type="button">View teams</button>
            </div>
        </div>

        <div class="event-hero__summary">
            <EventSummaryItem label="Starts" value="14 Nov 2026, 10:00">
                <template #icon>
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="3" y="4" width="18" height="17" rx="2" />
                        <path d="M16 2v4M8 2v4M3 10h18" />
                    </svg>
                </template>
            </EventSummaryItem>
            <EventSummaryItem label="Location" value="GRSU Innovation Hub">
                <template #icon>
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z" />
                        <circle cx="12" cy="10" r="2.5" />
                    </svg>
                </template>
            </EventSummaryItem>
            <EventSummaryItem label="Participants" value="128 / 160 registered">
                <template #icon>
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </template>
            </EventSummaryItem>
        </div>
    </section>
</template>

<style scoped>
.event-hero {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 370px;
    gap: 52px;
    align-items: center;
    padding: 38px 42px;
    background: var(--color-primary);
    color: #fff;
    overflow: hidden;
    position: relative;
}

.event-hero::after {
    content: "";
    position: absolute;
    width: 440px;
    height: 440px;
    right: 12%;
    top: -300px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 50%;
    box-shadow: 0 0 0 70px rgba(255, 255, 255, 0.035), 0 0 0 140px rgba(255, 255, 255, 0.025);
    pointer-events: none;
}

.event-hero__content,
.event-hero__summary {
    position: relative;
    z-index: 1;
}

.event-hero__eyebrow {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 22px;
}

.status,
.event-type {
    display: inline-flex;
    align-items: center;
    width: fit-content;
    border-radius: var(--radius-pill);
    font-family: var(--font-main);
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}

.status {
    padding: 7px 12px;
}

.status--upcoming {
    background: #d7f6df;
    color: #1d7b3b;
}

.event-type {
    color: rgba(255, 255, 255, 0.62);
}

.event-hero h1 {
    max-width: 650px;
    margin-bottom: 13px;
    font-family: var(--font-main);
    font-size: clamp(2.2rem, 4vw, 3.55rem);
    font-weight: 700;
    letter-spacing: -0.05em;
    line-height: 1.05;
}

.event-hero__lead {
    max-width: 635px;
    color: rgba(255, 255, 255, 0.76);
    font-family: var(--font-main);
    font-size: 1rem;
    line-height: 1.65;
}

.event-hero__actions {
    display: flex;
    gap: 12px;
    margin-top: 28px;
}

.event-hero__summary {
    display: flex;
    flex-direction: column;
    gap: 19px;
    padding: 22px 0 22px 34px;
    border-left: 1px solid rgba(255, 255, 255, 0.18);
}

@media (max-width: 1050px) {
    .event-hero {
        grid-template-columns: minmax(0, 1fr) 320px;
        gap: 28px;
        padding: 32px;
    }
}

@media (max-width: 820px) {
    .event-hero {
        grid-template-columns: 1fr;
    }

    .event-hero__summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        padding: 20px 0 0;
        border-top: 1px solid rgba(255, 255, 255, 0.18);
        border-left: 0;
    }
}

@media (max-width: 560px) {
    .event-hero {
        padding: 25px 20px;
    }

    .event-hero h1 {
        font-size: 2.3rem;
    }

    .event-hero__actions {
        flex-direction: column;
    }

    .event-hero__actions .button {
        width: 100%;
    }

    .event-hero__summary {
        display: flex;
        gap: 14px;
    }
}
</style>


