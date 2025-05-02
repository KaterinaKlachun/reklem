<template>
    <Head title="Контакты" />

    <PageBanner
        page-title="Контакты"
        current-page-name="Свяжитесь с нами"
    />

    <!-- Contact Info Section -->
    <section class="contact-section">
        <div class="wrapper">
            <div class="contact-header">
                <h1>Контакты</h1>
                <p class="contact-description">
                    Мы всегда рады новым проектам и сотрудничеству. Свяжитесь с нами удобным для вас способом.
                </p>
            </div>

            <div class="contact-grid">
                <!-- Address Block -->
                <div class="contact-card">
                    <div class="contact-icon" style="background-color: rgba(0, 123, 94, 0.1);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z" stroke="#007B5E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke="#007B5E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3>Адрес</h3>
                    <p>Москва, м.Октябрьское поле<br>ул. Народного ополчения, д.34, стр.3, офис 8</p>
                </div>

                <!-- Phone Block -->
                <div class="contact-card">
                    <div class="contact-icon" style="background-color: rgba(0, 153, 122, 0.1);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 16.92V19.92C22 20.47 21.55 20.92 21 20.92H19.92C10.38 20.92 3.07996 13.62 3.07996 4.08V3C3.07996 2.45 3.52996 2 4.07996 2H7.07996C7.62996 2 8.07996 2.45 8.07996 3V4.92C8.07996 5.47 7.62996 5.92 7.07996 5.92H5.31996C5.99996 10.31 9.68996 14 14.08 14.68V12.92C14.08 12.37 14.53 11.92 15.08 11.92H17.08C17.63 11.92 18.08 12.37 18.08 12.92V15.92C18.08 16.47 17.63 16.92 17.08 16.92H15.08" stroke="#00997A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3>Телефон</h3>
                    <p>+7 (495) 226-26-61<br>+7 (495) 133-16-28</p>
                </div>

                <!-- Email Block -->
                <div class="contact-card">
                    <div class="contact-icon" style="background-color: rgba(255, 166, 48, 0.1);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="#FFA630" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 6L12 13L2 6" stroke="#FFA630" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3>Почта</h3>
                    <p>info@reklem.ru</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Manager Section -->
    <section class="manager-section">
        <div class="wrapper">
            <div class="manager-container">
                <div class="manager-photo">
                    <img src="@/assets/img/contacts/photo.svg" alt="Менеджер по работе с клиентами">
                </div>
                <div class="manager-info">
                    <h2>Попович Андрей Александрович</h2>
                    <p class="manager-position">Менеджер по работе с клиентами г. Москва</p>

                    <div class="manager-contacts">
                        <div class="contact-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 16.92V19.92C22 20.47 21.55 20.92 21 20.92H19.92C10.38 20.92 3.07996 13.62 3.07996 4.08V3C3.07996 2.45 3.52996 2 4.07996 2H7.07996C7.62996 2 8.07996 2.45 8.07996 3V4.92C8.07996 5.47 7.62996 5.92 7.07996 5.92H5.31996C5.99996 10.31 9.68996 14 14.08 14.68V12.92C14.08 12.37 14.53 11.92 15.08 11.92H17.08C17.63 11.92 18.08 12.37 18.08 12.92V15.92C18.08 16.47 17.63 16.92 17.08 16.92H15.08" stroke="#007B5E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>+7 (925) 272-87-48</span>
                        </div>
                        <div class="contact-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="#007B5E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22 6L12 13L2 6" stroke="#007B5E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>man7@reklem.ru</span>
                        </div>
                    </div>
                </div>
                <div class="work-hours">
                    <h3>Часы работы</h3>
                    <div class="hours-item">
                        <span>Пн-Пт:</span>
                        <span class="hours-time">09:30 - 18:00</span>
                    </div>
                    <div class="hours-item">
                        <span>Сб-Вс:</span>
                        <span class="hours-time">Выходной</span>
                    </div>
                    <div class="social-links">
                        <a v-for="(button, index) in buttons" :key="index" :href="button.link" target="_blank" class="social-link">
                            <img :src="button.icon" :alt="button.alt" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="wrapper">
            <div class="map-container">
                <img src="@/assets/img/contacts/map.svg" alt="Карта расположения офиса">
            </div>
        </div>
    </section>
