<template>
    <Head title="Личный кабинет" />

    <PageBanner
        page-title="Личный кабинет"
        current-page-name="Личный кабинет"
    />

    <div class="dashboard-wrapper">
        <!-- Профиль -->
        <div class="profile-card" v-if="$page.props.auth.user">
            <div class="profile-avatar">
                <img
                    :src="$page.props.profile_photo_url || '/images/default-avatar.png'"
                    :alt="$page.props.auth.user.name"
                    class="profile-img"
                />
            </div>
            <div class="profile-info">
                <h2>{{ $page.props.auth.user.name }}</h2>
                <p>{{ $page.props.auth.user.email }}</p>
            </div>
        </div>

        <!-- Вкладки -->
        <div class="tabs">
            <button
                :class="{ active: activeTab === 'active' }"
                @click="activeTab = 'active'"
            >
                Активные заказы
            </button>
            <button
                :class="{ active: activeTab === 'completed' }"
                @click="activeTab = 'completed'"
            >
                Завершённые
            </button>
            <button
                :class="{ active: activeTab === 'settings' }"
                @click="activeTab = 'settings'"
            >
                Настройки
            </button>
        </div>

        <!-- Контент вкладок -->
        <div class="tab-content">
            <!-- Активные заказы -->
            <div v-if="activeTab === 'active'" class="active-orders">
                <div v-if="activeOrders.length === 0" class="empty-state">
                    <h3>У вас пока нет активных заказов</h3>
                    <p>Начните оформлять заказы, и они появятся здесь</p>
                </div>
                <div v-else>
                    <ul>
                        <li v-for="order in activeOrders" :key="order.id" class="order-item">
                            <div class="order-header">
                                <h4>Заказ №{{ order.id }}</h4>
                                <span class="order-status" :class="'status-' + order.status">
                                    {{ getStatusText(order.status) }}
                                </span>
                            </div>
                            <div class="order-products">
                                <div v-for="item in order.order_items" :key="item.id" class="product-item">
                                    <div class="product-details">
                                        <p>{{ item.product?.name || 'Товар' }}</p>
                                        <p>Цвет: {{ item.color || 'не указан' }}</p>
                                        <p>Количество: {{ item.quantity || 0 }}</p>
                                        <p>Цена: {{ formatPrice(item.price * item.quantity) }} ₽</p>
                                    </div>
                                </div>
                            </div>
                            <div class="order-footer">
                                <p class="order-total">Итого: {{ formatPrice(order.total_price) }} ₽</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Завершённые заказы -->
            <div v-else-if="activeTab === 'completed'" class="completed-orders">
                <div v-if="completedOrders.length === 0" class="empty-state">
                    <h3>Вы ещё не завершили ни одного заказа</h3>
                    <p>После завершения заказы появятся здесь</p>
                </div>
                <div v-else>
                    <ul>
                        <li v-for="order in completedOrders" :key="order.id" class="order-item">
                            <div class="order-header">
                                <h4>Заказ №{{ order.id }}</h4>
                                <span class="order-status status-completed">
                                    Завершён
                                </span>
                            </div>
                            <div class="order-products">
                                <div v-for="item in order.order_items" :key="item.id" class="product-item">
                                    <div class="product-details">
                                        <p>{{ item.product?.name || 'Товар' }}</p>
                                        <p>Цвет: {{ item.color || 'не указан' }}</p>
                                        <p>Количество: {{ item.quantity || 0 }}</p>
                                        <p>Цена: {{ formatPrice(item.price * item.quantity) }} ₽</p>
                                    </div>
                                </div>
                            </div>
                            <div class="order-footer">
                                <p class="order-total">Итого: {{ formatPrice(order.total_price) }} ₽</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Настройки -->
            <div v-else class="settings">
                <div class="settings-section">
                    <h3>Профиль</h3>
                    <Link :href="route('profile.edit')" class="btn primary">
                        Редактировать профиль
                    </Link>
                </div>
                <div class="settings-section">
                    <h3>Сессия</h3>
                    <form method="POST" :action="route('logout')" class="logout-form">
                        <input type="hidden" name="_token" :value="$page.props.csrf_token">
                        <button type="submit" class="btn danger">
                            Выйти из аккаунта
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import PageBanner from "@/Components/PageBanner.vue";

const activeTab = ref('active');
const { activeOrders, completedOrders } = usePage().props;

const formatPrice = (price) => {
    const num = Number(price);
    return isNaN(num) ? '0.00' : num.toFixed(2);
};

const getStatusText = (status) => {
    const statuses = {
        'pending': 'В обработке',
        'active': 'В пути',
        'completed': 'Завершён'
    };
    return statuses[status] || 'Неизвестно';
};

// Отладочный вывод
onMounted(() => {
    console.log('Active orders data:', activeOrders);
    console.log('Completed orders data:', completedOrders);
});
</script>

