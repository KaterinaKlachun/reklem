<template>
    <Head title="Редактирование профиля" />

    <!-- Баннер -->
    <PageBanner
        page-title="Редактирование профиля"
        :breadcrumbs="[
            { href: '/dashboard', label: 'Редактирование профиля /' },
            { label: 'Редактирование профиля' }
        ]"
    />

    <template>
        <div v-if="$page.props.status" class="flash-message">
            {{ $page.props.status }}
        </div>
    </template>

    <div class="profile-edit-wrapper">
        <div class="profile-grid">
            <!-- Левая колонка -->
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

            <!-- Правая колонка -->
            <div class="profile-column">
                <UpdatePasswordForm />
                <DeleteUserForm />
            </div>
        </div>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import PhotoUpload from '@/Pages/Profile/Partials/PhotoUpload.vue';
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import DeleteUserForm from "@/Pages/Profile/Partials/DeleteUserForm.vue";
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";
import PageBanner from "@/Components/PageBanner.vue";

const { mustVerifyEmail, status } = usePage().props;

const onPhotoUploadSuccess = () => {
    Inertia.reload({ only: ['auth'] });
};

const onPhotoUploadError = (errors) => {
    console.error('Ошибка загрузки фото:', errors);
};
</script>

<style scoped>
.flash-message {
    position: fixed;
    top: 2rem;
    right: 2rem;
    background: #38a169;
    color: white;
    padding: 1rem 2rem;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    z-index: 9999;
    animation: fadeOut 5s ease forwards;
}

@keyframes fadeOut {
    0% { opacity: 1; }
    90% { opacity: 1; }
    100% { opacity: 0; display: none; }
}

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
    --transition: all 0.2s ease;
}

/* Креативная типографика */
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;900&display=swap');

/* Основные стили */
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
    font-family: 'Montserrat', sans-serif;
    font-weight: 900;
    font-size: 1.8rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--primary);
    margin-bottom: 2rem;
    padding-bottom: 1rem;
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
@media (max-width: 1200px) {
    .profile-grid {
        gap: 2rem;
        max-width: 1000px;
    }
}

@media (max-width: 992px) {
    .profile-grid {
        grid-template-columns: 1fr;
        max-width: 800px;
    }

    .section-header {
        font-size: 1.6rem;
    }
}

@media (max-width: 768px) {
    .profile-grid {
        padding: 0 1.5rem;
        gap: 2rem;
    }

    .photo-section {
        padding: 2rem;
    }
}

@media (max-width: 576px) {
    .profile-grid {
        padding: 0 1rem;
        gap: 1.5rem;
    }

    .section-header {
        font-size: 1.4rem;
    }

    .photo-section {
        padding: 1.5rem;
    }
}
</style>
