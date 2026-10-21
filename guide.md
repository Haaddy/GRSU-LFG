# Веб-Дозор: описание лабораторной работы

## 1. Назначение проекта

«Веб-Дозор» — учебный симулятор блокировщика рекламы на Vue 3. Игровой интерфейс
показывается поверх существующей главной страницы. Игрок должен закрывать вредоносные
баннеры, блокировать уведомления, закрывать растущую рекламу и перетаскивать файл-троян
в зелёную зону карантина.

Реализация демонстрирует:

- динамический интерфейс на Vue 3;
- типизированные `props` и `emits`;
- DOM-события и делегирование событий;
- CSS-анимации;
- `sessionStorage`, `localStorage`, Cookie и IndexedDB;
- Drag-and-Drop API;
- таймеры и игровое состояние.

---

## 2. Где находится реализация

Основные файлы:

| Файл | Назначение |
|---|---|
| `Front/front/src/components/pages/HomePage.vue` | Подключает шапку, основную страницу и игровой overlay |
| `Front/front/src/components/Header.vue` | Кнопка запуска игры в шапке сайта |
| `Front/front/src/components/game/GameOverlay.vue` | Центральная логика игры и HUD |
| `Front/front/src/components/game/GameBanner.vue` | Обычный popup-баннер |
| `Front/front/src/components/game/TrojanFile.vue` | Файл-троян с Drag-and-Drop |
| `Front/front/src/components/game/ToastNotification.vue` | Toast-уведомление браузера |
| `Front/front/src/components/game/GrowingThreat.vue` | Растущая видеореклама |
| `Front/front/src/components/game/CaptchaModal.vue` | CAPTCHA-блокировка |
| `Front/front/src/composables/useGameStorage.ts` | Работа с браузерными хранилищами |
| `Front/front/src/assets/styles/general.css` | Глобальные стили тем |
| `plan.md` | Поэтапный план разработки |

Компонент видеорекламы первоначально назывался `VideoAd.vue`, но был переименован в
`GrowingThreat.vue`, потому что браузерный блокировщик рекламы блокировал запрос к файлу
с именем `VideoAd`.

---

## 3. Подключение игры к главной странице

В `HomePage.vue` хранится флаг:

```ts
const isGameVisible = ref(false)
```

Кнопка из шапки вызывает:

```ts
function openGame() {
  isGameVisible.value = true
}
```

В шаблоне:

```vue
<Header @start-game="openGame" />
<Hero />
<Sponsors />
<GameOverlay v-if="isGameVisible" auto-start />
```

Поэтому игра не закрывает главную страницу при загрузке. Пользователь сначала видит
обычный сайт, а затем нажимает кнопку **«Веб-Дозор»** в шапке.

`GameOverlay` получает `auto-start`, поэтому сразу открывается в рабочем режиме без
дополнительного стартового экрана.

---

## 4. Игровой overlay и HUD

Главный контейнер находится в `GameOverlay.vue`:

```html
<div class="game-overlay">
  <section class="game-shell">
    ...
  </section>
</div>
```

### Основные классы

| Класс | Назначение |
|---|---|
| `.game-overlay` | Фиксированный прозрачный слой поверх страницы |
| `.game-shell` | Верхняя игровая панель |
| `.game-header` | Заголовок игры и статистика |
| `.game-stats` | Карточки XP, трафика и пойманных угроз |
| `.game-status` | Текущее сообщение игры |
| `.game-footer` | Карантин и кнопки управления |
| `.game-footer__actions` | Кнопки настроек и новой волны |
| `.game-settings` | Панель изменения имени и темы |
| `.game-over` | Экран проигрыша |

Слой `.game-overlay` не имеет затемняющего фона:

```css
.game-overlay {
  position: fixed;
  inset: 0;
  pointer-events: none;
  background: transparent;
}
```

Сам HUD принимает события:

```css
.game-shell {
  pointer-events: auto;
}
```

Это позволяет видеть основную страницу под игрой, но взаимодействовать с элементами
игровой панели.

---

## 5. Обычный баннер

Файл: `GameBanner.vue`.

### Разметка

Баннер содержит:

- контейнер `.threat-card`;
- метку типа `.threat-card__badge`;
- индикатор опасности `.threat-card__signal`;
- заголовок и описание;
- опасную кнопку `.threat-card__fake-action`;
- крестик `.threat-card__close`.

Пример разметки:

```html
<article class="threat-card threat-card--banner" data-threat="banner">
  <span class="threat-card__badge">POP-UP</span>
  <span class="threat-card__signal">UNTRUSTED</span>
  ...
  <button data-threat-action="banner-damage">Скачать бесплатно</button>
  <button data-threat-action="banner-close">×</button>
</article>
```

