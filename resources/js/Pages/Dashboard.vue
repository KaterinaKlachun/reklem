<template>
    <Head title="Личный кабинет" />

    <PageBanner
        page-title="Личный кабинет"
        current-page-name="Личный кабинет"
    />

    <div class="dashboard-wrapper">
        <!-- Профиль -->
        <div class="profile-card">
            <div class="profile-avatar">
                <img
                    :src="computedPhotoUrl"
                    :alt="user.name"
                    class="profile-img"
                />
            </div>
            <div class="profile-info">
                <h2>{{ user.name }}</h2>
                <p>{{ user.email }}</p>
            </div>
        </div>

        <!-- Вкладки -->
        <div class="tabs">
            <button
                :class="{ active: activeTab === 'active' }"
                @click="activeTab = 'active'"
            >
                <svg viewBox="0 0 24 24" class="tab-icon">
                    <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,16.5V18H13V16.5H11M12,5.5A6,6 0 0,0 6,11.5H8A4,4 0 0,1 12,7.5A4,4 0 0,1 16,11.5C16,13.5 14.7,14.6 13.7,15.7C13.2,16.2 13,16.5 13,17.5H11C11,15.8 11.6,14.8 12.7,13.7C13.2,13.2 14,12.5 14,11.5A2,2 0 0,0 12,9.5A2,2 0 0,0 10,11.5H8A4,4 0 0,1 12,5.5Z"/>
                </svg>
                Активные заказы
            </button>
            <button
                :class="{ active: activeTab === 'completed' }"
                @click="activeTab = 'completed'"
            >
                <svg viewBox="0 0 24 24" class="tab-icon">
                    <path d="M12 2C6.5 2 2 6.5 2 12S6.5 22 12 22 22 17.5 22 12 17.5 2 12 2M10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z"/>
                </svg>
                Завершённые
            </button>
            <button
                :class="{ active: activeTab === 'settings' }"
                @click="activeTab = 'settings'"
            >
                <svg viewBox="0 0 24 24" class="tab-icon">
                    <path d="M12,15.5A3.5,3.5 0 0,1 8.5,12A3.5,3.5 0 0,1 12,8.5A3.5,3.5 0 0,1 15.5,12A3.5,3.5 0 0,1 12,15.5M19.43,12.97C19.47,12.65 19.5,12.33 19.5,12C19.5,11.67 19.47,11.34 19.43,11L21.54,9.37C21.73,9.22 21.78,8.95 21.66,8.73L19.66,5.27C19.54,5.05 19.27,4.96 19.05,5.05L16.56,6.05C16.04,5.66 15.5,5.32 14.87,5.07L14.5,2.42C14.46,2.18 14.25,2 14,2H10C9.75,2 9.54,2.18 9.5,2.42L9.13,5.07C8.5,5.32 7.96,5.66 7.44,6.05L4.95,5.05C4.73,4.96 4.46,5.05 4.34,5.27L2.34,8.73C2.21,8.95 2.27,9.22 2.46,9.37L4.57,11C4.53,11.34 4.5,11.67 4.5,12C4.5,12.33 4.53,12.65 4.57,12.97L2.46,14.63C2.27,14.78 2.21,15.05 2.34,15.27L4.34,18.73C4.46,18.95 4.73,19.03 4.95,18.95L7.44,17.94C7.96,18.34 8.5,18.68 9.13,18.93L9.5,21.58C9.54,21.82 9.75,22 10,22H14C14.25,22 14.46,21.82 14.5,21.58L14.87,18.93C15.5,18.67 16.04,18.34 16.56,17.94L19.05,18.95C19.27,19.03 19.54,18.95 19.66,18.73L21.66,15.27C21.78,15.05 21.73,14.78 21.54,14.63L19.43,12.97Z"/>
                </svg>
                Настройки
            </button>
        </div>

        <div class="tab-content">
            <div v-if="activeTab === 'active'" class="active-orders">
                <div class="empty-state">
                    <svg viewBox="0 0 24 24" class="empty-icon">
                        <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M12,10.5A1.5,1.5 0 0,0 10.5,12A1.5,1.5 0 0,0 12,13.5A1.5,1.5 0 0,0 13.5,12A1.5,1.5 0 0,0 12,10.5M7.5,10.5A1.5,1.5 0 0,0 6,12A1.5,1.5 0 0,0 7.5,13.5A1.5,1.5 0 0,0 9,12A1.5,1.5 0 0,0 7.5,10.5M16.5,10.5A1.5,1.5 0 0,0 15,12A1.5,1.5 0 0,0 16.5,13.5A1.5,1.5 0 0,0 18,12A1.5,1.5 0 0,0 16.5,10.5Z"/>
                    </svg>
                    <h3>У вас пока нет активных заказов</h3>
                    <p>Начните оформлять заказы, и они появятся здесь</p>
                    <Link href="/catalog" class="btn primary">Перейти в каталог</Link>
                </div>
            </div>

            <div v-else-if="activeTab === 'completed'" class="completed-orders">
                <div class="empty-state">
                    <svg viewBox="0 0 24 24" class="empty-icon">
                        <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M16.18,7.76L15.12,8.82L14.06,7.76L13,8.82L14.06,9.88L13,10.94L14.06,12L15.12,10.94L16.18,12L17.24,10.94L16.18,9.88L17.24,8.82L16.18,7.76M7.82,12L8.88,10.94L9.94,12L11,10.94L8.88,8.82L7.82,9.88L6.76,8.82L5.7,9.88L6.76,10.94L5.7,12L6.76,13.06L7.82,12M12,14C9.67,14 7.69,15.46 6.89,17.5H17.11C16.31,15.46 14.33,14 12,14Z"/>
                    </svg>
                    <h3>Вы ещё не завершили ни одного заказа</h3>
                    <p>После завершения заказы появятся здесь</p>
                </div>
            </div>

            <div v-else class="settings">
                <div class="settings-section">
                    <h3>Профиль</h3>
                    <Link :href="route('profile.edit')" class="btn primary">
                        <svg viewBox="0 0 24 24" class="btn-icon">
                            <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                        </svg>
                        Редактировать профиль
                    </Link>
                </div>

                <div class="settings-section">
                    <h3>Сессия</h3>
                    <form method="POST" :action="route('logout')" class="logout-form">
                        <input type="hidden" name="_token" :value="$page.props.csrf_token">
                        <button type="submit" class="btn danger">
                            <svg viewBox="0 0 24 24" class="btn-icon">
                                <path d="M16,17V14H9V10H16V7L21,12L16,17M14,2A2,2 0 0,1 16,4V6H14V4H5V20H14V18H16V20A2,2 0 0,1 14,22H5A2,2 0 0,1 3,20V4A2,2 0 0,1 5,2H14Z"/>
                            </svg>
                            Выйти из аккаунта
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, usePage, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import PageBanner from '@/Components/PageBanner.vue';

