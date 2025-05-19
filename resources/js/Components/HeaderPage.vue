<template>
    <header class="header">
        <div class="header-container">
            <!-- Логотип -->
            <Link href="/" class="logo">
                <img src="@/assets/img/header/logo.svg" alt="Logo" class="logo-image">
            </Link>

            <!-- Основное меню -->
            <nav class="main-nav">
                <ul class="nav-list">
                    <li class="nav-item" v-for="item in navItems" :key="item.path">
                        <Link
                            :href="item.path"
                            class="nav-link"
                            :class="{ 'active': $page.url.startsWith(item.path) }"
                        >
                            <span class="link-text">{{ item.title }}</span>
                            <span class="link-underline"></span>
                        </Link>
                    </li>
                </ul>
            </nav>

            <!-- Иконки пользователя и корзины -->
            <div class="user-actions">
                <template v-if="$page.props.auth.user">
                    <Link
                        :href="route('dashboard')"
                        class="user-profile"
                        :title="$page.props.auth.user.name"
                    >
                        <div class="avatar">
                            {{ getInitials($page.props.auth.user.name) }}
                        </div>
                        <span class="user-name">{{ getShortName($page.props.auth.user.name) }}</span>
                    </Link>
                </template>
                <Link v-else href="/login" class="login-btn">
                    <span>Войти</span>
                </Link>

                <Link href="/cart" class="cart-btn" :class="{ 'has-items': cartCount > 0 }">
                    <img :src="cartIcon" alt="Корзина" />
                </Link>

            </div>

            <!-- Мобильное меню -->
            <button
                class="mobile-menu-btn"
                @click="toggleMobileMenu"
                :class="{ 'active': isMobileMenuOpen }"
                aria-label="Меню"
            >
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>

        <!-- Мобильное меню (выпадашка) -->
        <Transition name="slide-down">
            <div class="mobile-menu" v-show="isMobileMenuOpen">
                <div class="mobile-menu-container">
                    <ul class="mobile-nav-list">
                        <li
                            class="mobile-nav-item"
                            v-for="item in navItems"
                            :key="item.path"
                            @click="closeMobileMenu"
                        >
                            <Link
                                :href="item.path"
                                class="mobile-nav-link"
                                :class="{ 'active': $page.url.startsWith(item.path) }"
                            >
                                {{ item.title }}
                            </Link>
                        </li>
                    </ul>

                    <div class="mobile-user-actions">
                        <template v-if="$page.props.auth.user">
                            <Link
                                :href="route('dashboard')"
                                class="mobile-user-profile"
                                @click="closeMobileMenu"
                            >
                                <div class="mobile-avatar">
                                    {{ getInitials($page.props.auth.user.name) }}
                                </div>
                                <span>{{ $page.props.auth.user.name }}</span>
                            </Link>
                        </template>
                        <Link
                            v-else
                            href="/login"
                            class="mobile-login-btn"
                            @click="closeMobileMenu"
                        >
                            <UserIcon class="icon" />
                            <span>Войти в аккаунт</span>
                        </Link>
                    </div>
                </div>
            </div>
        </Transition>
    </header>
</template>

<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'

const isMobileMenuOpen = ref(false)
const cartCount = ref(3) // Замените на реальные данные

// Статический импорт пути к иконке
const cartIcon = new URL('@/assets/img/header/shop.svg', import.meta.url).href

const navItems = [
    { path: '/about', title: 'О компании' },
    { path: '/catalog', title: 'Каталог' },
    { path: '/services', title: 'Услуги' },
    { path: '/contacts', title: 'Контакты' },
    { path: '/portfolio', title: 'Портфолио' }
]

function getInitials(fullName) {
    if (!fullName) return '👤'
    return fullName.split(' ').map(n => n[0]).join('').toUpperCase()
}

function getShortName(fullName) {
    if (!fullName) return ''
    return fullName.split(' ')[0]
}

function toggleMobileMenu() {
    isMobileMenuOpen.value = !isMobileMenuOpen.value
}

function closeMobileMenu() {
    isMobileMenuOpen.value = false
}

</script>

<style scoped>
/* Базовые стили */
.header {
    font-family: regular;
    background: #fff;
    box-shadow: 0 2px 20px rgba(0, 123, 94, 0.1);
    position: sticky;
    top: 0;
    z-index: 1000;
}

.header-container {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 40px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
}

