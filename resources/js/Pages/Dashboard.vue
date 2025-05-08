<template>
    <Head title="Личный кабинет" />
    <PageBanner page-title="Личный кабинет" current-page-name="Личный кабинет" />
    <div class="dashboard-wrapper">
        <!-- Профиль -->
        <div class="profile-card" v-if="$page.props.auth.user">
            <div class="profile-avatar">
                <img :src="$page.props.profile_photo_url || '/images/default-avatar.png'" :alt="$page.props.auth.user.name" class="profile-img" />
            </div>
            <div class="profile-info">
                <h2>{{ $page.props.auth.user.name }}</h2>
                <p>{{ $page.props.auth.user.email }}</p>
                <div class="stats">
                    <div class="stat">
                        <span class="stat-number">{{ activeOrders.length }}</span>
                        <span class="stat-label">Активных</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">{{ completedOrders.length }}</span>
                        <span class="stat-label">Завершённых</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Вкладки -->
        <div class="tabs">
            <button :class="{ active: activeTab === 'active' }" @click="activeTab = 'active'">
                <img src="@/assets/img/icons/active_orders.svg" class="btn-icons">
                Активные заказы
            </button>
            <button :class="{ active: activeTab === 'completed' }" @click="activeTab = 'completed'">
                <img src="@/assets/img/icons/checkmark.svg" class="btn-icons">
                Завершённые
            </button>
            <button :class="{ active: activeTab === 'settings' }" @click="activeTab = 'settings'">
                <img src="@/assets/img/icons/settings.svg" class="btn-icons">
                Настройки
            </button>
        </div>

        <!-- Контент вкладок -->
        <div class="tab-content">
            <!-- Активные заказы -->
            <div v-if="activeTab === 'active'" class="active-orders">
                <div v-if="activeOrders.length === 0" class="empty-state">
                    <div class="empty-icon">
                        <img src="@/assets/img/icons/shopping-cart.svg">
                    </div>
                    <h3>У вас пока нет активных заказов</h3>
                    <p>Начните оформлять заказы, и они появятся здесь</p>
                    <Link href="/catalog" class="btn primary">
                        Перейти в каталог
                        <img src="@/assets/img/icons/arrow-right.svg" class="btn-icon">
                    </Link>
                </div>
                <div v-else class="orders-grid">
                    <div v-for="order in activeOrders" :key="order.id" class="order-card">
                        <div class="order-header">
                            <div class="order-number">Заказ #{{ order.id }}</div>
                            <div class="order-status" :class="'status-' + order.status">
                                {{ getStatusText(order.status) }}
                            </div>
                        </div>

                        <div class="order-timeline">
                            <div class="timeline-step" :class="{'active': order.status === 'pending'}">
                                <div class="timeline-dot"></div>
                                <div class="timeline-label">Оформлен</div>
                            </div>
                            <div class="timeline-step" :class="{'active': order.status === 'active'}">
                                <div class="timeline-dot"></div>
                                <div class="timeline-label">В пути</div>
                            </div>
                            <div class="timeline-step" :class="{'active': order.status === 'completed'}">
                                <div class="timeline-dot"></div>
                                <div class="timeline-label">Доставлен</div>
                            </div>
                        </div>

                        <div class="order-products">
                            <div v-for="item in order.order_items" :key="item.id" class="product-item">
                                <div class="product-image-wrapper">
                                    <div class="product-image-placeholder" :style="{ backgroundColor: getRandomColor() }">
                                        {{ item.product?.name.charAt(0) || 'T' }}
                                    </div>
                                </div>
                                <div class="product-details">
                                    <div class="product-name">{{ item.product?.name || 'Товар' }}</div>
                                    <div class="product-meta">
                                        <span class="product-quantity">{{ item.quantity || 0 }} шт.</span>
                                        <span class="product-price">{{ formatPrice(item.price * item.quantity) }} ₽</span>
                                    </div>
                                    <div v-if="item.services && item.services.length" class="product-services">
                                        <div class="service-tag" v-for="service in item.services" :key="service.id">
                                            {{ service.name }} (+{{ formatPrice(service.pivot.price * item.quantity) }} ₽)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="order-footer">
                            <div class="order-total">
                                <span>Итого:</span>
                                <span class="total-price">{{ formatPrice(order.total_price) }} ₽</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Завершённые заказы -->
            <div v-else-if="activeTab === 'completed'" class="completed-orders">
                <div v-if="completedOrders.length === 0" class="empty-state">
                    <div class="empty-icon">
                        <img src="@/assets/img/icons/box.svg" class="btn-iconS">
                    </div>
                    <h3>Вы ещё не завершили ни одного заказа</h3>
                    <p>После завершения заказы появятся здесь</p>
                    <Link href="/catalog" class="btn primary">
                        Перейти в каталог
                        <img src="@/assets/img/icons/arrow-right.svg" class="btn-icon">
                    </Link>
                </div>
                <div v-else class="orders-grid">
                    <div v-for="order in completedOrders" :key="order.id" class="order-card completed">
                        <div class="order-header">
                            <div class="order-number">Заказ #{{ order.id }}</div>
                            <div class="order-date">{{ formatDate(order.created_at) }}</div>
                        </div>

                        <div class="order-products">
                            <div v-for="item in order.order_items" :key="item.id" class="product-item">
                                <div class="product-image-wrapper">
                                    <div class="product-image-placeholder" :style="{ backgroundColor: getRandomColor() }">
                                        {{ item.product?.name.charAt(0) || 'T' }}
                                    </div>
                                </div>
                                <div class="product-details">
                                    <div class="product-name">{{ item.product?.name || 'Товар' }}</div>
                                    <div class="product-meta">
                                        <span class="product-quantity">{{ item.quantity || 0 }} шт.</span>
                                        <span class="product-price">{{ formatPrice(item.price * item.quantity) }} ₽</span>
                                    </div>
                                    <div v-if="item.services && item.services.length" class="product-services">
                                        <div class="service-tag" v-for="service in item.services" :key="service.id">
                                            {{ service.name }} (+{{ formatPrice(service.pivot.price * item.quantity) }} ₽)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="order-footer">
                            <div class="order-total">
                                <span>Итого:</span>
                                <span class="total-price">{{ formatPrice(order.total_price) }} ₽</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Настройки -->
            <div v-else class="settings">
                <div class="settings-section">
                    <h3>Профиль</h3>
                    <Link :href="route('profile.edit')" class="btn primary">
                        Редактировать профиль
                        <img src="@/assets/img/icons/edit.svg" class="btn-icon">
                    </Link>
                </div>
                <div class="settings-section">
                    <h3>Сессия</h3>
                    <form method="POST" :action="route('logout')" class="logout-form">
                        <input type="hidden" name="_token" :value="$page.props.csrf_token">
                        <button type="submit" class="btn danger">
                            Выйти из аккаунта
                            <img src="@/assets/img/icons/exit.svg" class="btn-icon">
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

