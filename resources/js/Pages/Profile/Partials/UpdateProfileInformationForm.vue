<!-- UpdateProfileInformationForm.vue -->
<template>
    <div class="profile-section info-section">
        <h2 class="section-title">НАСТРОЙКИ ПРОФИЛЯ</h2>
        <p class="section-description">
            Обнови данные, если что-то поменялось.
        </p>

        <form @submit.prevent="form.patch(route('profile.update'))">
            <div class="form-group">
                <label class="form-label">ИМЯ</label>
                <div class="input-wrapper">
                    <input
                        v-model="form.name"
                        type="text"
                        class="form-input"
                        required
                        autofocus
                        autocomplete="name"
                    >
                    <div class="input-decoration"></div>
                </div>
                <div v-if="form.errors.name" class="form-error">
                    {{ form.errors.name }}
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">EMAIL</label>
                <div class="input-wrapper">
                    <input
                        v-model="form.email"
                        type="email"
                        class="form-input"
                        required
                        autocomplete="username"
                    >
                    <div class="input-decoration"></div>
                </div>
                <div v-if="form.errors.email" class="form-error">
                    {{ form.errors.email }}
                </div>
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null" class="verification-message">
                <p class="verification-text">Почта не подтверждена.</p>
                <a :href="route('verification.send')" class="verification-link">
                    Отправить подтверждение
                </a>
                <p v-if="status === 'verification-link-sent'" class="verification-success">
                    Письмо отправлено!
                </p>
            </div>

            <div class="form-actions">
                <button class="btn btn-save" :disabled="form.processing">
                    СОХРАНИТЬ ИЗМЕНЕНИЯ
                </button>
                <p v-if="form.recentlySuccessful" class="success-message">
                    Данные успешно обновлены!
                </p>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<style scoped>
.info-section {
    background-color: var(--white);
    border-radius: 16px;
    padding: 2.5rem;
    box-shadow: var(--shadow-sm);
    border: 2px solid rgba(255, 166, 48, 0.15);
}

.section-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 900;
    font-size: 1.6rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--accent);
    margin-bottom: 1.5rem;
    position: relative;
    padding-bottom: 1rem;
}

.section-title::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 4px;
    background: var(--primary);
    border-radius: 4px;
}

.section-description {
    color: var(--text-medium);
    font-family: 'Montserrat', sans-serif;
    font-size: 1.05rem;
    margin-bottom: 2.5rem;
    line-height: 1.6;
}

.form-group {
    margin-bottom: 2rem;
}

.form-label {
    display: block;
    margin-bottom: 1rem;
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--accent);
}

.input-wrapper {
    position: relative;
}

.form-input {
    width: 100%;
    padding: 1.25rem 1.5rem;
    border: 2px solid var(--light-bg);
    border-radius: 10px;
    font-family: 'Montserrat', sans-serif;
    font-size: 1.05rem;
    transition: var(--transition);
    background-color: var(--white);
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
    position: relative;
    z-index: 1;
}

.input-decoration {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 8px;
    background: linear-gradient(135deg, rgba(255, 166, 48, 0.1), rgba(255, 166, 48, 0.15));
    z-index: 0;
    transform: translate(4px, 4px);
    transition: var(--transition);
}

.form-input:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(255, 166, 48, 0.2);
}

.form-input:focus ~ .input-decoration {
    transform: translate(6px, 6px);
    background: linear-gradient(135deg, rgba(255, 166, 48, 0.15), rgba(255, 166, 48, 0.2));
}

.form-error {
    color: #e3342f;
    font-family: 'Montserrat', sans-serif;
    font-size: 0.9rem;
    margin-top: 0.75rem;
    font-weight: 600;
}

.verification-message {
    text-align: center;
    margin: 2rem 0;
}

.verification-text {
    color: var(--text-medium);
    font-family: 'Montserrat', sans-serif;
    font-size: 0.95rem;
    margin-bottom: 0.5rem;
}

.verification-link {
    color: var(--accent);
    font-weight: 700;
    text-decoration: none;
    transition: var(--transition);
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    background-color: rgba(255, 166, 48, 0.1);
}

.verification-link:hover {
    color: var(--white);
    background-color: var(--accent);
    text-decoration: none;
}

.verification-success {
    color: var(--primary-light);
    font-weight: 600;
    margin-top: 1rem;
}

.form-actions {
    margin-top: 2.5rem;
}

.btn-save {
    background: linear-gradient(135deg, var(--accent), var(--accent-light));
    color: var(--white);
    box-shadow: 0 4px 12px rgba(255, 166, 48, 0.3);
    padding: 1.25rem 2rem;
    font-weight: 800;
    font-size: 1.1rem;
    width: 100%;
}

.btn-save:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(255, 166, 48, 0.4);
}

.success-message {
    color: var(--primary-light);
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    margin-top: 1.5rem;
    text-align: center;
    font-size: 1.05rem;
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 992px) {
    .info-section {
        padding: 2rem;
    }

    .section-title {
        font-size: 1.5rem;
    }
}

@media (max-width: 768px) {
    .info-section {
        padding: 1.75rem;
    }

    .form-input {
        padding: 1.1rem 1.25rem;
    }

    .btn-save {
        padding: 1.1rem 1.5rem;
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .info-section {
        padding: 1.5rem;
    }

    .section-title {
        font-size: 1.4rem;
    }

    .form-label {
        font-size: 0.95rem;
    }
}
</style>