/* Логотип */
.logo {
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.logo:hover {
    transform: scale(1.05);
}

.logo-image {
    height: 40px;
    width: auto;
}

/* Основная навигация */
.main-nav {
    display: flex;
    align-items: center;
}

.nav-list {
    display: flex;
    gap: 2px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-item {
    position: relative;
}

.nav-link {
    padding: 12px 20px;
    text-decoration: none;
    color: #333;
    font-weight: 500;
    font-size: 16px;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: color 0.3s ease;
    position: relative;
}

.nav-link:hover {
    color: #00997a;
}

.nav-link.active {
    color: #007b5e;
    font-weight: 600;
}

.link-underline {
    position: absolute;
    bottom: 8px;
    left: 50%;
    transform: translateX(-50%) scaleX(0);
    width: 16px;
    height: 2px;
    background: #FFA630;
    border-radius: 2px;
    transition: transform 0.3s ease, width 0.3s ease;
}

.nav-link:hover .link-underline,
.nav-link.active .link-underline {
    transform: translateX(-50%) scaleX(1);
    width: 24px;
}

/* Блок пользователя */
.user-actions {
    display: flex;
    align-items: center;
    gap: 20px;
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    transition: transform 0.3s ease;
}

.user-profile:hover {
    transform: translateY(-2px);
}

.avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #007b5e, #00997a);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 14px;
    box-shadow: 0 4px 8px rgba(0, 123, 94, 0.2);
}

.user-name {
    font-weight: 500;
    color: #333;
    max-width: 120px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.login-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: linear-gradient(135deg, #007b5e, #00997a);
    color: white;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 123, 94, 0.25);
}

.login-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 123, 94, 0.35);
    background: linear-gradient(135deg, #00997a, #007b5e);
}

.icon {
    width: 20px;
    height: 20px;
}

/* Корзина */
.cart-btn {
    position: relative;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f8f8;
    border-radius: 50%;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.cart-btn:hover {
    background: #eee;
    transform: scale(1.1) rotate(-8deg);
}

.cart-counter {
    position: absolute;
    top: -4px;
    right: -4px;
    background: #FFA630;
    color: white;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 600;
}

/* Мобильное меню */
.mobile-menu-btn {
    display: none;
    width: 40px;
    height: 40px;
    position: relative;
    background: none;
    border: none;
    cursor: pointer;
    z-index: 1001;
    padding: 0;
}

.bar {
    display: block;
    position: absolute;
    height: 3px;
    width: 30px;
    background: #007b5e;
    border-radius: 2px;
    left: 5px;
    transition: all 0.3s ease;
}

.bar:nth-child(1) {
    top: 10px;
}

.bar:nth-child(2) {
    top: 18px;
}

.bar:nth-child(3) {
    top: 26px;
}

.mobile-menu-btn.active .bar:nth-child(1) {
    top: 18px;
    transform: rotate(45deg);
}

.mobile-menu-btn.active .bar:nth-child(2) {
    opacity: 0;
}

.mobile-menu-btn.active .bar:nth-child(3) {
    top: 18px;
    transform: rotate(-45deg);
}

.mobile-menu {
    position: fixed;
    top: 80px;
    left: 0;
    right: 0;
    background: white;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    z-index: 999;
    overflow-y: auto;
    max-height: calc(100vh - 80px);
}

.mobile-menu-container {
    padding: 20px 30px 40px;
}

.mobile-nav-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.mobile-nav-item {
    border-bottom: 1px solid #f0f0f0;
}

.mobile-nav-link {
    display: block;
    padding: 16px 0;
    text-decoration: none;
    color: #333;
    font-weight: 500;
    font-size: 18px;
    transition: color 0.3s ease;
}

.mobile-nav-link:hover,
.mobile-nav-link.active {
    color: #007b5e;
}

.mobile-user-actions {
    margin-top: 30px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.mobile-user-profile {
    display: flex;
    align-items: center;
    gap: 15px;
    text-decoration: none;
    padding: 12px 0;
}

.mobile-avatar {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #007b5e, #00997a);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 16px;
}

.mobile-login-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px 20px;
    background: linear-gradient(135deg, #007b5e, #00997a);
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.mobile-login-btn:hover {
    background: linear-gradient(135deg, #00997a, #007b5e);
}

/* Анимации */
.slide-down-enter-active,
.slide-down-leave-active {
    transition: all 0.5s ease;
}

.slide-down-enter-from,
.slide-down-leave-to {
    opacity: 0;
    transform: translateY(-20px);
}

/* Адаптивность */
@media (max-width: 1200px) {
    .header-container {
        padding: 0 30px;
    }

    .nav-link {
        padding: 12px 15px;
    }
}

@media (max-width: 992px) {
    .main-nav {
        display: none;
    }

    .user-actions {
        display: none;
    }

    .mobile-menu-btn {
        display: block;
    }

    .header-container {
        height: 70px;
        padding: 0 20px;
    }

    .logo-image {
        height: 35px;
    }
}

@media (max-width: 576px) {
    .mobile-menu-container {
        padding: 15px 20px 30px;
    }

    .mobile-nav-link {
        font-size: 16px;
        padding: 14px 0;
    }

    .mobile-avatar {
        width: 44px;
        height: 44px;
        font-size: 14px;
    }

    .mobile-login-btn {
        padding: 12px 16px;
        font-size: 15px;
    }
}
</style>
