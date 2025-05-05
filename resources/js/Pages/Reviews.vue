<template>
    <Head title="Отзывы" />

    <PageBanner
        page-title="Отзывы клиентов"
        current-page-name="Реальные мнения о нашей работе"
    />

    <!-- Rating Summary Block -->
    <section class="rating-summary">
        <div class="wrapper summary-container">
            <div class="average-rating">
                <h3>Средняя оценка</h3>
                <div class="rating-value">
                    <span class="average-number">{{ averageRating.toFixed(1) }}</span>
                    <div class="stars-container">
                        <span
                            v-for="i in 5"
                            :key="i"
                            :class="{ 'active': i <= Math.round(averageRating) }"
                        >★</span>
                    </div>
                </div>
                <p>На основе {{ totalReviews }} {{ reviewWordForm }}</p>
            </div>

            <div class="rating-distribution">
                <h3>Распределение оценок</h3>
                <div class="distribution-bar" v-for="n in 5" :key="n">
                    <span class="star-count">{{ 6 - n }}★</span>
                    <div class="bar-container">
                        <div class="bar" :style="{ width: getRatingPercentage(6 - n) + '%' }"></div>
                    </div>
                    <span class="count">{{ ratingCounts[6 - n] || 0 }} ({{ getRatingPercentage(6 - n).toFixed(0) }}%)</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Filter -->
    <section class="reviews-filter">
        <div class="wrapper filter-container">
            <div class="filter-group">
                <label>Сортировать по:</label>
                <select v-model="sortBy" @change="applyFilters">
                    <option value="newest">Сначала новые</option>
                    <option value="oldest">Сначала старые</option>
                    <option value="highest">Высокий рейтинг</option>
                    <option value="lowest">Низкий рейтинг</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Фильтр по рейтингу:</label>
                <div class="rating-filter">
                    <button
                        v-for="n in 5"
                        :key="n"
                        :class="{ active: ratingFilter === n }"
                        @click="toggleRatingFilter(n)"
                    >
                        {{ n }}★
                    </button>
                    <button
                        v-if="ratingFilter"
                        class="clear-filter"
                        @click="clearRatingFilter"
                    >
                        Сбросить
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- All Reviews Section -->
    <section class="all-reviews">
        <div class="wrapper" v-if="reviews.data.length === 0">
            <p class="no-reviews">Нет отзывов, соответствующих выбранным фильтрам</p>
        </div>

        <div class="wrapper reviews-grid" v-else>
            <div
                class="review-card"
                v-for="review in reviews.data"
                :key="review.id"
            >
                <div class="review-header">
                    <div class="user-details">
                        <h3>{{ review.name }}</h3>
                        <span class="review-date">{{ formatDate(review.date) }}</span>
                    </div>
                    <div class="review-rating">
                        <span
                            v-for="i in 5"
                            :key="i"
                            :class="{ 'active': i <= review.rating }"
                        >★</span>
                    </div>
                </div>
                <div class="review-content">
                    <h4>{{ review.title }}</h4>
                    <p>{{ review.text }}</p>
                </div>
            </div>
        </div>

        <div class="load-more wrapper" v-if="reviews.next_page_url">
            <button @click="loadMore" :disabled="loading">
                {{ loading ? 'Загрузка...' : 'Показать ещё отзывы' }}
            </button>
        </div>
    </section>
</template>

<script>
import PageBanner from '@/Components/PageBanner.vue'
import {Head, router} from '@inertiajs/vue3'

export default {
    components: {Head, PageBanner },

    props: {
        reviews: Object,
        filters: Object,
        averageRating: {
            type: Number,
            default: 0
        },
        totalReviews: {
            type: Number,
            default: 0
        },
        ratingCounts: {
            type: Object,
            default: () => ({}),
        },
    },

    data() {
        return {
            sortBy: this.filters.sort || 'newest',
            ratingFilter: this.filters.rating || null,
            loading: false,
        }
    },

    computed: {
        reviewWordForm() {
            const lastDigit = this.totalReviews % 10;
            const lastTwoDigits = this.totalReviews % 100;

            if (lastTwoDigits >= 11 && lastTwoDigits <= 19) return 'отзывов';
            if (lastDigit === 1) return 'отзыв';
            if (lastDigit >= 2 && lastDigit <= 4) return 'отзыва';
            return 'отзывов';
        }
    },

    methods: {
        getRatingPercentage(rating) {
            if (!this.totalReviews) return 0;
            return ((this.ratingCounts[rating] || 0) / this.totalReviews) * 100;
        },

        applyFilters() {
            const params = {
                sort: this.sortBy,
            }
            if (this.ratingFilter) params.rating = this.ratingFilter

            router.get(route('reviews.index'), params, {
                preserveState: true,
                preserveScroll: true,
                only: ['reviews', 'filters'],
            })
        },

        toggleRatingFilter(n) {
            this.ratingFilter = this.ratingFilter === n ? null : n
            this.applyFilters()
        },

        clearRatingFilter() {
            this.ratingFilter = null
            this.applyFilters()
        },

        loadMore() {
            if (this.loading) return
            this.loading = true

            const nextPage = this.reviews.current_page + 1
            const params = {
                sort: this.sortBy,
                page: nextPage,
            }
            if (this.ratingFilter) params.rating = this.ratingFilter

            router.get(route('reviews.index'), params, {
                preserveState: true,
                preserveScroll: true,
                only: ['reviews'],
                onSuccess: (page) => {
                    this.reviews.data = [...this.reviews.data, ...page.props.reviews.data]
                    this.reviews.current_page = page.props.reviews.current_page
                    this.reviews.next_page_url = page.props.reviews.next_page_url
                },
                onFinish: () => {
                    this.loading = false
                },
            })
        },

        formatDate(d) {
            return new Date(d).toLocaleDateString('ru-RU', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
            })
        },
    },
}
</script>

