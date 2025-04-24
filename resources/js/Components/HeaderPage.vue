<template>
    <!-- Шапка сайта -->
    <header>
        <section class="wrapper">
            <nav id="head">
                <!-- Логотип -->
                <div class="logo">
                    <Link href="/"><img alt="Logo" src="@/assets/img/header/logo.svg"/></Link>
                </div>

                <!-- Мобильное меню (бургер) -->
                <div class="burger" @click="toggleMobileMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <!-- Ссылки навигации -->
                <ul class="nav-links" :class="{ 'mobile-active': isMobileMenuOpen }">
                    <li><Link href="/about" @click="closeMobileMenu"><p>О компании</p></Link></li>
                    <li><Link href="/catalog" @click="closeMobileMenu"><p>Каталог</p></Link></li>
                    <li><Link href="/services" @click="closeMobileMenu"><p>Услуги</p></Link></li>
                    <li><Link href="/contacts" @click="closeMobileMenu"><p>Контакты</p></Link></li>
                    <li><Link href="/portfolio" @click="closeMobileMenu"><p>Портфолио</p></Link></li>
                    <li><Link href="/constructor" @click="closeMobileMenu"><p>Конструктор</p></Link></li>
                    <li class="mobile-icons">
                        <Link href="/account" @click="closeMobileMenu"><img src="@/assets/img/header/user.svg" alt="Личный кабинет" /></Link>
                        <Link href="/basket" @click="closeMobileMenu"><img src="@/assets/img/header/shop.svg" alt="Корзина" /></Link>
                    </li>
                </ul>

            </nav>
        </section>
    </header>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    name: "HeaderPage",
    components: {
        Link,
    },
    data() {
        return {
            isSearchVisible: false,
            isMobileMenuOpen: false,
            searchQuery: "",
            results: [],
            pages: [
                { page: "О компании", link: "/about", content: "Информация о компании" },
                { page: "Каталог", link: "/catalog", content: "Список товаров" },
                { page: "Услуги", link: "/services", content: "Описание услуг" },
                { page: "Контакты", link: "/contacts", content: "Свяжитесь с нами" },
                { page: "Портфолио", link: "/portfolio", content: "Готовые работы" },
                { page: "Конструктор", link: "/construct", content: "Конструктор" },
            ],
        };
    },
    methods: {
        toggleMobileMenu() {
            this.isMobileMenuOpen = !this.isMobileMenuOpen;
        },
        closeMobileMenu() {
            this.isMobileMenuOpen = false; // Закрываем меню при переходе
        },
    },
};
</script>

<style scoped>
/* Базовые стили (1920px и больше) */
header {
    background-color: #f2f2f2;
    border-bottom: solid #e5e5e5 2px;
}

.wrapper {
    width: 100%;
    max-width: 1180px;
    margin: 0 auto;
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
    font-family: medium;
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

.search-container {
    margin-top: 10px;
    display: flex;
    flex-direction: column;
    position: absolute;
    width: 100%;
    max-width: 1180px;
    background: #f2f2f2;
    z-index: 10;
    padding-bottom: 10px;
}

.search-container input {
    width: 100%;
    padding: 12px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.search-results {
    margin-top: 10px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.search-results ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.search-results li {
    padding: 12px;
    border-bottom: 1px solid #eee;
}

.search-results li:last-child {
    border-bottom: none;
}

.search-results a {
    text-decoration: none;
    color: #333;
    display: block;
}

.search-results a:hover {
    text-decoration: underline;
}

.no-results {
    margin-top: 10px;
    color: #999;
    padding: 12px;
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
@media (max-width: 1440px) {
    .wrapper {
        max-width: 1100px;
        padding: 0 20px;
    }

    .nav-links {
        gap: 15px;
    }

    .construct {
        padding: 10px 20px;
    }
}

@media (max-width: 992px) {
    .wrapper {
        max-width: 720px;
    }

    .nav-links {
        position: fixed;
        top: 0;
        right: -100%;
        width: 70%;
        height: 100vh;
        background: #f2f2f2;
        flex-direction: column;
        align-items: flex-start;
        padding: 80px 30px 30px;
        gap: 25px;
        transition: right 0.3s ease;
        z-index: 99;
    }

    .nav-links.mobile-active {
        right: 0;
    }

    .burger {
        display: flex;
    }

    .mobile-icons {
        display: flex;
        gap: 20px;
        margin-top: 20px;
    }

    .mobile-icons img {
        width: 50px;
        height: 50px;
    }

    .search-icon {
        order: -1;
        margin-bottom: 20px;
    }

    .burger.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }

    .burger.active span:nth-child(2) {
        opacity: 0;
    }

    .burger.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -6px);
    }
}

@media (max-width: 576px) {
    .wrapper {
        width: 100%;
        padding: 0 10px;
    }

    #head {
        padding: 10px 0;
    }

    .logo img {
        max-width: 130px;
    }

    .nav-links {
        width: 85%;
        padding: 70px 20px 20px;
    }

    .construct {
        padding: 8px 12px;
        font-size: 0.65rem;
    }

    .construct img {
        width: 16px;
        height: 16px;
    }

    .search-container input {
        padding: 10px;
    }

    .search-results li {
        padding: 10px;
    }
}
</style>
