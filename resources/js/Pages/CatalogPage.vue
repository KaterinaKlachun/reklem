<template>
    <Head title="Каталог" />

    <PageBanner
        page-title="Каталог"
        current-page-name="Каталог"
    />

    <section class="wrapper">
        <!-- Категории -->
        <div class="category-buttons">
            <button
                v-for="(category, key) in categories"
                :key="key"
                @click="selectCategory(key)"
                :class="{ active: selectedCategory === key }"
            >
                <img :src="category.image" :alt="category.name" />
                <p>{{ category.name }}</p>
            </button>
        </div>

        <!-- Индикатор загрузки -->
        <div v-if="loading" class="loading-overlay">
            <div class="loader"></div>
            <p>Загрузка товаров...</p>
        </div>

        <!-- Каталог товаров -->
        <div class="catalog_container">
            <div
                v-for="product in products"
                :key="product.id"
                class="product-card"
            >
                <img :src="product.image_url" :alt="product.title" />
                <h3>{{ product.title }}</h3>
                <p>{{ product.price }} ₽</p>
                <button @click="viewProduct(product.id)">Подробнее</button>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import {Head, router} from '@inertiajs/vue3'
import axios from 'axios'
import PageBanner from '@/Components/PageBanner.vue';

// Категории
const categories = {
    mugs: {
        name: 'Кружки',
        image: new URL('@/assets/img/catalog/icon_krysh.svg', import.meta.url).href
    },
    thermoses: {
        name: 'Термосы',
        image: new URL('@/assets/img/catalog/icon_termos.svg', import.meta.url).href
    },
    accessories: {
        name: 'Аксессуары',
        image: new URL('@/assets/img/catalog/icon_aksesyar.svg', import.meta.url).href
    },
    chancellery: {
        name: 'Канцелярия',
        image: new URL('@/assets/img/catalog/icon_kanc.svg', import.meta.url).href
    },
}

// Выбранная категория и список товаров
const selectedCategory = ref('mugs')
const products = ref([])
const loading = ref(false)  // Переменная для отображения индикатора загрузки

// Получение товаров с сервера по категории
const fetchProducts = async () => {
    loading.value = true; // Включаем индикатор загрузки
    try {
        const response = await axios.get('/catalog-products', {
            params: {
                category: selectedCategory.value,
            },
        })
        products.value = response.data
    } catch (error) {
        console.error('Ошибка загрузки товаров:', error)
    } finally {
        loading.value = false; // Отключаем индикатор после загрузки
    }
}

// Смена категории и перезагрузка товаров
const selectCategory = async (key) => {
    selectedCategory.value = key
    await fetchProducts()
}

// Переход на страницу товара
const viewProduct = (id) => {
    router.visit(`/product/${id}`)
}

// Загрузка при монтировании
onMounted(fetchProducts)
</script>

<style scoped>

.category-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 5%;
    margin-bottom: 5%;
}

.category-buttons button {
    border: none;
    background: transparent;
    cursor: pointer;
    text-align: center;
    transition: transform 0.3s ease;
}

.category-buttons button:hover {
    transform: scale(1.1);
}

.category-buttons button p {
    margin-top: 10px;
    font-size: 1rem;
    font-family: bold;
    color: #333;
}

.category-buttons button.active p {
    color: #00997a; /* Активная категория будет выделена */
}

.catalog_container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Количество колонок автоматически зависит от ширины экрана */
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
}

.product-card {
    background-color: #fff;
    border: 1px solid #00997a;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.product-card img {
    width: 100%;
    height: 220px;
    object-fit: contain; /* Сохраняем пропорции картинки, она не обрезается */
    border-radius: 10px;
    margin-bottom: 15px;
}

.product-card h3 {
    font-size: 1.2rem;
    color: #333;
    margin: 10px 0;
}

.product-card p {
    color: #00997a;
    font-size: 1.1rem;
    margin-bottom: 15px;
}

.product-card button {
    padding: 12px 20px;
    background-color: #00997a;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

.product-card button:hover {
    background-color: #007b5e;
}

/* Стиль для индикатора загрузки */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(255, 255, 255, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    flex-direction: column;
}

.loader {
    border: 4px solid rgba(0, 0, 0, 0.1);
    border-top: 4px solid #FFA630;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
    margin-bottom: 20px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.loading-overlay p {
    font-weight: bold;
    font-size: 1.5rem;
    color: #333;
    margin: 0;
}

/* Адаптивные стили для планшетов (1024px и меньше) */
@media (max-width: 1024px) {
    .category-buttons {
        display: flex;
        overflow-x: auto;
        gap: 12px;
        padding: 15px;
        margin: 20px 0;
        scrollbar-width: thin;
        scrollbar-color: #00997a #f0f0f0;
        -webkit-overflow-scrolling: touch;
    }

    .category-buttons::-webkit-scrollbar {
        height: 4px;
    }

    .category-buttons::-webkit-scrollbar-track {
        background: #f0f0f0;
    }

    .category-buttons::-webkit-scrollbar-thumb {
        background-color: #00997a;
        border-radius: 2px;
    }

    .category-buttons button {
        flex: 0 0 auto;
        width: 140px;
        padding: 12px;
        background: white;
        border-radius: 10px;
        transition: all 0.2s ease;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .category-buttons button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .category-buttons button.active {
        background: #e6f7f4;
        border-color: #00997a;
        box-shadow: 0 4px 8px rgba(0, 153, 122, 0.15);
    }

    .category-buttons button img {
        width: 40px;
        height: 40px;
        margin-bottom: 8px;
    }

    .category-buttons button p {
        margin-top: 0;
        font-size: 0.9rem;
        font-weight: 500;
        color: #333;
        white-space: nowrap;
    }

    .catalog_container {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 16px;
        padding: 0 15px;
    }
}

/* Адаптивные стили для мобильных устройств (768px и меньше) */
@media (max-width: 768px) {
    .category-buttons {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        padding: 0 15px;
    }

    .category-buttons button {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 12px 8px;
        background: #f5f5f5;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .category-buttons button:hover {
        transform: none;
        background: #e0e0e0;
    }

    .category-buttons button.active {
        background: #e0f2f1;
        border: 1px solid #00997a;
    }

    .category-buttons button img {
        width: 40px;
        height: 40px;
        margin-bottom: 8px;
    }

    .category-buttons button p {
        margin-top: 5px;
        font-size: 0.95rem;
        white-space: nowrap;
    }
}

/* Адаптивные стили для маленьких мобильных устройств (480px и меньше) */
@media (max-width: 480px) {
    .category-buttons {
        gap: 10px;
        padding: 0 10px;
    }

    .category-buttons button {
        padding: 10px 5px;
    }

    .category-buttons button img {
        width: 35px;
        height: 35px;
    }

    .category-buttons button p {
        font-size: 0.85rem;
    }
}
</style>