const user = usePage().props.auth.user;
const activeTab = ref('active');

const computedPhotoUrl = computed(() => {
    if (user?.profile_photo_path) {
        return `/storage/${user.profile_photo_path}`;
    }
    return '/assets/img/profile/default-avatar.png';
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

/* Основные стили (1920px и больше) */
.dashboard-wrapper {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
}

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
}

.profile-avatar:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0, 123, 94, 0.3);
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

.tab-content {
    background: var(--white);
    padding: 30px;
    border-radius: 16px;
    box-shadow: var(--shadow-sm);
    min-height: 300px;
}

.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 40px 20px;
}

.empty-icon {
    width: 80px;
    height: 80px;
    fill: var(--primary-light);
    margin-bottom: 20px;
    opacity: 0.5;
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

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
    border: none;
    cursor: pointer;
    gap: 8px;
}

.btn-icon {
    width: 20px;
    height: 20px;
    fill: currentColor;
}

.btn.primary {
    background: var(--primary);
    color: var(--white);
    box-shadow: 0 4px 12px rgba(0, 123, 94, 0.3);
}

.btn.primary:hover {
    background: var(--primary-light);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 123, 94, 0.4);
}

.btn.secondary {
    background: var(--white);
    color: var(--primary);
    border: 2px solid var(--primary);
}

.btn.secondary:hover {
    background: rgba(0, 123, 94, 0.1);
}

.btn.danger {
    background: #f8f9fa;
    color: #dc3545;
    border: 2px solid #dc3545;
}

.btn.danger:hover {
    background: rgba(220, 53, 69, 0.1);
}

.settings-section {
    margin-bottom: 30px;
    padding-bottom: 30px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.settings-section:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.settings-section h3 {
    margin-top: 0;
    margin-bottom: 15px;
    color: var(--primary);
}

/* Адаптив */
@media (max-width: 1200px) {
    .profile-card {
        padding: 25px;
    }

    .profile-info h2 {
        font-size: 24px;
    }
}

@media (max-width: 992px) {
    .profile-card {
        flex-direction: column;
        text-align: center;
    }

    .profile-avatar {
        margin-bottom: 20px;
    }

    .profile-info {
        margin-left: 0;
    }

    .tabs {
        overflow-x: auto;
        padding-bottom: 5px;
    }

    .tabs button {
        white-space: nowrap;
    }
}

@media (max-width: 768px) {
    .dashboard-wrapper {
        padding: 0 15px;
        margin: 30px auto;
    }

    .profile-card {
        padding: 20px;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
    }

    .tab-content {
        padding: 20px;
    }
}

@media (max-width: 576px) {
    .profile-card {
        padding: 15px;
    }

    .tabs button {
        padding: 10px 15px;
        font-size: 14px;
    }

    .empty-icon {
        width: 60px;
        height: 60px;
    }
}

/* iPhone 10 и меньше (375px) */
@media (max-width: 414px) {
    .profile-card {
        border-radius: 12px;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        border-width: 3px;
    }

    .profile-info h2 {
        font-size: 20px;
    }

    .tab-content {
        padding: 15px;
    }

    .btn {
        padding: 10px 15px;
        font-size: 14px;
    }
}
</style>
