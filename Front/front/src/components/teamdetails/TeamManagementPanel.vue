<template>
    <section class="management-panel" aria-labelledby="management-title">
        <span class="section-heading__overline">Team settings</span>
        <h2 id="management-title">Manage team</h2>
        <p>Keep your team details current as your idea takes shape.</p>
        <div class="management-panel__actions">
            <button class="button button--outline" type="button">Edit team</button>
            <button class="button button--outline" type="button">Invite teammates</button>
        </div>
        <button class="danger-button" type="button">Disband team</button>
    </section>
</template>

<style scoped>
.management-panel {
    padding: 25px;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    background: var(--color-primary-light);
}

.section-heading__overline {
    color: var(--color-primary);
    font-family: var(--font-main);
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

h2 {
    margin-top: 8px;
    color: var(--color-text);
    font-family: var(--font-main);
    font-size: 1.2rem;
}

p {
    margin-top: 7px;
    color: var(--color-text-secondary);
    font-family: var(--font-main);
    font-size: 0.8rem;
    line-height: 1.5;
}

.management-panel__actions {
    display: grid;
    gap: 9px;
    margin-top: 20px;
}

.button,
.danger-button {
    min-height: 40px;
    padding: 9px 13px;
    border-radius: var(--radius-md);
    cursor: pointer;
    font-family: var(--font-main);
    font-size: 0.78rem;
    font-weight: 700;
}

.button--outline {
    border: 1px solid var(--color-border);
    background: var(--color-white);
    color: var(--color-primary);
}

.danger-button {
    width: 100%;
    margin-top: 16px;
    border: 0;
    background: transparent;
    color: #b42318;
}

.button:focus-visible,
.danger-button:focus-visible {
    outline: 3px solid rgba(0, 122, 255, 0.25);
    outline-offset: 3px;
}
</style>
