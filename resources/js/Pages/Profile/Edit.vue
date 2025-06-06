<template>
    <!-- SEO: Заголовок страницы -->
    <Head title="Редактирование профиля" />

    <!-- Баннер с навигацией -->
    <PageBanner
        page-title="Редактирование профиля"
        :breadcrumbs="[
            { href: '/dashboard', label: 'Редактирование профиля /' },
            { label: 'Редактирование профиля' }
        ]"
    />

    <div class="profile-edit-wrapper">
        <div class="profile-grid">
            <!-- Левая колонка: фото + форма информации -->
            <div class="profile-column">
                <div class="photo-section">
                    <h2 class="section-header">ВАШ ПРОФИЛЬ</h2>
                    <PhotoUpload
                        route-name="profile.photo.update"
                        @success="onPhotoUploadSuccess"
                        @error="onPhotoUploadError"
                    />
                </div>

                <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" />
            </div>

            <!-- Правая колонка: пароль + удаление -->
            <div class="profile-column">
                <UpdatePasswordForm />
                <DeleteUserForm />
            </div>
        </div>
    </div>

    <!-- Модальное окно с сообщением (успех/ошибка) -->
    <ModalMessage
        v-if="showModal"
        :status="modalStatus"
        :message="modalMessage"
        @close="closeModal"
    />
</template>

<script setup>
// Импорт базовых зависимостей
import { ref, watch } from 'vue';
import { usePage, Head } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

// Импорт компонентов
import PhotoUpload from '@/Pages/Profile/Partials/PhotoUpload.vue';
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import DeleteUserForm from "@/Pages/Profile/Partials/DeleteUserForm.vue";
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";
import PageBanner from "@/Components/PageBanner.vue";
import ModalMessage from "@/Components/ModalMessage.vue"; // модалка для уведомлений

// Получение props от сервера
const { mustVerifyEmail, status } = usePage().props;

// Обработка успешной загрузки фото
const onPhotoUploadSuccess = () => {
    Inertia.reload({ only: ['auth'] }); // Обновляем auth-данные пользователя
};

// Обработка ошибки при загрузке фото
const onPhotoUploadError = (errors) => {
    console.error('Ошибка загрузки фото:', errors);
};

// Реактивные переменные для модального окна
const showModal = ref(false);
const modalMessage = ref('');
const modalStatus = ref('');

// Отслеживание сообщений от сервера
watch(() => usePage().props.photoStatus, (newStatus) => {
    if (newStatus) {
        showModal.value = true;
        modalStatus.value = newStatus;
        modalMessage.value = usePage().props.photoMessage || '';
    }
});

// Закрытие модального окна
const closeModal = () => {
    showModal.value = false;
};
</script>

<style scoped>
/* Базовые переменные */
:root {
    --primary: #007b5e;
    --accent: #FFA630;
    --light-bg: #f2f2f2;
    --white: #ffffff;
    --text-dark: #212121;
    --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
}

/* Основная разметка */
.profile-edit-wrapper {
    width: 100%;
    padding: 2rem 0;
    background-color: var(--light-bg);
    min-height: calc(100vh - 120px);
}

.profile-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2.5rem;
    max-width: 1300px;
    margin: 0 auto;
    padding: 0 2rem;
}

.profile-column {
    display: flex;
    flex-direction: column;
    gap: 2.5rem;
}

.section-header {
    font-weight: 900;
    font-size: 1.8rem;
    text-transform: uppercase;
    color: var(--primary);
    margin-bottom: 2rem;
    border-bottom: 3px solid var(--accent);
}

.photo-section {
    background-color: var(--white);
    border-radius: 16px;
    padding: 2.5rem;
    box-shadow: var(--shadow-sm);
    border: 2px solid rgba(0, 123, 94, 0.1);
}

/* Адаптив */
@media (max-width: 992px) {
    .profile-grid {
        grid-template-columns: 1fr;
    }
}
</style>