### Props

Компонент получает:

```ts
title: string
description: string
fakeClose: boolean
```

`fakeClose` определяет, будет ли крестик настоящим или фальшивым. В
`GameOverlay.vue` значение случайное:

```ts
const isBannerCloseFake = ref(Math.random() < 0.5)
```

Если крестик настоящий, ему назначается `banner-close`. Если фальшивый —
`banner-damage`.

### Стили

Баннер оформлен тёмным градиентом, красной рамкой и тенью. При появлении используется
анимация `threat-in`, которая изменяет прозрачность, позицию и масштаб элемента.

---

## 6. Файл-троян и Drag-and-Drop

Файл: `TrojanFile.vue`.

Троян отображается как:

```html
<article class="trojan-card" draggable="true" data-threat="trojan">
```

У него нет кнопки закрытия. Пользователь должен перетащить его в карантин.

### Обработка перетаскивания

При начале перетаскивания:

```ts
event.dataTransfer?.setData('text/plain', 'trojan-file')
event.dataTransfer.effectAllowed = 'move'
```

Компонент хранит состояние:

```ts
const isDragging = ref(false)
```

Во время Drag-and-Drop добавляется класс:

```css
.trojan-card--dragging {
  opacity: 0.88;
  border-color: #b9f3c5;
  box-shadow: 0 0 0 4px rgba(122, 231, 141, 0.2);
  transform: rotate(2deg) scale(1.04);
}
```

Это делает перетаскиваемый элемент более заметным, но не превращает его в полностью
прозрачный стандартный drag-preview.

### Таймер трояна

Троян имеет ограниченный таймер. Если время истекло, компонент сообщает родителю через
emit `expired`, после чего здоровье уменьшается.

---

## 7. Зона карантина

Зона находится в `GameOverlay.vue` и использует стандартные события:

```html
@dragover="allowDrop"
@dragleave="leaveQuarantine"
@drop="dropToQuarantine"
```

При наведении трояна зона получает класс:

```html
:class="{ 'quarantine--active': isQuarantineActive }"
```

Основные состояния:

- `.quarantine` — обычная зелёная зона;
- `.quarantine--active` — зона подсвечена и увеличена при наведении файла.

Для проверки типа файла используется значение из `dataTransfer`:

```ts
if (event.dataTransfer?.getData('text/plain') !== 'trojan-file') return
```

После успешного сброса троян удаляется, счётчик пойманных угроз увеличивается, а запись
сохраняется в IndexedDB.

---

## 8. Делегирование событий

Все клики по угрозам обрабатываются одним обработчиком на общем контейнере:

```html
<main class="threat-zone" @click="handleThreatClick">
```

Компоненты добавляют атрибуты:

```html
data-threat="banner"
data-threat="trojan"
data-threat-action="banner-close"
data-threat-action="banner-damage"
data-threat-action="toast-block"
data-threat-action="toast-allow"
data-threat-action="video-close"
```

Родитель получает исходный элемент через `event.target`, находит ближайший элемент
с помощью `closest()` и выбирает действие.

Отдельное событие клика **мимо баннера** намеренно не реализовано по условию задания.

---

## 9. Toast-уведомление

Файл: `ToastNotification.vue`.

Toast содержит:

- иконку предупреждения `.toast-threat__icon`;
- заголовок и описание;
- кнопку `toast-block`;
- кнопку `toast-allow`.

Логика:

- **Блокировать** — уведомление исчезает, угроза считается пойманной;
- **Разрешить** — уведомление исчезает, `adSpeed` меняется с `1` на `2`;
- после этого растущая реклама ускоряется в два раза.

---

## 10. Растущая видеореклама

Файл: `GrowingThreat.vue`.

Компонент получает:

```ts
progress: number
duration: number
```

Основные классы:

- `.video-threat` — контейнер угрозы;
- `.video-threat__badge` — метка `VIDEO AD`;
- `.video-threat__screen` — содержимое рекламного блока.

В `GameOverlay.vue` каждую секунду увеличивается `videoProgress`. При достижении
`100` реклама исчезает, а система получает урон.

Длительность:

- обычная скорость — 18 секунд;
- после разрешения уведомлений — 9 секунд.

---

## 11. CAPTCHA-атака

Файл: `CaptchaModal.vue`.

При создании компонента генерируется случайная строка из пяти символов:

```ts
Math.random().toString(36).slice(2, 7).toUpperCase()
```

CAPTCHA:

- отображается как модальное окно;
- принимает ввод в `<input>`;
- проверяет строку без учёта регистра;
- при ошибке очищает ввод и показывает сообщение;
- при успехе отправляет `verified`.

