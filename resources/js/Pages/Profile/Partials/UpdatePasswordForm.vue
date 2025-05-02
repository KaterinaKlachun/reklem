<!-- UpdatePasswordForm.vue -->
<template>
    <div class="profile-section password-section">
        <h2 class="section-title">СМЕНА ПАРОЛЯ</h2>
        <p class="section-description">
            Поставь нормальный пароль, чтобы не взломали.
        </p>

        <form @submit.prevent="updatePassword">
            <div class="form-group">
                <label class="form-label">ТЕКУЩИЙ ПАРОЛЬ</label>
                <div class="input-wrapper">
                    <input
                        ref="currentPasswordInput"
                        v-model="form.current_password"
                        type="password"
                        class="form-input"
                        autocomplete="current-password"
                    >
                    <div class="input-decoration"></div>
                </div>
                <div v-if="form.errors.current_password" class="form-error">
                    {{ form.errors.current_password }}
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">НОВЫЙ ПАРОЛЬ</label>
                <div class="input-wrapper">
                    <input
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="form-input"
                        autocomplete="new-password"
                    >
                    <div class="input-decoration"></div>
                </div>
                <div v-if="form.errors.password" class="form-error">
                    {{ form.errors.password }}
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">ПОВТОРИ ПАРОЛЬ</label>
                <div class="input-wrapper">
                    <input
                        v-model="form.password_confirmation"
                        type="password"
                        class="form-input"
                        autocomplete="new-password"
                    >
                    <div class="input-decoration"></div>
                </div>
            </div>

            <div class="form-actions">
                <button class="btn btn-save" :disabled="form.processing">
                    СОХРАНИТЬ ПАРОЛЬ
                </button>
                <p v-if="form.recentlySuccessful" class="success-message">
                    Пароль успешно изменён!
                </p>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<style scoped>
.password-section {
    background-color: var(--white);
    border-radius: 16px;
    padding: 2.5rem;
    box-shadow: var(--shadow-sm);
    border: 2px solid rgba(0, 123, 94, 0.1);
}

.section-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 900;
    font-size: 1.6rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--primary);
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
    background: var(--accent);
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
    color: var(--primary);
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
    background: linear-gradient(135deg, rgba(0, 123, 94, 0.1), rgba(0, 153, 122, 0.1));
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
    background: linear-gradient(135deg, rgba(0, 123, 94, 0.15), rgba(0, 153, 122, 0.15));
}

.form-error {
    color: #e3342f;
    font-family: 'Montserrat', sans-serif;
    font-size: 0.9rem;
    margin-top: 0.75rem;
    font-weight: 600;
}

.form-actions {
    margin-top: 2.5rem;
}

.btn-save {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: var(--white);
    box-shadow: 0 4px 12px rgba(0, 123, 94, 0.3);
    padding: 1.25rem 2rem;
    font-weight: 800;
    font-size: 1.1rem;
}

.btn-save:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0, 123, 94, 0.4);
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
    .password-section {
        padding: 2rem;
    }

    .section-title {
        font-size: 1.5rem;
    }
}

@media (max-width: 768px) {
    .password-section {
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
    .password-section {
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
