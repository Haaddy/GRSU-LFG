<template>
    <section class="team-section" aria-labelledby="team-preferences-title">
        <div class="section-heading">
            <div>
                <h2 id="team-preferences-title">Team preferences</h2>
                <p>Help the right people find your team.</p>
            </div>
        </div>

        <div class="field-row">
            <div class="field">
                <label for="team-size">Team size <span aria-hidden="true">*</span></label>
                <select id="team-size" class="input" name="team-size" required>
                    <option value="" disabled selected>Select size</option>
                    <option>2 people</option>
                    <option>3 people</option>
                    <option>4 people</option>
                    <option>5 people</option>
                </select>
            </div>

            <div class="field">
                <label for="team-focus">Main focus</label>
                <select id="team-focus" class="input" name="team-focus">
                    <option value="" disabled selected>Select focus</option>
                    <option>Development</option>
                    <option>Design</option>
                    <option>Product</option>
                    <option>Research</option>
                    <option>Open to anything</option>
                </select>
            </div>
        </div>

        <div class="field">
            <label for="team-skills">Skills you are looking for</label>
            <input id="team-skills" class="input" name="team-skills" type="text" placeholder="e.g. Vue, UI design, pitching" autocomplete="off">
            <small>Separate skills with commas.</small>
        </div>

        <label class="check-field" for="team-public">
            <input id="team-public" name="team-public" type="checkbox" checked>
            <span>
                <strong>Let participants request to join</strong>
                <small>People can send a request before the event starts.</small>
            </span>
        </label>
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

.input {
    width: 100%;
    font-family: var(--font-main);
    color: var(--color-text);
}

.field small,
.check-field small {
    color: var(--color-text-secondary);
    font-family: var(--font-main);
    font-size: 0.76rem;
    line-height: 1.4;
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

.check-field input:focus-visible,
.input:focus-visible {
    outline: 3px solid rgba(0, 122, 255, 0.2);
    outline-offset: 1px;
}

.check-field span {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

@media (max-width: 620px) {
    .field-row {
        grid-template-columns: 1fr;
    }
}
</style>
