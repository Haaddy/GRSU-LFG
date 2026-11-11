<script setup lang="ts">
import DashboardHeader from '../dashboard/DashboardHeader.vue';
</script>

<template>
    <div class="event-details">
        <DashboardHeader />

        <main class="event-details__main container">
            <router-link class="back-link" to="/dashboard">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Back to events
            </router-link>

            <section class="event-hero" aria-labelledby="event-title">
                <div class="event-hero__content">
                    <div class="event-hero__eyebrow">
                        <span class="status status--upcoming">Upcoming</span>
                        <span class="event-type">Team event</span>
                    </div>
                    <h1 id="event-title">GRSU Hackathon 2026</h1>
                    <p class="event-hero__lead">
                        48-часовой хакатон по разработке игр и веб-приложений.
                        Соберите команду, создайте прототип и поборитесь за главный приз.
                    </p>
                    <div class="event-hero__actions">
                        <button class="button button--primary" type="button">Create team</button>
                        <button class="button button--secondary" type="button">View teams</button>
                    </div>
                </div>

                <div class="event-hero__summary">
                    <div class="summary-item">
                        <span class="summary-item__icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="3" y="4" width="18" height="17" rx="2" />
                                <path d="M16 2v4M8 2v4M3 10h18" />
                            </svg>
                        </span>
                        <div>
                            <span class="summary-item__label">Starts</span>
                            <strong>14 Nov 2026, 10:00</strong>
                        </div>
                    </div>
                    <div class="summary-item">
                        <span class="summary-item__icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z" />
                                <circle cx="12" cy="10" r="2.5" />
                            </svg>
                        </span>
                        <div>
                            <span class="summary-item__label">Location</span>
                            <strong>GRSU Innovation Hub</strong>
                        </div>
                    </div>
                    <div class="summary-item">
                        <span class="summary-item__icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </span>
                        <div>
                            <span class="summary-item__label">Participants</span>
                            <strong>128 / 160 registered</strong>
                        </div>
                    </div>
                </div>
            </section>

            <div class="event-layout">
                <div class="event-layout__primary">
                    <section class="panel panel--about" aria-labelledby="about-title">
                        <div class="section-heading">
                            <div>
                                <span class="section-heading__overline">The challenge</span>
                                <h2 id="about-title">About this event</h2>
                            </div>
                            <span class="created-date">Created 24 Sep 2026</span>
                        </div>
                        <p>
                            GRSU Hackathon — это возможность за одни выходные пройти путь от
                            идеи до работающего продукта. Работайте вместе с другими студентами,
                            получайте советы от менторов и представьте результат жюри.
                        </p>
                        <p>
                            Подойдут проекты в любой сфере: от игр и образовательных сервисов до
                            инструментов для кампуса. Участники могут использовать любые технологии.
                        </p>
                        <div class="event-facts">
                            <div class="event-fact">
                                <span class="event-fact__label">Organizer</span>
                                <strong>GRSU Dev Club</strong>
                            </div>
                            <div class="event-fact">
                                <span class="event-fact__label">Team size</span>
                                <strong>2–5 people</strong>
                            </div>
                            <div class="event-fact">
                                <span class="event-fact__label">Format</span>
                                <strong>On-site</strong>
                            </div>
                        </div>
                    </section>

                    <section class="panel" aria-labelledby="teams-title">
                        <div class="section-heading">
                            <div>
                                <span class="section-heading__overline">Find your crew</span>
                                <h2 id="teams-title">Existing teams <span class="count">8</span></h2>
                            </div>
                            <button class="text-button" type="button">See all teams
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                            </button>
                        </div>

                        <div class="team-list">
                            <article class="team-card">
                                <div class="team-card__top">
                                    <div class="team-card__identity">
                                        <span class="team-mark team-mark--purple">PX</span>
                                        <div>
                                            <h3>Pixel Pioneers</h3>
                                            <p>Building playful tools for campus life</p>
                                        </div>
                                    </div>
                                    <span class="team-capacity">3 / 5</span>
                                </div>
                                <div class="team-card__bottom">
                                    <span class="captain"><span class="avatar avatar--small">A</span> Captain: Alex Morozov</span>
                                    <button class="button button--small button--outline" type="button">Request to join</button>
                                </div>
                            </article>
                            <article class="team-card">
                                <div class="team-card__top">
                                    <div class="team-card__identity">
                                        <span class="team-mark team-mark--orange">NW</span>
                                        <div>
                                            <h3>Next Wave</h3>
                                            <p>AI-powered study companion</p>
                                        </div>
                                    </div>
                                    <span class="team-capacity">4 / 5</span>
                                </div>
                                <div class="team-card__bottom">
                                    <span class="captain"><span class="avatar avatar--small avatar--green">M</span> Captain: Maria Sidorova</span>
                                    <button class="button button--small button--outline" type="button">Request to join</button>
                                </div>
                            </article>
                            <article class="team-card">
                                <div class="team-card__top">
                                    <div class="team-card__identity">
                                        <span class="team-mark team-mark--blue">GC</span>
                                        <div>
                                            <h3>Green Code</h3>
                                            <p>Making sustainable choices easier</p>
                                        </div>
                                    </div>
                                    <span class="team-capacity">2 / 5</span>
                                </div>
                                <div class="team-card__bottom">
                                    <span class="captain"><span class="avatar avatar--small avatar--pink">D</span> Captain: Denis Kim</span>
                                    <button class="button button--small button--outline" type="button">Request to join</button>
                                </div>
                            </article>
                        </div>
                    </section>
                </div>

                <aside class="event-layout__aside">
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

                    <section class="panel organizer-panel" aria-labelledby="organizer-title">
                        <div class="organizer-panel__title">
                            <span class="avatar">G</span>
                            <div>
                                <span class="section-heading__overline">Organized by</span>
                                <h2 id="organizer-title">GRSU Dev Club</h2>
                            </div>
                        </div>
                        <p>Student community for builders, designers and tech enthusiasts.</p>
                        <router-link to="/profile" class="text-button">View organizer profile
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                        </router-link>
                    </section>

                </aside>
            </div>
        </main>
    </div>
