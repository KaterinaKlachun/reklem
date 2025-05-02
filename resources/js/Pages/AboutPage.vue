<template>
    <Head title="О компании" />

    <PageBanner
        page-title="Немного о нас"
        current-page-name="О компании"
    />

    <!-- About Section -->
    <section class="about-section">
        <div class="wrapper">
            <div class="about-content">
                <div class="about-text">
                    <p>В своём стремлении улучшить пользовательский опыт мы упускаем, что ключевые особенности структуры проекта.</p>
                    <p>Значимость этих проблем настолько очевидна, что реализация намеченных плановых заданий, а также свежий взгляд на привычные вещи - безусловно открывает новые горизонты для системы массового участия.</p>
                </div>
                <div class="about-highlight">
                    <div class="highlight-card">
                        <div class="highlight-icon" style="background-color: rgba(0, 155, 122, 0.1);">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.709 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4881 2.02168 11.3363C2.16356 9.18455 2.99721 7.13631 4.39828 5.49706C5.79935 3.85781 7.69279 2.71537 9.79619 2.24013C11.8996 1.7649 14.1003 1.98232 16.07 2.86" stroke="#007B5E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22 4L12 14.01L9 11.01" stroke="#007B5E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3>10+ лет</h3>
                        <p>Успешной работы</p>
                    </div>
                    <div class="highlight-card">
                        <div class="highlight-icon" style="background-color: rgba(255, 166, 48, 0.1);">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 12C14.2091 12 16 10.2091 16 8C16 5.79086 14.2091 4 12 4C9.79086 4 8 5.79086 8 8C8 10.2091 9.79086 12 12 12Z" stroke="#FFA630" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6 20V19C6 17.9391 6.42143 16.9217 7.17157 16.1716C7.92172 15.4214 8.93913 15 10 15H14C15.0609 15 16.0783 15.4214 16.8284 16.1716C17.5786 16.9217 18 17.9391 18 19V20" stroke="#FFA630" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3>50+</h3>
                        <p>Профессионалов</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners-section">
        <div class="wrapper">
            <h2 class="section-title">Нам доверяют</h2>
            <div class="partners-grid">
                <div class="partner-logo" v-for="i in 4" :key="i">
                    <img :src="`/assets/img/about/brand${i}.svg`" :alt="`Brand ${i}`">
                </div>
            </div>
        </div>
    </section>

    <!-- Production Section -->
    <section class="production-section">
        <div class="wrapper">
            <div class="production-content">
                <div class="production-text">
                    <h2 class="section-title">Производство</h2>
                    <p>Значимость этих проблем настолько очевидна, что реализация намеченных плановых заданий, а также свежий взгляд на привычные вещи - безусловно открывает новые горизонты для системы массового участия.</p>
                </div>
                <div class="production-image">
                    <img src="../assets/img/about/production.svg" alt="Production">
                </div>
            </div>
        </div>
    </section>

    <!-- History Section -->
    <section class="history-section">
        <div class="wrapper">
            <h2 class="section-title">История компании</h2>
            <p class="history-description">Наш путь от небольшой команды до лидера отрасли</p>

            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-year">2010</div>
                    <div class="timeline-content">
                        <h3>Основание компании</h3>
                        <p>Небольшая команда энтузиастов начала свой путь</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2014</div>
                    <div class="timeline-content">
                        <h3>Первый крупный проект</h3>
                        <p>Заключили контракт с международной компанией</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2018</div>
                    <div class="timeline-content">
                        <h3>Расширение производства</h3>
                        <p>Открыли новый производственный комплекс</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2023</div>
                    <div class="timeline-content">
                        <h3>Лидер рынка</h3>
                        <p>Признаны лидером в своей отрасли</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import PageBanner from '@/Components/PageBanner.vue';
import {Head} from "@inertiajs/vue3";
export default {
    name: "AboutPage",
    components: {Head, PageBanner},
};
</script>

<style scoped>
/* Base Styles */

.section-title {
    font-size: 2rem;
    margin-bottom: 1rem;
    color: var(--primary);
    position: relative;
    display: inline-block;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 0;
    width: 100%;
    height: 8px;
    background-color: var(--accent);
    z-index: -1;
    opacity: 0.3;
}

/* About Section */
.about-section {
    padding: 80px 0;
}

.about-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.about-text p {
    margin-bottom: 20px;
    font-size: 1.125rem;
    line-height: 1.7;
}

.about-highlight {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.highlight-card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    text-align: center;
}

.highlight-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
}

.highlight-card h3 {
    font-size: 1.5rem;
    color: var(--primary);
    margin-bottom: 5px;
}

/* Partners Section */
.partners-section {
    padding: 80px 0;
    background-color: var(--light-bg);
    text-align: center;
}

.partners-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 40px;
    margin-top: 40px;
    align-items: center;
}

.partner-logo {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease;
}

.partner-logo:hover {
    transform: translateY(-5px);
}

.partner-logo img {
    max-width: 100%;
    height: auto;
    filter: grayscale(100%);
    opacity: 0.7;
    transition: all 0.3s ease;
}

.partner-logo:hover img {
    filter: grayscale(0%);
    opacity: 1;
}

/* Production Section */
.production-section {
    padding: 80px 0;
}

.production-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.production-image img {
    width: 100%;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

/* History Section */
.history-section {
    padding: 80px 0;
    background-color: var(--light-bg);
}

.history-description {
    font-size: 1.125rem;
    color: var(--primary-light);
    margin-bottom: 40px;
}

.timeline {
    position: relative;
    max-width: 800px;
    margin: 0 auto;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 2px;
    height: 100%;
    background: linear-gradient(to bottom, var(--primary), var(--accent));
}

.timeline-item {
    position: relative;
    margin-bottom: 40px;
    padding-left: 30px;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-year {
    position: absolute;
    left: -15px;
    top: 0;
    background: white;
    color: var(--primary);
    font-weight: 700;
    padding: 5px 15px;
    border-radius: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    border: 2px solid var(--accent);
}

.timeline-content {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.timeline-content h3 {
    color: var(--primary);
    margin-bottom: 10px;
}

/* Responsive Styles */
@media (max-width: 1200px) {
    .wrapper {
        max-width: 1000px;
    }
}

@media (max-width: 992px) {
    .about-content {
        grid-template-columns: 1fr;
        gap: 40px;
    }

    .production-content {
        grid-template-columns: 1fr;
        gap: 40px;
    }

    .partners-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {

    .about-highlight {
        grid-template-columns: 1fr;
    }

    .section-title {
        font-size: 1.75rem;
    }

    .about-section,
    .partners-section,
    .production-section,
    .history-section {
        padding: 60px 0;
    }
}

@media (max-width: 576px) {

    .partners-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .timeline {
        padding-left: 20px;
    }

    .timeline-item {
        padding-left: 20px;
    }

    .timeline-year {
        left: -10px;
        padding: 3px 10px;
        font-size: 0.875rem;
    }
}
</style>
