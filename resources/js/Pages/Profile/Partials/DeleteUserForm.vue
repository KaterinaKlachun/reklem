<!-- DeleteUserForm.vue -->
<template>
    <div class="profile-section danger-section">
        <h2 class="section-title">УДАЛИТЬ АККАУНТ</h2>
        <p class="section-description">
            После удаления все данные исчезнут. Сохрани нужное заранее.
        </p>

        <div class="text-center">
            <button class="btn btn-danger" @click="confirmUserDeletion">
                УДАЛИТЬ АККАУНТ
            </button>
        </div>

        <!-- Модалка подтверждения -->
        <div v-if="confirmingUserDeletion" class="modal-overlay" @click.self="closeModal">
            <div class="modal-content">
                <h2 class="modal-title">ТОЧНО УДАЛИТЬ?</h2>
                <p class="modal-description">
                    Введи пароль, чтобы подтвердить удаление.
                </p>

                <div class="form-group">
                    <div class="input-wrapper">
                        <input
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            class="form-input"
                            placeholder="Твой пароль"
                            @keyup.enter="deleteUser"
                        >
                        <div class="input-decoration"></div>
                    </div>
                    <div v-if="form.errors.password" class="form-error">
                        {{ form.errors.password }}
                    </div>
                </div>

                <div class="modal-actions">
                    <button class="btn btn-cancel" @click="closeModal">
                        Отмена
                    </button>
                    <button
                        class="btn btn-confirm-delete"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Да, удалить
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
    form.clearErrors();
    form.reset();
};
</script>

<style scoped>
.danger-section {
    background-color: var(--white);
    border-radius: 16px;
    padding: 2.5rem;
    box-shadow: var(--shadow-sm);
    border: 2px solid rgba(227, 52, 47, 0.15);
}

.section-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 900;
    font-size: 1.6rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #e3342f;
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
    background: #e3342f;
    border-radius: 4px;
}

.section-description {
    color: var(--text-medium);
    font-family: 'Montserrat', sans-serif;
    font-size: 1.05rem;
    margin-bottom: 2.5rem;
    line-height: 1.6;
}

.btn-danger {
    background: linear-gradient(135deg, #e3342f, #d62c27);
    color: white;
    box-shadow: 0 4px 12px rgba(227, 52, 47, 0.3);
    padding: 1.25rem 2.5rem;
    font-weight: 800;
    font-size: 1.1rem;
    width: 100%;
    max-width: 300px;
}

.btn-danger:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(227, 52, 47, 0.4);
}

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    backdrop-filter: blur(5px);
}

.modal-content {
    background: var(--white);
    border-radius: 16px;
    width: 90%;
    max-width: 500px;
    padding: 2.5rem;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    animation: modalEnter 0.3s ease-out;
}

.modal-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 900;
    font-size: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #e3342f;
    margin-bottom: 1.5rem;
}

.modal-description {
    color: var(--text-medium);
    font-family: 'Montserrat', sans-serif;
    font-size: 1.05rem;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.modal-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

.btn-cancel {
    background-color: var(--light-bg);
    color: var(--text-dark);
    border: 2px solid #ddd;
    padding: 1rem 2rem;
    font-weight: 700;
    flex: 1;
}

.btn-cancel:hover {
    background-color: #e8e8e8;
}

.btn-confirm-delete {
    background: linear-gradient(135deg, #e3342f, #d62c27);
    color: var(--white);
    padding: 1rem 2rem;
    font-weight: 700;
    flex: 1;
}

.btn-confirm-delete:hover {
    background: linear-gradient(135deg, #d62c27, #c92520);
}

@keyframes modalEnter {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .danger-section {
        padding: 2rem;
    }

    .section-title {
        font-size: 1.5rem;
    }

    .modal-content {
        padding: 1.75rem;
    }

    .modal-actions {
        flex-direction: column;
    }

    .btn-cancel,
    .btn-confirm-delete {
        width: 100%;
    }
}

@media (max-width: 576px) {
    .danger-section {
        padding: 1.5rem;
    }

    .section-title {
        font-size: 1.4rem;
    }

    .btn-danger {
        padding: 1.1rem 1.5rem;
        font-size: 1rem;
    }
}
</style>
