<script setup lang="ts">
import Header from '../Header.vue';
import SearchInput from '../ui/SearchInput.vue';
import SelectField from '../ui/SelectField.vue';
import FilterChips from '../ui/FilterChips.vue';
import EventCard from '../dashboard/EventCard.vue';
import type { EventItem } from '@/types/event';

const events: EventItem[] = [
    {
        id: 1,
        name: "GRSU Hackathon 2026",
        description: "48-часовой хакатон по разработке игр и веб-приложений. Стипендия — главный приз.",
        date: "2026-11-14 10:00",
        organizer: "GRSU Dev Club",
        participants: 128,
        teamRequired: true,
        status: 'Upcoming'
    },
    {
        id: 2,
        name: "Квиз «Степуху на ёлку»",
        description: "Классический квиз на 6 раундов. Собирай команду, депни все баллы.",
        date: "2026-11-21 18:30",
        organizer: "Студсовет",
        participants: 64,
        teamRequired: true,
        status: 'Upcoming'
    },
    {
        id: 3,
        name: "Open Source Sprint",
        description: "Спринт по контрибьютам в open source. Менторы помогают выбрать первый таск.",
        date: "2026-11-05 12:00",
        organizer: "IT-Факультет",
        participants: 41,
        teamRequired: false,
        status: 'Ongoing'
    },
    {
        id: 4,
        name: "Кубок по футболу 5x5",
        description: "Уличный турнир между факультетами. Матчи по 15 минут, плей-офф с четвертьфиналов.",
        date: "2026-11-09 16:00",
        organizer: "Спортклуб GRSU",
        participants: 80,
        teamRequired: true,
        status: 'Upcoming'
    },
    {
        id: 5,
        name: "Лекция: как завозить",
        description: "Открытая лекция о проектной работе: от идеи до продакшена. Вход свободный.",
        date: "2026-10-28 19:00",
        organizer: "GRSU Talks",
        participants: 210,
        teamRequired: false,
        status: 'Completed'
    },
    {
        id: 6,
        name: "Game Jam: Casino Mode",
        description: "Джем по созданию мини-игр за 24 часа. Тема объявляется на старте.",
        date: "2026-12-02 09:00",
        organizer: "GRSU Dev Club",
        participants: 96,
        teamRequired: true,
        status: 'Upcoming'
    }
];
</script>

<template>
    <div class="dashboard">
        <!-- !  ================= HEADER ================= -->
        <Header/>

        <!-- ================= EXPLORE EVENTS ================= -->
         <!-- TODO in componetn -->
        <main class="dashboard__main container">
            <section class="explore">
                <div class="explore__head">
                    <h2 class="explore__title">Explore Events</h2>
                    <p class="explore__subtitle">Найди мероприятие, собери состав и завози</p>
                </div>

                <!-- Toolbar: search + filters + sort -->
                 <!-- TODO in component -->
                <div class="explore__toolbar">
                    <SearchInput/>
                    <SelectField/>
                </div>

                <FilterChips/>

                <!-- Events grid -->
                 <!-- TODO compontent -->
                <div class="explore__grid">
                    <EventCard v-for="event in events" :key="event.id" :event="event"/>
                </div>
            </section>
        </main>
    </div>
</template>

<style scoped>
    /* ================= main ================= */
    .dashboard__main {
        padding-top: 48px;
        padding-bottom: 64px;
    }

    .explore__head {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 32px;
    }

    .explore__title {
        font-family: var(--font-main);
        font-weight: 700;
        font-size: 2rem;
        color: #000;
    }

    .explore__subtitle {
        font-family: var(--font-main);
        font-weight: 400;
        color: var(--color-placeholder);
    }

    /* toolbar (layout only, контент — в SearchInput / SelectField) */
    .explore__toolbar {
        display: flex;
        gap: 16px;
        margin-bottom: 20px;
    }

    /* ================= grid (layout only, карточка — в EventCard) ================= */
    .explore__grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }

    /* ================= adaptive ================= */
    @media (max-width: 960px) {
        .explore__toolbar {
            flex-direction: column;
        }
    }

    @media (max-width: 768px) {
        .explore__title {
            font-size: 1.6rem;
        }
    }

    @media (max-width: 480px) {
        .explore__grid {
            grid-template-columns: 1fr;
        }
    }
</style>


