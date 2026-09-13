<?php

/**
 * Карта маршрутов приложения (Роутинг).
 * 
 * Каждый элемент массива представляет собой отдельный маршрут:
 * [0] string - URL-адрес (например, '/' или '/docs') или '*' для динамических модулей
 * [1] string - Обработчик в формате 'ИмяКонтроллера@метод' или специальный флаг
 * [2] string - HTTP-метод (GET, POST).
 *
 * @var array<int, array<int, string>>
 */
return [
    // Документация и страницы
    ['/docs', 'PageController@docs', 'GET'],
    ['/routes', 'PageController@routes', 'GET'],
    
    // Главная страница
    ['/', 'HomeController@index', 'GET'],
    ['/', 'HomeController@store', 'POST'],
    ['/', 'HomeController@store1', 'POST'],
    
    // Информационные страницы
    ['/about', 'AboutController@about', 'GET'],
    ['/reviews', 'ReviewsController@reviews', 'GET'],
    ['/contact', 'ContactController@contact', 'GET'],
    ['/stock', 'StockController@stock', 'GET'],
    
    // Каталог и корзина
    ['/catalog', 'CatalogController@catalog', 'GET'],
    ['/catalog', 'BasketController@store', 'POST'],
    ['/basket', 'BasketController@basket', 'GET'],
    ['/basket', 'BasketController@destroy', 'POST'],
    
    // Профиль и авторизация
    ['/profile', 'ProfileController@profile', 'GET'],
    ['/profile', 'ProfileController@deleteIMG', 'POST'],
    ['/login', 'ProfileController@login', 'GET'],
    ['/login', 'ProfileController@index', 'POST'],
    ['/register', 'ProfileController@register', 'GET'],
    ['/register', 'ProfileController@store', 'POST'],
    
    // Админ-панель
    ['/admin', 'AdminController@admin', 'GET'],
    
    // Работа с изображениями
    ['/img', 'ImgController@img', 'GET'],
    ['/img', 'ImgController@img', 'POST'],
    
    // Тестовые роуты (Q)
    ['/q', 'qController@q', 'GET'],
    ['/q', 'qController@w', 'POST'],
    ['/q', 'qController@e', 'POST'],
    
    // Динамический fallback (маска '*')
    ['*', 'DYNAMIC_MODULES_FALLBACK', 'GET'],
    ['*', 'DYNAMIC_MODULES_FALLBACK', 'POST'],
];