</template>

<style scoped>
    .event-details {
        min-height: 100vh;
        background: #fff;
        color: #101010;
    }

    .event-details__main {
        padding-top: 30px;
        padding-bottom: 80px;
    }

    .back-link,
    .text-button,
    .captain,
    .registration-note,
    .event-type,
    .created-date,
    .section-heading__overline,
    .summary-item__label,
    .event-fact__label,
    .spots__label,
    .spots__caption,
    .manage-action {
        font-family: var(--main-font);
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 26px;
        color: #686868;
        font-size: 0.88rem;
        font-weight: 500;
    }

    .back-link:hover,
    .text-button:hover {
        color: #121b68;
    }

    .back-link svg,
    .text-button svg {
        width: 18px;
        height: 18px;
        fill: none;
        stroke: currentColor;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-width: 1.8;
    }

    .event-hero {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 370px;
        gap: 52px;
        align-items: center;
        padding: 38px 42px;
        border-radius: 0;
        background: #121b68;
        color: #fff;
        overflow: hidden;
        position: relative;
    }

    .event-hero::after {
        content: "";
        position: absolute;
        width: 440px;
        height: 440px;
        right: 12%;
        top: -300px;
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 50%;
        box-shadow: 0 0 0 70px rgba(255, 255, 255, 0.035), 0 0 0 140px rgba(255, 255, 255, 0.025);
        pointer-events: none;
    }

    .event-hero__content,
    .event-hero__summary {
        position: relative;
        z-index: 1;
    }

    .event-hero__eyebrow {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 22px;
    }

    .status,
    .event-type {
        display: inline-flex;
        align-items: center;
        width: fit-content;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .status {
        padding: 7px 12px;
    }

    .status--upcoming {
        background: #d7f6df;
        color: #1d7b3b;
    }

    .event-type {
        color: rgba(255, 255, 255, 0.62);
    }

    .event-hero h1 {
        max-width: 650px;
        margin-bottom: 13px;
        font-family: var(--main-font);
        font-size: clamp(2.2rem, 4vw, 3.55rem);
        font-weight: 700;
        letter-spacing: -0.05em;
        line-height: 1.05;
    }

    .event-hero__lead {
        max-width: 635px;
        color: rgba(255, 255, 255, 0.76);
        font-family: var(--main-font);
        font-size: 1rem;
        line-height: 1.65;
    }

    .event-hero__actions {
        display: flex;
        gap: 12px;
        margin-top: 28px;
    }

    .button {
        border: 0;
        border-radius: 10px;
        cursor: pointer;
        font-family: var(--main-font);
        font-size: 0.88rem;
        font-weight: 700;
        transition: transform 160ms ease, box-shadow 160ms ease, background 160ms ease;
    }

    .button:hover {
        transform: translateY(-1px);
    }

    .button--primary {
        background: #fff;
        color: #121b68;
        padding: 13px 20px;
    }

    .button--primary:hover {
        box-shadow: 0 7px 18px rgba(0, 0, 0, 0.16);
    }

    .button--secondary {
        padding: 12px 20px;
        border: 1px solid rgba(255, 255, 255, 0.35);
        background: transparent;
        color: #fff;
    }

    .event-hero__summary {
        display: flex;
        flex-direction: column;
        gap: 19px;
        padding: 22px 0 22px 34px;
        border-left: 1px solid rgba(255, 255, 255, 0.18);
    }

    .summary-item {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .summary-item__icon {
        display: grid;
        place-items: center;
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.12);
    }

    .summary-item svg {
        width: 18px;
        height: 18px;
        fill: none;
        stroke: #fff;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-width: 1.8;
    }

    .summary-item__label {
        display: block;
        margin-bottom: 3px;
        color: rgba(255, 255, 255, 0.56);
        font-size: 0.72rem;
    }

    .summary-item strong {
        font-family: var(--main-font);
        font-size: 0.88rem;
        font-weight: 500;
    }

    .event-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.42fr) minmax(310px, 0.78fr);
        gap: 64px;
        align-items: start;
        margin-top: 24px;
    }

    .event-layout__primary,
    .event-layout__aside {
        display: flex;
        flex-direction: column;
        gap: 0;
        min-width: 0;
    }

    .panel {
        padding: 34px 0;
        border: 0;
        border-bottom: 1px solid #e8e8e8;
        border-radius: 0;
        background: transparent;
    }

    .event-layout__primary .panel:first-child {
        padding-top: 28px;
    }

    .event-layout__primary .panel:last-child,
    .event-layout__aside .panel:last-child {
        border-bottom: 0;
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
        color: #878787;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    h2,
    h3 {
        font-family: var(--main-font);
    }

    h2 {
        font-size: 1.35rem;
        letter-spacing: -0.03em;
    }

    .panel--about > p {
        max-width: 760px;
        margin-bottom: 14px;
        color: #656565;
        font-family: var(--main-font);
        font-size: 0.91rem;
        line-height: 1.65;
    }

    .created-date {
        padding-top: 5px;
        color: #8a8a8a;
        font-size: 0.76rem;
        white-space: nowrap;
    }

    .event-facts {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-top: 26px;
        padding-top: 22px;
        border-top: 1px solid #ededed;
    }

    .event-fact {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .event-fact__label {
        color: #929292;
        font-size: 0.75rem;
    }

    .event-fact strong {
        font-family: var(--main-font);
        font-size: 0.88rem;
        font-weight: 700;
    }

    .count {
        display: inline-grid;
        place-items: center;
        min-width: 24px;
        height: 24px;
        margin-left: 5px;
        padding: 0 6px;
        border-radius: 999px;
        background: #f0f1f7;
        color: #121b68;
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
        color: #121b68;
        cursor: pointer;
        font-size: 0.8rem;
        font-weight: 700;
    }

    .text-button svg {
        width: 15px;
        height: 15px;
    }

    .team-list {
        display: grid;
        gap: 0;
    }

    .team-card {
        padding: 18px 0;
        border: 0;
        border-top: 1px solid #ededed;
        border-radius: 0;
    }

    .team-card:first-child {
        border-top: 0;
    }

    .team-card__top,
    .team-card__bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
    }

    .team-card__bottom {
        margin-top: 16px;
        padding-top: 13px;
        border-top: 1px dashed #e5e5e5;
    }

    .team-card__identity,
    .captain {
        display: flex;
        align-items: center;
    }

    .team-card__identity {
        gap: 11px;
    }

    .team-mark {
        display: grid;
        place-items: center;
        width: 39px;
        height: 39px;
        flex-shrink: 0;
        border-radius: 11px;
        font-family: var(--main-font);
        font-size: 0.78rem;
        font-weight: 700;
    }

    .team-mark--purple { background: #eee8ff; color: #6740c8; }
    .team-mark--orange { background: #fff0dd; color: #c76b10; }
    .team-mark--blue { background: #e4f2ff; color: #2175be; }

    .team-card h3 {
        margin-bottom: 3px;
        font-size: 0.92rem;
    }

    .team-card p {
        color: #8b8b8b;
        font-family: var(--main-font);
        font-size: 0.74rem;
    }

    .team-capacity {
        align-self: flex-start;
        color: #707070;
        font-family: var(--main-font);
        font-size: 0.76rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .captain {
        gap: 8px;
        color: #707070;
        font-size: 0.74rem;
    }

    .avatar {
        display: inline-grid;
        place-items: center;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #121b68;
        color: #fff;
        font-family: var(--main-font);
        font-size: 0.8rem;
        font-weight: 700;
    }

    .avatar--small {
        width: 25px;
        height: 25px;
        background: #e7e9f7;
        color: #121b68;
        font-size: 0.65rem;
    }

    .avatar--green { background: #e3f4e8; color: #248a3d; }
    .avatar--pink { background: #fbe6ee; color: #bd4d76; }

    .button--small {
        padding: 8px 11px;
        font-size: 0.72rem;
    }

    .button--outline {
        border: 1px solid #d6d8e6;
        background: #fff;
        color: #121b68;
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
        font-size: 1.2rem;
    }

    .registration-panel__description {
        margin-bottom: 23px;
        color: #757575;
        font-family: var(--main-font);
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
        font-size: 0.72rem;
    }

    .spots__label {
        margin-bottom: 9px;
    }

    .spots__label strong {
        color: #121b68;
        font-size: 0.78rem;
    }

    .progress {
        height: 7px;
        overflow: hidden;
        border-radius: 999px;
        background: #e1e3f0;
    }

    .progress span {
        display: block;
        width: 80%;
        height: 100%;
        border-radius: inherit;
        background: #121b68;
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
        background: #121b68;
        color: #fff;
    }

    .button--ghost {
        padding: 11px 20px;
        border: 1px solid #d9dbea;
        background: transparent;
        color: #121b68;
    }

    .registration-note {
        display: flex;
        gap: 6px;
        align-items: flex-start;
        margin-top: 17px;
        color: #888;
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

    .organizer-panel {
        padding: 30px 0;
    }

    .organizer-panel h2 {
        font-size: 0.94rem;
    }

    .organizer-panel p {
        margin: 15px 0 12px 49px;
        color: #858585;
        font-family: var(--main-font);
        font-size: 0.77rem;
        line-height: 1.5;
    }

    .organizer-panel .text-button {
        margin-left: 49px;
    }

    @media (max-width: 1050px) {
        .event-hero {
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 28px;
            padding: 32px;
        }

        .event-layout {
            grid-template-columns: minmax(0, 1fr) 320px;
        }
    }

    @media (max-width: 820px) {
        .event-hero,
        .event-layout {
            grid-template-columns: 1fr;
        }

        .event-hero__summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            padding: 20px 0 0;
            border-top: 1px solid rgba(255, 255, 255, 0.18);
            border-left: 0;
        }
    }

    @media (max-width: 560px) {
        .event-details__main {
            padding-top: 20px;
            padding-bottom: 48px;
        }

        .event-hero {
            padding: 25px 20px;
        }

        .event-hero h1 {
            font-size: 2.3rem;
        }

        .event-hero__actions {
            flex-direction: column;
        }

        .event-hero__actions .button {
            width: 100%;
        }

        .event-hero__summary {
            display: flex;
            gap: 14px;
        }

        .panel {
            padding: 25px 0;
        }

        .section-heading {
            flex-direction: column;
            gap: 8px;
        }

        .created-date {
            padding-top: 0;
        }

        .event-facts {
            gap: 10px;
        }

        .event-fact strong {
            font-size: 0.78rem;
        }

        .team-card__top,
        .team-card__bottom {
            align-items: flex-start;
        }

        .team-card__bottom {
            flex-direction: column;
        }

        .team-card__bottom .button {
            width: 100%;
        }
    }
</style>
