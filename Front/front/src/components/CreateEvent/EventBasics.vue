<template>
    <section class="form-section" aria-labelledby="event-basics-title">
        <div class="section-heading">
            <div>
                <h2 id="event-basics-title">Event basics</h2>
                <p>Give participants a clear first impression.</p>
            </div>
        </div>

        <div class="field field--wide">
            <label for="event-name">Event name <span aria-hidden="true">*</span></label>
            <input id="event-name" class="input" name="event-name" type="text" placeholder="e.g. GRSU Hackathon 2026" autocomplete="off" required>
        </div>

        <div class="field-row">
            <div class="field">
                <label for="event-type">Event type <span aria-hidden="true">*</span></label>
                <select id="event-type" class="input" name="event-type" required>
                    <option value="" disabled selected>Select type</option>
                    <option>Hackathon</option>
                    <option>Festival</option>
                    <option>Quiz</option>
                    <option>Sport</option>
                    <option>Workshop</option>
                    <option>Other</option>
                </select>
            </div>

            <div class="field">
                <label for="event-topic">Topic</label>
                <input id="event-topic" class="input" name="event-topic" type="text" placeholder="e.g. Web development" autocomplete="off">
            </div>
        </div>

        <div class="field field--wide">
            <label for="event-summary">Short description <span aria-hidden="true">*</span></label>
            <input id="event-summary" class="input" name="event-summary" type="text" placeholder="One sentence about your event…" autocomplete="off" required>
        </div>

        <div class="field field--wide">
            <label for="event-description">About the event <span aria-hidden="true">*</span></label>
            <textarea id="event-description" class="input textarea" name="event-description" rows="5" placeholder="Tell participants what they will do, learn or create…" autocomplete="off" required></textarea>
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

label {
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

.textarea {
    height: auto;
    min-height: 132px;
    resize: vertical;
    line-height: 1.5;
}

select.input {
    color: var(--color-text);
}

.input:focus-visible {
    outline: 3px solid rgba(0, 122, 255, 0.2);
    outline-offset: 1px;
}

@media (max-width: 620px) {
    .field-row {
        grid-template-columns: 1fr;
    }
}
</style>
