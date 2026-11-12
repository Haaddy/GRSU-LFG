<script setup lang="ts">
import Header from '../Header.vue';
import TeamHero from '../teamdetails/TeamHero.vue';
import TeamMembersPanel from '../teamdetails/TeamMembersPanel.vue';
import TeamRequestsPanel from '../teamdetails/TeamRequestsPanel.vue';
</script>

<template>
    <div class="team-details-page">
        <Header />

        <main class="team-details container">
            <router-link class="back-link" to="/event-details">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Back to event
            </router-link>

            <TeamHero />

            <div class="team-details__layout">
                <div class="team-details__primary">
                    <TeamMembersPanel />
                    <TeamRequestsPanel />
                </div>
            </div>
        </main>
    </div>
</template>

<style scoped>
.team-details-page {
    min-height: 100vh;
    background: var(--color-white);
    color: var(--color-text);
}

.team-details {
    padding-top: 30px;
    padding-bottom: 80px;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 26px;
    color: var(--color-text-secondary);
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

.team-details__layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr);
    align-items: start;
    margin-top: 24px;
}

.team-details__primary {
    display: flex;
    flex-direction: column;
    gap: 0;
    min-width: 0;
}

@media (max-width: 900px) {
    .team-details__layout {
        gap: 24px;
    }
}

@media (max-width: 560px) {
    .team-details {
        padding-top: 20px;
        padding-bottom: 48px;
    }
}
</style>
