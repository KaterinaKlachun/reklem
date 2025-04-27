<template>
        <!-- Main Banner -->
        <section class="modern-banner">
            <div class="wrapper">
                <div class="banner-content">
                    <div class="banner-text">
                        <h1>Планируете сделать <span>принт?</span><br>Вы пришли по адресу</h1>
                        <p class="banner-description">
                            Reklem - только оптовая работа высокого качества с индивидуальным подходом. Работаем с 2008 года.
                        </p>
                        <div class="button-group">
                            <button class="cta-button" @click="goToCatalog">Перейти в каталог</button>
                            <button class="secondary-button" @click="goToAbout">О компании</button>
                        </div>
                    </div>
                    <div class="banner-image">
                        <div class="image-container">
                            <img src="@/assets/img/main/background.svg" alt="Пример продукции" class="product-image">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section class="wrapper">
            <div class="modern-features">
                <div class="feature-card" v-for="(item, index) in aboutCards" :key="index">
                    <div class="feature-icon">
                        <img :src="item.image" :alt="item.title">
                    </div>
                    <h3>{{ item.title }}</h3>
                    <p>{{ item.description }}</p>
                </div>
            </div>
        </section>

        <!-- About Us -->
        <section class="wrapper">
            <div class="modern-about">
                <div class="about-content">
                    <div class="about-text">
                        <h2><span>Пара слов</span> о нас, производстве и брендинге</h2>
                        <p>В своём стремлении улучшить пользовательский опыт мы упускаем, что ключевые особенности структуры проекта опыт мы упускаем, что ключевые особенности структуры проекта.</p>
                    </div>
                    <div class="about-visual">
                        <img src="@/assets/img/main/key_cup.svg" alt="Продукция" class="about-image">
                        <div class="about-shape"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Popular Products -->
        <PopularProducts :products="products" />

        <!-- Services -->
        <section class="wrapper">
            <div class="modern-services">
                <h2>Популярные услуги</h2>
                <div class="services-grid">
                    <div class="service-card" v-for="(service, index) in services" :key="index">
                        <div class="service-icon">
                            <img :src="service.image" :alt="service.name">
                        </div>
                        <h3>{{ service.name }}</h3>
                        <p>{{ service.description }}</p>
                        <button @click="goToService(service.id)" class="service-link">
                            Подробнее
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 0L6.59 1.41L12.17 7H0V9H12.17L6.59 14.59L8 16L16 8L8 0Z" fill="#10BB87"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Reviews -->
        <section class="modern-reviews-section">
            <div class="wrapper">
                <div class="reviews-container">
                    <div class="reviews-header">
                        <h2>Отзывы наших <span>клиентов</span></h2>
                        <p>Узнайте, что говорят о нас те, кто уже воспользовался нашими услугами</p>
                    </div>

                    <div class="reviews-slider">
                        <!-- Review Card 1 -->
                        <div class="review-card">
                            <div class="review-content">
                                <div class="review-rating">
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                </div>
                                <p class="review-text">"Отличное качество печати! Заказывали фирменные ручки для всей компании. Сделали быстро, даже раньше срока. Буем обращаться еще!"</p>
                                <div class="review-author">
                                    <img src="@/assets/img/main/ivan_avatar.svg" alt="Аватар" class="author-avatar">
                                    <div class="author-info">
                                        <h4>Иван Петров</h4>
                                        <p>Директор ООО "ТехноПром"</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Review Card 2 -->
                        <div class="review-card">
                            <div class="review-content">
                                <div class="review-rating">
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                </div>
                                <p class="review-text">"Работаем с Reklem уже 5 лет. Всегда стабильное качество и индивидуальный подход. Рекомендую как надежного поставщика."</p>
                                <div class="review-author">
                                    <img src="@/assets/img/main/helen_avatar.svg" alt="Аватар" class="author-avatar">
                                    <div class="author-info">
                                        <h4>Елена Смирнова</h4>
                                        <p>Маркетинг-директор "БрендГрупп"</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Review Card 3 -->
                        <div class="review-card">
                            <div class="review-content">
                                <div class="review-rating">
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                </div>
                                <p class="review-text">"Заказали срочный тираж буклетов - выполнили в срок, несмотря на сложности. Качество на высоте, цены адекватные."</p>
                                <div class="review-author">
                                    <img src="@/assets/img/main/alex_avatar.svg" alt="Аватар" class="author-avatar">
                                    <div class="author-info">
                                        <h4>Алексей Козлов</h4>
                                        <p>ИП "Козлов и Партнеры"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="reviews-footer">
                        <button class="all-reviews-button" @click="goToReview">
                            Все отзывы
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 0L6.59 1.41L12.17 7H0V9H12.17L6.59 14.59L8 16L16 8L8 0Z" fill="#10BB87"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- News -->
        <section class="wrapper">
            <div class="modern-news">
                <h2>Оставайтесь <span>в курсе</span> <span>событий</span></h2>
                <div class="news-grid">
                    <div class="news-card" v-for="(event, index) in events" :key="index">
                        <h3>{{ event.title }}</h3>
                        <p>{{ event.description }}</p>
                    </div>
                </div>
                <button @click="goToNews" class="news-button">
                    Все новости
                    <img src="@/assets/img/main/new.svg" alt="Новости">
                </button>
            </div>
        </section>
