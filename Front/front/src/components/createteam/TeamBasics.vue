<template>
    <section class="team-section" aria-labelledby="team-basics-title">
        <div class="section-heading">
            <div>
                <h2 id="team-basics-title">Team basics</h2>
                <p>Give your team a clear identity.</p>
            </div>
        </div>

        <div class="field">
            <label for="team-name">Team name <span aria-hidden="true">*</span></label>
            <input id="team-name" class="input" name="team-name" type="text" placeholder="e.g. Pixel Pioneers" autocomplete="off" required>
        </div>

        <div class="field">
            <label for="team-tagline">Short description <span aria-hidden="true">*</span></label>
            <input id="team-tagline" class="input" name="team-tagline" type="text" placeholder="What are you building together?" autocomplete="off" required>
        </div>

        <div class="field">
            <label for="team-description">About the team</label>
            <textarea id="team-description" class="input textarea" name="team-description" rows="5" placeholder="Tell participants what your team is looking for and what you want to create." autocomplete="off"></textarea>
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

label span {
    color: var(--color-error);
}

.input {
    width: 100%;
    font-family: var(--font-main);
    color: var(--color-text);
}

.textarea {
    height: auto;
    min-height: 132px;
    resize: vertical;
    line-height: 1.5;
}

.input:focus-visible {
    outline: 3px solid rgba(0, 122, 255, 0.2);
    outline-offset: 1px;
}
</style>
