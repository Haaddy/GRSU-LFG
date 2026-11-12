<script setup lang="ts">
import Header from '../Header.vue';
import TeamBasics from '../createteam/TeamBasics.vue';
import TeamMembers from '../createteam/TeamMembers.vue';
import TeamPreferences from '../createteam/TeamPreferences.vue';
</script>

<template>
    <div class="create-team-page">
        <Header />

        <main class="create-team container">
            <router-link class="back-link" to="/event-details">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Back to event
            </router-link>

            <div class="page-heading">
                <span class="page-heading__overline">GRSU Hackathon 2026</span>
                <h1>Create a team</h1>
                <p>Bring together the people you need to build something great.</p>
            </div>

            <form class="create-team__form" autocomplete="off">
                <div class="create-team__layout">
                    <div class="create-team__steps">
                        <div class="form-step">
                            <span class="form-step__number" aria-hidden="true">1</span>
                            <TeamBasics />
                        </div>
                        <div class="form-step">
                            <span class="form-step__number" aria-hidden="true">2</span>
                            <TeamPreferences />
                        </div>
                        <div class="form-step">
                            <span class="form-step__number" aria-hidden="true">3</span>
                            <TeamMembers />
                        </div>
                    </div>

                    <aside class="team-summary">
                        <span class="team-summary__overline">Creating for</span>
                        <h2>GRSU Hackathon 2026</h2>
                        <p>48-hour hackathon for games and web applications.</p>
                        <div class="team-summary__meta">
                            <span>2–5 people per team</span>
                            <span>32 spots remaining</span>
                        </div>
                        <p class="team-summary__note">
                            You can update your team details and invite teammates after creating it.
                        </p>
                    </aside>
                </div>

                <div class="create-team__actions">
                    <router-link class="button button--cancel" to="/event-details">Cancel</router-link>
                    <button class="button button--create" type="submit">Create team</button>
                </div>
            </form>
        </main>
    </div>
</template>

<style scoped>
.create-team-page {
    min-height: 100vh;
    background: var(--color-white);
    color: var(--color-text);
}

.create-team {
    padding-top: 30px;
    padding-bottom: 80px;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 30px;
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

.page-heading {
    max-width: 620px;
    margin: 0 auto 32px;
    text-align: center;
}

.page-heading__overline {
    display: block;
    margin-bottom: 9px;
    color: var(--color-primary);
    font-family: var(--font-main);
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.page-heading h1 {
    color: var(--color-text);
    font-family: var(--font-main);
    font-size: clamp(1.8rem, 3vw, 2.5rem);
    font-weight: 700;
    letter-spacing: -0.04em;
    line-height: 1.05;
}

.page-heading p {
    margin-top: 12px;
    color: var(--color-text-secondary);
    font-family: var(--font-main);
    font-size: 0.9rem;
}

.create-team__form {
    max-width: 960px;
    margin: 0 auto;
}

.create-team__layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr);
    gap: 48px;
    align-items: start;
    width: 100%;
    min-width: 0;
}

.create-team__steps {
    display: flex;
    flex-direction: column;
    gap: 48px;
    min-width: 0;
}

.form-step {
    display: grid;
    grid-template-columns: 34px minmax(0, 1fr);
    gap: 16px;
    position: relative;
}

.form-step:not(:last-child)::after {
    content: "";
    position: absolute;
    top: 34px;
    bottom: -48px;
    left: 16px;
    width: 1px;
    background: var(--color-border);
}

.form-step__number {
    position: relative;
    z-index: 1;
    display: grid;
    place-items: center;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: var(--color-primary-light);
    color: var(--color-primary);
    font-family: var(--font-main);
    font-size: 0.78rem;
    font-weight: 700;
}

.team-summary {
    width: 95%;
    max-width: 100%;
    min-width: 0;
    justify-self: end;
    padding: 24px;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    background: var(--color-primary-light);
}

.team-summary__overline {
    color: var(--color-primary);
    font-family: var(--font-main);
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.team-summary h2 {
    margin-top: 8px;
    color: var(--color-text);
    font-family: var(--font-main);
    font-size: 1.1rem;
}

.team-summary p {
    margin-top: 8px;
    color: var(--color-text-secondary);
    font-family: var(--font-main);
    font-size: 0.82rem;
    line-height: 1.5;
}

.team-summary__meta {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 18px;
}

.team-summary__meta span {
    padding: 7px 10px;
    border-radius: var(--radius-pill);
    background: var(--color-white);
    color: var(--color-primary);
    font-family: var(--font-main);
    font-size: 0.7rem;
    font-weight: 700;
}

.team-summary__note {
    padding-top: 16px;
    border-top: 1px solid var(--color-border);
}

.create-team__actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 46px;
    padding-top: 24px;
    border-top: 1px solid var(--color-border-light);
}

.button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 48px;
    padding: 12px 24px;
    border-radius: var(--radius-lg);
    font-family: var(--font-main);
    font-size: 0.88rem;
    font-weight: 700;
    transition: background-color var(--transition-fast), color var(--transition-fast), border-color var(--transition-fast), transform var(--transition-fast);
}

.button:hover {
    transform: translateY(-1px);
}

.button:focus-visible,
.back-link:focus-visible {
    outline: 3px solid rgba(0, 122, 255, 0.25);
    outline-offset: 3px;
}

.button--cancel {
    border: 1px solid var(--color-border);
    color: var(--color-text-secondary);
}

.button--create {
    border: 1px solid var(--color-black);
    background: var(--color-black);
    color: var(--color-white);
    cursor: pointer;
}

.button--create:hover {
    background: var(--color-primary);
    border-color: var(--color-primary);
}

@media (max-width: 560px) {
    .create-team {
        padding-top: 22px;
        padding-bottom: 50px;
    }

    .page-heading {
        margin-bottom: 26px;
    }

    .create-team__steps {
        gap: 36px;
    }

    .form-step {
        grid-template-columns: 28px minmax(0, 1fr);
        gap: 10px;
    }

    .form-step:not(:last-child)::after {
        left: 13px;
        bottom: -36px;
    }

    .form-step__number {
        width: 28px;
        height: 28px;
        font-size: 0.7rem;
    }

    .create-team__actions {
        justify-content: stretch;
    }

    .button {
        flex: 1;
        padding-right: 16px;
        padding-left: 16px;
    }
}
</style>
