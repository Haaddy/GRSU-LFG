<script setup lang="ts">
import EventFact from './EventFact.vue';
</script>

<template>
    <section class="panel panel--about" aria-labelledby="about-title">
        <div class="section-heading">
            <div>
                <span class="section-heading__overline">The challenge</span>
                <h2 id="about-title">About this event</h2>
            </div>
            <span class="created-date">Created 24 Sep 2026</span>
        </div>
        <p>
            GRSU Hackathon — это возможность за одни выходные пройти путь от
            идеи до работающего продукта. Работайте вместе с другими студентами,
            получайте советы от менторов и представьте результат жюри.
        </p>
        <p>
            Подойдут проекты в любой сфере: от игр и образовательных сервисов до
            инструментов для кампуса. Участники могут использовать любые технологии.
        </p>
        <div class="event-facts">
            <EventFact label="Organizer" value="GRSU Dev Club" />
            <EventFact label="Team size" value="2–5 people" />
            <EventFact label="Format" value="On-site" />
        </div>
    </section>
</template>

<style scoped>
.panel {
    padding: 34px 0;
    border-bottom: 1px solid #e8e8e8;
}

.panel--about {
    padding-top: 28px;
}

.section-heading {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 18px;
    margin-bottom: 22px;
}

.section-heading__overline {
    display: block;
    margin-bottom: 7px;
    color: var(--color-text-muted);
    font-family: var(--font-main);
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

h2 {
    font-family: var(--font-main);
    font-size: 1.35rem;
    letter-spacing: -0.03em;
}

.panel--about > p {
    max-width: 760px;
    margin-bottom: 14px;
    color: var(--color-text-secondary);
    font-family: var(--font-main);
    font-size: 0.91rem;
    line-height: 1.65;
}

.created-date {
    padding-top: 5px;
    color: #8a8a8a;
    font-family: var(--font-main);
    font-size: 0.76rem;
    white-space: nowrap;
}

.event-facts {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-top: 26px;
    padding-top: 22px;
    border-top: 1px solid var(--color-border-light);
}

@media (max-width: 560px) {
    .panel {
        padding: 25px 0;
    }

    .section-heading {
        flex-direction: column;
        gap: 8px;
    }

    .created-date {
        padding-top: 0;
    }

    .event-facts {
        gap: 10px;
    }

    .event-fact strong {
        font-size: 0.78rem;
    }
}
</style>

