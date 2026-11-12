<template>
    <section class="form-section" aria-labelledby="event-schedule-title">
        <div class="section-heading">
            <div>
                <h2 id="event-schedule-title">Date & location</h2>
                <p>Help participants understand when and where to join.</p>
            </div>
        </div>

        <div class="field-row">
            <div class="field">
                <label for="event-start-date">Start date <span aria-hidden="true">*</span></label>
                <input id="event-start-date" class="input" name="start-date" type="date" required>
            </div>
            <div class="field">
                <label for="event-start-time">Start time <span aria-hidden="true">*</span></label>
                <input id="event-start-time" class="input" name="start-time" type="time" required>
            </div>
        </div>

        <div class="field-row">
            <div class="field">
                <label for="event-end-date">End date</label>
                <input id="event-end-date" class="input" name="end-date" type="date">
            </div>
            <div class="field">
                <label for="event-end-time">End time</label>
                <input id="event-end-time" class="input" name="end-time" type="time">
            </div>
        </div>

        <div class="field-row">
            <div class="field">
                <label for="event-format">Format <span aria-hidden="true">*</span></label>
                <select id="event-format" class="input" name="format" required>
                    <option value="" disabled selected>Select format</option>
                    <option>On-site</option>
                    <option>Online</option>
                    <option>Hybrid</option>
                </select>
            </div>
            <div class="field">
                <label for="event-location">Location <span aria-hidden="true">*</span></label>
                <input id="event-location" class="input" name="location" type="text" placeholder="e.g. GRSU Innovation Hub" autocomplete="off" required>
            </div>
        </div>

        <div class="field field--wide">
            <label for="registration-deadline">Registration deadline</label>
            <input id="registration-deadline" class="input" name="registration-deadline" type="date">
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
