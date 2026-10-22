<script setup lang="ts">
type DragState = {
    item: HTMLElement
    pointerId: number
    offsetX: number
    offsetY: number
}

let drag: DragState | null = null
let zIndex = 30

function bannerFromTarget(target: EventTarget | null): HTMLElement | null {
    if (!(target instanceof Element)) {
        return null
    }

    return target.closest('.banners__item')
}

function closeBanner(event: MouseEvent) {
    const target = event.target
    if (!(target instanceof Element) || !target.closest('.banners__close')) {
        return
    }

    const item = bannerFromTarget(target)
    if (!item) {
        return
    }

    item.style.display = 'none'
}

function onPointerDown(event: PointerEvent) {
    if (event.button !== 0) {
        return
    }

    const target = event.target
    if (!(target instanceof Element)) {
        return
    }

    if (target.closest('.banners__close, .banners__link')) {
        return
    }

    const item = bannerFromTarget(target)
    if (!item) {
        return
    }

    const rect = item.getBoundingClientRect()

    item.style.right = 'auto'
    item.style.bottom = 'auto'
    item.style.left = `${rect.left}px`
    item.style.top = `${rect.top}px`
    item.style.zIndex = String(++zIndex)
    item.classList.add('banners__item--dragging')
    item.setPointerCapture(event.pointerId)

    drag = {
        item,
        pointerId: event.pointerId,
        offsetX: event.clientX - rect.left,
        offsetY: event.clientY - rect.top
    }
}

function moveBanner(event: PointerEvent) {
    if (!drag || event.pointerId !== drag.pointerId) {
        return
    }

    const maxLeft = Math.max(0, window.innerWidth - drag.item.offsetWidth)
    const maxTop = Math.max(0, window.innerHeight - drag.item.offsetHeight)
    const left = Math.min(Math.max(0, event.clientX - drag.offsetX), maxLeft)
    const top = Math.min(Math.max(0, event.clientY - drag.offsetY), maxTop)

    drag.item.style.left = `${left}px`
    drag.item.style.top = `${top}px`
}

function onPointerUp(event: PointerEvent) {
    moveBanner(event)

    if (!drag || event.pointerId !== drag.pointerId) {
        return
    }

    drag.item.classList.remove('banners__item--dragging')
    drag = null
}
</script>

<template>
    <div
        class="banners"
        @pointerdown="onPointerDown"
        @pointermove="moveBanner"
        @pointerup="onPointerUp"
        @pointercancel="onPointerUp"
        @click="closeBanner"
    >
        <article class="banners__item banners__item--1">
            <button class="banners__close" type="button" aria-label="Закрыть">×</button>
            <p class="banners__label">Реклама</p>
            <img class="banners__image" src="../assets/imgs/sponsors/1xbet.png" alt="">
            <p class="banners__text">Фрибет уже на счету</p>
            <a class="banners__link" href="">Забрать</a>
        </article>

        <article class="banners__item banners__item--2">
            <button class="banners__close" type="button" aria-label="Закрыть">×</button>
            <p class="banners__label">Реклама</p>
            <img class="banners__image" src="../assets/imgs/sponsors/sweetbananza.png" alt="">
            <p class="banners__text">Крути, пока стипендия тёплая</p>
            <a class="banners__link" href="">Крутить</a>
        </article>

        <article class="banners__item banners__item--3">
            <button class="banners__close" type="button" aria-label="Закрыть">×</button>
            <p class="banners__label">Реклама</p>
            <img class="banners__image" src="../assets/imgs/sponsors/grsucasino.png" alt="">
            <p class="banners__text">Казино ГрГУ открыто</p>
            <a class="banners__link" href="">Депнуть</a>
        </article>

        <article class="banners__item banners__item--4">
            <button class="banners__close" type="button" aria-label="Закрыть">×</button>
            <p class="banners__label">Реклама</p>
            <img class="banners__image" src="../assets/imgs/sponsors/doghouse.png" alt="">
            <p class="banners__text">Псы уже в игре</p>
            <a class="banners__link" href="">Играть</a>
        </article>

        <article class="banners__item banners__item--5">
            <button class="banners__close" type="button" aria-label="Закрыть">×</button>
            <p class="banners__label">Реклама</p>
            <img class="banners__image" src="../assets/imgs/sponsors/csgo.png" alt="">
            <p class="banners__text">Скин за регистрацию</p>
            <a class="banners__link" href="">Забрать</a>
        </article>

        <article class="banners__item banners__item--6">
            <button class="banners__close" type="button" aria-label="Закрыть">×</button>
            <p class="banners__label">Реклама</p>
            <img class="banners__image" src="../assets/imgs/sponsors/kfc.png" alt="">
            <p class="banners__text">Ведро по цене пары</p>
            <a class="banners__link" href="">Заказать</a>
        </article>

        <article class="banners__item banners__item--7">
            <button class="banners__close" type="button" aria-label="Закрыть">×</button>
            <p class="banners__label">Реклама</p>
            <img class="banners__image" src="../assets/imgs/sponsors/monster.png" alt="">
            <p class="banners__text">Дожить до зачёта</p>
            <a class="banners__link" href="">Взять</a>
        </article>

        <article class="banners__item banners__item--8">
            <button class="banners__close" type="button" aria-label="Закрыть">×</button>
            <p class="banners__label">Реклама</p>
            <img class="banners__image" src="../assets/imgs/sponsors/nike.png" alt="">
            <p class="banners__text">Успей, пока скидка жива</p>
            <a class="banners__link" href="">Смотреть</a>
        </article>

        <article class="banners__item banners__item--9">
            <button class="banners__close" type="button" aria-label="Закрыть">×</button>
            <p class="banners__label">Реклама</p>
            <img class="banners__image" src="../assets/imgs/sponsors/f1.png" alt="">
            <p class="banners__text">Болид быстрее деканата</p>
            <a class="banners__link" href="">Смотреть</a>
        </article>

        <article class="banners__item banners__item--10">
            <button class="banners__close" type="button" aria-label="Закрыть">×</button>
            <p class="banners__label">Реклама</p>
            <img class="banners__image" src="../assets/imgs/sponsors/ufc.png" alt="">
            <p class="banners__text">Бой сегодня ночью</p>
            <a class="banners__link" href="">Смотреть</a>
        </article>

        <article class="banners__item banners__item--11">
            <button class="banners__close" type="button" aria-label="Закрыть">×</button>
            <p class="banners__label">Реклама</p>
            <img class="banners__image" src="../assets/imgs/sponsors/nvidia.png" alt="">
            <p class="banners__text">Видеокарта сама себя окупит</p>
            <a class="banners__link" href="">Купить</a>
        </article>

        <article class="banners__item banners__item--12">
            <button class="banners__close" type="button" aria-label="Закрыть">×</button>
            <p class="banners__label">Реклама</p>
            <img class="banners__image" src="../assets/imgs/sponsors/olympus.png" alt="">
            <p class="banners__text">Зевс одобряет деп</p>
            <a class="banners__link" href="">Играть</a>
        </article>
    </div>
