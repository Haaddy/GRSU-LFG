<template>
    <section class="form-section" aria-labelledby="event-participation-title">
        <div class="section-heading">
            <div>
                <h2 id="event-participation-title">Participants & teams</h2>
                <p>Set the shape of the event before people register.</p>
            </div>
        </div>

        <div class="field">
            <label for="participant-limit">Maximum participants <span aria-hidden="true">*</span></label>
            <input id="participant-limit" class="input" name="participant-limit" type="number" min="1" placeholder="e.g. 160" required>
        </div>

        <label class="check-field" for="team-required">
            <input id="team-required" name="team-required" type="checkbox">
            <span>
                <strong>Teams are required</strong>
                <small>Participants will join or create a team.</small>
            </span>
        </label>

        <div class="field-row">
            <div class="field">
                <label for="team-min">Minimum team size</label>
                <input id="team-min" class="input" name="team-min" type="number" min="1" placeholder="2">
            </div>
            <div class="field">
                <label for="team-max">Maximum team size</label>
                <input id="team-max" class="input" name="team-max" type="number" min="1" placeholder="5">
            </div>
        </div>

        <div class="field">
            <label for="event-skills">Preferred skills</label>
            <input id="event-skills" class="input" name="skills" type="text" placeholder="e.g. Design, Vue, pitching…" autocomplete="off">
        </div>
    </section>
</template>

<style scoped>
.form-section {
    display: flex;
    flex-direction: column;
    gap: 22px;
}

.section-heading {
    display: flex;
    align-items: flex-start;
    gap: 14px;
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

.field-row {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
}

.field {
    display: flex;
    flex-direction: column;
    gap: 8px;
    min-width: 0;
}

label,
.check-field strong {
    color: var(--color-text);
    font-family: var(--font-main);
    font-size: 0.82rem;
    font-weight: 700;
}

label span {
    color: var(--color-error);
}

.input {
    font-family: var(--font-main);
    color: var(--color-text);
}

.input:focus-visible,
.check-field input:focus-visible {
    outline: 3px solid rgba(0, 122, 255, 0.2);
    outline-offset: 1px;
}

.check-field {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    cursor: pointer;
}

.check-field input {
    width: 18px;
    height: 18px;
    margin-top: 1px;
    accent-color: var(--color-primary);
}

.check-field span {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.check-field small {
    color: var(--color-text-secondary);
    font-family: var(--font-main);
    font-size: 0.78rem;
    line-height: 1.4;
}

@media (max-width: 620px) {
    .field-row {
        grid-template-columns: 1fr;
    }
}
</style>
