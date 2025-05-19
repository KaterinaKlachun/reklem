<template>
    <Head title="Политика обработки данных" />

    <!-- Баннер -->
    <PageBanner
        page-title="Политика обработки персональных данных"
        :breadcrumbs="[
            { href: '/', label: 'Главная /' },
            { label: 'Обработка данных' }
        ]"
    />

    <!-- Содержимое страницы -->
    <div class="data-processing-page">
        <!-- Hero Section -->
        <div class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title">Ваши данные <span class="highlight">в безопасности</span></h1>
                <p class="hero-subtitle">Мы ценим ваше доверие и защищаем вашу личную информацию</p>
            </div>
            <div class="hero-graphic">
                <div class="shield-animation">
                    <img src="@/assets/img/icons/check.svg" class="img-check">
                </div>
            </div>
        </div>

        <!-- Key Principles Grid -->
        <div class="principles-section">
            <h2 class="section-title">Наши принципы работы с данными</h2>
            <div class="principles-grid">
                <div
                    class="principle-card"
                    v-for="(item, index) in dataItems"
                    :key="index"
                    :style="{ 'transition-delay': `${index * 0.1}s` }"
                >
                    <div class="card-icon">
                        <img :src="item.icon" :alt="item.title" class="card-icon">
                    </div>
                    <h3>{{ item.title }}</h3>
                    <p>{{ item.content }}</p>
                </div>
            </div>
        </div>

        <!-- Policy Sections -->
        <div class="policy-sections">
            <!-- Usage Section -->
            <div class="policy-section">
                <div class="section-header">
                    <img src="@/assets/img/icons/text.svg" class="icon">
                    <h2>Использование сервиса</h2>
                </div>
                <div class="section-content">
                    <div class="policy-point">
                        <h3>
                            <img src="@/assets/img/icons/magaz.svg" class="icon">
                            Интернет-магазин
                        </h3>
                        <p>Печать ваших дизайнов на различных предметах и продажа готовых изделий.</p>
                    </div>
                    <div class="policy-point">
                        <h3>
                            <img src="@/assets/img/icons/handshake.svg" class="icon">
                            Партнёрская программа
                        </h3>
                        <p>Зарабатывайте, рекомендуя наш сервис через партнёрские ссылки.</p>
                    </div>
                </div>
            </div>

            <!-- Restrictions Section -->
            <div class="policy-section accent">
                <div class="section-header">
                    <img src="@/assets/img/icons/nosymbol.svg" class="icon">
                    <h2>Запрещённые действия</h2>
                </div>
                <div class="section-content">
                    <ul class="prohibited-list">
                        <li v-for="(item, index) in prohibitedActions" :key="index">
                            <img src="@/assets/img/icons/xcircle.svg" class="icon"> {{ item }}
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Rights Section -->
            <div class="policy-section">
                <div class="section-header">
                    <img src="@/assets/img/icons/scale.svg" alt="" class="icon">
                    <h2>Ваши права</h2>
                </div>
                <div class="section-content">
                    <div class="rights-grid">
                        <div class="right-item">
                            <img src="@/assets/img/icons/eye.svg" alt="" class="icon">
                            <p>Доступ к вашим данным</p>
                        </div>
                        <div class="right-item">
                            <img src="@/assets/img/icons/pencil_square.svg" alt="" class="icon">
                            <p>Исправление информации</p>
                        </div>
                        <div class="right-item">
                            <img src="@/assets/img/icons/trash.svg" alt="" class="icon">
                            <p>Удаление данных</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Section -->
        <div class="security-section">
            <div class="security-content">
                <h2><img src="@/assets/img/icons/check.svg" class="icon">
                    Технологии защиты</h2>
                <p>Мы используем передовые методы для безопасности ваших данных:</p>
                <div class="tech-badges">
          <span v-for="tech in techStack" :key="tech">
            <img src="@/assets/img/icons/path_small.svg" class="icon"> {{ tech }}
          </span>
                </div>
            </div>
            <div class="security-visual">
                <div class="lock-animation">
                    <img src="@/assets/img/icons/lock_bold.svg" class="icon">
                </div>
            </div>
        </div>

        <!-- Final Section -->
        <div class="final-section">
            <h2>Заключительные положения</h2>
            <p>Настоящая политика регулируется законодательством РФ. Все споры решаются сначала переговорами, а при невозможности согласия - в судебном порядке.</p>
            <p>Политика действует бессрочно до замены новой версией.</p>
        </div>
    </div>