</template>

<script>
import PageBanner from '@/Components/PageBanner.vue';
import {Head} from "@inertiajs/vue3";

export default {
    name: "ContactsPage",
    components: {Head, PageBanner },
    data() {
        return {
            buttons: [
                {
                    icon: new URL('@/assets/img/contacts/youtube.svg', import.meta.url).href,
                    alt: "YouTube",
                    link: "https://youtube.com",
                },
                {
                    icon: new URL('@/assets/img/contacts/telegram.svg', import.meta.url).href,
                    alt: "Telegram",
                    link: "https://t.me/reklempub",
                },
                {
                    icon: new URL('@/assets/img/contacts/whatsapp.svg', import.meta.url).href,
                    alt: "WhatsApp",
                    link: "https://whatsapp.com",
                },
            ],
        };
    }
};
</script>

<style scoped>
/* Base Styles */
:root {
    --primary: #007b5e;
    --primary-light: #00997a;
    --accent: #FFA630;
    --light-bg: #f2f2f2;
    --dark-text: #1a1a1a;
    --light-text: #ffffff;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    color: var(--dark-text);
    line-height: 1.6;
}

.wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

h1, h2, h3 {
    font-weight: 700;
    line-height: 1.2;
}

/* Contact Section */
.contact-section {
    padding: 80px 0;
    background-color: white;
}

.contact-header {
    text-align: center;
    margin-bottom: 60px;
}

.contact-header h1 {
    font-size: 2.5rem;
    color: var(--primary);
    margin-bottom: 20px;
}

.contact-description {
    font-size: 1.125rem;
    color: var(--primary-light);
    max-width: 600px;
    margin: 0 auto;
}

.contact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
}

.contact-card {
    background: white;
    border-radius: 12px;
    padding: 40px 30px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    text-align: center;
    transition: transform 0.3s ease;
}

.contact-card:hover {
    transform: translateY(-5px);
}

.contact-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}

.contact-card h3 {
    font-size: 1.25rem;
    color: var(--primary);
    margin-bottom: 15px;
}

.contact-card p {
    color: #555;
    line-height: 1.7;
}

/* Manager Section */
.manager-section {
    padding: 80px 0;
    background-color: var(--light-bg);
}

.manager-container {
    display: grid;
    grid-template-columns: auto 1fr auto;
    gap: 40px;
    align-items: center;
    background: white;
    border-radius: 12px;
    padding: 40px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
}

.manager-photo img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--accent);
}

.manager-info h2 {
    font-size: 1.5rem;
    color: var(--primary);
    margin-bottom: 10px;
}

.manager-position {
    color: var(--primary-light);
    margin-bottom: 20px;
}

.manager-contacts {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--dark-text);
}

.work-hours {
    text-align: center;
}

.work-hours h3 {
    color: var(--primary);
    margin-bottom: 20px;
}

.hours-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.hours-time {
    color: var(--primary-light);
    font-weight: 600;
}

.social-links {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 30px;
}

.social-link img {
    width: 40px;
    height: 40px;
    transition: transform 0.3s ease;
}

.social-link:hover img {
    transform: scale(1.1);
}

/* Map Section */
.map-section {
    padding: 0 0 80px;
}

.map-container {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.map-container img {
    width: 100%;
    height: auto;
    display: block;
}

/* Responsive Styles */
@media (max-width: 992px) {
    .manager-container {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .manager-contacts {
        align-items: center;
    }

    .contact-item {
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .contact-header h1 {
        font-size: 2rem;
    }

    .contact-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .contact-section,
    .manager-section {
        padding: 60px 0;
    }

    .manager-container {
        padding: 30px 20px;
    }

    .manager-info h2 {
        font-size: 1.25rem;
    }
}
</style>
