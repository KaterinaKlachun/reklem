<template>
    <div>
        <HeaderPage />
        <main>
            <slot />
            <FAQ />
            <ContactForm />
        </main>
        <FooterPage />
    </div>
</template>

<script setup>
import HeaderPage from '@/Components/HeaderPage.vue'
import FooterPage from '@/Components/FooterPage.vue'
import FAQ from '@/Components/FAQ.vue'
import ContactForm from '@/Components/ContactForm.vue'
</script>

<style lang="css">

@font-face {
    font-family: "bold";
    src: url("@/assets/font/Inter-SemiBold.woff2") format("woff2"),
    url("@/assets/font/Inter-SemiBold.woff") format("woff");
}

@font-face {
    font-family: "medium";
    src: url("@/assets/font/Inter-Medium.woff2") format("woff2"),
    url("@/assets/font/Inter-Medium.woff") format("woff");
}

@font-face {
    font-family: "regular";
    src: url("@/assets/font/Inter-Regular.woff2") format("woff2"),
    url("@/assets/font/Inter-Regular.woff") format("woff");
}

* {
    margin: 0;
    padding: 0;
}

body {
    font-family: 'regular';
    line-height: 1.6;
    background-color: white;
}

.wrapper {
    width: 100%;
    max-width: 1180px;
    margin: 0 auto;
}

.pagination a{
    text-decoration: none;
    font-family: medium;
    font-size: 1rem;
    color: black;
}

.cat{
    position: relative;
    margin-top: 11%;
    width: 450px;
}

.cat h1 span {
    text-decoration: underline 5px;
    text-decoration-color: #FFA630; /* Цвет подчеркивания */
}

.cat h1{
    font-family: bold;
    font-size: 36px;
}

.cat p{
    margin-top: 20%;
    font-family: regular;
    font-size: 1rem;
}

button {
    transition: transform 0.1s ease;
}

button:active {
    transform: scale(0.95);
}

</style>
