<?php

namespace App\Controllers;

use Core\Controller;

class StockController extends Controller
{
    public function stock()
    {
        $this->render('stock', [
            'title' => 'Акции',
        ]);
    }
}
