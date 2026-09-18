<?php

/** 
 * Главный шаблон (Layout) сайта.
 * 
 * @var string $content HTML-код конкретной страницы (View)
 * @var array|null $auth_user Массив с данными авторизованного пользователя из сессии
 * @var string|null $title Заголовок страницы (если передан из контроллера)
 */
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Нет названия') ?></title>

    <!--ICON-->
    <link rel="icon" type="image/png" href="/assets/img/ClearVC.svg">

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">

    <!--FontAwesome-->
    <link rel="stylesheet" href="/assets/fontAwesome/css/all.css">

    <!--CSS-->
    <link rel="stylesheet" href="/assets/css/style.css">

    <!--JS общий для всех страниц-->
    <script defer src="/assets/js/script.js"></script>

    <!--Bootstrap JS-->
    <script defer src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- js рендера (подставляется отдельно для каждой страницы) -->
    <?php if (!empty($js)):
        $jsFiles = array_filter(array_map('trim', explode(',', $js)));
        foreach ($jsFiles as $jsItem): ?>
            <script defer src="/assets/js/<?= htmlspecialchars($jsItem, ENT_QUOTES, 'UTF-8') ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php $search = $_SERVER['REQUEST_URI']; ?>
</head>

<body>
    <header>
        <div class="bg-dark">
            <nav class="d-flex align-items-center justify-content-center p-5 flex-wrap">
                <a href="/" class="nav-link text-white hover">ДЕКОР ДЛЯ ДОМА</a>
                <a href="/about" class="nav-link text-white hover <?= ($search == '/about') ? 'active1' : '' ?>">О нас</a>
                <a href="/catalog" class="nav-link text-white hover <?= ($search == '/catalog') ? 'active1' : '' ?>">Каталог</a>
                <a href="/reviews" class="nav-link text-white hover  <?= ($search == '/reviews') ? 'active1' : '' ?>">Отзывы</a>
                <a href="/contact" class="nav-link text-white hover <?= ($search == '/contact') ? 'active1' : '' ?>">Контакты</a>
                <a href="/stock" class="nav-link text-white hover <?= ($search == '/stock') ? 'active1' : '' ?>">Акции</a>
                <a href="/basket" class="nav-link text-white hover <?= ($search == '/basket') ? 'active1' : '' ?>"><i class="fas fa-shopping-basket text-white me-2"></i>Козина</a>
                <a href="/login" class="nav-link text-white hover <?= ($search == '/profile' || $search == '/login' || $search == '/register') ? 'active1' : '' ?>"><i class="fas fa-user text-white me-2"></i>Личный кабинет</a>
            </nav>
        </div>
    </header>

    <main>
        <?= $content ?>
    </main>

    <footer class="d-flex align-items-center justify-content-center bg-dark p-5 flex-column">
        <p class="text-white-50 fs-6 m-0 mb-2">Декор для дома</p>
        <p class="text-white-50 fs-6 m-0 mb-3">@Все права защищены</p>
        <div>
            <a href="https://vk.com" target="_blank"><i class="fab fa-vk text-white fs-2 hover"></i></a>
            <a href="https://telegram.com" target="_blank"><i class="fab fa-telegram text-white fs-2 hover"></i></a>
            <a href="https://youtube.com" target="_blank"><i class="fab fa-youtube text-white fs-2 hover"></i></a>
        </div>
        <p class="text-white-50 fs-6 m-0 mt-4">Powered by ClearVC <?= \Core\Controller::VERSION ?>-dev</p>
    </footer>
</body>

</html>
