<template>
    <section class="page-banner">
        <div class="wrapper">
            <div class="breadcrumb-trail">
                <Link href="/catalog" class="breadcrumb-link">Каталог /</Link>
                <span class="breadcrumb-current">{{ currentPageName }}</span>
            </div>

            <div class="banner-content">
                <h1 class="banner-title">
                    <span class="title-text">{{ pageTitle }}</span>
                    <span class="title-underline"></span>
                </h1>
            </div>
        </div>

        <!-- Геометрические элементы фона -->
        <div class="banner-geo-shapes">
            <div class="geo-shape-1"></div>
            <div class="geo-shape-2"></div>
            <div class="geo-shape-3"></div>
            <div class="geo-shape-4"></div>
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
    position: relative;
    z-index: 2;
}

.page-banner {
    height: 380px;
    background-color: #f2f2f2;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 0 8%;
    position: relative;
    overflow: hidden;
    isolation: isolate;
}

.breadcrumb-trail {
    font-family: 'Inter', sans-serif;
    font-size: 0.95rem;
    color: #6c757d;
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 3;
}

.breadcrumb-link {
    color: #6c757d;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
}

.breadcrumb-link:hover {
    color: #FFA630;
    text-decoration: underline;
}

.breadcrumb-current {
    color: #007b5e;
    font-weight: 600;
    margin-left: 8px;
}

.banner-content {
    position: relative;
    z-index: 2;
    max-width: 70%;
}

.banner-title {
    font-size: 3.2rem;
    font-weight: 800;
    color: #212529;
    margin: 0;
    position: relative;
    display: inline-block;
    line-height: 1.2;
    font-family: 'Inter', sans-serif;
    letter-spacing: -0.5px;
}

.title-underline {
    position: absolute;
    bottom: -12px;
    left: 0;
    width: 80px;
    height: 5px;
    background: #FFA630;
    border-radius: 3px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
    transform-origin: left center;
}

.banner-title:hover .title-underline {
    width: 100%;
    background: #00997a;
}

/* Геометрический фон */
.banner-geo-shapes {
    position: absolute;
    inset: 0;
    z-index: 1;
    overflow: hidden;
}

.geo-shape-1 {
    position: absolute;
    top: -50px;
    right: -50px;
    width: 300px;
    height: 300px;
    background: rgba(0, 123, 94, 0.08);
    clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
    transform: rotate(15deg);
    animation: float 8s ease-in-out infinite;
}

.geo-shape-2 {
    position: absolute;
    bottom: -80px;
    left: -80px;
    width: 400px;
    height: 400px;
    background: rgba(255, 166, 48, 0.05);
    clip-path: circle(50% at 50% 50%);
    animation: float 10s ease-in-out infinite reverse;
}

.geo-shape-3 {
    position: absolute;
    top: 30%;
    left: 60%;
    width: 150px;
    height: 150px;
    background: rgba(0, 153, 122, 0.1);
    clip-path: polygon(0% 0%, 100% 0%, 50% 100%);
    animation: float 6s ease-in-out infinite 2s;
}

.geo-shape-4 {
    position: absolute;
    bottom: 20%;
    right: 10%;
    width: 200px;
    height: 200px;
    background: rgba(0, 123, 94, 0.05);
    clip-path: polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 70% 100%, 30% 100%, 0% 70%, 0% 30%);
    animation: float 12s ease-in-out infinite;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(5deg);
    }
}

/* Адаптив */
@media (max-width: 1024px) {
    .banner-title {
        font-size: 2.8rem;
    }
}

@media (max-width: 768px) {
    .page-banner {
        height: 280px;
        padding: 0 5%;
    }

    .banner-content {
        max-width: 90%;
    }

    .banner-title {
        font-size: 2.2rem;
    }

    .geo-shape-1,
    .geo-shape-2,
    .geo-shape-3,
    .geo-shape-4 {
        opacity: 0.5;
    }
}

@media (max-width: 480px) {
    .page-banner {
        height: 240px;
    }

    .banner-title {
        font-size: 1.8rem;
    }

    .title-underline {
        height: 4px;
        bottom: -8px;
    }

    .breadcrumb-trail {
        font-size: 0.85rem;
    }
}
</style>
