<script setup lang="ts">
import TeamCard from './TeamCard.vue';
</script>

<template>
    <section class="panel" aria-labelledby="teams-title">
        <div class="section-heading">
            <div>
                <span class="section-heading__overline">Find your crew</span>
                <h2 id="teams-title">Existing teams <span class="count">8</span></h2>
            </div>
            <button class="text-button" type="button">
                See all teams
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
            </button>
        </div>

        <div class="team-list">
            <TeamCard
                initials="PX"
                color="purple"
                name="Pixel Pioneers"
                details-to="/team-details/pixel-pioneers"
                description="Building playful tools for campus life"
                capacity="3 / 5"
                captain-initial="A"
                captain-name="Alex Morozov"
            />
            <TeamCard
                initials="NW"
                color="orange"
                name="Next Wave"
                description="AI-powered study companion"
                capacity="4 / 5"
                captain-initial="M"
                captain-name="Maria Sidorova"
                captain-color="green"
            />
            <TeamCard
                initials="GC"
                color="blue"
                name="Green Code"
                description="Making sustainable choices easier"
                capacity="2 / 5"
                captain-initial="D"
                captain-name="Denis Kim"
                captain-color="pink"
            />
        </div>
    </section>
</template>

<style scoped>
.panel {
    padding: 34px 0;
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

.count {
    display: inline-grid;
    place-items: center;
    min-width: 24px;
    height: 24px;
    margin-left: 5px;
    padding: 0 6px;
    border-radius: var(--radius-pill);
    background: #f0f1f7;
    color: var(--color-primary);
    font-size: 0.72rem;
    vertical-align: 2px;
}

.text-button {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 0;
    border: 0;
    background: transparent;
    color: var(--color-primary);
    cursor: pointer;
    font-family: var(--font-main);
    font-size: 0.8rem;
    font-weight: 700;
}

.text-button:hover {
    color: var(--color-primary);
}

.text-button svg {
    width: 15px;
    height: 15px;
    fill: none;
    stroke: currentColor;
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-width: 1.8;
}

.team-list {
    display: grid;
}

@media (max-width: 560px) {
    .panel {
        padding: 25px 0;
    }

    .section-heading {
        flex-direction: column;
        gap: 8px;
    }
}
</style>
