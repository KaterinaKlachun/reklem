<template>
    <Head title="Услуги" />


    <PageBanner
        page-title="Наши услуги"
        current-page-name="Услуги"
    />
    <div class="services-2025">
        <div class="services-header">
            <h2>Наши услуги</h2>
            <p>Инновационные решения для вашего бренда</p>
        </div>

        <div class="services-grid">
            <div
                v-for="(service, index) in services"
                :key="service.id"
                class="service-card"
                :style="{'--accent-color': getAccentColor(index)}"
                @mouseenter="flippedCard = service.id"
                @mouseleave="flippedCard = null"
            >
                <div class="card-inner" :class="{ 'is-flipped': flippedCard === service.id }">
                    <!-- Лицевая сторона -->
                    <div class="card-face card-front">
                        <h3>{{ service.title }}</h3>
                        <p class="service-summary">{{ service.shortDescription }}</p>
                        <ul class="features-list">
                            <li v-for="(feature, i) in service.advantages" :key="i">
                                {{ feature.title }}
                            </li>
                        </ul>
                    </div>

                    <!-- Обратная сторона -->
                    <div class="card-face card-back">
                        <div class="back-header">
                            <h4>{{ service.title }}</h4>
                            <p class="back-description">{{ service.description }}</p>
                        </div>
                        <div class="back-scrollable">
                            <div class="back-features">
                                <div v-for="(feature, i) in service.advantages" :key="i" class="back-feature">
                                    <div class="feature-number">{{ i+1 }}</div>
                                    <div class="feature-content">
                                        <h5>{{ feature.title }}</h5>
                                        <p>{{ feature.text }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import PageBanner from "@/Components/PageBanner.vue";
import {Head} from "@inertiajs/vue3";

const props = defineProps({
    services: Array
});

const flippedCard = ref(null);

const getAccentColor = (index) => {
    const colors = ['#FFA630', '#00997a', '#007b5e'];
    return colors[index % colors.length];
};
</script>

<style scoped>
/* Основные стили (1920px+) */
.services-2025 {
    max-width: 1440px;
    margin: 0 auto;
    padding: 100px 40px;
    font-family: 'Inter', -apple-system, sans-serif;
}

.services-header {
    text-align: center;
    margin-bottom: 80px;
}

.services-header h2 {
    font-size: 42px;
    font-weight: 700;
    color: #333;
    margin-bottom: 20px;
}

.services-header p {
    font-size: 18px;
    color: #777;
    max-width: 600px;
    margin: 0 auto;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
}

.service-card {
    perspective: 1200px;
    height: 420px;
}

.card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    transform-style: preserve-3d;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

.card-face {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    padding: 32px;
    box-sizing: border-box;
    border-radius: 16px;
    overflow: hidden;
}

.card-front {
    background: white;
    display: flex;
    flex-direction: column;
}

.card-back {
    background: linear-gradient(135deg, var(--accent-color), color-mix(in srgb, var(--accent-color) 80%, #333));
    transform: rotateY(180deg);
    display: flex;
    flex-direction: column;
    color: #fff; /* Белый текст для лучшей читаемости */
}

.is-flipped {
    transform: rotateY(180deg);
}

/* Стили для лицевой стороны */
.service-card h3 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 16px;
    color: #333;
}

.service-summary {
    font-size: 16px;
    color: #555;
    margin-bottom: 20px;
}

.features-list {
    margin: 0;
    padding: 0;
    list-style: none;
    flex-grow: 1;
}

.features-list li {
    position: relative;
    padding-left: 24px;
    margin-bottom: 12px;
    font-size: 15px;
    color: #555;
}

.features-list li:before {
    content: "";
    position: absolute;
    left: 0;
    top: 10px;
    width: 12px;
    height: 2px;
    background-color: var(--accent-color);
}

/* Стили для обратной стороны */
.back-header {
    margin-bottom: 20px;
}

.back-header h4 {
    font-size: 22px;
    color: white;
    margin-bottom: 12px;
}

.back-description {
    color: rgba(255,255,255,0.9);
    font-size: 15px;
}

.back-scrollable {
    flex: 1;
    overflow-y: auto;
    padding: 20px 32px;
    scrollbar-width: thin;
    scrollbar-color: rgba(255,255,255,0.3) transparent;
}

.back-scrollable::-webkit-scrollbar {
    width: 6px;
}

.back-scrollable::-webkit-scrollbar-track {
    background: transparent;
}

.back-scrollable::-webkit-scrollbar-thumb {
    background-color: rgba(255,255,255,0.3);
    border-radius: 3px;
}


.back-features {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.back-feature {
    display: flex;
    gap: 12px;
}

.feature-number {
    width: 26px;
    height: 26px;
    background: white;
    color: var(--accent-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    flex-shrink: 0;
}

.feature-content h5 {
    font-size: 16px;
    color: white;
    margin-bottom: 6px;
}

.feature-content p {
    font-size: 14px;
    color: rgba(255,255,255,0.8);
    margin: 0;
}

/* Адаптив */
@media (max-width: 1440px) {
    .services-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }
}

@media (max-width: 1200px) {
    .services-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .service-card {
        height: 380px;
    }
}

@media (max-width: 768px) {
    .services-2025 {
        padding: 80px 30px;
    }

    .services-header {
        margin-bottom: 60px;
    }

    .service-card {
        height: 360px;
    }

    .card-face {
        padding: 24px;
    }
}

@media (max-width: 480px) {
    .services-2025 {
        padding: 60px 20px;
    }

    .services-header h2 {
        font-size: 32px;
    }

    .services-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .service-card {
        height: 340px;
        min-height: auto;
    }

    .card-face {
        padding: 20px;
    }
}

/* iPhone X и меньше */
@media (max-width: 375px) {
    .services-2025 {
        padding: 50px 16px;
    }

    .services-header h2 {
        font-size: 28px;
    }

    .service-card {
        height: 320px;
    }

    .service-card h3,
    .back-header h4 {
        font-size: 20px;
    }

    .service-summary,
    .back-description {
        font-size: 14px;
    }

    .features-list li {
        font-size: 14px;
    }
}
</style>