</template>

<script>
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import axios from "axios";
import PopularProducts from '@/Components/PopularProducts.vue';

export default {
    components: {
        PopularProducts,
    },
    setup() {
        const products = ref([]);
        const services = ref([
            { id: 1, image: new URL('@/assets/img/main/gravir.svg', import.meta.url).href, name: 'Гравировка', description: 'Точное нанесение логотипа, рисунка или текста на поверхность изделия с помощью лазера.' },
            { id: 2, image: new URL('@/assets/img/main/shlefov.svg', import.meta.url).href, name: 'Шелкография', description: 'Метод печати высокого качества для нанесения изображений на изделия из любых материалов.' },
            { id: 3, image: new URL('@/assets/img/main/tisnen.svg', import.meta.url).href, name: 'Тиснение', description: 'Создание рельефного изображения или логотипа с эффектом глубины и прочным визуальным акцентом.' },
            { id: 4, image: new URL('@/assets/img/main/tampo.svg', import.meta.url).href, name: 'Тампопечать', description: 'Точное нанесение логотипов и изображений на изделия с неровной поверхностью с помощью силиконового валика.' },
        ]);
        const events = ref([
            { title: 'Маски теперь в продаже', description: 'Принимая во внимание показатели успешности, синтетическое тестирование способствует повышению качества анализа существующих паттернов поведения.' },
            { title: 'Обновление сайта и новое позиционирование', description: 'Мы вынуждены отталкиваться от того, что начало повседневной работы требует анализа направлений по формированию прогрессивного развития.' },
        ]);
        const aboutCards = ref([
            { image: new URL('@/assets/img/main/timer.svg', import.meta.url).href, title: 'Принт за 24 часа', description: 'Некоторые заказы можем произвести быстрее суток' },
            { image: new URL('@/assets/img/main/flash.svg', import.meta.url).href, title: 'Быстрая доставка', description: 'Сотрудничаем с быстрыми и надежными службами' },
            { image: new URL('@/assets/img/main/box.svg', import.meta.url).href, title: 'Только ОПТ', description: 'Работаем на большие объемы брендинга' },
        ]);

        onMounted(async () => {
            const response = await fetch('/popular-products');
            products.value = await response.json();
        });

        const goToProduct = (product) => {
            if (product && product.id) {
                router.visit(`/product/${product.id}`);
            } else {
                console.error('Товар не имеет идентификатора:', product);
            }
        };

        const goToCatalog = () => router.visit('/catalog');
        const goToAbout = () => router.visit('/about');
        const goToPortfolio = () => router.visit('/portfolio');
        const goToNews = () => router.visit('/news');
        const goToService = (serviceId) => router.visit(`/service/${serviceId}`);
        const goToReview = () => router.visit('/reviews');

        return {
            products,
            services,
            events,
            aboutCards,
            goToProduct,
            goToCatalog,
            goToAbout,
            goToPortfolio,
            goToNews,
            goToService,
            goToReview,
        };
    },
};
</script>

<style scoped>

/* Main Banner */
.modern-banner {
    position: relative;
    background-color: #F2F2F2;
    overflow: hidden;
    min-height: 80vh;
    display: flex;
    align-items: center;
}

.banner-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1440px;
    margin: 0 auto;
    width: 100%;
    gap: 60px;
}

.banner-text {
    max-width: 600px;
    z-index: 2;
}

.modern-banner h1 {
    font-family: 'bold', sans-serif;
    font-size: 56px;
    line-height: 1.2;
    margin-bottom: 24px;
    color: #333;
}

.modern-banner h1 span {
    position: relative;
    color: #FFA630;
}

.modern-banner h1 span::after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 0;
    width: 100%;
    height: 12px;
    background-color: rgba(255, 166, 48, 0.3);
    z-index: -1;
    border-radius: 4px;
}

