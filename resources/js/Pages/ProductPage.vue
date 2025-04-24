<template>
    <!-- Информация о странице -->
    <section class="info">
        <div class="pagination">
            <router-link to="/">Главная / </router-link>
            <router-link to="/catalog">Каталог /</router-link>
        </div>
    </section>

    <!-- Информация о продукте -->
    <section v-if="product" class="wrapper">
        <div class="product">
            <div class="product_left">
                <!-- Ленивая загрузка изображения продукта -->
                <img
                    :src="selectedColorImage"
                    :alt="product.name"
                    class="product-image"
                    loading="lazy"
                />
            </div>
            <div class="product_right">
                <p>{{ product.name }}</p>
                <div class="stock_info">
                    <p id="art">Арт. {{ product.article }}</p>
                    <p>На складе {{ product.stock }} шт.</p>
                </div>
                <div class="custom-select">
                    <div class="options">
                        <p>Цвет</p>
                        <select @change="updateColorImage($event.target.value)">
                            <option
                                v-for="color in product.product_colors"
                                :key="color.color"
                                :value="color.color"
                            >
                                {{ color.color }}
                            </option>
                        </select>
                    </div>
                </div>
                <p id="product-price" class="product-price">{{ product.price }} ₽</p>
                <div class="add-to-cart-container">
                    <button
                        class="add-to-cart-button"
                        @click="addToCart"
                        aria-label="Добавить в корзину"
                    >
                        В корзину
                    </button>
                    <div class="quantity-counter">
                        <!-- Ленивая загрузка иконок -->
                        <button
                            @click="selectedQuantity = Math.max(1, selectedQuantity - 1)"
                            class="decrement-button"
                            aria-label="Уменьшить количество"
                        >
                            <img
                                src="@/assets/img/product/minus.svg"
                                alt="Уменьшить количество"
                                loading="lazy"
                            />
                        </button>
                        <span>{{ selectedQuantity }}</span>
                        <button
                            @click="selectedQuantity++"
                            class="increment-button"
                            aria-label="Увеличить количество"
                        >
                            <img
                                src="@/assets/img/product/plus.svg"
                                alt="Увеличить количество"
                                loading="lazy"
                            />
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="product_info">
            <h1>Описание</h1>
            <p>{{ product.description }}</p>
        </div>
    </section>

    <section v-else>
        <p>Загрузка данных о продукте...</p>
    </section>
</template>

<script>
import axios from 'axios';

export default {
    name: "ProductPage",
    props: ["id"], // id передаётся как пропс
    data() {
        return {
            product: null,
            selectedColorImage: null,
            selectedQuantity: 1,
        };
    },
    methods: {
        async loadProduct() {
            try {
                // Запрос к API Laravel
                const response = await axios.get(`/api/products/${this.id}`);
                this.product = response.data;

                // Установка изображения для первого цвета
                if (this.product.product_colors && this.product.product_colors.length > 0) {
                    this.selectedColorImage = this.product.product_colors[0].image_url;
                } else {
                    this.selectedColorImage = null;
                }
            } catch (error) {
                console.error("Ошибка при загрузке продукта:", error);
            }
        },
        updateColorImage(selectedColor) {
            const selectedColorData = this.product.product_colors?.find(
                (color) => color.color === selectedColor
            );
            if (selectedColorData) {
                this.selectedColorImage = selectedColorData.image_url;
            } else {
                this.selectedColorImage = null;
            }
        },
        addToCart() {
            console.log(`Добавлено в корзину: ${this.selectedQuantity} шт. товара "${this.product.name}"`);
        },
    },
    created() {
        this.loadProduct();
    },
    watch: {
        "$route.params.id": "loadProduct", // Следим за изменением id в URL
    },
};
</script>

<style scoped>
.product {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-top: 10%;
}

.product_left img {
    width: 100%;
    max-width: 450px;
}

.product_right {
    width: 100%;
    max-width: 50%;
    padding-left: 2%;
}

.product_right p {
    font-family: medium;
    font-size: 1.5rem;
}

.stock_info {
    display: flex;
    justify-content: space-between;
    margin-top: 5%;
}

.stock_info p {
    font-family: medium;
    font-size: 0.75rem;
    color: #FFA630;
}

#art {
    color: #10BB87;
}

.options {
    display: flex;
    justify-content: space-between;
    padding: 10px;
    align-items: center;
    margin-top: 5%;
}

.options p {
    font-family: medium;
    font-size: 0.85rem;
}

.options select {
    background-color: #FAFAFA;
    border: 1px solid #F2F2F2;
    border-radius: 4px;
    width: 70%;
    height: 40px;
}

.product-price {
    margin-top: 5%;
    width: 275px;
    height: 70px;
    background-image: url("@/assets/img/product/back.svg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: white;
    font-family: medium;
}

.add-to-cart-container {
    display: flex;
    margin-top: 10%;
    justify-content: space-between;
}

.add-to-cart-button {
    width: 300px;
    background-color: white;
    border: none;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}

.quantity-counter {
    display: flex;
    align-items: center;
    width: 30%;
}

.decrement-button,
.increment-button {
    background-color: white;
    border: none;
    padding: 5px;
}

.quantity-counter span {
    margin: 0 10px;
    font-size: 16px;
    color: #00A860;
}

.product_info {
    margin-top: 10%;
}

.product_info h1 {
    color: #10BB87;
    font-family: medium;
    font-size: 1.5rem;
    margin-bottom: 5%;
}

.product_info p {
    font-family: regular;
    font-size: 0.875rem;
}

@media screen and (max-width: 768px) {
    .product {
        flex-direction: column;
        align-items: center;
    }

    .product_left,
    .product_right {
        width: 100%;
        padding-left: 0;
    }

    .add-to-cart-container {
        flex-direction: column;
        align-items: center;
    }
}
</style>