</template>

<script>
import { Head } from "@inertiajs/vue3";
import PageBanner from "@/Components/PageBanner.vue";

export default {
    name: 'DataProcessingPage',
    components: { PageBanner, Head },

    data() {
        return {
            dataItems: [
                {
                    icon: new URL('@/assets/img/icons/stack.svg', import.meta.url).href,
                    title: "Минимум данных",
                    content: "Собираем только необходимую информацию для выполнения заказа"
                },
                {
                    icon: new URL('@/assets/img/icons/access-control.svg', import.meta.url).href,
                    title: "Контроль доступа",
                    content: "Строгий контроль доступа к вашей информации"
                },
                {
                    icon: new URL('@/assets/img/icons/lock.svg', import.meta.url).href,
                    title: "Шифрование",
                    content: "Все данные передаются и хранятся в зашифрованном виде"
                },
                {
                    icon: new URL('@/assets/img/icons/handraised.svg', import.meta.url).href,
                    title: "Без лишнего обмена",
                    content: "Не передаём данные третьим лицам без необходимости"
                },
                {
                    icon: new URL('@/assets/img/icons/clock.svg', import.meta.url).href,
                    title: "Ограниченное хранение",
                    content: "Храним данные только требуемое законом время"
                },
                {
                    icon: new URL('@/assets/img/icons/control.svg', import.meta.url).href,
                    title: "Ваш контроль",
                    content: "Вы можете управлять своими данными в любое время"
                }
            ],
            prohibitedActions: [
                "Регистрация под чужим именем",
                "Размещение незаконного контента",
                "Использование вредоносного ПО",
                "Нарушение авторских прав",
                "Автоматизированный сбор данных",
                "Обход технических ограничений"
            ],
            techStack: [
                "SSL-шифрование",
                "Соответствие GDPR",
                "Защита PCI DSS",
                "2FA аутентификация",
                "Регулярные аудиты"
            ]
        }
    }
}
</script>

<style scoped>
:root {
    --primary: #007b5e;
    --primary-light: #00997a;
    --primary-soft: rgba(0, 155, 122, 0.1);
    --secondary: #FFA630;
    --secondary-light: rgba(255, 166, 48, 0.1);
    --dark: #2e2e2e;
    --gray: #6c757d;
    --light-gray: #f2f2f2;
    --white: #ffffff;
    --danger: #dc3545;
}

.img-check{
    width: 128px;
    height: 128px;
}

.icon{
    width: 24px;
    height: 24px;
}

.data-processing-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px 60px;
    font-family: regular;
    color: var(--dark);
    line-height: 1.6;
}

/* Hero Section */
.hero-section {
    display: flex;
    align-items: center;
    gap: 40px;
    margin: 60px 0;
    padding: 40px 0;
}

.hero-content {
    flex: 1;
}

.hero-title {
    font-size: 2.8rem;
    font-weight: 700;
    margin: 0 0 20px;
    line-height: 1.2;
    color: var(--dark);
}

.highlight {
    color: var(--primary);
    position: relative;
    display: inline-block;
}

.highlight::after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 0;
    width: 100%;
    height: 8px;
    background-color: var(--secondary);
    opacity: 0.3;
    z-index: -1;
    border-radius: 4px;
}

.hero-subtitle {
    font-size: 1.2rem;
    color: var(--gray);
    margin: 0;
    max-width: 500px;
}

.hero-graphic {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

.shield-animation {
    width: 250px;
    height: 250px;
    background: var(--primary-soft);
    border-radius: 50%;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    animation: pulse 3s infinite ease-in-out;
}

.shield-animation::before {
    content: '';
    position: absolute;
    width: 200px;
    height: 200px;
    background: var(--white);
    border-radius: 50%;
    box-shadow: 0 0 0 10px rgba(0, 123, 94, 0.1);
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-15px); }
}

/* Principles Section */
.principles-section {
    margin: 100px 0;
}

.section-title {
    text-align: center;
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 50px;
    color: var(--dark);
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: var(--secondary);
    border-radius: 2px;
}

.principles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
}

