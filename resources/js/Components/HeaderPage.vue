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
