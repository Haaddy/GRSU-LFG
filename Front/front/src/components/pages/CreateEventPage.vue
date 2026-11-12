<script setup lang="ts">
import Header from '../Header.vue';
import EventBasics from '../CreateEvent/EventBasics.vue';
import EventSchedule from '../CreateEvent/EventSchedule.vue';
import EventParticipation from '../CreateEvent/EventParticipation.vue';
</script>

<template>
    <div class="create-event-page">
        <Header />

        <main class="create-event container">
            <router-link class="back-link" to="/dashboard">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Back to events
            </router-link>

            <div class="page-heading">
                <span class="page-heading__overline">Organize something great</span>
                <h1>Create Event</h1>
                <p>Set up your event and find the right participants.</p>
            </div>

            <form class="create-event__form" autocomplete="off">
                <div class="create-event__layout">
                    <div class="create-event__steps">
                        <div class="form-step">
                            <span class="form-step__number" aria-hidden="true">1</span>
                            <EventBasics />
                        </div>
                        <div class="form-step">
                            <span class="form-step__number" aria-hidden="true">2</span>
                            <EventSchedule />
                        </div>
                        <div class="form-step">
                            <span class="form-step__number" aria-hidden="true">3</span>
                            <EventParticipation />
                        </div>
                    </div>

                    <section class="tip-panel" aria-labelledby="tip-title">
                        <span class="tip-panel__mark" aria-hidden="true">i</span>
                        <div>
                            <h2 id="tip-title">Make it easy to join</h2>
                            <p>A clear description, realistic limits and a precise location help participants decide faster.</p>
                        </div>
                    </section>
                </div>

                <div class="create-event__actions">
                    <router-link class="button button--cancel" to="/dashboard">Cancel</router-link>
                    <button class="button button--create" type="button">Create event</button>
                </div>
            </form>
        </main>
    </div>
</template>

<style scoped>
.create-event-page {
    min-height: 100vh;
    background: #fff;
    color: var(--color-text);
}

.create-event {
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
    text-wrap: balance;
}

.page-heading p {
    margin-top: 12px;
    color: var(--color-text-secondary);
    font-family: var(--font-main);
    font-size: 0.9rem;
}

.create-event__layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr);
    gap: 48px;
    align-items: start;
}

.create-event__form {
    max-width: 960px;
    margin: 0 auto;
}

.create-event__steps {
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

.tip-panel {
    display: flex;
    align-items: flex-start;
    gap: 13px;
    padding: 20px;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    background: var(--color-primary-light);
}

.tip-panel__mark {
    display: grid;
    flex: 0 0 auto;
    place-items: center;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: var(--color-primary);
    color: #fff;
    font-family: Georgia, serif;
    font-size: 0.85rem;
    font-weight: 700;
}

.tip-panel h2 {
    color: var(--color-text);
    font-family: var(--font-main);
    font-size: 0.9rem;
    font-weight: 700;
}

.tip-panel p {
    margin-top: 6px;
    color: var(--color-text-secondary);
    font-family: var(--font-main);
    font-size: 0.8rem;
    line-height: 1.5;
}

.create-event__actions {
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

.button--cancel:hover {
    border-color: var(--color-input-focus);
    color: var(--color-text);
}

.button--create {
    border: 1px solid var(--color-black);
    background: var(--color-black);
    color: #fff;
    cursor: pointer;
}

.button--create:hover {
    background: var(--color-primary);
    border-color: var(--color-primary);
}

@media (max-width: 560px) {
    .create-event {
        padding-top: 22px;
        padding-bottom: 50px;
    }

    .page-heading {
        margin-bottom: 26px;
    }

    .create-event__steps {
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

    .create-event__actions {
        justify-content: stretch;
    }

    .button {
        flex: 1;
        padding-right: 16px;
        padding-left: 16px;
    }
}
</style>