<style scoped>
/* Базовые переменные */
:root {
    --primary: #007b5e;
    --primary-light: #00997a;
    --accent: #FFA630;
    --accent-light: #FFC266;
    --light-bg: #f2f2f2;
    --white: #ffffff;
    --text-dark: #212121;
    --text-medium: #616161;
    --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
    --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.12);
    --shadow-lg: 0 8px 24px rgba(0, 123, 94, 0.15);
    --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}

/* Основные стили */
.dashboard-wrapper {
    max-width: 1200px;
    margin: 40px auto;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Карточка профиля */
.profile-card {
    display: flex;
    background: var(--white);
    padding: 30px;
    border-radius: 16px;
    box-shadow: var(--shadow-lg);
    align-items: center;
    margin-bottom: 40px;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(0, 123, 94, 0.1);
}

.profile-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 8px;
    background: linear-gradient(90deg, var(--primary), var(--accent));
}

.profile-avatar {
    position: relative;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid var(--primary);
    box-shadow: var(--shadow-md);
    transition: var(--transition);
    flex-shrink: 0;
}

.profile-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-info {
    margin-left: 30px;
    flex: 1;
}

.profile-info h2 {
    margin: 0 0 8px;
    font-size: 28px;
    color: var(--primary);
    font-weight: 800;
}

.profile-info p {
    margin: 0 0 20px;
    color: var(--text-medium);
    font-size: 16px;
}

/* Вкладки */
.tabs {
    display: flex;
    border-bottom: 2px solid rgba(0, 123, 94, 0.1);
    margin-bottom: 30px;
    gap: 5px;
}

.tabs button {
    padding: 12px 24px;
    border: none;
    background: none;
    cursor: pointer;
    font-size: 16px;
    color: var(--text-medium);
    border-bottom: 3px solid transparent;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    border-radius: 8px 8px 0 0;
}

.tabs button:hover {
    background: rgba(0, 123, 94, 0.05);
    color: var(--primary);
}

.tabs button.active {
    color: var(--primary);
    border-color: var(--primary);
    background: rgba(0, 123, 94, 0.1);
}

/* Контент вкладок */
.tab-content {
    background: var(--white);
    padding: 30px;
    border-radius: 16px;
    box-shadow: var(--shadow-sm);
    min-height: 300px;
}

/* Состояние пустого списка */
.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 60px 20px;
}

.empty-state h3 {
    font-size: 20px;
    color: var(--primary);
    margin-bottom: 10px;
}

.empty-state p {
    color: var(--text-medium);
    margin-bottom: 20px;
    max-width: 400px;
}

/* Стили для заказов */
.order-item {
    background: white;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
}

.order-header h4 {
    margin: 0;
    font-size: 18px;
    color: var(--text-dark);
}

.order-status {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
}

.status-pending {
    background-color: #fff3cd;
    color: #856404;
}

.status-active {
    background-color: #cce5ff;
    color: #004085;
}

.status-completed {
    background-color: #d4edda;
    color: #155724;
}

.order-products {
    margin-bottom: 15px;
}

.product-item {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #f5f5f5;
}

.product-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.product-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #eee;
}

.product-details {
    flex: 1;
}

.product-details p {
    margin: 4px 0;
    color: var(--text-dark);
}

.product-details p:first-child {
    font-weight: 600;
}

.order-footer {
    text-align: right;
    font-weight: 600;
    font-size: 18px;
    padding-top: 10px;
    border-top: 1px solid #eee;
}

.order-total {
    color: var(--primary);
    margin: 0;
}

/* Кнопки */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: var(--transition);
}

.btn.primary {
    background-color: var(--primary);
    color: var(--white);
}

.btn.primary:hover {
    background-color: var(--primary-light);
}

.btn.danger {
    background-color: var(--accent);
    color: var(--white);
}

.btn.danger:hover {
    background-color: var(--accent-light);
}

.btn-icon {
    width: 16px;
    height: 16px;
    fill: var(--white);
    margin-right: 10px;
}

.settings-section {
    margin-bottom: 30px;
}

.settings-section h3 {
    margin: 0 0 15px;
    color: var(--primary);
    font-size: 18px;
}

/* Адаптивность */
@media (max-width: 1024px) {
    .dashboard-wrapper {
        margin: 30px auto;
    }

    .profile-card {
        padding: 20px;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
    }
}

@media (max-width: 768px) {
    .profile-card {
        flex-direction: column;
        text-align: center;
    }

    .profile-avatar {
        margin-bottom: 20px;
        margin-left: 0;
    }

    .profile-info {
        margin-left: 0;
    }

    .tabs {
        overflow-x: auto;
        padding-bottom: 5px;
    }

    .order-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
}

@media (max-width: 480px) {
    .dashboard-wrapper {
        padding: 0 15px;
        margin: 20px auto;
    }

    .profile-card {
        padding: 15px;
    }

    .tab-content {
        padding: 20px;
    }

    .product-item {
        flex-direction: column;
    }

    .product-image {
        width: 100%;
        height: auto;
        max-height: 200px;
    }

    .btn {
        width: 100%;
    }
}
</style>
