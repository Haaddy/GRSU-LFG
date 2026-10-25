<script setup lang="ts">
</script>

<template>
    <div class="events">
        <header class="events__bar">
            <div class="events__bar-inner container">
                <p class="events__logo">GRSU</p>
                <p class="events__account">Привет</p>
            </div>
        </header>

        <main class="events__main container">
            <div class="events__intro">
                <h1>Куда идём?</h1>
                <p>Смотри, что скоро будет, и выбирай, с кем туда идти.</p>
            </div>

            <form class="events__filters" @submit.prevent>
                <div class="events__field">
                    <label for="event-date">Дата</label>
                    <input id="event-date" class="events__control" type="date">
                </div>

                <div class="events__field">
                    <label for="event-location">Место</label>
                    <input id="event-location" class="events__control" type="text" placeholder="Корпус, аудитория или адрес">
                </div>

                <div class="events__field">
                    <label for="event-team">Команда</label>
                    <select id="event-team" class="events__control">
                        <option>Все</option>
                        <option>С командой</option>
                        <option>Без команды</option>
                    </select>
                </div>

                <div class="events__field">
                    <label for="event-type">Тип мероприятия</label>
                    <select id="event-type" class="events__control">
                        <option>Все типы</option>
                        <option>Хакатон</option>
                        <option>Фестиваль</option>
                        <option>Забег</option>
                        <option>Квиз</option>
                        <option>Конференция</option>
                    </select>
                </div>

                <div class="events__field">
                    <label for="event-duration">Продолжительность</label>
                    <select id="event-duration" class="events__control">
                        <option>Любая</option>
                        <option>До 2 часов</option>
                        <option>От 2 до 6 часов</option>
                        <option>Один день</option>
                        <option>Несколько дней</option>
                    </select>
                </div>

                <button class="events__submit" type="submit">Найти</button>
            </form>

            <section class="events__list" aria-label="Список мероприятий">
                <a class="events__card" href="#">
                    <div class="events__card-main">
                        <h2 class="events__name">Хакатон «Цифровой ГрГУ»</h2>
                        <p class="events__description">Двухдневное командное соревнование: за 32 часа нужно собрать прототип сервиса для университета и защитить его перед жюри.</p>
                    </div>

                    <dl class="events__meta">
                        <div>
                            <dt>Начало</dt>
                            <dd>14 ноября 2026, 10:00</dd>
                        </div>
                        <div>
                            <dt>Конец</dt>
                            <dd>15 ноября 2026, 18:00</dd>
                        </div>
                        <div>
                            <dt>Место</dt>
                            <dd>ГрГУ, ул. Ожешко, 22, аудитория 218</dd>
                        </div>
                        <div>
                            <dt>Команда</dt>
                            <dd class="events__pill">Нужна</dd>
                        </div>
                        <div>
                            <dt>Участники</dt>
                            <dd>до 80</dd>
                        </div>
                        <div>
                            <dt>Размер команды</dt>
                            <dd>от 3 до 5</dd>
                        </div>
                    </dl>
                </a>

                <a class="events__card events__card--empty" href="#">
                    <div class="events__card-main">
                        <p class="events__note">Пустая карточка</p>
                        <h2 class="events__name">Название мероприятия</h2>
                        <p class="events__description">Описание</p>
                    </div>

                    <dl class="events__meta">
                        <div>
                            <dt>Начало</dt>
                            <dd>—</dd>
                        </div>
                        <div>
                            <dt>Конец</dt>
                            <dd>—</dd>
                        </div>
                        <div>
                            <dt>Место</dt>
                            <dd>—</dd>
                        </div>
                        <div>
                            <dt>Команда</dt>
                            <dd>—</dd>
                        </div>
                        <div>
                            <dt>Участники</dt>
                            <dd>—</dd>
                        </div>
                        <div>
                            <dt>Размер команды</dt>
                            <dd>—</dd>
                        </div>
                    </dl>
                </a>
            </section>
        </main>
    </div>
</template>

