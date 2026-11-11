<template>
    <section class="panel registration-panel" aria-labelledby="registration-title">
        <div class="registration-panel__header">
            <span class="section-heading__overline">Your participation</span>
            <span class="registration-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 6 9 17l-5-5" /></svg>
            </span>
        </div>
        <h2 id="registration-title">Join the hackathon</h2>
        <p class="registration-panel__description">
            Create a team or join an existing one to reserve your spot.
        </p>
        <div class="spots">
            <div class="spots__label"><span>Places remaining</span><strong>32 spots</strong></div>
            <div class="progress"><span></span></div>
            <div class="spots__caption"><span>128 registered</span><span>160 max</span></div>
        </div>
        <button class="button button--primary button--wide" type="button">Create a team</button>
        <button class="button button--ghost button--wide" type="button">I’ll join a team</button>
        <p class="registration-note">
            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9" /><path d="M12 11v5M12 8h.01" /></svg>
            You can change your team before registration closes.
        </p>
    </section>
</template>

<style scoped>
.panel {
    border-bottom: 0;
}

.registration-panel {
    margin-top: 28px;
    padding: 25px;
    border: 1px solid #dfe1f2;
    border-radius: 16px;
    background: #f7f8ff;
}

.registration-panel__header,
.organizer-panel__title {
    display: flex;
    align-items: center;
    gap: 11px;
}

.registration-panel__header {
    justify-content: space-between;
    margin-bottom: 10px;
}

.section-heading__overline {
    display: block;
    color: var(--color-text-muted);
    font-family: var(--font-main);
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.registration-icon {
    display: grid;
    place-items: center;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #d7f6df;
    color: #1d7b3b;
}

.registration-icon svg {
    width: 16px;
    height: 16px;
    fill: none;
    stroke: currentColor;
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-width: 2;
}

.registration-panel h2 {
    margin-bottom: 7px;
    font-family: var(--font-main);
    font-size: 1.2rem;
}

.registration-panel__description {
    margin-bottom: 23px;
    color: #757575;
    font-family: var(--font-main);
    font-size: 0.82rem;
    line-height: 1.5;
}

.spots {
    margin-bottom: 21px;
}

.spots__label,
.spots__caption {
    display: flex;
    justify-content: space-between;
    color: #727272;
    font-family: var(--font-main);
    font-size: 0.72rem;
}

.spots__label {
    margin-bottom: 9px;
}

.spots__label strong {
    color: var(--color-primary);
    font-size: 0.78rem;
}

.progress {
    height: 7px;
    overflow: hidden;
    border-radius: var(--radius-pill);
    background: #e1e3f0;
}

.progress span {
    display: block;
    width: 80%;
    height: 100%;
    border-radius: inherit;
    background: var(--color-primary);
}

.spots__caption {
    margin-top: 7px;
    color: #9b9b9b;
    font-size: 0.68rem;
}

.button--wide {
    width: 100%;
}

.registration-panel .button--primary {
    margin-bottom: 9px;
    background: var(--color-primary);
    color: #fff;
}

.button--ghost {
    padding: 11px 20px;
    border: 1px solid #d9dbea;
    background: transparent;
    color: var(--color-primary);
}

.registration-note {
    display: flex;
    gap: 6px;
    align-items: flex-start;
    margin-top: 17px;
    color: #888;
    font-family: var(--font-main);
    font-size: 0.68rem;
    line-height: 1.45;
}

.registration-note svg {
    width: 14px;
    height: 14px;
    flex: 0 0 auto;
    fill: none;
    stroke: currentColor;
    stroke-linecap: round;
    stroke-width: 1.7;
}
</style>


