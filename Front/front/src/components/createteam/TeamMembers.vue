<template>
    <section class="team-section" aria-labelledby="team-members-title">
        <div class="section-heading">
            <div>
                <h2 id="team-members-title">Your team</h2>
                <p>You are the captain. Add a note for future teammates.</p>
            </div>
        </div>

        <div class="captain-card">
            <span class="captain-card__avatar" aria-hidden="true">H</span>
            <div>
                <strong>Haaddy</strong>
                <span>Captain</span>
            </div>
        </div>

        <div class="field">
            <label for="team-note">Message to potential teammates</label>
            <textarea id="team-note" class="input textarea" name="team-note" rows="4" placeholder="Tell people what kind of teammate would be a great fit." autocomplete="off"></textarea>
        </div>
    </section>
</template>

<style scoped>
.team-section {
    display: flex;
    flex-direction: column;
    gap: 22px;
}

.section-heading {
    padding-bottom: 20px;
    border-bottom: 1px solid var(--color-border-light);
}

h2 {
    color: var(--color-text);
    font-family: var(--font-main);
    font-size: 1.25rem;
    font-weight: 700;
    line-height: 1.2;
}

.section-heading p {
    margin-top: 6px;
    color: var(--color-text-secondary);
    font-family: var(--font-main);
    font-size: 0.86rem;
    line-height: 1.45;
}

.captain-card {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-md);
    background: var(--color-primary-light);
}

.captain-card__avatar {
    display: grid;
    place-items: center;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: var(--color-primary);
    color: var(--color-white);
    font-family: var(--font-main);
    font-size: 0.8rem;
    font-weight: 700;
}

.captain-card strong,
.captain-card span:not(.captain-card__avatar) {
    display: block;
    font-family: var(--font-main);
}

.captain-card strong {
    color: var(--color-text);
    font-size: 0.88rem;
}

.captain-card span:not(.captain-card__avatar) {
    margin-top: 3px;
    color: var(--color-text-secondary);
    font-size: 0.76rem;
}

.field {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

label {
    color: var(--color-text);
    font-family: var(--font-main);
    font-size: 0.82rem;
    font-weight: 700;
}

.input {
    width: 100%;
    font-family: var(--font-main);
    color: var(--color-text);
}

.textarea {
    height: auto;
    min-height: 108px;
    resize: vertical;
    line-height: 1.5;
}

.input:focus-visible {
    outline: 3px solid rgba(0, 122, 255, 0.2);
    outline-offset: 1px;
}
</style>
