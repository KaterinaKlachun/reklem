<template>
    <Head title="Обмен и возврат" />

    <!-- Баннер -->
    <PageBanner
        page-title="Информация об обмене и возврате"
        :breadcrumbs="[
            { href: '/', label: 'Главная /' },
            { label: 'Обмен и возврат' }
        ]"
    />

    <div class="wrapper">
        <div class="return-exchange-page">
            <div class="content">
                <p class="intro-text">Мы гарантируем <span class="highlight">возврат денег</span> и <span class="highlight">замену товара</span> в течение 30 дней.</p>

                <div class="divider"></div>

                <p class="regular-text">Если по каким-то причинам вы не удовлетворены покупкой, то можете обменять / вернуть товар приобретённый на Printdirect в течение 30 дней с момента получения заказа, при условии сохранения товарного вида.</p>

                <div class="notice-block">
                    <p>Поскольку все предметы изготавливаются индивидуально под ваш заказ и, соответственно, после возврата подлежат утилизации, мы обещаем вам, что:</p>
                </div>

                <div class="steps">
                    <div class="step">
                        <div class="step-number">1</div>
                        <p>Если нами допущена ошибка, или вам не нравится качество предметов, мы <strong>без вопросов</strong> заменим товар / вернём за него деньги.</p>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <p>Если ошибка сделана вами при создании своего предмета (вы загрузили неверный макет и т.д.), напишите нам, и мы посмотрим, что можно сделать.</p>
                    </div>
                </div>

                <h2 class="requisites-title">Наши реквизиты</h2>

                <div class="requisites-block">
                    <h3>ООО "Принтдирект ДВ"</h3>
                    <p><span>ИНН:</span> 2536285937</p>
                    <p><span>ОГРН:</span> 1182536006375</p>
                    <p><span>Адрес:</span> 690091, Владивосток, ул. Светланская, д. 115</p>
                </div>

                <div class="requisites-block">
                    <h3>ИП Петров Дмитрий Владимирович</h3>
                    <p><span>ИНН:</span> 253719048216</p>
                    <p><span>ОГРНИП:</span> 319253700342815</p>
                    <p><span>Адрес:</span> 690048, Владивосток, ул. Фокина, д. 14б</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Head} from "@inertiajs/vue3";
import PageBanner from "@/Components/PageBanner.vue";

export default {
    name: 'ReturnExchangePage',
    components: {PageBanner, Head},
}
</script>

<style scoped>
.return-exchange-page {
    margin: 0 auto;
    padding: 20px;
    font-family: regular;
    color: #2d3748;
    position: relative;
}

.content {
    padding: 20px;
}

.intro-text {
    font-size: 1.3rem;
    text-align: center;
    margin: 30px 0;
    font-weight: 600;
    color: #007b5e;
}

.highlight {
    color: #FFA630;
    font-weight: 700;
    text-shadow: 0 2px 4px rgba(255, 166, 48, 0.2);
}

.divider {
    height: 3px;
    background: linear-gradient(to right, transparent, #00997a, transparent);
    margin: 30px 0;
    opacity: 0.5;
}

.regular-text {
    font-size: 1.1rem;
    line-height: 1.7;
    margin-bottom: 30px;
}

.notice-block {
    background: #007b5e;
    color: white;
    padding: 25px;
    border-radius: 8px;
    margin: 30px 0;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 20px rgba(0, 123, 94, 0.2);
}

.notice-block::before {
    content: '';
    position: absolute;
    top: -20px;
    right: -20px;
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.notice-block p {
    margin: 0;
    font-size: 1.1rem;
    position: relative;
    z-index: 1;
}

.steps {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin: 40px 0;
}

.step {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    padding: 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    border-left: 5px solid #FFA630;
    transition: transform 0.3s ease;
}

.step:hover {
    transform: translateY(-3px);
}

.step-number {
    background: #FFA630;
    color: white;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.2rem;
    flex-shrink: 0;
    box-shadow: 0 4px 8px rgba(255, 166, 48, 0.3);
}

.step p {
    margin: 0;
    font-size: 1.05rem;
}

.step strong {
    color: #007b5e;
}

.requisites-title {
    font-size: 2rem;
    color: #007b5e;
    text-align: center;
    margin: 60px 0 30px;
    position: relative;
}

.requisites-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background: #FFA630;
}

.requisites-block {
    background: white;
    padding: 25px;
    border-radius: 10px;
    margin-bottom: 25px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    border-top: 3px solid #00997a;
}

.requisites-block h3 {
    color: #007b5e;
    margin-top: 0;
    margin-bottom: 20px;
    font-size: 1.3rem;
}

.requisites-block p {
    margin: 10px 0;
    font-size: 1rem;
}

.requisites-block span {
    color: #00997a;
    font-weight: 600;
    min-width: 70px;
    display: inline-block;
}

/* Адаптивность */
@media (max-width: 768px) {
    .main-title {
        font-size: 2.2rem;
    }

    .intro-text {
        font-size: 1.1rem;
    }

    .notice-block {
        padding: 20px;
    }

    .step {
        flex-direction: column;
        gap: 15px;
    }

    .requisites-title {
        font-size: 1.6rem;
    }
}

@media (max-width: 480px) {
    .return-exchange-page {
        padding: 10px;
    }

    .main-title {
        font-size: 1.8rem;
        margin: 20px 0;
    }

    .content {
        padding: 10px;
    }

    .requisites-block {
        padding: 20px;
    }
}
</style>