const formatDate = (dateString) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('ru-RU', options);
};

const getStatusText = (status) => {
    const statuses = {
        'pending': 'В обработке',
        'active': 'В пути',
        'completed': 'Завершён'
    };
    return statuses[status] || 'Неизвестно';
};

const getRandomColor = () => {
    const colors = ['#FFA630', '#00997a', '#007b5e', '#FF7043', '#5C6BC0', '#26A69A'];
    return colors[Math.floor(Math.random() * colors.length)];
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
    padding: 0 20px;
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

.stats {
    display: flex;
    gap: 20px;
    margin-top: 15px;
}

.stat {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px 15px;
    background: rgba(0, 123, 94, 0.05);
    border-radius: 8px;
    min-width: 80px;
}

.stat-number {
    font-size: 20px;
    font-weight: 700;
    color: var(--primary);
}

.stat-label {
    font-size: 14px;
    color: var(--text-medium);
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

.tab-icon {
    width: 20px;
    height: 20px;
    fill: currentColor;
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

.empty-icon {
    width: 80px;
    height: 80px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0, 123, 94, 0.05);
    border-radius: 50%;
}

.empty-icon svg {
    width: 40px;
    height: 40px;
    fill: var(--primary);
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
.orders-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 20px;
}

.order-card {
    background: var(--white);
    border-radius: 12px;
    padding: 20px;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
    border: 1px solid rgba(0, 123, 94, 0.1);
    display: flex;
    flex-direction: column;
}

.order-card.completed {
    border-left: 4px solid var(--primary);
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid rgba(0, 123, 94, 0.1);
}

.order-number {
    font-weight: 700;
    color: var(--primary);
    font-size: 18px;
}

.order-date {
    color: var(--text-medium);
    font-size: 14px;
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

/* Таймлайн заказа */
.order-timeline {
    display: flex;
    justify-content: space-between;
    margin: 15px 0;
    position: relative;
    padding-bottom: 20px;
}

.order-timeline::before {
    content: '';
    position: absolute;
    top: 8px;
    left: 0;
    right: 0;
    height: 2px;
    background: #e0e0e0;
    z-index: 1;
}

.timeline-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 2;
    flex: 1;
}

.timeline-dot {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #e0e0e0;
    margin-bottom: 8px;
    position: relative;
}

.timeline-step.active .timeline-dot {
    background: var(--primary);
    box-shadow: 0 0 0 4px rgba(0, 123, 94, 0.2);
}

.timeline-label {
    font-size: 12px;
    color: var(--text-medium);
    text-align: center;
}

.timeline-step.active .timeline-label {
    color: var(--primary);
    font-weight: 600;
}

/* Товары в заказе */
.order-products {
    margin: 15px 0;
}

.product-item {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid rgba(0, 123, 94, 0.05);
}

.product-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.product-image-wrapper {
    flex-shrink: 0;
}

.product-image-placeholder {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 24px;
    box-shadow: var(--shadow-sm);
}

.product-details {
    flex: 1;
}

.product-name {
    font-weight: 600;
    margin-bottom: 5px;
    color: var(--text-dark);
}

.product-meta {
    display: flex;
    gap: 10px;
    font-size: 14px;
    color: var(--text-medium);
    margin-bottom: 8px;
}

.product-services {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    margin-top: 5px;
}

.service-tag {
    background: rgba(255, 166, 48, 0.1);
    color: var(--accent);
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
}

.product-review {
    display: flex;
    align-items: center;
}

.review-btn {
    display: flex;
    align-items: center;
    gap: 5px;
    background: none;
    border: none;
    color: var(--accent);
    font-size: 14px;
    cursor: pointer;
    padding: 5px;
}

.review-btn svg {
    width: 16px;
    height: 16px;
    fill: var(--accent);
}

/* Подвал заказа */
.order-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
    padding-top: 15px;
    border-top: 1px solid rgba(0, 123, 94, 0.1);
}

.order-total {
    font-weight: 600;
    color: var(--text-dark);
}

.total-price {
    color: var(--primary);
    font-size: 18px;
    margin-left: 5px;
}

.order-action {
    display: flex;
    align-items: center;
    gap: 5px;
    background: none;
    border: none;
    color: var(--primary);
    font-weight: 600;
    cursor: pointer;
    padding: 8px 12px;
    border-radius: 6px;
    transition: var(--transition);
}

.order-action:hover {
    background: rgba(0, 123, 94, 0.1);
}

.order-action svg {
    width: 16px;
    height: 16px;
    fill: var(--primary);
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
    text-decoration: none;
}

.btn.primary {
    background-color: var(--primary);
    color: var(--white);
}

.btn.primary:hover {
    background-color: var(--primary-light);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn.danger {
    background-color: var(--accent);
    color: var(--white);
}

.btn.danger:hover {
    background-color: var(--accent-light);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn-icon {
    width: 22px;
    height: 22px;
    fill: var(--white);
    margin-left: 10px;
}

.btn-icons{
    width: 24px;
    height: 24px;
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

    .stats {
        justify-content: center;
    }

    .tabs {
        overflow-x: auto;
        padding-bottom: 5px;
    }

    .orders-grid {
        grid-template-columns: 1fr;
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

    .product-image-placeholder {
        width: 100%;
        height: 120px;
        margin-bottom: 10px;
    }

    .btn {
        width: 100%;
    }

    .order-footer {
        flex-direction: column;
        gap: 10px;
        align-items: flex-start;
    }

    .order-action {
        width: 100%;
        justify-content: center;
    }
}
</style>
