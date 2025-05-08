<template>
    <header>
        <section class="wrapper">
            <nav id="head">
                <!-- Логотип -->
                <div class="logo">
                    <Link href="/"><img alt="Logo" src="@/assets/img/header/logo.svg" class="clickable" /></Link>
                </div>

                <!-- Мобильное меню (бургер) -->
                <div class="burger" @click="toggleMobileMenu" @mousedown="startBurgerPress" @mouseup="endBurgerPress" @mouseleave="endBurgerPress">
                    <span :class="{ 'burger-pressed': isBurgerPressed }"></span>
                    <span :class="{ 'burger-pressed': isBurgerPressed }"></span>
                    <span :class="{ 'burger-pressed': isBurgerPressed }"></span>
                </div>

                <!-- Навигация -->
                <ul class="nav-links" :class="{ 'mobile-active': isMobileMenuOpen }">
                    <li><Link href="/about" @click="closeMobileMenu" class="nav-link"><p>О компании</p></Link></li>
                    <li><Link href="/catalog" @click="closeMobileMenu" class="nav-link"><p>Каталог</p></Link></li>
                    <li><Link href="/services" @click="closeMobileMenu" class="nav-link"><p>Услуги</p></Link></li>
                    <li><Link href="/contacts" @click="closeMobileMenu" class="nav-link"><p>Контакты</p></Link></li>
                    <li><Link href="/portfolio" @click="closeMobileMenu" class="nav-link"><p>Портфолио</p></Link></li>
                    <li><Link href="/constructor" @click="closeMobileMenu" class="nav-link"><p>Конструктор</p></Link></li>

                    <!-- Иконки: Личный кабинет / Корзина -->
                    <li class="mobile-icons">
                        <template v-if="$page.props.auth.user">
                            <span class="inline-flex rounded-md">
                                <Link
                                    :href="route('dashboard')"
                                    class="user-button"
                                    @mousedown="startButtonPress('user')"
                                    @mouseup="endButtonPress('user')"
                                    @mouseleave="endButtonPress('user')"
                                    :class="{ 'button-pressed': isUserButtonPressed }"
                                >
                                    {{ $page.props.auth.user.name }}
                                </Link>
                            </span>
                        </template>

                        <Link v-else href="/login" @click="closeMobileMenu" class="icon-link" @mousedown="startIconPress('user')" @mouseup="endIconPress('user')" @mouseleave="endIconPress('user')">
                            <img src="@/assets/img/header/user.svg" alt="Личный кабинет" :class="{ 'icon-pressed': isUserIconPressed }" />
                        </Link>

                        <Link href="/cart" @click="closeMobileMenu" class="icon-link" @mousedown="startIconPress('cart')" @mouseup="endIconPress('cart')" @mouseleave="endIconPress('cart')">
                            <img src="@/assets/img/header/shop.svg" alt="Корзина" :class="{ 'icon-pressed': isCartIconPressed }" />
                        </Link>
                    </li>
                </ul>
            </nav>
        </section>
    </header>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const isMobileMenuOpen = ref(false);
const isBurgerPressed = ref(false);
const isUserIconPressed = ref(false);
const isCartIconPressed = ref(false);
const isUserButtonPressed = ref(false);

function toggleMobileMenu() {
    isMobileMenuOpen.value = !isMobileMenuOpen.value;
}

function closeMobileMenu() {
    isMobileMenuOpen.value = false;
}

function startBurgerPress() {
    isBurgerPressed.value = true;
}

function endBurgerPress() {
    isBurgerPressed.value = false;
}

function startIconPress(icon) {
    if (icon === 'user') isUserIconPressed.value = true;
    if (icon === 'cart') isCartIconPressed.value = true;
}

function endIconPress(icon) {
    if (icon === 'user') isUserIconPressed.value = false;
    if (icon === 'cart') isCartIconPressed.value = false;
}

function startButtonPress(button) {
    if (button === 'user') isUserButtonPressed.value = true;
}

function endButtonPress(button) {
    if (button === 'user') isUserButtonPressed.value = false;
}
</script>

<style scoped>
/* Базовые стили (1920px и больше) */
header {
    background-color: #f2f2f2;
    border-bottom: solid #e5e5e5 2px;
}

#head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px 0;
    position: relative;
}

.logo img {
    width: 100%;
    max-width: 180px;
    transition: transform 0.1s ease;
}

