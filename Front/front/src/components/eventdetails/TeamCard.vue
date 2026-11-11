<script setup lang="ts">
defineProps<{
    initials: string;
    color: 'purple' | 'orange' | 'blue';
    name: string;
    description: string;
    capacity: string;
    captainInitial: string;
    captainName: string;
    captainColor?: 'green' | 'pink';
}>();
</script>

<template>
    <article class="team-card">
        <div class="team-card__top">
            <div class="team-card__identity">
                <span class="team-mark" :class="`team-mark--${color}`">{{ initials }}</span>
                <div>
                    <h3>{{ name }}</h3>
                    <p>{{ description }}</p>
                </div>
            </div>
            <span class="team-capacity">{{ capacity }}</span>
        </div>
        <div class="team-card__bottom">
            <span class="captain">
                <span class="avatar avatar--small" :class="captainColor ? `avatar--${captainColor}` : ''">
                    {{ captainInitial }}
                </span>
                Captain: {{ captainName }}
            </span>
            <button class="button button--small button--outline" type="button">Request to join</button>
        </div>
    </article>
</template>

<style scoped>
.team-card {
    padding: 18px 0;
    border-top: 1px solid var(--color-border-light);
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
    border-top: 1px dashed var(--color-border);
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
    font-family: var(--font-main);
    font-size: 0.78rem;
    font-weight: 700;
}

.team-mark--purple { background: #eee8ff; color: #6740c8; }
.team-mark--orange { background: #fff0dd; color: #c76b10; }
.team-mark--blue { background: #e4f2ff; color: #2175be; }

.team-card h3 {
    margin-bottom: 3px;
    font-family: var(--font-main);
    font-size: 0.92rem;
}

.team-card p {
    color: #8b8b8b;
    font-family: var(--font-main);
    font-size: 0.74rem;
}

.team-capacity {
    align-self: flex-start;
    color: #707070;
    font-family: var(--font-main);
    font-size: 0.76rem;
    font-weight: 700;
    white-space: nowrap;
}

.captain {
    gap: 8px;
    color: #707070;
    font-family: var(--font-main);
    font-size: 0.74rem;
}

.avatar {
    display: inline-grid;
    place-items: center;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #e7e9f7;
    color: var(--color-primary);
    font-family: var(--font-main);
    font-size: 0.65rem;
    font-weight: 700;
}

.avatar--green { background: #e3f4e8; color: #248a3d; }
.avatar--pink { background: #fbe6ee; color: #bd4d76; }

@media (max-width: 560px) {
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


