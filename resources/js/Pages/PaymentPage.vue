<template>
    <Head title="Личный кабинет" />
    <div class="payment-container">
        <div class="payment-card">
            <h1 class="payment-title">Подтверждение оплаты</h1>
            <div class="payment-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48" height="48">
                    <path fill="#007b5e" d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4z"/>
                    <path fill="#f2f2f2" d="M34.6 14.6L21 28.2l-5.6-5.6-2.8 2.8 8.4 8.4 16.4-16.4z"/>
                </svg>
            </div>

            <form @submit.prevent="submitPayment" class="payment-form">
                <div class="form-group">
                    <label for="number">Номер карты</label>
                    <div class="input-wrapper">
                        <input
                            type="text"
                            id="number"
                            v-model="payment.number"
                            required
                            :class="{'is-invalid': errors.number}"
                            placeholder="XXXX XXXX XXXX XXXX"
                            maxlength="16"
                            @input="limitCardNumber"
                        />
                        <span class="card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path fill="#00997a" d="M20 4H4c-1.11 0-2 .89-2 2v12c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                            </svg>
                        </span>
                    </div>
                    <div v-if="errors.number" class="error-message">{{ errors.number }}</div>
                </div>

                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="expiry">Срок действия</label>
                        <div class="input-wrapper">
                            <input
                                type="text"
                                id="expiry"
                                v-model="payment.expiry"
                                required
                                :class="{'is-invalid': errors.expiry}"
                                placeholder="MM/YY"
                                @input="formatExpiry"
                            />
                            <span class="calendar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="#00997a" d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V9h14v10zM5 7V5h14v2H5zm2 4h10v2H7zm0 4h7v2H7z"/>
                                </svg>
                            </span>
                        </div>
                        <div v-if="errors.expiry" class="error-message">{{ errors.expiry }}</div>
                    </div>

                    <div class="form-group half-width">
                        <label for="cvv">CVV код</label>
                        <div class="input-wrapper">
                            <input
                                type="text"
                                id="cvv"
                                v-model="payment.cvv"
                                required
                                :class="{'is-invalid': errors.cvv}"
                                maxlength="3"
                                placeholder="•••"
                            />
                            <span class="lock-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="#00997a" d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                                </svg>
                            </span>
                        </div>
                        <div v-if="errors.cvv" class="error-message">{{ errors.cvv }}</div>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    <span>Оплатить</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="currentColor" d="M5 13h11.17l-4.88 4.88c-.39.39-.39 1.03 0 1.42.39.39 1.02.39 1.41 0l6.59-6.59c.39-.39.39-1.02 0-1.41l-6.58-6.6c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L16.17 11H5c-.55 0-1 .45-1 1s.45 1 1 1z"/>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Модальное окно -->
        <div v-if="paymentSuccess" class="modal-overlay">
            <div class="modal-content">
                <div class="modal-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="64" height="64">
                        <path fill="#007b5e" d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4z"/>
                        <path fill="#f2f2f2" d="M34.6 14.6L21 28.2l-5.6-5.6-2.8 2.8 8.4 8.4 16.4-16.4z"/>
                    </svg>
                </div>
                <h2>Ваш заказ успешно оплачен!</h2>
                <p class="modal-text">Вы можете отследить статус в личном кабинете.</p>
                <button @click="closeModal" class="modal-btn">
                    Перейти в личный кабинет
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                        <path fill="currentColor" d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import {Head} from "@inertiajs/vue3";

export default {
    components: {Head},
    data() {
        return {
            payment: {
                number: '',
                expiry: '',
                cvv: '',
            },
            paymentSuccess: false,
            errors: {},
        };
    },
    methods: {
        limitCardNumber() {
            this.payment.number = this.payment.number.replace(/\D/g, '').slice(0, 16);
        },

        formatExpiry() {
            let formatted = this.payment.expiry.replace(/\D/g, '');
            if (formatted.length > 2) {
                formatted = formatted.slice(0, 2) + '/' + formatted.slice(2, 4);
            }
            this.payment.expiry = formatted;
        },

        validatePayment() {
            const errors = {};
            if (!/^\d{16}$/.test(this.payment.number)) {
                errors.number = 'Номер карты должен состоять из 16 цифр.';
            }

            const [month, year] = this.payment.expiry.split('/');
            const currentDate = new Date();
            if (
                !/^(0[1-9]|1[0-2])\/\d{2}$/.test(this.payment.expiry) ||
                new Date(+('20' + year), month - 1) < currentDate
            ) {
                errors.expiry = 'Неверный срок действия карты.';
            }

            if (!/^\d{3}$/.test(this.payment.cvv)) {
                errors.cvv = 'CVV должен состоять из 3 цифр.';
            }

            this.errors = errors;
            return Object.keys(errors).length === 0;
        },

        async submitPayment() {
            if (!this.validatePayment()) {
                return;
            }

            try {
                await axios.post('/cart/payment/confirm', this.payment);
                this.paymentSuccess = true;
            } catch (error) {
                console.error('Ошибка оплаты:', error);
            }
        },

        closeModal() {
            this.paymentSuccess = false;
            this.$inertia.visit('/dashboard');
        },
    },
};
</script>

