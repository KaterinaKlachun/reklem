<template>
    <div class="review-form-container">
        <h3>Оставить отзыв</h3>
        <form @submit.prevent="submitReview" class="review-form">
            <div class="rating-input">
                <label>Ваша оценка:</label>
                <div class="stars">
                    <button
                        v-for="i in 5"
                        :key="i"
                        type="button"
                        class="star-btn"
                        :class="{ 'active': i <= rating }"
                        @click="rating = i"
                    >
                        ★
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="title">Заголовок отзыва:</label>
                <input
                    type="text"
                    id="title"
                    v-model="title"
                    required
                    placeholder="Краткое описание вашего опыта"
                >
            </div>

            <div class="form-group">
                <label for="text">Ваш отзыв:</label>
                <textarea
                    id="text"
                    v-model="text"
                    required
                    placeholder="Расскажите подробнее о вашем опыте"
                    rows="4"
                ></textarea>
            </div>

            <button type="submit" class="submit-btn" :disabled="isSubmitting">
                {{ isSubmitting ? 'Отправка...' : 'Отправить отзыв' }}
            </button>
        </form>
    </div>
</template>

<script>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

export default {
    name: 'ReviewForm',
    
    setup() {
        const rating = ref(0)
        const title = ref('')
        const text = ref('')
        const isSubmitting = ref(false)

        const submitReview = async () => {
            if (rating.value === 0) {
                alert('Пожалуйста, выберите оценку')
                return
            }

            isSubmitting.value = true

            try {
                await router.post(route('reviews.store'), {
                    rating: rating.value,
                    title: title.value,
                    text: text.value
                })

                // Очищаем форму после успешной отправки
                rating.value = 0
                title.value = ''
                text.value = ''
            } catch (error) {
                console.error('Ошибка при отправке отзыва:', error)
            } finally {
                isSubmitting.value = false
            }
        }

        return {
            rating,
            title,
            text,
            isSubmitting,
            submitReview
        }
    }
}
</script>

<style scoped>
.review-form-container {
    background: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    margin-bottom: 30px;
}

.review-form-container h3 {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 20px;
}

.review-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.rating-input {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.stars {
    display: flex;
    gap: 5px;
}

.star-btn {
    background: none;
    border: none;
    font-size: 2rem;
    color: #ccc;
    cursor: pointer;
    transition: color 0.2s;
    padding: 0;
    line-height: 1;
}

.star-btn:hover,
.star-btn.active {
    color: #FFA630;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group label {
    font-weight: 600;
    color: #333;
}

.form-group input,
.form-group textarea {
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.2s;
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #007b5e;
}

.submit-btn {
    background: #007b5e;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s;
}

.submit-btn:hover:not(:disabled) {
    background: #005a45;
}

.submit-btn:disabled {
    background: #cccccc;
    cursor: not-allowed;
}

@media (max-width: 768px) {
    .review-form-container {
        padding: 16px;
    }

    .star-btn {
        font-size: 1.8rem;
    }
}
</style> 