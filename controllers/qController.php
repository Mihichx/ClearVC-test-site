<?php

namespace App\Controllers;

use Core\Controller;

class qController extends Controller
{   
    public function q()
    {
        $this->render('q', [
            'title' => 'q',
        ]);
    }

    public function w()
    {
        echo 1;
        $this->img();
        exit;
    }

    public function e()
    {
        echo 2;
    }
}
