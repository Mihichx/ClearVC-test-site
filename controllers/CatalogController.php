<?php

namespace App\Controllers;

use Core\Controller;
use PDO;

class CatalogController extends Controller
{
    public function catalog()
    {
        // --- 1. Базовая часть SQL-запроса ---
        $baseQuery = " FROM items INNER JOIN category ON items.category_id = category.id";
        $where = "";
        $params = [];

        // Фильтрация (Поиск)
        if (!empty($_GET['search'])) {
            $search = $_GET['search'];
            $where .= " WHERE items.title LIKE :search";
            $params['search'] = "%$search%";
        }

        // --- 2. Подсчет общего количества товаров (для пагинации) ---
        $countStmt = $this->db->prepare("SELECT COUNT(*) " . $baseQuery . $where);
        $countStmt->execute($params);
        $total_elements = (int)$countStmt->fetchColumn();

        // --- 3. Настройки пагинации ---
        $limit = 2; 
        $total_pages = ceil($total_elements / $limit);
        if ($total_pages < 1) $total_pages = 1;

        // Текущая страница
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($current_page < 1) $current_page = 1;
        if ($current_page > $total_pages) $current_page = $total_pages;

        // Вычисление смещения
        $offset = ($current_page - 1) * $limit;

        // --- 4. Получение отфильтрованных и ограниченных данных ---
        $dataQuery = "SELECT items.id, items.title AS product_name, items.price, category.name AS category_name" . $baseQuery . $where;

        // Сортировка
        if (!empty($_GET['sort']) && in_array(strtolower($_GET['sort']), ['asc', 'desc'])) {
            $sort = $_GET['sort'];
            $dataQuery .= " ORDER BY items.price $sort";
        }

        // Добавляем LIMIT и OFFSET напрямую в SQL (для производительности)
        $dataQuery .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($dataQuery);
        
        // Привязываем параметры фильтрации
        foreach ($params as $key => $val) {
            $stmt->bindValue(':' . $key, $val);
        }
        // Важно: для LIMIT и OFFSET нужно явно указать тип PARAM_INT
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        $products = $stmt->fetchAll();

        // --- 5. Передача данных во вью ---
        $this->render('catalog', [
            'title'        => 'Товары',
            'products'     => $products,
            'current_page' => $current_page,
            'total_pages'  => $total_pages
        ]);
    }
}
