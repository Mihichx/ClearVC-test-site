<?php

/**
 * Карта маршрутов приложения (Роутинг).
 * 
 * Каждый элемент массива представляет собой отдельный маршрут:
 * [0] string - URL-адрес (например, '/' или '/docs') или '*' для динамических модулей
 * [1] string - Обработчик в формате 'ИмяКонтроллера@метод' или специальный флаг
 * [2] string - HTTP-метод (GET, POST). По умолчанию: GET
 *
 * @var array<int, array<int, string>>
 */
return [
    ['/docs', 'PageController@docs'],
    ['/routes', 'PageController@routes'],
    ['/', 'HomeController@index'],
    ['/', 'HomeController@store', 'POST'],
    ['/', 'HomeController@store1', 'POST'],
    ['/about', 'AboutController@about'],
    ['/catalog', 'CatalogController@catalog'],
    ['/catalog', 'BasketController@store', 'POST'],
    ['/reviews', 'ReviewsController@reviews'],
    ['/contact', 'ContactController@contact'],
    ['/stock', 'StockController@stock'],
    ['/basket', 'BasketController@basket'],
    ['/basket', 'BasketController@destroy', 'POST'],
    ['/profile', 'ProfileController@deleteIMG', 'POST'],
    ['/profile', 'ProfileController@profile'],
    ['/login', 'ProfileController@login'],
    ['/login', 'ProfileController@index', 'POST'],
    ['/register', 'ProfileController@register'],
    ['/register', 'ProfileController@store', 'POST'],
    ['/admin', 'AdminController@admin'],
    ['/img', 'ImgController@img'],
    ['/img', 'ImgController@img', 'POST'],
    ['/q', 'qController@q'],
    ['/q', 'qController@w', 'POST'],
    ['/q', 'qController@e', 'POST'],
    ['*', 'DYNAMIC_MODULES_FALLBACK'],
    ['*', 'DYNAMIC_MODULES_FALLBACK', 'POST'],
];
