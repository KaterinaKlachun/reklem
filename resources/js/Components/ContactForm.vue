<template>
    <!-- Основной контейнер -->
    <section class="wrapper">
        <!-- Форма обратной связи -->
        <div class="contact_form">
            <!-- Текстовый блок -->
            <div class="contact_txt">
                <h2>Нужна <span>помощь?</span></h2>
                <p>Оставьте свои данные — мы перезвоним
                    и решим вопрос. Помните, оставляя
                    контакты, вы даёте согласие на
                    обработку персональных данных.
                </p>
            </div>
            <!-- Форма ввода данных -->
            <form>
                <label for="name">Имя</label>
                <input type="text" id="name" placeholder="Женя" required>
                <label for="phone">Телефон</label>
                <input type="tel" id="phone" placeholder="+7 000 000 00 00" required>
                <button type="submit">
                    Отправить
                    <img src="@/assets/img/arrow_right_green.svg" alt="">
                </button>
            </form>
        </div>
    </section>
</template>

<script>
export default {
    // Название компонента
    name: "ContactForm",
};
</script>

<style scoped>
.contact_form {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    background-image: url('@/assets/img/main/help.svg');
    background-size: cover;
    background-position: center;
    border-radius: 30px;
    padding: 60px 80px;
    margin-top: 10%;
    gap: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(2px);
}

.contact_txt {
    flex: 1 1 350px;
    max-width: 600px;
    color: white;
}

.contact_form h2 {
    font-size: 36px;
    margin-bottom: 16px;
    font-family: medium;
    color: #fff;
}

.contact_form h2 span {
    text-decoration: underline 4px;
    text-decoration-color: #FFA630;
}

.contact_form p {
    font-size: 14px;
    font-family: regular;
    color: #d4f1ea;
    line-height: 1.6;
    margin-top: 10px;
}

/* Форма */
.contact_form form {
    flex: 1 1 300px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.contact_form label {
    font-size: 12px;
    color: #007b5e;
    font-family: medium;
}

.contact_form input {
    padding: 12px 14px;
    border-radius: 8px;
    border: none;
    background-color: white;
    font-size: 14px;
    font-family: regular;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
}

.contact_form button {
    margin-top: 10px;
    padding: 12px;
    border: none;
    border-radius: 8px;
    background-color: #00997a;
    color: white;
    font-family: medium;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s ease;
}

.contact_form button:hover {
    background-color: #007b5e;
}

.contact_form button img {
    margin-left: 10px;
    width: 16px;
}

/* Responsive ↓↓↓ */

@media (max-width: 1024px) {
    .contact_form {
        padding: 40px 40px;
    }

    .contact_txt,
    .contact_form form {
        flex: 1 1 100%;
        text-align: center;
    }

    .contact_form form {
        align-items: center;
        margin-top: 20px;
    }

    .contact_form input {
        width: 100%;
    }

    .contact_form button {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .contact_form {
        padding: 30px 20px;
        border-radius: 20px;
    }

    .contact_form h2 {
        font-size: 28px;
    }

    .contact_form p {
        font-size: 12px;
    }

    .contact_form button {
        font-size: 13px;
    }
}

</style>