</template>

<style scoped>
    .banners{
        position: fixed;
        inset: 0;
        z-index: 20;
        pointer-events: none;
    }

    .banners__item{
        position: absolute;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        width: min(200px, 42vw);
        padding: 28px 12px 12px;
        pointer-events: auto;
        cursor: grab;
        user-select: none;
        touch-action: none;
        background-color: #fff;
        border: 2px solid #000;
        border-radius: 16px;
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.25);
    }

    .banners__item--1{ top: 8%; left: 1%; }
    .banners__item--2{ top: 6%; right: 1%; }
    .banners__item--3{ top: 34%; left: 2%; }
    .banners__item--4{ top: 30%; right: 2%; }
    .banners__item--5{ bottom: 4%; left: 1%; }
    .banners__item--6{ bottom: 6%; right: 1%; }
    .banners__item--7{ top: 4%; left: 38%; }
    .banners__item--8{ bottom: 4%; left: 36%; }
    .banners__item--9{ top: 58%; left: 16%; }
    .banners__item--10{ top: 52%; right: 14%; }
    .banners__item--11{ bottom: 22%; left: 8%; }
    .banners__item--12{ top: 18%; right: 24%; }

    .banners__item--dragging{
        cursor: grabbing;
    }

    .banners__close{
        position: absolute;
        top: 6px;
        right: 8px;
        border: 0;
        background: transparent;
        color: #000;
        font-size: 1.25rem;
        line-height: 1;
        cursor: pointer;
        touch-action: auto;
    }

    .banners__label{
        margin: 0;
        color: #121B68;
        font-family: var(--main-font);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .banners__image{
        width: 100%;
        height: 72px;
        object-fit: contain;
        pointer-events: none;
    }

    .banners__text{
        margin: 0;
        color: #000;
        font-family: var(--main-font);
        font-size: 0.85rem;
        font-weight: 500;
        line-height: 1.3;
        text-align: center;
    }

    .banners__link{
        width: 100%;
        padding: 8px 12px;
        border-radius: 12px;
        background-color: #000;
        color: #fff;
        font-family: var(--main-font);
        font-size: 0.85rem;
        font-weight: 500;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        touch-action: auto;
    }

    .banners__link:hover{
        scale: 1.05;
        transition: 0.3s;
    }

    @media (max-width: 960px){
        .banners__item{
            gap: 6px;
            padding: 26px 10px 10px;
        }

        .banners__image{
            height: 56px;
        }

        .banners__item--7,
        .banners__item--8,
        .banners__item--12{
            display: none;
        }
    }

    @media (max-width: 768px){
        .banners__text{
            font-size: 0.75rem;
        }

        .banners__item--9,
        .banners__item--10,
        .banners__item--11{
            display: none;
        }

        .banners__item--1{ top: 8px; left: 8px; }
        .banners__item--2{ top: 8px; right: 8px; }
        .banners__item--3{ top: 230px; left: 8px; }
        .banners__item--4{ top: 250px; right: 8px; }
        .banners__item--5{ top: auto; bottom: 8px; left: 8px; }
        .banners__item--6{ top: auto; bottom: 8px; right: 8px; }
    }

    @media (max-width: 480px){
        .banners__item{
            width: min(150px, 46vw);
            gap: 4px;
            padding: 24px 8px 8px;
        }

        .banners__image{
            height: 44px;
        }

        .banners__link{
            padding: 6px 8px;
            font-size: 0.75rem;
        }

        .banners__item--3,
        .banners__item--4{
            display: none;
        }

        .banners__item--1{ top: 8px; left: 8px; }
        .banners__item--2{ top: 8px; right: 8px; }
        .banners__item--5{ top: auto; bottom: 8px; left: 8px; }
        .banners__item--6{ top: auto; bottom: 8px; right: 8px; }
    }
</style>