.banner-description {
    font-family: 'regular', sans-serif;
    font-size: 20px;
    line-height: 1.6;
    margin-bottom: 40px;
    color: #555;
}

.button-group {
    display: flex;
    gap: 20px;
}

.cta-button {
    background-color: #10BB87;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 18px 36px;
    font-family: 'bold', sans-serif;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(16, 187, 135, 0.3);
}

.cta-button:hover {
    background-color: #0E9D75;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(14, 157, 117, 0.4);
}

.secondary-button {
    background-color: transparent;
    color: #10BB87;
    border: 2px solid #10BB87;
    border-radius: 8px;
    padding: 16px 34px;
    font-family: 'bold', sans-serif;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.secondary-button:hover {
    background-color: rgba(16, 187, 135, 0.1);
}

.banner-image {
    flex: 1;
    position: relative;
    max-width: 600px;
}

.image-container {
    position: relative;
    width: 100%;
    height: 100%;
}

.product-image {
    width: 100%;
    height: auto;
    object-fit: contain;
    filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.15));
}

/* About Section */
.modern-about {
    padding: 100px 0;
}

.about-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 80px;
}

.about-text {
    flex: 1;
    max-width: 600px;
}

.modern-about h2 {
    font-family: 'bold', sans-serif;
    font-size: 42px;
    line-height: 1.2;
    margin-bottom: 24px;
    color: #333;
}

.modern-about h2 span {
    position: relative;
    color: #333;
}

.modern-about h2 span::after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 0;
    width: 100%;
    height: 6px;
    background-color: #FFA630;
    z-index: -1;
    border-radius: 4px;
}

.modern-about p {
    font-family: 'regular', sans-serif;
    font-size: 18px;
    line-height: 1.6;
    margin-bottom: 32px;
    color: #555;
}

.modern-about-button {
    background-color: #10BB87;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 16px 32px;
    font-family: 'bold', sans-serif;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.modern-about-button:hover {
    background-color: #0E9D75;
}

.about-visual {
    position: relative;
    flex: 1;
    max-width: 600px;
}

.about-image {
    width: 100%;
    height: auto;
    object-fit: contain;
    position: relative;
    z-index: 2;
}

.about-shape {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 120%;
    height: 120%;
    background: radial-gradient(circle, #FFA630 0%, transparent 70%);
    opacity: 0.1;
    z-index: 1;
    border-radius: 50%;
}

/* Features */
.modern-features {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
    padding: 80px 0;
}

.feature-card {
    background: white;
    border-radius: 16px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
}

.feature-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
}

.feature-card h3 {
    font-family: 'bold', sans-serif;
    font-size: 20px;
    margin-bottom: 16px;
    color: #333;
}

.feature-card p {
    font-family: 'regular', sans-serif;
    font-size: 16px;
    line-height: 1.6;
    color: #B3B3B3;
}

/* Services */
.modern-services {
    padding: 100px 0;
}

.modern-services h2 {
    font-family: 'bold', sans-serif;
    font-size: 42px;
    margin-bottom: 60px;
    color: #333;
    text-align: center;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
}

.service-card {
    background: white;
    border-radius: 16px;
    padding: 40px 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
}

.service-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.service-card h3 {
    font-family: 'bold', sans-serif;
    font-size: 18px;
    margin-bottom: 16px;
    color: #333;
}

.service-card p {
    font-family: 'regular', sans-serif;
    font-size: 16px;
    line-height: 1.6;
    color: #B3B3B3;
    margin-bottom: 24px;
}

.service-link {
    font-family: 'medium', sans-serif;
    font-size: 16px;
    color: #10BB87;
    background: none;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 0;
    transition: color 0.3s ease;
}

.service-link:hover {
    color: #0E9D75;
}

/* Reviews */
.modern-reviews-section {
    padding: 100px 0;
    background-color: #F8F9FA;
    position: relative;
    overflow: hidden;
}

.reviews-header {
    text-align: center;
    margin-bottom: 60px;
}

.reviews-header h2 {
    font-family: 'bold', sans-serif;
    font-size: 42px;
    color: #333;
    margin-bottom: 16px;
}

.reviews-header p {
    font-family: 'regular', sans-serif;
    font-size: 18px;
    color: #B3B3B3;
    max-width: 600px;
    margin: 0 auto;
}

.reviews-slider {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-bottom: 40px;
}

.review-card {
    background: white;
    border-radius: 16px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.review-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
}

.review-rating {
    margin-bottom: 20px;
}

.star {
    color: #FFA630;
    font-size: 20px;
    margin-right: 4px;
}

.review-text {
    font-family: 'regular', sans-serif;
    font-size: 16px;
    line-height: 1.6;
    color: #555;
    margin-bottom: 24px;
}

.review-author {
    display: flex;
    align-items: center;
}

.author-avatar {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    margin-right: 16px;
    object-fit: cover;
}

.author-info h4 {
    font-family: 'bold', sans-serif;
    font-size: 16px;
    color: #333;
    margin-bottom: 4px;
}

.author-info p {
    font-family: 'regular', sans-serif;
    font-size: 14px;
    color: #B3B3B3;
}

.reviews-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.all-reviews-button {
    background-color: white;
    color: #10BB87;
    border: 2px solid #10BB87;
    border-radius: 8px;
    padding: 16px 32px;
    font-family: 'medium', sans-serif;
    font-size: 16px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.all-reviews-button:hover {
    background-color: #10BB87;
    color: white;
}

/* News */
.modern-news {
    padding: 100px 0;
}

.modern-news h2 {
    font-family: 'bold', sans-serif;
    font-size: 42px;
    margin-bottom: 60px;
    color: #333;
}

.modern-news h2 span {
    position: relative;
    color: #333;
}

.modern-news h2 span::after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 0;
    width: 100%;
    height: 6px;
    background-color: #FFA630;
    z-index: -1;
    border-radius: 4px;
}

.news-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 40px;
    margin-bottom: 60px;
}

