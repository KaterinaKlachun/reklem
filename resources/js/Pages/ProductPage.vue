<template>
    <Head title="Продукт" />

    <PageBannerProduct
        page-title="Наша продукция"
        current-page-name="Продукт"
    />

    <section v-if="product" class="product-wrapper">
        <div class="product-container">
            <div class="product-left">
                <!-- Изображение продукта -->
                <div class="image-container">
                    <img :src="selectedColorImage" :alt="product.name" class="product-image" loading="lazy" />
                </div>
            </div>
            <div class="product-right">
                <h1 class="product-title">{{ product.name }}</h1>

                <div class="stock-info">
                    <span class="badge article-badge">Арт. {{ product.article }}</span>
                    <span class="badge stock-badge">На складе {{ product.stock }} шт.</span>
                </div>

                <div class="color-selector">
                    <label>Цвет:</label>
                    <select @change="updateColorImage($event.target.value)" class="styled-select">
                        <option v-for="color in product.product_colors" :key="color.color" :value="color.color">
                            {{ color.color }}
                        </option>
                    </select>
                </div>

                <div class="price-container">
                    <span class="product-price">{{ product.price }} ₽</span>
                </div>

                <div class="add-to-cart-container">
                    <div class="quantity-counter">
                        <button @click="selectedQuantity = Math.max(1, selectedQuantity - 1)"
                                class="quantity-button decrement" aria-label="Уменьшить количество">
                            −
                        </button>
                        <span class="quantity-value">{{ selectedQuantity }}</span>
                        <button @click="selectedQuantity++"
                                class="quantity-button increment" aria-label="Увеличить количество">
                            +
                        </button>
                    </div>
                    <button class="add-to-cart-button" @click="addToCart" aria-label="Добавить в корзину">
                        В корзину
                    </button>
                </div>
            </div>
        </div>

        <div class="product-info">
            <h2 class="section-title">Описание</h2>
            <p class="product-description">{{ product.description }}</p>
        </div>
    </section>

    <section v-else class="loading-section">
        <div class="loader"></div>
        <p>Загрузка данных о продукте...</p>
    </section>
</template>

<script>
import PageBannerProduct from "@/Components/PageBannerProduct.vue";
import {Head} from "@inertiajs/vue3";

export default {
    components: {Head, PageBannerProduct },
    props: {
        product: Object,
    },
    data() {
        return {
            selectedColorImage: this.product?.product_colors[0]?.image_url || '',
            selectedQuantity: 1,
        };
    },
    methods: {
        updateColorImage(selectedColor) {
            const selectedColorData = this.product.product_colors.find(
                (color) => color.color === selectedColor
            );
            this.selectedColorImage = selectedColorData ? selectedColorData.image_url : null;
        },
        addToCart() {
            console.log(`Добавлено в корзину: ${this.selectedQuantity} шт. товара "${this.product.name}"`);
        },
    },
};
</script>

<style scoped>
.product-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.product-container {
    display: flex;
    gap: 2rem;
    background: #fff;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.product-left {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

.image-container {
    background: #f2f2f2;
    border-radius: 8px;
    padding: 1rem;
    display: flex;
    justify-content: center;
    align-items: center;
}

.product-image {
    max-width: 100%;
    max-height: 400px;
    object-fit: contain;
    border-radius: 6px;
}

.product-right {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.product-title {
    font-size: 2rem;
    color: #333;
    font-weight: 600;
    margin-bottom: 1rem;
}

.stock-info {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
}

.article-badge {
    background-color: #f2f2f2;
    color: #007b5e;
}

.stock-badge {
    background-color: #FFA630;
    color: white;
}

.color-selector {
    margin-bottom: 2rem;
}

.color-selector label {
    display: block;
    margin-bottom: 0.5rem;
    color: #555;
    font-weight: 500;
}

.styled-select {
    width: 100%;
    padding: 0.8rem;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    background-color: white;
    font-size: 1rem;
    color: #333;
    transition: all 0.3s;
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23007b5e' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.8rem center;
    background-size: 1rem;
}

.styled-select:focus {
    outline: none;
    border-color: #00997a;
    box-shadow: 0 0 0 2px rgba(0, 155, 122, 0.2);
}

.price-container {
    margin: 1.5rem 0;
}

.product-price {
    font-size: 2rem;
    font-weight: 700;
    color: #007b5e;
}

.add-to-cart-container {
    display: flex;
    gap: 1rem;
    margin-top: auto;
}

.quantity-counter {
    display: flex;
    align-items: center;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
}

.quantity-button {
    width: 40px;
    height: 40px;
    background: white;
    border: none;
    font-size: 1.2rem;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.quantity-button:hover {
    background: #f2f2f2;
}

.quantity-value {
    width: 40px;
    text-align: center;
    font-weight: 500;
}

.add-to-cart-button {
    flex: 1;
    padding: 0.8rem;
    background: #007b5e;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.add-to-cart-button:hover {
    background: #00997a;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 155, 122, 0.2);
}

.product-info {
    margin-top: 3rem;
    background: #fff;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.section-title {
    font-size: 1.5rem;
    color: #007b5e;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #f2f2f2;
}

.product-description {
    line-height: 1.6;
    color: #555;
}

.loading-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 300px;
}

.loader {
    border: 4px solid #f2f2f2;
    border-top: 4px solid #007b5e;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
    margin-bottom: 1rem;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@media screen and (max-width: 768px) {
    .product-container {
        flex-direction: column;
        gap: 1.5rem;
        padding: 1.5rem;
    }

    .add-to-cart-container {
        flex-direction: column;
    }

    .product-right, .product-left {
        width: 100%;
    }

    .product-image {
        max-height: 300px;
    }

    .product-title {
        font-size: 1.6rem;
    }

    .product-price {
        font-size: 1.6rem;
    }

    .quantity-counter {
        margin-bottom: 1.5rem;
    }

    .quantity-button {
        width: 35px;
        height: 35px;
    }

    .add-to-cart-button {
        padding: 0.7rem;
    }

    .product-info {
        padding: 1.5rem;
    }
}
</style>