<style scoped>
/* Основные стили (1920px и больше) */
.payment-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f2f2f2;
    padding: 2rem;
}

.payment-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 123, 94, 0.1);
    padding: 2.5rem;
    width: 100%;
    max-width: 500px;
    position: relative;
    overflow: hidden;
}

.payment-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 8px;
    background: linear-gradient(90deg, #007b5e, #00997a, #FFA630);
}

.payment-title {
    color: #007b5e;
    text-align: center;
    margin-bottom: 1.5rem;
    font-size: 1.8rem;
    font-weight: 600;
}

.payment-icon {
    text-align: center;
    margin-bottom: 1.5rem;
}

.payment-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-group label {
    color: #007b5e;
    font-weight: 500;
    font-size: 0.95rem;
}

.input-wrapper {
    position: relative;
}

.input-wrapper input {
    width: 100%;
    padding: 0.8rem 1rem 0.8rem 2.5rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.input-wrapper input:focus {
    border-color: #00997a;
    box-shadow: 0 0 0 2px rgba(0, 153, 122, 0.2);
    outline: none;
}

.input-wrapper input::placeholder {
    color: #aaa;
}

.card-icon,
.calendar-icon,
.lock-icon {
    position: absolute;
    left: 0.8rem;
    top: 50%;
    transform: translateY(-50%);
    color: #00997a;
}

.form-row {
    display: flex;
    gap: 1rem;
}

.half-width {
    flex: 1;
}

.submit-btn {
    background: linear-gradient(135deg, #007b5e, #00997a);
    color: white;
    border: none;
    padding: 1rem;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    margin-top: 0.5rem;
}

.submit-btn:hover {
    background: linear-gradient(135deg, #006a50, #00886c);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 123, 94, 0.3);
}

.submit-btn:active {
    transform: translateY(0);
    box-shadow: 0 2px 5px rgba(0, 123, 94, 0.3);
}

.error-message {
    color: #e74c3c;
    font-size: 0.85rem;
    margin-top: 0.25rem;
}

.is-invalid {
    border-color: #e74c3c !important;
}

.is-invalid:focus {
    box-shadow: 0 0 0 2px rgba(231, 76, 60, 0.2) !important;
}

/* Модальное окно */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    animation: fadeIn 0.3s ease;
}

.modal-content {
    background: white;
    padding: 2.5rem;
    border-radius: 16px;
    text-align: center;
    max-width: 400px;
    width: 90%;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    position: relative;
}

.modal-content::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 8px;
    background: linear-gradient(90deg, #007b5e, #00997a, #FFA630);
    border-radius: 16px 16px 0 0;
}

.modal-icon {
    margin-bottom: 1.5rem;
}

.modal-icon svg {
    animation: bounceIn 0.5s ease;
}

.modal-content h2 {
    color: #007b5e;
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.modal-text {
    color: #555;
    margin-bottom: 1.5rem;
    line-height: 1.5;
}

.modal-btn {
    background: linear-gradient(135deg, #007b5e, #00997a);
    color: white;
    border: none;
    padding: 0.8rem 1.5rem;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.modal-btn:hover {
    background: linear-gradient(135deg, #006a50, #00886c);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 123, 94, 0.3);
}

.modal-btn:active {
    transform: translateY(0);
}

/* Анимации */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes bounceIn {
    0% { transform: scale(0.5); opacity: 0; }
    50% { transform: scale(1.1); opacity: 1; }
    100% { transform: scale(1); }
}

/* Адаптивность */
@media screen and (max-width: 768px) {
    .payment-container {
        padding: 1rem;
    }

    .payment-card {
        padding: 1.5rem;
    }

    .payment-title {
        font-size: 1.5rem;
    }

    .form-row {
        flex-direction: column;
        gap: 1.5rem;
    }

    .half-width {
        width: 100%;
    }
}

@media screen and (max-width: 480px) {
    .payment-card {
        padding: 1.25rem;
        border-radius: 12px;
    }

    .payment-title {
        font-size: 1.3rem;
        margin-bottom: 1rem;
    }

    .input-wrapper input {
        padding: 0.7rem 1rem 0.7rem 2.2rem;
        font-size: 0.95rem;
    }

    .submit-btn {
        padding: 0.9rem;
        font-size: 0.95rem;
    }

    .modal-content {
        padding: 1.5rem;
    }

    .modal-content h2 {
        font-size: 1.3rem;
    }

    .modal-btn {
        padding: 0.7rem 1.25rem;
        font-size: 0.95rem;
    }
}
</style>
