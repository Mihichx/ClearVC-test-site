<?php

namespace App\Controllers;

use Core\Controller;

class BasketController extends Controller
{
    public function basket()
    {
        $stmt = $this->db->query("SELECT 
            items.id,
            items.title AS product_name, 
            items.price,
            category.name AS category_name
            FROM items
            INNER JOIN category ON items.category_id = category.id
        ");
        $products = $stmt->fetchAll();

        if (empty($_SESSION['basket'])) {
            $content1 = "<h2 class='text-center mt-5'>Корзина пуста</h2>";
        } else {
            $content = "";
            $sum = 0;
            foreach ($_SESSION['basket'] as $id => $quantity) {
                $sum += $products[$id-1]['price'] * $quantity;
                $content .= "
                    <div class='col-4 text-white'>
                        <div class='bg-dark p-5 rounded'>
                            <form method='POST'>
                                <input name='delate' type='hidden' value='{$id}'>
                                <h3>{$products[$id-1]['product_name']}</h3>
                                <h5 class='text-white-50'>{$products[$id-1]['category_name']}</h5>
                                <h5 class='text-white-50'>Кол-во. {$quantity}</h5>
                                <h5>{$products[$id-1]['price']} руб.</h5>
                                <button type='submit'>Удалить</button>
                            </form>
                        </div>
                    </div>
                ";
            }
            if ($sum > 0) $sum = "<h2 class='text-center mt-5'>Общая стоимость корзины: {$sum} руб.</h2>";
            else $sum = '';
        }
        

        $this->render('basket', [
            'title' => 'Корзина',
            'products' => $products,
            'content1' => $content1 ?? '',
            'content' => $content ?? '',
            'sum' => $sum ?? ''
        ]);
    }

    public function store()
    {
        global $connect;

        if (!empty($_POST['id_product'])) {
            $product_id = $_POST['id_product'];

            if (isset($_SESSION['basket'][$product_id])) {
                $_SESSION['basket'][$product_id]++;
            } else {
                $_SESSION['basket'][$product_id] = 1;
            }

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function destroy()
    {
        global $connect;

        if (!empty($_POST['delate'])) {
            $product_id = $_POST['delate'];

            if (isset($_SESSION['basket'][$product_id])) {
                $_SESSION['basket'][$product_id]--;

                if ($_SESSION['basket'][$product_id] == 0) unset($_SESSION['basket'][$product_id]);
            }

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
}
