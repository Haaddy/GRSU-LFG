<script setup lang="ts">
import TeamMemberRow from './TeamMemberRow.vue';
</script>

<template>
    <section class="panel" aria-labelledby="members-title">
        <div class="section-heading">
            <div>
                <span class="section-heading__overline">The crew</span>
                <h2 id="members-title">Team members <span class="count">3</span></h2>
            </div>
            <button class="text-button" type="button">Invite teammates</button>
        </div>

        <div class="member-list">
            <TeamMemberRow initial="A" name="Alex Morozov" role="Captain" />
            <TeamMemberRow initial="M" name="Maria Sidorova" role="Designer" color="green" can-kick />
            <TeamMemberRow initial="D" name="Denis Kim" role="Developer" color="pink" can-kick />
        </div>
    </section>
</template>

<style scoped>
.panel {
    padding: 34px 0;
    border-bottom: 1px solid var(--color-border);
}

.member-list {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 12px 24px;
}

.section-heading {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 18px;
    margin-bottom: 8px;
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
    color: var(--color-text);
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
    background: var(--color-primary-light);
    color: var(--color-primary);
    font-size: 0.72rem;
    vertical-align: 2px;
}

.text-button {
    padding: 5px 0;
    border: 0;
    background: transparent;
    color: var(--color-primary);
    cursor: pointer;
    font-family: var(--font-main);
    font-size: 0.8rem;
    font-weight: 700;
}

.text-button:focus-visible {
    outline: 3px solid rgba(0, 122, 255, 0.25);
    outline-offset: 3px;
}

@media (max-width: 700px) {
    .member-list {
        grid-template-columns: 1fr;
    }
}
</style>