.principle-card {
    background: var(--white);
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    opacity: 0;
    transform: translateY(20px);
    animation: fadeIn 0.6s forwards;
    border: 1px solid var(--light-gray);
}

@keyframes fadeIn {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.principle-card h3 {
    font-size: 1.3rem;
    margin: 0 0 15px;
    color: var(--dark);
}

.principle-card p {
    color: var(--gray);
    margin: 0;
    font-size: 0.95rem;
}

/* Policy Sections */
.policy-sections {
    margin: 80px 0;
}

.policy-section {
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 40px;
}

.policy-section.accent .section-header h2,
.policy-section.accent .section-header i,
.policy-section.accent .prohibited-list li {
    color: var(--white);
}

.section-header {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 25px 30px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.section-header i {
    font-size: 1.5rem;
    color: var(--primary);
}

.section-header h2 {
    font-size: 1.5rem;
    margin: 0;
    color: var(--dark);
}

.section-content {
    padding: 30px;
}

.policy-point {
    margin-bottom: 25px;
    position: relative;
}

.policy-point:last-child {
    margin-bottom: 0;
}

.policy-point h3 {
    font-size: 1.2rem;
    margin: 0 0 10px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.policy-point h3 i {
    color: var(--primary);
}

.policy-point p {
    margin: 0;
    color: var(--gray);
}

.prohibited-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.prohibited-list li {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--dark);
}

.prohibited-list li i {
    color: var(--secondary);
}

.rights-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.right-item {
    text-align: center;
    padding: 20px;
    background: var(--light-gray);
    border-radius: 8px;
    transition: all 0.3s ease;
}

.right-item img{
    margin-right: auto;
    margin-left: auto;
}

.right-item i {
    font-size: 2rem;
    color: var(--primary);
    margin-bottom: 15px;
}

.right-item p {
    margin: 0;
    font-weight: 500;
}

/* Security Section */
.security-section {
    display: flex;
    align-items: center;
    gap: 60px;
    margin: 100px 0;
    background: var(--light-gray);
    border-radius: 16px;
    padding: 60px;
}

.security-content {
    flex: 1;
}

.security-content h2 {
    font-size: 1.8rem;
    margin: 0 0 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    color: var(--dark);
}

.security-content h2 i {
    color: var(--primary);
}

.security-content p {
    color: var(--gray);
    margin: 0 0 30px;
    font-size: 1.1rem;
}

.tech-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.tech-badges span {
    background: var(--primary-soft);
    color: var(--primary);
    padding: 10px 18px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.tech-badges i {
    font-size: 0.9rem;
    color: var(--primary);
}

.security-visual {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

.lock-animation {
    width: 200px;
    height: 200px;
    background: var(--primary-soft);
    border-radius: 20px;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    animation: pulse 3s infinite ease-in-out;
}

/* Final Section */
.final-section {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
    padding: 40px;
    background: var(--white);
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    border: 1px solid var(--light-gray);
}

.final-section h2 {
    font-size: 1.8rem;
    margin: 0 0 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    color: var(--dark);
}

.final-section h2 i {
    color: var(--primary);
}

.final-section p {
    color: var(--gray);
    margin: 0 auto 15px;
    max-width: 600px;
}

/* Responsive Styles */
@media (max-width: 1024px) {
    .hero-title {
        font-size: 2.4rem;
    }

    .security-section {
        gap: 40px;
        padding: 40px;
    }
}

@media (max-width: 768px) {
    .hero-section {
        flex-direction: column;
        text-align: center;
    }

    .hero-title {
        font-size: 2rem;
    }

    .highlight::after {
        bottom: 2px;
        height: 6px;
    }

    .hero-subtitle {
        margin: 0 auto;
    }

    .security-section {
        flex-direction: column;
    }

    .security-content {
        text-align: center;
    }

    .tech-badges {
        justify-content: center;
    }

    .section-title {
        font-size: 1.8rem;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 1.8rem;
    }

    .hero-subtitle {
        font-size: 1rem;
    }

    .principles-grid {
        grid-template-columns: 1fr;
    }

    .policy-section {
        margin-bottom: 30px;
    }

    .section-header {
        padding: 20px;
    }

    .section-content {
        padding: 20px;
    }

    .security-section {
        padding: 30px 20px;
        margin: 60px 0;
    }

    .final-section {
        padding: 30px 20px;
    }
}
</style>
