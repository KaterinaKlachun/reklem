<template>
    <section class="wrapper">
        <div class="contact_form">
            <div class="contact_txt">
                <h2>Нужна <span>помощь?</span></h2>
                <p>Оставьте свои данные — мы перезвоним и решим вопрос. Помните, оставляя контакты, вы даёте согласие на обработку персональных данных.</p>
            </div>

            <form @submit.prevent="handleSubmit" class="form-container">
                <div class="input-group">
                    <label for="name">Имя</label>
                    <div class="input-wrapper">
                        <input type="text" id="name" name="name" placeholder="Женя" required v-model="form.name">
                        <div class="input-decoration"></div>
                    </div>
                </div>

                <div class="input-group">
                    <label for="phone">Телефон</label>
                    <div class="input-wrapper">
                        <input type="tel" id="phone" name="phone" placeholder="+7 000 000 00 00" required v-model="form.phone">
                        <div class="input-decoration"></div>
                    </div>
                </div>

                <button type="submit" :disabled="submitting" class="submit-btn">
                    <span>{{ submitting ? 'Отправка...' : 'Отправить' }}</span>
                    <div class="btn-arrow">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 0L6.59 1.41L12.17 7H0V9H12.17L6.59 14.59L8 16L16 8L8 0Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="btn-hover-effect"></div>
                </button>

                <div class="form-messages">
                    <p v-if="success" class="success-message">Спасибо! Мы свяжемся с вами.</p>
                    <p v-if="error" class="error-message">{{ error }}</p>
                </div>
            </form>
        </div>
    </section>
</template>

<script>
import axios from 'axios';
export default {
    name: "ContactForm",
    data() {
        return {
            form: {
                name: '',
                phone: '',
            },
            submitting: false,
            error: null,
            success: false
        };
    },
    methods: {
        async handleSubmit() {
            this.submitting = true;
            this.error = null;
            this.success = false;

            try {
                const response = await axios.post('/contact', this.form);
                this.success = true;
                this.form.name = '';
                this.form.phone = '';
                console.log('Форма успешно отправлена', response.data);
            } catch (err) {
                this.error = 'Произошла ошибка при отправке формы.';
                console.error(err);
            } finally {
                this.submitting = false;
            }
        }
    }
};
</script>

<style scoped>
/* Базовые стили (1920px+) */
.contact_form {
    font-family: regular;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    background: linear-gradient(135deg, rgba(0, 123, 94, 0.9), rgba(0, 153, 122, 0.9));
    background-size: cover;
    background-position: center;
    border-radius: 30px;
    padding: 40px;
    margin: 80px 0;
    gap: 40px;
    box-shadow: 0 20px 40px rgba(0, 123, 94, 0.2);
    position: relative;
    overflow: hidden;
}

.contact_form::before {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    background-color: #FFA630;
    border-radius: 50%;
    opacity: 0.15;
    z-index: 0;
}

.contact_txt {
    flex: 1;
    min-width: 350px;
    max-width: 500px;
    color: white;
    position: relative;
    z-index: 1;
}

.contact_form h2 {
    font-size: 42px;
    margin-bottom: 20px;
    font-weight: 600;
    color: white;
    line-height: 1.2;
}

.contact_form h2 span {
    position: relative;
    display: inline-block;
}

.contact_form h2 span::after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 0;
    width: 100%;
    height: 8px;
    background-color: #FFA630;
    z-index: -1;
    border-radius: 4px;
}

.contact_form p {
    font-size: 16px;
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.6;
    margin-top: 10px;
}

.form-container {
    flex: 1;
    min-width: 350px;
    max-width: 450px;
    display: flex;
    flex-direction: column;
    gap: 25px;
    position: relative;
    z-index: 1;
}

.input-group {
    position: relative;
}

.input-group label {
    display: block;
    font-size: 14px;
    color: white;
    margin-bottom: 8px;
    font-weight: 500;
}

.input-wrapper {
    position: relative;
}

.input-wrapper input {
    width: 100%;
    padding: 16px 20px;
    border-radius: 10px;
    border: none;
    background-color: rgba(255, 255, 255, 0.95);
    font-size: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.input-wrapper input:focus {
    outline: none;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

.input-decoration {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 3px;
    background-color: #FFA630;
    transition: width 0.3s ease;
}

.input-wrapper input:focus ~ .input-decoration {
    width: 100%;
}

.submit-btn {
    margin-top: 10px;
    padding: 18px 30px;
    border: none;
    border-radius: 10px;
    background-color: #FFA630;
    color: white;
    font-weight: 600;
    font-size: 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 166, 48, 0.3);
}

.submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(255, 166, 48, 0.4);
}

.submit-btn:active {
    transform: translateY(0);
}

.btn-arrow {
    margin-left: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.3s ease;
}

.submit-btn:hover .btn-arrow {
    transform: translateX(4px);
}

.btn-hover-effect {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, rgba(255,255,255,0.1), rgba(255,255,255,0.3));
    transform: translateX(-100%);
    transition: transform 0.3s ease;
}

.submit-btn:hover .btn-hover-effect {
    transform: translateX(100%);
}

.form-messages {
    min-height: 40px;
    margin-top: 10px;
}

.success-message {
    color: #d4f1ea;
    font-size: 14px;
    text-align: center;
}

.error-message {
    color: #ffcccc;
    font-size: 14px;
    text-align: center;
}

/* Адаптивность */
@media (max-width: 1200px) {
    .contact_form {
        padding: 60px;
        margin: 80px 0;
    }
}

@media (max-width: 992px) {
    .contact_form {
        flex-direction: column;
        gap: 40px;
        padding: 50px;
    }

    .contact_txt,
    .form-container {
        min-width: 100%;
        max-width: 100%;
    }

    .contact_form h2 {
        font-size: 36px;
    }
}

@media (max-width: 768px) {
    .wrapper {
        padding: 0 30px;
    }

    .contact_form {
        padding: 40px;
        margin: 60px 0;
        border-radius: 25px;
    }

    .contact_form h2 {
        font-size: 32px;
    }

    .contact_form p {
        font-size: 15px;
    }
}

@media (max-width: 576px) {
    .wrapper {
        padding: 0 20px;
    }

    .contact_form {
        padding: 30px 25px;
        margin: 50px 0;
        border-radius: 20px;
        gap: 30px;
    }

    .contact_form h2 {
        font-size: 28px;
    }

    .contact_form h2 span::after {
        height: 6px;
        bottom: 3px;
    }

    .input-wrapper input {
        padding: 14px 18px;
    }

    .submit-btn {
        padding: 16px 25px;
        font-size: 15px;
    }
}

@media (max-width: 375px) { /* iPhone X и меньше */
    .contact_form {
        padding: 25px 20px;
        margin: 40px 0;
    }

    .contact_form h2 {
        font-size: 24px;
    }

    .contact_form p {
        font-size: 14px;
    }

    .input-wrapper input {
        padding: 12px 16px;
        font-size: 15px;
    }

    .submit-btn {
        padding: 14px 20px;
    }
}
</style>
