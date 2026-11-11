<script setup lang="ts">
import Header from '../Header.vue';
import EventAbout from '../eventdetails/EventAbout.vue';
import EventHero from '../eventdetails/EventHero.vue';
import OrganizerPanel from '../eventdetails/OrganizerPanel.vue';
import RegistrationPanel from '../eventdetails/RegistrationPanel.vue';
import TeamsSection from '../eventdetails/TeamsSection.vue';
</script>

<template>
    <div class="event-details">
        <Header />

        <main class="event-details__main container">
            <router-link class="back-link" to="/dashboard">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Back to events
            </router-link>

            <EventHero />

            <div class="event-layout">
                <div class="event-layout__primary">
                    <EventAbout />
                    <TeamsSection />
                </div>

                <aside class="event-layout__aside">
                    <RegistrationPanel />
                    <OrganizerPanel />
                </aside>
            </div>
        </main>
    </div>
</template>

<style scoped>
.event-details {
    min-height: 100vh;
    background: #fff;
    color: #101010;
}

.event-details__main {
    padding-top: 30px;
    padding-bottom: 80px;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 26px;
    color: #686868;
    font-family: var(--font-main);
    font-size: 0.88rem;
    font-weight: 500;
}

.back-link:hover {
    color: var(--color-primary);
}

.back-link svg {
    width: 18px;
    height: 18px;
    fill: none;
    stroke: currentColor;
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-width: 1.8;
}

:deep(.button) {
    border: 0;
    border-radius: var(--radius-md);
    cursor: pointer;
    font-family: var(--font-main);
    font-size: 0.88rem;
    font-weight: 700;
    transition: transform 160ms ease, box-shadow 160ms ease, background 160ms ease;
}

:deep(.button:hover) {
    transform: translateY(-1px);
}

:deep(.button--primary) {
    background: #fff;
    color: var(--color-primary);
    padding: 13px 20px;
}

:deep(.button--primary:hover) {
    box-shadow: 0 7px 18px rgba(0, 0, 0, 0.16);
}

:deep(.button--secondary) {
    padding: 12px 20px;
    border: 1px solid rgba(255, 255, 255, 0.35);
    background: transparent;
    color: #fff;
}

:deep(.button--small) {
    padding: 8px 11px;
    font-size: 0.72rem;
}

:deep(.button--outline) {
    border: 1px solid #d6d8e6;
    background: #fff;
    color: var(--color-primary);
}

:deep(.button--wide) {
    width: 100%;
}

:deep(.button--ghost) {
    padding: 11px 20px;
    border: 1px solid #d9dbea;
    background: transparent;
    color: var(--color-primary);
}

.event-layout {
    display: grid;
    grid-template-columns: minmax(0, 1.42fr) minmax(310px, 0.78fr);
    gap: 64px;
    align-items: start;
    margin-top: 24px;
}

.event-layout__primary,
.event-layout__aside {
    display: flex;
    flex-direction: column;
    gap: 0;
    min-width: 0;
}

@media (max-width: 1050px) {
    .event-layout {
        grid-template-columns: minmax(0, 1fr) 320px;
    }
}

@media (max-width: 820px) {
    .event-layout {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 560px) {
    .event-details__main {
        padding-top: 20px;
        padding-bottom: 48px;
    }
}
</style>