.nav-links {
    list-style: none;
    display: flex;
    align-items: center;
    gap: 20px;
    margin: 0;
    padding: 0;
}

.nav-links li {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.nav-links a {
    text-decoration: none;
}

.nav-links p {
    font-family: medium, Inter,serif;
    font-size: 1rem;
    color: black;
    margin: 0;
}

.construct img {
    width: 18px;
    height: 18px;
}

.icons img {
    width: 50px;
    height: 50px;
}

/* Эффекты нажатия */
.clickable:active {
    transform: scale(0.95);
}

.burger-pressed {
    background-color: #666 !important;
    transform: scale(0.9);
}

.nav-link {
    transition: transform 0.1s ease, color 0.1s ease;
}

.nav-link:active p {
    color: #666;
    transform: scale(0.95);
}

.icon-link img {
    transition: transform 0.1s ease;
}

.icon-pressed {
    transform: scale(0.85);
}

.user-button {
    transition: all 0.1s ease;
    border: 1px solid #ddd;
    padding: 8px 16px;
    border-radius: 4px;
}

.button-pressed {
    transform: scale(0.95);
    background-color: #f0f0f0;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
}

/* Мобильное меню (скрыто на десктопе) */
.burger {
    display: none;
    flex-direction: column;
    justify-content: space-between;
    width: 30px;
    height: 21px;
    cursor: pointer;
    z-index: 100;
}

.burger span {
    display: block;
    width: 100%;
    height: 3px;
    background-color: #000;
    transition: all 0.3s ease;
}

/* Адаптивность */
/* Планшеты и small ноутбуки: 771–1024 */
@media screen and (max-width: 1024px) and (min-width: 771px) {
    #head {
        padding: 10px 30px;
        gap: 20px;
    }

    .logo img {
        max-width: 150px;
    }

    .nav-links {
        gap: 15px;
    }

    .nav-links p {
        font-size: 0.95rem;
    }

    .burger {
        display: none; /* Бургер пока не нужен — меню в линию */
    }

    .mobile-icons {
        display: flex;
        gap: 15px;
    }

    .mobile-icons img {
        width: 50px;
        height: 50px;
    }
}

@media screen and (max-width: 768px) {
    #head {
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 15px 20px; /* Добавили отступы слева/справа */
    }

    .burger {
        display: flex;
    }

    .nav-links {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #f2f2f2;
        flex-direction: column;
        align-items: stretch;
        padding: 20px;
        display: none;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        z-index: 99;
    }

    .nav-links.mobile-active {
        display: flex;
    }

    .nav-links li {
        width: 100%;
        padding: 12px 10px;
        border-bottom: 1px solid #e5e5e5;
        text-align: left;
    }

    .nav-links p {
        font-size: 1rem;
        margin: 0;
    }

    .logo img {
        max-width: 120px;
    }

    .mobile-icons {
        display: flex;
        gap: 15px;
        margin-top: 10px;
        padding-left: 10px;
    }

    .mobile-icons img {
        width: 50px;
        height: 50px;
    }
}
/* Мобилки и планшеты вертикально: до 770px */
@media screen and (max-width: 770px) {
    #head {
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 15px 20px;
    }

    .burger {
        display: flex;
    }

    .nav-links {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #f2f2f2;
        flex-direction: column;
        align-items: stretch;
        padding: 20px;
        display: none;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        z-index: 99;
    }

    .nav-links.mobile-active {
        display: flex;
    }

    .nav-links li {
        width: 100%;
        padding: 12px 10px;
        border-bottom: 1px solid #e5e5e5;
        text-align: left;
    }

    .nav-links p {
        font-size: 1rem;
        margin: 0;
    }

    .mobile-icons {
        display: flex;
        gap: 15px;
        margin-top: 10px;
        padding-left: 10px;
    }

    .mobile-icons img {
        width: 50px;
        height: 50px;
    }

    .logo img {
        max-width: 120px;
    }
}

/* iPhone X и меньше */
@media screen and (max-width: 480px) {
    #head {
        padding: 10px 15px;
    }

    .logo img {
        max-width: 100px;
    }

    .burger {
        width: 25px;
        height: 18px;
    }

    .burger span {
        height: 2px;
    }

    .nav-links p {
        font-size: 0.9rem;
    }

    .mobile-icons img {
        width: 45px;
        height: 45px;
    }
}
</style>
