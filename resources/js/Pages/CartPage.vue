<template>
    <Head title="Корзина" />

    <PageBanner
        page-title="Корзина"
        current-page-name="Корзина"
    />

    <section class="cart">
        <div class="wrapper">
            <div class="cart-container" v-if="cartItems.length > 0">
                <div class="cart-items">
                    <div v-for="item in cartItems" :key="item.id" class="cart-item">
                        <div class="item-image-wrapper">
                            <img
                                :src="fullImageUrl(item.product.image_url)"
                                :alt="item.product.name"
                                class="item-image"
                                @error="handleImageError"
                            />
                        </div>
                        <div class="item-content">
                            <div class="item-header">
                                <h3 class="item-title">{{ item.product.name }}</h3>
                                <button @click="removeItem(item.id)" class="remove-item">
                                    <img
                                        src="@/assets/img/icons/close.svg"
                                        alt="Удалить"
                                        class="icon icon-close"
                                    >
                                </button>
                            </div>
                            <p class="item-color">Цвет: {{ item.color }}</p>
                            <div class="item-footer">
                                <div class="quantity-control">
                                    <button @click="updateQuantity(item.id, item.quantity - 1)" class="quantity-btn">
                                        <img
                                            src="@/assets/img/icons/minus.svg"
                                            alt="Уменьшить"
                                            class="icon icon-minus"
                                        >
                                    </button>
                                    <span class="quantity-value">{{ item.quantity }}</span>
                                    <button @click="updateQuantity(item.id, item.quantity + 1)" class="quantity-btn">
                                        <img
                                            src="@/assets/img/icons/plus.svg"
                                            alt="Увеличить"
                                            class="icon icon-plus"
                                        >
                                    </button>
                                </div>
                                <p class="item-price">
                                    {{ item.product.price * item.quantity }} ₽
                                    <template v-if="item.service_price">
                                        + Услуга: {{ item.service_price * item.quantity }} ₽
                                    </template>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="cart-summary">
                    <div class="summary-row">
                        <span>Товары:</span>
                        <span>{{ cartItems.reduce((acc, item) => acc + item.quantity, 0) }} шт.</span>
                    </div>
                    <div class="summary-row total">
                        <span>Итого:</span>
                        <span class="total-price">{{ totalPrice }} ₽</span>
                    </div>
                    <button @click="submitOrder" class="checkout-button">
                        Оформить заказ
                    </button>
                </div>
            </div>

            <div v-else class="empty-cart">
                <div class="empty-icon">
                    <img
                        src="@/assets/img/icons/shopping-cart.svg"
                        alt="Корзина"
                        class="icon icon-cart"
                    >
                </div>
                <h3 class="empty-title">Ваша корзина пуста</h3>
                <p class="empty-text">Добавьте товары из каталога</p>
                <Link href="/catalog" class="continue-shopping">
                    Перейти в каталог
                    <img
                        src="@/assets/img/icons/arrow-right.svg"
                        alt=""
                        class="icon icon-arrow"
                    >
                </Link>
            </div>
        </div>
    </section>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import PageBanner from '@/Components/PageBanner.vue';

export default {
    components: { Head, Link, PageBanner },
    props: {
        cartItems: {
            type: Array,
            default: () => []
        },
        errors: Object,
        auth: Object,
        csrf_token: String
    },
    computed: {
        totalPrice() {
            return this.cartItems.reduce((total, item) => {
                const serviceTotal = item.service_price ? item.service_price * item.quantity : 0;
                return total + (item.product.price * item.quantity) + serviceTotal;
            }, 0);
        }
    },
    methods: {
        fullImageUrl(path) {
            if (!path) return '/images/placeholder-product.jpg';
            return path.startsWith('http') ? path : `${window.location.origin}/${path.replace(/^\/+/, '')}`;
        },
        handleImageError(event) {
            event.target.src = '/images/placeholder-product.jpg';
        },
        updateQuantity(itemId, newQuantity) {
            if (newQuantity < 1) return;
            this.$inertia.patch(`/cart/${itemId}`, {
                quantity: newQuantity
            }, {
                preserveScroll: true
            });
        },
        removeItem(itemId) {
            if (confirm('Удалить товар из корзины?')) {
                this.$inertia.delete(`/cart/${itemId}`, {
                    preserveScroll: true
                });
            }
        },

        async submitOrder(){
            try {
                const response = await this.$inertia.post('/cart/checkout');
                console.log('Заказ отправлен:', response);
            } catch (error) {
                console.log('Ошибка при оформлении заказа:', error);
            }
        },
    }
};
</script>

