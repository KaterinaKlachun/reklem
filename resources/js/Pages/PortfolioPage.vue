<template>
    <PageBanner
        page-title="Портфолио"
        current-page-name="Наши работы"
    />

    <section class="wrapper">
        <div class="portfolio-intro">
            <h2>Реализованные проекты</h2>
            <p class="intro-text">
                Каждая работа - это уникальный опыт и профессиональный подход.
                Мы создаем решения, которые работают на результат.
            </p>
        </div>

        <div class="portfolio_container">
            <div
                v-for="(product, index) in products"
                :key="product.title"
                class="product-card"
            >
                <img
                    :src="`/assets/img/portfolio/${product.img}`"
                    :alt="product.title"
                    class="product-image"
                    loading="lazy"
                />
                <h3 class="product-title">{{ product.title }}</h3>
            </div>
        </div>
    </section>
</template>

<script>
import PageBanner from "@/Components/PageBanner.vue";

export default {
    name: "PortfolioPage",
    components: {PageBanner},
    data() {
        return {
            products: [
                { title: "АО «Леруа Мерлен Восток»", img: "icon1.svg" },
                { title: "ИП Варкутинов", img: "icon2.svg" },
                { title: "АО «Лукоил Рус»", img: "icon3.svg" },
                { title: "ИП Джарахов", img: "icon4.svg" },
                { title: "ИП Иванова", img: "icon5.svg" },
                { title: "ООО «ТехноПром»", img: "icon6.svg" },
                { title: "ЗАО «ЭкоПак»", img: "icon7.svg" },
                { title: "ООО «ГлобалСтрой»", img: "icon8.svg" },
                { title: "ИП Ткачев", img: "icon9.svg" },
                { title: "ООО «МедСервис»", img: "icon10.svg" },
                { title: "АО «Газпром»", img: "icon11.svg" },
                { title: "ИП Ребров", img: "icon12.svg" },
                { title: "ООО «АгроПром»", img: "icon13.svg" },
                { title: "ИП Белова", img: "icon14.svg" },
                { title: "ООО «ФлораТех»", img: "icon15.svg" },
                { title: "ЗАО «СтройКомплект»", img: "icon16.svg" }
            ]
        };
    }
};
</script>

<style scoped>

.portfolio-intro {
    text-align: center;
    margin: 60px 0 40px;
}

.portfolio-intro h2 {
    font-size: 2.5rem;
    color: #007b5e;
    margin-bottom: 20px;
    font-weight: 700;
}

.intro-text {
    font-size: 1.2rem;
    color: #333333;
    max-width: 800px;
    margin: 0 auto;
    line-height: 1.6;
}

.portfolio_container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin: 60px 0;
}

.product-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 20px;
}

.product-image {
    width: 100%;
    max-height: 200px;
    object-fit: contain;
    border-radius: 10%;
    margin-bottom: 15px;
}

.product-title {
    font-size: 1rem;
    font-weight: 600;
    color: #007b5e;
    min-height: 40px;
    display: flex;
    align-items: center;
}

/* Адаптивность */
@media (max-width: 1200px) {
    .portfolio_container {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 900px) {
    .portfolio_container {
        grid-template-columns: repeat(2, 1fr);
    }

    .portfolio-intro h2 {
        font-size: 2rem;
    }

    .intro-text {
        font-size: 1rem;
    }
}

@media (max-width: 600px) {
    .portfolio_container {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .portfolio-intro {
        margin: 40px 0 20px;
    }

    .portfolio-intro h2 {
        font-size: 1.8rem;
    }

    .product-image {
        max-height: 180px;
    }
}
</style>