<style scoped>
    .events{
        min-height: 100vh;
        background:
            radial-gradient(circle at 0% 0%, #B7E4FF 0, transparent 32%),
            radial-gradient(circle at 100% 8%, #DDD4FF 0, transparent 28%),
            linear-gradient(180deg, #E7F5FF 0%, #F7FBFF 46%, #F4F7FF 100%);
        color: #1C2B4A;
    }

    .events__bar{
        background-color: transparent;
    }

    .events__bar-inner{
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: 80px;
    }

    .events__logo{
        color: #2F6BFF;
        font-family: var(--main-font);
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: 0.04em;
    }

    .events__account{
        padding: 8px 16px;
        border-radius: 999px;
        background-color: #fff;
        color: #2F6BFF;
        font-family: var(--main-font);
        font-size: 0.95rem;
        font-weight: 700;
        box-shadow: 0 8px 20px rgba(47, 107, 255, 0.12);
    }

    .events__main{
        padding-top: 40px;
        padding-bottom: 64px;
    }

    .events__intro{
        max-width: 640px;
        margin-bottom: 28px;
    }

    .events__intro h1{
        color: #2457E6;
        font-size: 2.75rem;
        font-weight: 700;
        line-height: 1.1;
    }

    .events__intro p{
        margin-top: 10px;
        color: #4E6280;
        font-size: 1.05rem;
        line-height: 1.5;
    }

    .events__filters{
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 16px;
        align-items: end;
        margin-bottom: 28px;
        padding: 22px;
        background-color: rgba(255, 255, 255, 0.92);
        border-radius: 28px;
        box-shadow: 0 16px 40px rgba(47, 107, 255, 0.1);
    }

    .events__field{
        display: flex;
        flex-direction: column;
        gap: 8px;
        min-width: 0;
    }

    .events__field label{
        color: #5B6F8C;
        font-family: var(--main-font);
        font-size: 0.8rem;
        font-weight: 700;
    }

    .events__control{
        width: 100%;
        height: 48px;
        padding: 0 14px;
        border: 0;
        border-radius: 14px;
        background-color: #EEF5FF;
        color: #1C2B4A;
        font-family: var(--main-font);
        font-size: 0.95rem;
    }

    .events__control::placeholder{
        color: #8AA0B8;
    }

    .events__control:focus{
        outline: 2px solid #8EBEFF;
    }

    .events__submit{
        height: 48px;
        border: 0;
        border-radius: 14px;
        background: linear-gradient(90deg, #3B6BFF, #2EC5FF);
        color: #fff;
        font-family: var(--main-font);
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
    }

    .events__submit:hover{
        filter: brightness(1.05);
    }

    .events__list{
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .events__card{
        display: grid;
        grid-template-columns: minmax(0, 1.3fr) minmax(260px, 0.9fr);
        gap: 28px;
        padding: 24px;
        background-color: #fff;
        border-radius: 28px;
        color: inherit;
        box-shadow: 0 14px 36px rgba(47, 107, 255, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .events__card:hover{
        transform: translateY(-4px);
        box-shadow: 0 18px 40px rgba(47, 107, 255, 0.18);
    }

    .events__card:focus-visible{
        outline: 3px solid #3B6BFF;
        outline-offset: 3px;
    }

    .events__card--empty{
        background-color: rgba(255, 255, 255, 0.72);
        box-shadow: none;
        outline: 2px dashed #8EBEFF;
    }

    .events__note{
        display: inline-block;
        margin-bottom: 10px;
        padding: 4px 10px;
        border-radius: 999px;
        background-color: #E7F1FF;
        color: #2F6BFF;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .events__name{
        color: #2457E6;
        font-size: 1.6rem;
        font-weight: 700;
        line-height: 1.25;
    }

    .events__card--empty .events__name,
    .events__card--empty .events__description{
        color: #8AA0B8;
    }

    .events__description{
        margin-top: 12px;
        color: #3E5670;
        font-size: 1rem;
        line-height: 1.55;
    }

    .events__meta{
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px 20px;
        margin: 0;
        padding: 18px;
        background-color: #F3F7FF;
        border-radius: 20px;
    }

    .events__pill{
        display: inline-flex;
        align-self: flex-start;
        padding: 4px 10px;
        border-radius: 999px;
        background-color: #2F6BFF;
        color: #fff;
    }

    .events__meta div{
        display: flex;
        flex-direction: column;
        gap: 4px;
        min-width: 0;
    }

    .events__meta dt{
        color: #6B7F99;
        font-family: var(--main-font);
        font-size: 0.75rem;
        font-weight: 700;
    }

    .events__meta dd{
        margin: 0;
        color: #1C2B4A;
        font-family: var(--main-font);
        font-size: 0.95rem;
        font-weight: 500;
        line-height: 1.4;
    }

    @media (max-width: 1100px){
        .events__filters{
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 960px){
        .events__intro h1{
            font-size: 2.2rem;
        }

        .events__card{
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }

    @media (max-width: 768px){
        .events__bar-inner{
            min-height: 64px;
        }

        .events__main{
            padding-top: 28px;
            padding-bottom: 40px;
        }

        .events__filters{
            grid-template-columns: 1fr;
            padding: 16px;
        }

        .events__card{
            padding: 16px;
        }

        .events__name{
            font-size: 1.25rem;
        }
    }

    @media (max-width: 480px){
        .events__meta{
            grid-template-columns: 1fr;
        }

        .events__account{
            font-size: 0.85rem;
        }
    }
</style>
