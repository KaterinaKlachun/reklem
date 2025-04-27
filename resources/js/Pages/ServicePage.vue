<template>

    <PageBanner
        page-title="Наши услуги"
        current-page-name="Услуги"
    />
    <div class="services-2025">
        <div class="services-header">
            <p>Инновационные решения для вашего бренда</p>
        </div>

        <div class="services-accordion">
            <div
                v-for="(service, index) in services"
                :key="service.id"
                class="service-card"
                :class="{ 'active': activeService === service.id }"
                :style="{'--accent-color': getAccentColor(index)}"
            >
                <div class="service-preview" @click="toggleService(service.id)">
                    <div class="service-meta">
                        <div class="service-icon">
                            <img :src="service.image" :alt="service.title">
                        </div>
                        <h3>{{ service.title }}</h3>
                    </div>
                    <div class="service-indicator">
                        <div class="indicator-line"></div>
                        <div class="indicator-arrow">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M7 10l5 5 5-5" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <transition name="service-expand">
                    <div v-if="activeService === service.id" class="service-details">
                        <div class="service-content">
                            <p class="service-description">{{ service.shortDescription }}</p>

                            <div class="service-features">
                                <div
                                    v-for="(feature, i) in service.advantages"
                                    :key="i"
                                    class="feature-item"
                                >
                                    <div class="feature-number">{{ i+1 }}</div>
                                    <div>
                                        <h4>{{ feature.title }}</h4>
                                        <p>{{ feature.text }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import PageBanner from "@/Components/PageBanner.vue";

const props = defineProps({
    services: Array
});

const activeService = ref(null);

const toggleService = (id) => {
    activeService.value = activeService.value === id ? null : id;
};

const getAccentColor = (index) => {
    const colors = ['#FFA630', '#00997a', '#007b5e'];
    return colors[index % colors.length];
};
</script>

<style scoped>
/* Base Styles (1920px+) */
.services-2025 {
    max-width: 1440px;
    margin: 0 auto;
    padding: 100px 40px;
    font-family: 'Inter', -apple-system, sans-serif;
}

.services-header {
    text-align: center;
    margin-bottom: 60px;
}

.services-header h2 {
    font-size: 42px;
    font-weight: 700;
    color: #333;
    margin-bottom: 16px;
}

.services-header p {
    font-size: 18px;
    color: #777;
    max-width: 600px;
    margin: 0 auto;
}

.services-accordion {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.service-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.service-card.active {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
}

.service-preview {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 32px 40px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.service-card.active .service-preview {
    background-color: var(--accent-color);
}

.service-meta {
    display: flex;
    align-items: center;
    gap: 24px;
}

.service-icon {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f2f2f2;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.service-card.active .service-icon {
    background: rgba(255, 255, 255, 0.2);
}

.service-icon img {
    width: 32px;
    height: 32px;
    object-fit: contain;
}

.service-card h3 {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    transition: all 0.3s ease;
}

.service-card.active h3 {
    color: white;
}

.service-indicator {
    display: flex;
    align-items: center;
    gap: 16px;
}

.indicator-line {
    width: 40px;
    height: 2px;
    background: #ddd;
    transition: all 0.3s ease;
}

.service-card.active .indicator-line {
    background: rgba(255, 255, 255, 0.5);
    width: 60px;
}

.indicator-arrow svg {
    transition: all 0.3s ease;
}

.service-card.active .indicator-arrow svg {
    transform: rotate(180deg);
    stroke: white;
}

.service-details {
    overflow: hidden;
}

.service-content {
    padding: 0 40px 40px;
}

.service-description {
    font-size: 18px;
    line-height: 1.6;
    color: #555;
    margin-bottom: 32px;
    padding-top: 16px;
}

.service-features {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
    margin-top: 40px;
}

.feature-item {
    display: flex;
    gap: 16px;
}

.feature-number {
    width: 32px;
    height: 32px;
    background: var(--accent-color);
    color: white;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    flex-shrink: 0;
    margin-top: 4px;
}

.feature-item h4 {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.feature-item p {
    font-size: 16px;
    line-height: 1.6;
    color: #777;
}

/* Animations */
.service-expand-enter-active,
.service-expand-leave-active {
    transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.service-expand-enter-from,
.service-expand-leave-to {
    opacity: 0;
    transform: translateY(-20px);
}

/* Responsive Styles */
@media (max-width: 1200px) {
    .services-2025 {
        padding: 80px 40px;
    }

    .service-features {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 992px) {
    .services-header h2 {
        font-size: 36px;
    }

    .service-preview {
        padding: 24px 32px;
    }

    .service-content {
        padding: 0 32px 32px;
    }
}

@media (max-width: 768px) {
    .services-2025 {
        padding: 60px 24px;
    }

    .services-header h2 {
        font-size: 32px;
    }

    .services-header p {
        font-size: 16px;
    }

    .service-preview {
        padding: 20px 24px;
    }

    .service-meta {
        gap: 16px;
    }

    .service-icon {
        width: 48px;
        height: 48px;
    }

    .service-icon img {
        width: 24px;
        height: 24px;
    }

    .service-card h3 {
        font-size: 18px;
    }

    .service-content {
        padding: 0 24px 24px;
    }

    .service-description {
        font-size: 16px;
    }
}

@media (max-width: 480px) {
    .services-2025 {
        padding: 40px 16px;
    }

    .services-header h2 {
        font-size: 28px;
    }

    .service-preview {
        padding: 16px 20px;
    }

    .service-meta {
        gap: 12px;
    }

    .service-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
    }

    .indicator-line {
        width: 20px;
    }

    .service-card.active .indicator-line {
        width: 40px;
    }

    .feature-item {
        gap: 12px;
    }

    .feature-number {
        width: 28px;
        height: 28px;
        font-size: 14px;
    }

    .feature-item h4 {
        font-size: 16px;
    }

    .feature-item p {
        font-size: 14px;
    }
}

/* iPhone X (375px) specific */
@media (max-width: 375px) {
    .service-preview {
        padding: 14px 16px;
    }

    .service-content {
        padding: 0 16px 16px;
    }

    .service-meta {
        gap: 10px;
    }

    .service-icon {
        width: 36px;
        height: 36px;
    }

    .service-card h3 {
        font-size: 16px;
    }

    .service-description {
        font-size: 15px;
    }
}
</style>
