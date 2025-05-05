<template>
    <!-- Основной контейнер -->
    <section class="wrapper">
        <!-- Блок FAQ -->
        <div class="faq">
            <!-- Заголовок FAQ -->
            <h1>Часто задаваемые<br><span>вопросы</span></h1>

            <!-- Секции с вопросами и ответами -->
            <div class="faq_section">

                <!-- Первая колонка вопросов -->
                <div class="faq_section1">
                    <details>
                        <summary>
                            <span>Вы доставляете по всей России?</span>
                            <img class="icon" src="@/assets/img/arrow_down.svg" alt="plus icon" />
                        </summary>
                        <p>Да, мы организуем доставку по всей территории России с помощью надёжных курьерских служб. Вы также можете выбрать способ доставки, который лучше всего вам подходит.</p>
                    </details>
                    <details>
                        <summary>
                            <span>А на бумаге печатаете?</span>
                            <img class="icon" src="@/assets/img/arrow_down.svg" alt="plus icon" />
                        </summary>
                        <p>Нет, мы не выполняем печать на бумаге — такие услуги обычно предоставляют типографии. Мы специализируемся на печати на кружках, термосах, канцелярии, флешках и других подобных поверхностях.</p>
                    </details>
                    <details>
                        <summary>
                            <span>Можно сделать принт на своей вещи?</span>
                            <img class="icon" src="@/assets/img/arrow_down.svg" alt="plus icon" />
                        </summary>
                        <p>Да, вы можете принести свою вещь для нанесения принта. Обратите внимание, что материал должен соответствовать нашим требованиям для наилучшего результата печати. Рекомендуем уточнить детали у менеджера.</p>
                    </details>
                    <details>
                        <summary>
                            <span>Как быстро сможете произвести заказ?</span>
                            <img class="icon" src="@/assets/img/arrow_down.svg" alt="plus icon" />
                        </summary>
                        <p>Сроки выполнения зависят от сложности и объема заказа. Обычно стандартные заказы выполняются в течение 3-5 рабочих дней. Для срочных заказов у нас также предусмотрены ускоренные опции.</p>
                    </details>
                </div>

                <!-- Вторая колонка вопросов -->
                <div class="faq_section1">
                    <details>
                        <summary>
                            <span>Можно заказать одну какую-то позицию?</span>
                            <img class="icon" src="@/assets/img/arrow_down.svg" alt="plus icon" />
                        </summary>
                        <p>Конечно! Мы выполняем заказы в любом объеме — от одной единицы до крупных партий. Вы всегда можете заказать один экземпляр для проверки качества.</p>
                    </details>
                    <details>
                        <summary>
                            <span>Из-за заграницы можно заказать?</span>
                            <img class="icon" src="@/assets/img/arrow_down.svg" alt="plus icon" />
                        </summary>
                        <p>К сожалению, мы работаем только с заказами внутри России и не предоставляем международную доставку. Если вы находитесь за границей, вы можете оформить заказ через друзей или родственников, проживающих в России, и они смогут получить его для вас. Мы предлагаем несколько удобных способов доставки по стране, чтобы ваш заказ был доставлен быстро и надёжно.</p>
                    </details>
                    <details>
                        <summary>
                            <span>Можно организовать самовывоз?</span>
                            <img class="icon" src="@/assets/img/arrow_down.svg" alt="plus icon" />
                        </summary>
                        <p>К сожалению, у нас не предусмотрен самовывоз. Мы осуществляем только доставку по всей России, чтобы обеспечить удобство и безопасность получения вашего заказа.</p>
                    </details>
                    <details>
                        <summary>
                            <span>А если я не юр лицо, будем сотрудничать?</span>
                            <img class="icon" src="@/assets/img/arrow_down.svg" alt="plus icon" />
                        </summary>
                        <p>Конечно! Мы работаем как с юридическими, так и с физическими лицами. Независимо от статуса, вы можете рассчитывать на качественное обслуживание и поддержку.</p>
                    </details>
                </div>

            </div>
        </div>
    </section>
</template>

<script>
export default {
    // Название компонента
    name: "FAQ",
};
</script>

<style scoped>
/* ЧИСТЫЙ ВНЕШНИЙ ВИД */
.faq {
    margin-top: 8%;
    padding: 0;
}

/* Заголовок */
.faq h1 {
    font-family: bold;
    font-size: 3rem;
    line-height: 1.2;
    margin-bottom: 2rem;
    color: #333;
}

.faq h1 span {
    text-decoration: underline 5px;
    text-decoration-color: #FFA630;
}

/* Контейнер секций */
.faq_section {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

/* Одна колонка по умолчанию */
.faq_section1 {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

/* Элемент FAQ */
details {
    border-radius: 1rem;
    background: transparent;
    padding: 1rem 1.5rem;
    border-top: 2px solid #B3B3B3;
    cursor: pointer;
    transition: background 0.3s ease;
}

details[open] {
    background: #FFF8F0;
    border-left: 4px solid #FFA630;
}

summary {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-family: bold;
    font-size: 1.125rem;
    list-style: none;
    user-select: none;
}

.icon {
    transition: transform 0.3s ease;
    width: 1.2rem;
    height: 1.2rem;
}

details[open] .icon {
    transform: rotate(180deg);
}

details p {
    font-family: regular;
    font-size: 1rem;
    color: #666;
    margin-top: 1rem;
    line-height: 1.5;
}

/* АДАПТИВНОСТЬ */

/* Две колонки — только на очень широких экранах */
@media (min-width: 1920px) {
    .faq_section {
        flex-direction: row;
        justify-content: space-between;
        gap: 3rem;
    }

    .faq_section1 {
        width: 48%;
    }
}

@media (max-width: 1919px) {
    .faq{
        margin: 20px;
    }
}

/* Планшеты и средние экраны */
@media (max-width: 1024px) {
    .faq{
        margin: 20px;
    }

    .faq h1 {
        font-size: 2.5rem;
    }

    summary {
        font-size: 1rem;
    }

    details p {
        font-size: 0.95rem;
    }
}

/* Мобильные */
@media (max-width: 768px) {
    .faq h1 {
        font-size: 2rem;
        text-align: center;
    }

    summary {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .icon {
        align-self: flex-end;
    }
}

</style>