<style scoped>
.wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Rating Summary Block */
.rating-summary {
    padding: 30px 0;
    background: #fff;
    border-bottom: 1px solid #f2f2f2;
}

.summary-container {
    display: flex;
    gap: 40px;
    flex-wrap: wrap;
}

.average-rating {
    text-align: center;
    padding: 20px;
    min-width: 200px;
    background: #f9f9f9;
    border-radius: 8px;
    flex: 1;
}

.rating-value {
    font-size: 2rem;
    margin: 15px 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
}

.average-number {
    font-size: 2.5rem;
    font-weight: bold;
    color: #333;
}

.stars-container {
    font-size: 1.8rem;
    letter-spacing: 2px;
}

.stars-container span {
    color: #ccc;
}

.stars-container span.active {
    color: #FFA630;
}

.average-rating p {
    color: #666;
    margin-top: 5px;
    font-size: 0.9rem;
}

.rating-distribution {
    flex: 2;
    background: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
}

.rating-distribution h3 {
    margin-bottom: 15px;
    color: #333;
}

.distribution-bar {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.star-count {
    width: 40px;
    color: #FFA630;
    font-weight: bold;
}

.bar-container {
    flex-grow: 1;
    height: 20px;
    background: #e0e0e0;
    border-radius: 10px;
    margin: 0 15px;
    overflow: hidden;
}

.bar {
    height: 100%;
    background: #FFA630;
    border-radius: 10px;
    transition: width 0.5s ease;
}

.count {
    width: 80px;
    text-align: right;
    color: #666;
    font-size: 0.9rem;
}

/* Filter */
.reviews-filter {
    padding: 20px 0;
    background: #fff;
    border-bottom: 1px solid #f2f2f2;
}
.filter-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}
.filter-group {
    display: flex;
    align-items: center;
    gap: 10px;
}
.filter-group label {
    font-weight: 600;
    color: #007b5e;
    white-space: nowrap;
}
.filter-group select {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background: #fff;
    cursor: pointer;
}
.rating-filter {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}
.rating-filter button {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background: #fff;
    cursor: pointer;
    transition: all 0.2s;
}
.rating-filter button:hover {
    background: #f0f0f0;
}
.rating-filter button.active {
    background: #007b5e;
    color: #fff;
    border-color: #007b5e;
}
.rating-filter .clear-filter {
    background: transparent;
    border: none;
    color: #007b5e;
    text-decoration: underline;
    margin-left: 5px;
}

/* Reviews Grid */
.all-reviews {
    padding: 40px 0;
    background: #f9f9f9;
}
.reviews-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
}
.review-card {
    background: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s, box-shadow 0.3s;
}
.review-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}
.review-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 16px;
    gap: 10px;
}
.user-details h3 {
    margin: 0;
    font-size: 1.1rem;
    color: #333;
}
.review-date {
    display: block;
    font-size: 0.85rem;
    color: #666;
    margin-top: 5px;
}

/* Star Rating */
.review-rating {
    font-size: 1.2rem;
    white-space: nowrap;
}
.review-rating span {
    color: #ccc;
}
.review-rating span.active {
    color: #FFA630;
}

/* Content */
.review-content h4 {
    margin: 0 0 8px;
    font-size: 1rem;
    color: #007b5e;
}
.review-content p {
    margin: 0;
    font-size: 0.95rem;
    color: #444;
    line-height: 1.5;
}

.no-reviews {
    text-align: center;
    padding: 40px;
    color: #666;
    font-size: 1.1rem;
}

/* Load More */
.load-more {
    text-align: center;
    margin-top: 30px;
}
.load-more button {
    padding: 12px 30px;
    background: #007b5e;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.2s;
}
.load-more button:hover {
    background: #005a45;
}
.load-more button:disabled {
    background: #cccccc;
    cursor: not-allowed;
}

@media (max-width: 768px) {
    .summary-container {
        flex-direction: column;
        gap: 20px;
    }

    .average-rating {
        min-width: auto;
    }

    .filter-container {
        flex-direction: column;
        align-items: flex-start;
    }

    .filter-group {
        width: 100%;
        flex-direction: column;
        align-items: flex-start;
    }

    .rating-filter {
        width: 100%;
        justify-content: space-between;
    }

    .rating-filter button {
        flex: 1;
        text-align: center;
    }
}
</style>
