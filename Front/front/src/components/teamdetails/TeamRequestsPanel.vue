<template>
    <section class="panel requests-panel" aria-labelledby="requests-title">
        <div class="section-heading">
            <div>
                <span class="section-heading__overline">Manage your team</span>
                <h2 id="requests-title">Join requests <span class="count">2</span></h2>
            </div>
        </div>

        <article class="request-card">
            <span class="request-card__avatar" aria-hidden="true">S</span>
            <div class="request-card__content">
                <strong>Sofia Ivanova</strong>
                <span>Frontend developer · React, TypeScript</span>
                <p>“I would love to help turn the idea into a polished product.”</p>
            </div>
            <div class="request-card__actions">
                <button class="button button--small button--outline" type="button">Decline</button>
                <button class="button button--small button--accept" type="button">Accept</button>
            </div>
        </article>

        <article class="request-card">
            <span class="request-card__avatar request-card__avatar--orange" aria-hidden="true">K</span>
            <div class="request-card__content">
                <strong>Kirill Petrov</strong>
                <span>Product · Prototyping, research</span>
                <p>“I have experience with student-focused web products.”</p>
            </div>
            <div class="request-card__actions">
                <button class="button button--small button--outline" type="button">Decline</button>
                <button class="button button--small button--accept" type="button">Accept</button>
            </div>
        </article>
    </section>
</template>

<style scoped>
.panel {
    padding: 34px 0;
}

.section-heading {
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

.request-card {
    display: grid;
    grid-template-columns: auto minmax(0, 1fr) auto;
    gap: 12px;
    align-items: start;
    padding: 17px 0;
    border-top: 1px solid var(--color-border-light);
}

.request-card__avatar {
    display: grid;
    place-items: center;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #e7e9f7;
    color: var(--color-primary);
    font-family: var(--font-main);
    font-size: 0.8rem;
    font-weight: 700;
}

.request-card__avatar--orange {
    background: #fff0dd;
    color: #c76b10;
}

.request-card__content {
    min-width: 0;
}

.request-card__content strong,
.request-card__content span,
.request-card__content p {
    display: block;
    font-family: var(--font-main);
}

.request-card__content strong {
    color: var(--color-text);
    font-size: 0.86rem;
}

.request-card__content span {
    margin-top: 3px;
    color: var(--color-text-secondary);
    font-size: 0.74rem;
}

.request-card__content p {
    margin-top: 8px;
    color: var(--color-text-secondary);
    font-size: 0.78rem;
    line-height: 1.45;
}

.request-card__actions {
    display: flex;
    gap: 8px;
}

.button {
    border-radius: var(--radius-md);
    cursor: pointer;
    font-family: var(--font-main);
    font-weight: 700;
}

.button--small {
    padding: 8px 11px;
    font-size: 0.72rem;
}

.button--outline {
    border: 1px solid var(--color-border);
    background: var(--color-white);
    color: var(--color-primary);
}

.button--accept {
    border: 1px solid var(--color-primary);
    background: var(--color-primary);
    color: var(--color-white);
}

.button:focus-visible {
    outline: 3px solid rgba(0, 122, 255, 0.25);
    outline-offset: 3px;
}

@media (max-width: 620px) {
    .request-card {
        grid-template-columns: auto minmax(0, 1fr);
    }

    .request-card__actions {
        grid-column: 2;
    }
}
</style>
