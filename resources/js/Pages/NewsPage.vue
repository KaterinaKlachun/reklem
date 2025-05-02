<template>
    <Head title="Новости" />

    <PageBanner
        page-title="Новости компании"
        current-page-name="Новости"
    />

    <section class="wrapper">
        <div id="news-container" class="news_container">
            <div v-for="(newsItem, index) in newsList" :key="index" class="news-card">
                <h3 class="news-title">{{ newsItem.title }}</h3>
                <p class="news-description">{{ newsItem.description }}</p>
                <p class="news-date">{{ formatDate(newsItem.date) }}</p>
            </div>
        </div>
    </section>
</template>

<script setup>
import {Head, Link} from '@inertiajs/vue3';
import PageBanner from '@/Components/PageBanner.vue';

// Получаем props из Inertia
const props = defineProps({
    newsList: {
        type: Array,
        required: true
    }
});

const formatDate = (dateString) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('ru-RU', options);
};
</script>

<style scoped>
.news_container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
    max-width: 1200px;
    padding: 40px 0px;
    margin: 0 auto;
}

/* Карточка новости */
.news-card {
    background-color: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
}

.news-title {
    font-size: 1.1rem;
    font-weight: bold;
    color: #007b5e;
    margin-bottom: 8px;
    font-family: medium;
    text-align: left;
}

.news-description {
    font-size: 0.95rem;
    font-family: regular;
    color: #666;
    line-height: 1.5;
    margin-bottom: 12px;
    text-align: left;
}

.news-date {
    color: #FFA630;
    font-weight: bold;
    font-size: 0.85rem;
    text-align: right;
    margin-top: auto;
}

/* Адаптивность */
@media (max-width: 1024px) {
    .news_container {
        grid-template-columns: repeat(2, 1fr);
        padding: 30px 20px;
    }
}

@media (max-width: 768px) {
    .news_container {
        grid-template-columns: 1fr;
        padding: 20px 15px;
    }

    .news-card {
        padding: 20px;
    }
}

</style>
