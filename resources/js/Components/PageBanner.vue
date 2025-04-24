<template>
    <section class="page-banner">
        <div class="wrapper">
            <div class="breadcrumb-trail">
                <Link href="/" class="breadcrumb-link">Главная /</Link>
                <span class="breadcrumb-current">{{ currentPageName }}</span>
            </div>

            <div class="banner-content">
                <h1 class="banner-title">
                    <span class="title-text">{{ pageTitle }}</span>
                    <span class="title-underline"></span>
                </h1>
            </div>

            <div class="banner-accent"></div>
        </div>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    pageTitle: {
        type: String,
        required: true
    },
    currentPageName: {
        type: String,
        required: true
    }
});
</script>

<style scoped>
.wrapper {
    width: 100%;
    max-width: 1180px;
    margin: 0 auto;
}

.page-banner {
    height: 280px;
    background: #f2f2f2; /* Ваш серый фон */
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 0 10%;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.breadcrumb-trail {
    font-family: 'Inter', sans-serif;
    font-size: 0.95rem;
    color: #6c757d; /* Стандартный серый для хлебных крошек */
    margin-bottom: 1rem;
}

.breadcrumb-link {
    color: #6c757d;
    text-decoration: none;
    transition: all 0.3s ease;
}

.breadcrumb-link:hover {
    color: #FFA630; /* Ваш оранжевый при наведении */
}

.breadcrumb-current {
    color: #10BB87; /* Ваш зеленый для текущей страницы */
    font-weight: 500;
    margin-left: 8px;
}

.banner-content {
    position: relative;
    z-index: 2;
}

.banner-title {
    font-size: 2.8rem;
    font-weight: 700;
    color: #212529; /* Темный цвет для заголовка */
    margin: 0;
    position: relative;
    display: inline-block;
    line-height: 1.2;
}

.title-underline {
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 70px;
    height: 4px;
    background: #10BB87; /* Ваш зеленый для подчеркивания */
    border-radius: 2px;
    transition: width 0.3s ease;
}

.banner-title:hover .title-underline {
    width: 100%;
}

.banner-accent {
    position: absolute;
    right: -50px;
    top: 50%;
    transform: translateY(-50%);
    width: 200px;
    height: 200px;
    background: rgba(16, 187, 135, 0.1); /* 10% прозрачности вашего зеленого */
    border-radius: 50%;
    z-index: 1;
}

@media (max-width: 768px) {
    .page-banner {
        height: 220px;
        padding: 0 5%;
    }

    .banner-title {
        font-size: 2rem;
    }
}
</style>