<style scoped>
.cart {
    padding: 60px 0;
}

.wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Карточки товаров */
.cart-items {
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-bottom: 40px;
}

.cart-item {
    display: flex;
    gap: 20px;
    padding: 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 123, 94, 0.08);
    transition: transform 0.2s, box-shadow 0.2s;
}

.cart-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0, 123, 94, 0.12);
}

.item-image-wrapper {
    width: 100px;
    height: 100px;
    flex-shrink: 0;
    border-radius: 8px;
    overflow: hidden;
    background-color: #f2f2f2;
}

.item-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.item-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.item-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 8px;
}

.item-title {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: #007b5e;
}

/* Стили для иконок */
.icon {
    display: block;
    pointer-events: none;
}

.icon-close {
    width: 16px;
    height: 16px;
    filter: invert(27%) sepia(51%) saturate(2878%) hue-rotate(346deg) brightness(104%) contrast(97%);
}

.icon-minus,
.icon-plus {
    width: 12px;
    height: 12px;
    filter: brightness(0) invert(1);
}

.icon-cart {
    width: 64px;
    height: 64px;
    filter: invert(24%) sepia(99%) saturate(1190%) hue-rotate(144deg) brightness(93%) contrast(101%);
}

.icon-arrow {
    width: 16px;
    height: 16px;
    filter: invert(24%) sepia(99%) saturate(1190%) hue-rotate(144deg) brightness(93%) contrast(101%);
}

.remove-item {
    background: none;
    border: none;
    padding: 4px;
    cursor: pointer;
    transition: transform 0.2s;
}

.remove-item:hover {
    transform: scale(1.1);
}

.item-color {
    margin: 0 0 12px;
    font-size: 14px;
    color: #666;
}

.item-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}

.quantity-control {
    display: flex;
    align-items: center;
    gap: 8px;
}

.quantity-btn {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #00997a;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.2s;
}

.quantity-btn:hover {
    background-color: #007b5e;
}

.quantity-value {
    min-width: 24px;
    text-align: center;
    font-weight: 500;
}

.item-price {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: #007b5e;
}

/* Итоговая сумма */
.cart-summary {
    background: white;
    padding: 24px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 123, 94, 0.08);
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    font-size: 16px;
    color: #555;
}

.summary-row.total {
    margin: 20px 0;
    padding-top: 20px;
    border-top: 1px solid #eee;
    font-size: 18px;
    font-weight: 500;
}

.total-price {
    font-weight: 600;
    color: #007b5e;
}

.checkout-button {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 16px;
    background-color: #FFA630;
    color: white;
    font-size: 16px;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.2s, transform 0.2s;
}

.checkout-button:hover {
    background-color: #ff9500;
    transform: translateY(-2px);
}

/* Пустая корзина */
.empty-cart {
    text-align: center;
    padding: 40px 0;
}

.empty-icon {
    margin-bottom: 20px;
}

.empty-title {
    margin: 0 0 8px;
    font-size: 24px;
    color: #007b5e;
}

.empty-text {
    margin: 0 0 24px;
    font-size: 16px;
    color: #666;
}

.continue-shopping {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background-color: white;
    color: #00997a;
    font-weight: 500;
    text-decoration: none;
    border: 2px solid #00997a;
    border-radius: 8px;
    transition: all 0.2s;
}

.continue-shopping:hover {
    background-color: #00997a;
    color: white;
}

/* Адаптив */
@media (max-width: 1024px) {
    .cart {
        padding: 40px 0;
    }
}

@media (max-width: 768px) {
    .cart-item {
        flex-direction: column;
        gap: 16px;
    }

    .item-image-wrapper {
        width: 100%;
        height: 160px;
    }

    .item-footer {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }

    .icon-cart {
        width: 48px;
        height: 48px;
    }
}

@media (max-width: 480px) {
    .wrapper {
        padding: 0 16px;
    }

    .cart {
        padding: 32px 0;
    }

    .item-title {
        font-size: 16px;
    }

    .checkout-button,
    .continue-shopping {
        width: 100%;
    }
}
</style>
