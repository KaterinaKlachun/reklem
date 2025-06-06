<template>
    <!-- SEO: заголовок страницы -->
    <Head title="Редактирование профиля" />

    <!-- Хлебные крошки / заголовок -->
    <PageBanner
        page-title="Редактирование профиля"
        :breadcrumbs="[
            { href: '/dashboard', label: 'Личный кабинет /' },
            { label: 'Редактирование профиля' }
        ]"
    />

    <div class="profile-edit-wrapper">
        <div class="profile-grid">
            <!-- Левая колонка -->
            <div class="profile-column">
                <div class="photo-section">
                    <h2 class="section-header">Ваш профиль</h2>
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

    <!-- Модальное окно -->
    <ModalMessage
        v-if="showModal"
        :status="modalStatus"
        :message="modalMessage"
        @close="closeModal"
    />
</template>

<script setup>
// Импорт необходимых зависимостей
import { ref } from 'vue';
import { usePage, Head } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

// Импорт компонентов
import PhotoUpload from '@/Pages/Profile/Partials/PhotoUpload.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
import PageBanner from '@/Components/PageBanner.vue';
import ModalMessage from '@/Components/ModalMessage.vue';

// Получаем props от Inertia (сервер передаёт их в render)
const page = usePage();
const { mustVerifyEmail, status, photoStatus, photoMessage } = page.props;

// Обработка результата загрузки фото
const showModal = ref(false);
const modalStatus = ref('');
const modalMessage = ref('');

// Отображаем модалку сразу, если есть статус от сервера
if (photoStatus) {
    showModal.value = true;
    modalStatus.value = photoStatus;
    modalMessage.value = photoMessage || '';
}

// Обработка событий от компонента загрузки фото
const onPhotoUploadSuccess = () => {
    Inertia.reload({ only: ['auth'] }); // Можно убрать, если auth не нужен
};

const onPhotoUploadError = (errors) => {
    console.error('Ошибка загрузки фото:', errors);
};

const closeModal = () => {
    showModal.value = false;
};
</script>

<style scoped>
.profile-edit-wrapper {
    width: 100%;
    padding: 2rem 0;
    background-color: #f2f2f2;
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
    color: #007b5e;
    margin-bottom: 2rem;
    border-bottom: 3px solid #FFA630;
}

.photo-section {
    background-color: white;
    border-radius: 16px;
    padding: 2.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    border: 2px solid rgba(0, 123, 94, 0.1);
}

/* Адаптив */
@media (max-width: 992px) {
    .profile-grid {
        grid-template-columns: 1fr;
        padding: 0 1.5rem;
    }
}
</style>
