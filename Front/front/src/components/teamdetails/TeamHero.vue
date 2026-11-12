<template>
    <section class="team-hero" aria-labelledby="team-title">
        <div class="team-hero__identity">
            <span class="team-hero__mark" aria-hidden="true">PX</span>
            <div>
                <span class="team-hero__overline">GRSU Hackathon 2026</span>
                <h1 id="team-title">Pixel Pioneers</h1>
                <p>Building playful tools for campus life.</p>
            </div>
        </div>
        <div class="team-hero__meta">
            <span class="team-hero__status">Open for teammates</span>
            <strong>3 / 5 members</strong>
        </div>
    </section>
</template>

<style scoped>
.team-hero {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
    padding: 30px 34px;
    background: var(--color-primary);
    color: var(--color-white);
}

.team-hero__identity {
    display: flex;
    align-items: center;
    gap: 16px;
    min-width: 0;
}

.team-hero__mark {
    display: grid;
    place-items: center;
    width: 58px;
    height: 58px;
    flex-shrink: 0;
    border-radius: var(--radius-lg);
    background: #eee8ff;
    color: #6740c8;
    font-family: var(--font-main);
    font-size: 1rem;
    font-weight: 700;
}

.team-hero__overline {
    color: rgba(255, 255, 255, 0.65);
    font-family: var(--font-main);
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.team-hero h1 {
    margin-top: 6px;
    font-family: var(--font-main);
    font-size: clamp(1.8rem, 3vw, 2.7rem);
    letter-spacing: -0.04em;
    line-height: 1.05;
    text-wrap: balance;
}

.team-hero p {
    margin-top: 8px;
    color: rgba(255, 255, 255, 0.76);
    font-family: var(--font-main);
    font-size: 0.86rem;
}

.team-hero__meta {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 10px;
    flex-shrink: 0;
    font-family: var(--font-main);
}

.team-hero__status {
    padding: 7px 11px;
    border-radius: var(--radius-pill);
    background: var(--color-success-bg);
    color: var(--color-success);
    font-size: 0.7rem;
    font-weight: 700;
}

.team-hero__meta strong {
    font-size: 0.82rem;
    font-weight: 500;
}

@media (max-width: 560px) {
    .team-hero {
        align-items: flex-start;
        flex-direction: column;
        padding: 24px 20px;
    }

    .team-hero__meta {
        align-items: flex-start;
    }
}
</style>