.news-card {
    background: white;
    border-radius: 16px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
}

.news-card h3 {
    font-family: 'bold', sans-serif;
    font-size: 24px;
    margin-bottom: 16px;
    color: #333;
}

.news-card p {
    font-family: 'regular', sans-serif;
    font-size: 16px;
    line-height: 1.6;
    color: #B3B3B3;
}

.news-button {
    display: block;
    margin-left: auto;
    background-color: white;
    color: #333;
    border: 2px solid #10BB87;
    border-radius: 10px;
    padding: 16px 32px;
    font-family: 'medium', sans-serif;
    font-size: 16px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
}

.news-button:hover {
    background-color: #10BB87;
    color: white;
}

/* ---------- Адаптив от 1440 до 1025px ---------- */
@media screen and (max-width: 1440px) {
    .banner-content {
        gap: 40px;
    }

    .modern-banner h1 {
        font-size: 48px;
    }

    .banner-description {
        font-size: 18px;
    }

    .button-group {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .about-content {
        gap: 60px;
    }

    .services-grid {
        grid-template-columns: repeat(3, 1fr);
    }

    .reviews-slider {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* ---------- Планшеты: 1024 до 768px ---------- */
@media screen and (max-width: 1024px) {
    .banner-content {
        flex-direction: column-reverse;
        text-align: center;
        gap: 30px;
    }

    .banner-text {
        max-width: 100%;
    }

    .banner-image {
        max-width: 100%;
    }

    .about-content {
        flex-direction: column;
        text-align: center;
    }

    .modern-about h2,
    .modern-services h2,
    .modern-news h2,
    .reviews-header h2 {
        font-size: 32px;
    }

    .modern-about p,
    .banner-description {
        font-size: 16px;
    }

    .modern-features {
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }

    .services-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .reviews-slider {
        grid-template-columns: 1fr;
    }

    .news-grid {
        grid-template-columns: 1fr;
    }
}

/* ---------- Мобилки: 767px и меньше ---------- */
@media screen and (max-width: 767px) {
    .modern-banner {
        min-height: auto;
        padding: 60px 0;
    }

    .banner-content {
        flex-direction: column-reverse;
        gap: 20px;
    }

    .modern-banner h1 {
        font-size: 28px;
    }

    .banner-description {
        font-size: 15px;
    }

    .button-group {
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .cta-button,
    .secondary-button,
    .modern-about-button,
    .all-reviews-button,
    .news-button {
        width: 100%;
        padding: 14px 24px;
        font-size: 14px;
    }

    .about-content {
        flex-direction: column;
        gap: 20px;
    }

    .about-text {
        max-width: 100%;
    }

    .about-image {
        width: 100%;
        max-width: 300px;
        margin: 0 auto;
    }

    .modern-features {
        grid-template-columns: 1fr;
    }

    .services-grid {
        grid-template-columns: 1fr;
    }

    .review-card {
        padding: 20px;
    }

    .reviews-header p {
        font-size: 14px;
    }

    .news-card {
        padding: 20px;
    }

    .modern-services,
    .modern-about,
    .modern-news,
    .modern-reviews-section {
        padding: 60px 0;
    }
}

</style>