Пока CAPTCHA открыта, `handleThreatClick` сразу прекращает обработку клика:

```ts
if (showCaptcha.value || isGameOver.value) return
```

Также каждую секунду к вредоносному трафику добавляется `5 MB`.
CAPTCHA появляется регулярно с минутным интервалом во время активной игры.

---

## 12. Игровой цикл

Состояние игры хранится в `GameOverlay.vue` через `ref`:

```ts
const showBanner = ref(true)
const showTrojan = ref(true)
const showToast = ref(true)
const showVideo = ref(true)
const caught = ref(0)
const isGameOver = ref(false)
```

### Автоматические волны

После запуска планируется следующая волна через случайный интервал от 6 до 15 секунд.
При появлении новой волны:

- баннер снова показывается;
- троян снова показывается;
- toast снова показывается;
- видеореклама начинается заново;
- позиция угрозы выбирается случайно;
- настоящий или фальшивый крестик выбирается заново.

### Позиционирование угроз

Для баннера и трояна выбирается позиция `0`, `1` или `2`.
Эти значения превращаются в классы:

```css
.threat-zone__item--0
.threat-zone__item--1
.threat-zone__item--2
```

Классы используют разные `transform`, чтобы элементы появлялись слева, по центру или
справа.

### Проигрыш

Если здоровье становится `0`, появляется `.game-over`:

- текущая игра останавливается;
- CAPTCHA закрывается;
- новые волны больше не создаются;
- пользователь может нажать «Начать заново».

Перезапуск сбрасывает здоровье, трафик, счётчик угроз, скорость рекламы и позиции.

---

## 13. Браузерные хранилища

Логика находится в `useGameStorage.ts`.

### SessionStorage

Используется для данных текущей вкладки:

| Ключ | Значение |
|---|---|
| `web-watch-health` | XP/здоровье системы |
| `web-watch-traffic` | вредоносный трафик в MB |

### LocalStorage

Используется для постоянных настроек:

| Ключ | Значение |
|---|---|
| `web-watch-player-name` | имя оператора |
| `web-watch-theme` | техническое значение `night` или `signal` |

Пользователь видит значения тем **«Ночная»** и **«Светлая»**. `signal` — внутренний
идентификатор светлой темы.

### Cookie

При запуске игры создаётся:

```text
web-watch-vip=active
```

Cookie имеет `max-age=300`, то есть живёт 5 минут.

### IndexedDB

База называется `web-watch-database`, версия — `2`.

В ней создаются object store:

| Store | Назначение |
|---|---|
| `threat_logs` | журнал обезвреженных угроз |
| `inventory` | инвентарь пойманных угроз |
| `cyber_threats` | последняя информация по типам угроз |

При успешном обезвреживании баннера или трояна одна транзакция записывает данные во
все три store.

---

## 14. CSS-темы

Тема сохраняется в `localStorage`, а затем класс добавляется к `<body>`:

```html
<body class="theme-night">
```

или:

```html
<body class="theme-signal">
```

### Ночная тема

Использует тёмный фон страницы и тёмную игровую панель.

### Светлая тема

Использует:

- светлый фон страницы;
- светлый HUD;
- тёмный текст;
- светлые поля настроек;
- светлые статистические карточки.

Эти темы являются демонстрационной частью лабораторной: они показывают сохранение
настроек и динамическое изменение классов без перезагрузки.

---

## 15. Как проверить работу

1. Запустить frontend:

   ```powershell
   cd Front\front
   npm run dev
   ```

2. Открыть `http://localhost:5173`.
3. Нажать **«Веб-Дозор»** в шапке.
4. Проверить появление верхнего HUD поверх страницы.
5. Открыть DevTools (`F12`) → **Application**.
6. Проверить:
   - `Session Storage` → XP и трафик;
   - `Local Storage` → имя и тема;
   - `Cookies` → `web-watch-vip`;
   - `IndexedDB` → `web-watch-database`.
7. Закрыть баннер настоящим крестиком.
8. Перетащить троян в зелёную зону карантина.
9. Проверить записи в `threat_logs`, `inventory` и `cyber_threats`.
10. Нажать «Разрешить» в toast и убедиться, что реклама растёт быстрее.
11. Дождаться CAPTCHA или проверить её после временного уменьшения интервала.
12. Проверить экран проигрыша после снижения XP до `0`.

---

## 16. Проверка сборки

Для проверки типов и production-сборки используется:

```powershell
cd Front\front
npm run build
```

Команда запускает:

- `vue-tsc --build` — проверку TypeScript/Vue-типы;
- `vite build` — production-сборку.

На момент написания руководства обе проверки проходят успешно.
