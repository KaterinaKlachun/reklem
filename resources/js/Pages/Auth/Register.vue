<template>
    <div class="auth-container">
        <Head title="Регистрация" />

        <div class="auth-header">
            <h2>Создайте аккаунт</h2>
            <p>Заполните форму для регистрации</p>
        </div>

        <form @submit.prevent="submit" class="auth-form">
            <div class="input-group">
                <label>ФИО</label>
                <input v-model="form.name" type="text" placeholder="Иванов Иван Иванович" />
                <div v-if="form.errors.name" class="error-message">
                    <span>{{ form.errors.name }}</span>
                </div>
            </div>

            <div class="input-group">
                <label>Email</label>
                <input v-model="form.email" type="email" placeholder="example@mail.com" />
                <div v-if="form.errors.email" class="error-message">
                    <span>{{ form.errors.email }}</span>
                </div>
            </div>

            <div class="input-group">
                <label>Пароль</label>
                <input v-model="form.password" type="password" placeholder="••••••••" />
                <div v-if="form.errors.password" class="error-message">
                    <span>{{ form.errors.password }}</span>
                </div>
            </div>

            <div class="input-group">
                <label>Повторите пароль</label>
                <input v-model="form.password_confirmation" type="password" placeholder="••••••••" />
            </div>

            <button :disabled="form.processing" class="auth-button">
                <span v-if="!form.processing">Зарегистрироваться</span>
                <span v-else class="loading">...</span>
            </button>

            <div class="auth-footer">
                <p>Уже есть аккаунт? <Link href="/login" class="auth-link">Войти</Link></p>
            </div>
        </form>
    </div>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
})

function submit() {
    form.post(route('register'))
}
</script>

<style scoped>
/* Основные стили */
.auth-container {
    max-width: 480px;
    margin: 2rem auto;
    padding: 2.5rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 155, 122, 0.1);
}

.auth-header {
    text-align: center;
    margin-bottom: 2rem;
}

.auth-header h2 {
    color: #007b5e;
    font-size: 1.8rem;
    margin-bottom: 0.5rem;
}

.auth-header p {
    color: #666;
    font-size: 1rem;
}

.auth-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.input-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

label {
    color: #007b5e;
    font-weight: 500;
    font-size: 0.95rem;
}

input {
    width: 100%;
    padding: 1rem;
    border: 2px solid #f2f2f2;
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s;
    background-color: #f9f9f9;
}

input:focus {
    border-color: #FFA630;
    outline: none;
    box-shadow: 0 0 0 3px rgba(255, 166, 48, 0.2);
}

.auth-button {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(to right, #00997a, #007b5e);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    margin-top: 1rem;
}

.auth-button:hover {
    background: linear-gradient(to right, #007b5e, #00634e);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 155, 122, 0.3);
}

.auth-button:disabled {
    background: #cccccc;
    transform: none;
    box-shadow: none;
    cursor: not-allowed;
}

.loading {
    display: inline-block;
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

.auth-footer {
    text-align: center;
    margin-top: 1.5rem;
    color: #666;
}

.auth-link {
    color: #FFA630;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s;
}

.auth-link:hover {
    color: #e69100;
}

.error-message {
    color: #e3342f;
    font-size: 0.85rem;
    margin-top: 0.25rem;
    padding: 0.5rem;
    background-color: rgba(227, 52, 47, 0.1);
    border-radius: 5px;
}

/* Адаптивность */
@media (max-width: 768px) {
    .auth-container {
        margin: 1rem;
        padding: 1.5rem;
        border-radius: 12px;
    }

    .auth-header h2 {
        font-size: 1.5rem;
    }

    input, .auth-button {
        padding: 0.8rem;
    }
}

@media (max-width: 480px) {
    .auth-container {
        margin: 0.5rem;
        padding: 1.2rem;
        border-radius: 10px;
    }

    .auth-header h2 {
        font-size: 1.3rem;
    }

    input {
        padding: 0.7rem;
    }

    .auth-button {
        padding: 0.8rem;
    }
}

@media (max-width: 375px) {
    .auth-container {
        padding: 1rem;
    }

    .auth-header p {
        font-size: 0.9rem;
    }

    label {
        font-size: 0.9rem;
    }

    input {
        font-size: 0.9rem;
    }
}
</style>
