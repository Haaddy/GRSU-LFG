<template>
    <section class="panel organizer-panel" aria-labelledby="organizer-title">
        <div class="organizer-panel__title">
            <span class="avatar">G</span>
            <div>
                <span class="section-heading__overline">Organized by</span>
                <h2 id="organizer-title">GRSU Dev Club</h2>
            </div>
        </div>
        <p>Student community for builders, designers and tech enthusiasts.</p>
        <router-link to="/profile" class="text-button">
            View organizer profile
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
        </router-link>
    </section>
</template>

<style scoped>
.panel {
    border-bottom: 0;
}

.organizer-panel {
    padding: 30px 0;
}

.organizer-panel__title {
    display: flex;
    align-items: center;
    gap: 11px;
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

.organizer-panel h2 {
    font-family: var(--font-main);
    font-size: 0.94rem;
}

.avatar {
    display: inline-grid;
    place-items: center;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: var(--color-primary);
    color: #fff;
    font-family: var(--font-main);
    font-size: 0.8rem;
    font-weight: 700;
}

.organizer-panel p {
    margin: 15px 0 12px 49px;
    color: #858585;
    font-family: var(--font-main);
    font-size: 0.77rem;
    line-height: 1.5;
}

.text-button {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    margin-left: 49px;
    padding: 5px 0;
    color: var(--color-primary);
    font-family: var(--font-main);
    font-size: 0.8rem;
    font-weight: 700;
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
</style>


