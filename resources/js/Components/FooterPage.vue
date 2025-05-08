<template>
  <!-- Блок подвала -->
  <footer>
    <section class="wrapper">
      <!-- Контейнер для содержимого подвала -->
      <div class="footer-container">

        <!-- Логотип -->
        <div class="footer-logo">
          <img src="@/assets/img/footer/logo.svg" alt="Reklem" class="logo-img">
        </div>

        <!-- Ссылки подвала -->
        <div class="footer-links">

          <!-- Колонка "Компания" -->
          <div class="footer-column">
            <h4>Компания</h4>
            <ul>
              <li><Link href="/contacts">Контакты</Link></li>
              <li><Link href="#">Доставка и оплата</Link></li>
              <li><Link href="#">Обмен и возврат</Link></li>
            </ul>
          </div>

          <!-- Колонка "Клиентам" -->
          <div class="footer-column">
            <h4>Клиентам</h4>
            <ul>
              <li><Link href="/dashboard">Личный кабинет</Link></li>
              <li><Link href="#">Партнерство</Link></li>
              <li><Link href="#">Гарантия</Link></li>
            </ul>
          </div>

          <!-- Колонка "Политика" -->
          <div class="footer-column">
            <h4>Политика</h4>
            <ul>
              <li><Link href="#">Обработка данных</Link></li>
              <li>
                <img src="@/assets/img/footer/copyright.svg" alt="Copyright">
              </li>
            </ul>
          </div>

        </div>
      </div>
    </section>
  </footer>
</template>

<script>
import { Link } from '@inertiajs/vue3'; // ← ВАЖНО: импорт компонента Link
export default {
  // Название компонента
  name: "FooterPage",
  components: {
      Link,
  },
};
</script>

<style scoped>

footer {
    background-color: #f9f9f9;
    padding: 60px 20px 40px;
    font-family: regular,Inter,serif;
    color: #2e2e2e;
}

.footer-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 40px;
    max-width: 1200px;
    margin: 0 auto;
    align-items: flex-start;
}

.footer-logo {
    text-align: center;
}

.logo-img {
    max-width: 140px;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

.footer-links {
    display: contents;
}

/* Колонки */
.footer-column h4 {
    font-size: 16px;
    margin-bottom: 14px;
    font-weight: 600;
    color: #007b5e;
}

.footer-column ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-column ul li {
    margin-bottom: 10px;
}

.footer-column ul li a {
    font-size: 14px;
    text-decoration: none;
    color: #444;
    transition: color 0.3s ease, transform 0.3s ease;
    display: inline-block;
}

.footer-column ul li a:hover {
    color: #00997a;
    transform: translateX(3px);
}

/* Иконка внизу */
.footer-column ul li img {
    margin-top: 8px;
}

/* Адаптив */
@media (max-width: 768px) {
    .footer-container {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .footer-logo {
        margin-bottom: 30px;
    }

    .footer-column h4 {
        color: #00997a;
    }
}

</style>
