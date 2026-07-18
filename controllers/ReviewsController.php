<?php

namespace App\Controllers;

use Core\Controller;

class ReviewsController extends Controller
{
    public function reviews()
    {
        $this->render('reviews', [
            'title' => 'Отзывы',
        ]);
    }
}
