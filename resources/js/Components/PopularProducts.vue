<template>
    <section class="wrapper">
        <div class="section-header">
            <h2>Популярные и новые <span>товары</span></h2>
        </div>
        <div class="products-grid">
            <div class="product-card" v-for="(product, index) in products" :key="index" @click="goToProduct(product)">
                <div class="product-image-container">
                    <img :src="product.image_url" :alt="product.title" class="product-image" />
                    <div class="product-badge">New</div>
                </div>
                <div class="product-info">
                    <h3 class="product-title">{{ product.title }}</h3>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
defineProps({
    products: Array,
});

import { router } from '@inertiajs/vue3';

function goToProduct(product) {
    router.visit(`/catalog/${product.id}`);
}

function formatPrice(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}
</script>

<style scoped>
/* Основные стили */
.section-header h2 {
    font-size: 2.25rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 30px;
    color: #333;
    position: relative;
    display: inline-block;
}

.section-header h2 span {
    position: relative;
    z-index: 1;
}

.section-header h2 span::after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 0;
    width: 100%;
    height: 6px;
    background-color: #FFA630;
    z-index: -1;
    border-radius: 4px;
}

.products-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 25px;
    margin-top: 30px;
    justify-content: flex-start;
}

.product-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    width: calc(33.333% - 17px); /* 3 колонки с учетом gap */
    min-width: 150px;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.product-image-container {
    position: relative;
    padding-top: 100%;
    overflow: hidden;
}

.product-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.03);
}

.product-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #FFA630;
    color: white;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
}

.product-info {
    padding: 15px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.product-title {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #333;
    flex-grow: 1;
}

/* 1200px и ниже — 3 в ряд → 2 */
@media (max-width: 1200px) {
    .product-card {
        width: calc(50% - 12.5px); /* 2 карточки в ряд с gap */
    }
}

/* 768px и ниже — 2 в ряд → 1 */
@media (max-width: 768px) {
    .products-grid {
        justify-content: center;
    }

    .product-card {
        width: 100%;
        max-width: 420px;
    }

    .product-info {
        padding: 12px;
    }

    .product-title {
        font-size: 15px;
    }

    .product-price {
        font-size: 16px;
    }

    .product-button {
        font-size: 13px;
        padding: 8px 12px;
    }
}

/* Микроадаптив под iPhone SE / X / Mini */
@media (max-width: 480px) {
    .section-header h2 {
        font-size: 1.6rem;
    }

    .product-button {
        width: 100%;
        text-align: center;
    }

    .product-footer {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
}

</style>
