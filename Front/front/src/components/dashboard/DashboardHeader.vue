<script setup lang="ts">
</script>

<template>
 <header class="header">
            <div class="header__container container">
                <div class="header__left">
                    <h1 class="header__logo">GRSU</h1>
                    <router-link to="/dashboard" class="header__dashboard">Dashboard</router-link>
                </div>

                <div class="header__actions">
                    <button type="button" class="header__create">
                        <svg class="header__create-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        <span class="header__create-label">Create Event</span>
                    </button>

                    <button type="button" class="header__notifications" aria-label="Notifications">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                        </svg>
                        <span class="header__badge">3</span>
                    </button>

                    <router-link to="/profile" class="header__avatar" aria-label="Profile">H</router-link>
                </div>
            </div>
        </header>
</template>

<style scoped>
    .header {
        position: sticky;
        top: 0;
        z-index: 100;
        width: 100%;
        background-color: #fff;
        border-bottom: solid 1px var(--input-border);
    }

    .header__container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 96px;
    }

    .header__left {
        display: flex;
        align-items: center;
        gap: 28px;
    }

    .header__logo {
        font-family: var(--logo-font);
        font-size: var(--logo-size);
    }

    .header__dashboard {
        font-family: var(--main-font);
        font-weight: 700;
        color: #000;
        padding: 8px 10px;

        &:hover{
            background-color: #f0ecec;
            border-radius: 10px;
            transition: 0.3s;
        }
    }

    .header__actions {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .header__create {
        display: flex;
        align-items: center;
        gap: 10px;

        background-color: #000;
        color: #fff;
        border: none;
        padding: 15px 29px;
        border-radius: 18px;

        font-family: var(--main-font);
        font-weight: 500;
        font-size: 15px;
        white-space: nowrap;
    }

    .header__create-icon {
        width: 16px;
        height: 16px;
    }

    .header__notifications {
        position: relative;

        display: flex;
        align-items: center;
        justify-content: center;

        width: 48px;
        height: 48px;

        background: none;
        /* border: solid 1px #000; */
        /* border-radius: 50%; */
        border: none;

        color: #000;
    }

    .header__notifications svg {
        width: 26px;
        height: 26px;
    }

    .header__badge {
        position: absolute;
        top: -1px;
        right: -1px;

        min-width: 20px;
        height: 20px;
        padding: 0 5px;

        display: flex;
        align-items: center;
        justify-content: center;

        background-color: var(--error-color);
        color: #fff;
        border-radius: 999px;

        font-family: var(--main-font);
        font-size: 0.7rem;
        font-weight: 700;
        line-height: 1;
    }

    .header__avatar {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 48px;
        height: 48px;
        border-radius: 50%;

        background-color: #121B68;
        color: #fff;

        font-family: var(--main-font);
        font-weight: 700;
        font-size: 0.9rem;
    }

    .header__create:hover,
    .header__notifications:hover,
    .header__avatar:hover {
        scale: 1.1;
        transition: 0.3s;
    }

    /* ================= adaptive ================= */
    @media (max-width: 960px) {
        .header__container {
            height: auto;
            min-height: 80px;
            gap: 16px;
        }

        .header__logo {
            font-size: 2.75rem;
        }
    }

    @media (max-width: 768px) {
        .header__container {
            min-height: 72px;
            padding-top: 12px;
            padding-bottom: 12px;
        }

        .header__left {
            gap: 16px;
        }

        .header__logo {
            font-size: 2.25rem;
        }

        .header__actions {
            gap: 10px;
        }

        .header__create {
            padding: 12px 18px;
            font-size: 0.85rem;
        }

        .header__create-label {
            display: none;
        }

        .header__notifications,
        .header__avatar {
            width: 44px;
            height: 44px;
        }
    }

    @media (max-width: 480px) {
        .header__logo {
            font-size: 1.75rem;
        }

        .header__dashboard {
            font-size: 0.85rem;
        }

        .header__actions {
            gap: 8px;
        }

        .header__create {
            padding: 10px 12px;
        }

        .header__notifications,
        .header__avatar {
            width: 40px;
            height: 40px;
        }
    }
</style>