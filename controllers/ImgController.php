<?php

namespace App\Controllers;

use Core\Controller;
use Core\Helpers\Image;

class ImgController extends Controller
{
    public function img()
    {   
        $status = Image::load($this->db);

        $this->render('img', [
            'title' => 'img',
            'error' => $status
        ]);
    }
}
