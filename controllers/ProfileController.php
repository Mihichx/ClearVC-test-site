<?php

namespace App\Controllers;

use Core\Controller;
use Core\Helpers\Image;

class ProfileController extends Controller
{   
    public function auth($stmt)
    {
        $_SESSION['user'] = [
            'id'    => $stmt['id'],
            'login' => $stmt['login'],
            'role' => $stmt['role'],
            'basket'=> []
        ];
    }

    public function logout($stmt)
    {
        $_SESSION['user'] = [
            'id'    => $stmt[0]['id'],
            'login' => $stmt[0]['login'],
            'role' => $stmt[0]['role'],
            'basket'=> []
        ];
    }

    public function profile()
    {
        if (empty($_SESSION['user'])) { header('Location: /login'); }
        
        $this->recoveryIMG($this->db);

        //unset($_SESSION['user']);

        $this->render('profile', [
            'title' => 'Профиль',
            'avatar_path' => Image::unload($this->db) ?? ''
        ]);
    }

    public function login()
    {
        if (!empty($_SESSION['user'])) { header('Location: /profile'); }

        $this->render('login', [
            'title' => 'Вход'
        ]);
    }

    public function register()
    {
        $this->render('register', [
            'title' => 'Регистрация',
        ]);
    }

    public function index()
    {
        if (empty($_POST['name'])) { 
            $_SESSION['error'] = 'Введите имя';
            header('Location: /login');
            exit;
        }

        if (empty($_POST['password'])) { 
            $_SESSION['error'] = 'Введите пароль';
            header('Location: /login');
            exit;
        }

        $name = $_POST['name'];
        
        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `login` = ?");
        $stmt->execute([$name]);
        $stmt = $stmt->fetch();

        if ($stmt) {
            $password = $_POST['password'];
            $hashPassword = $stmt['password'];

            if (password_verify($password, $hashPassword)) {
                $this->auth($stmt);
                unset($_SESSION['error']);
                header('Location: /profile');
                exit;
            } else {
                $_SESSION['error'] = 'Неправильный пароль или логин';
                header('Location: /login');
                exit;
            }
        } else {
            $_SESSION['error'] = 'Неправильный пароль или логин';
            header('Location: /login');
            exit;
        }
    }

    public function store()
    {
         if (empty($_POST['name'])) { 
            $_SESSION['error'] = 'Введите имя';
            header('Location: /register');
            exit;
        }
        
        if (empty($_POST['password'])) { 
            $_SESSION['error'] = 'Введите пароль';
            header('Location: /register');
            exit;
        }

        if (empty($_POST['password1'])) { 
            $_SESSION['error'] = 'Введите повторно пароль';
            header('Location: /register');
            exit;
        }

        if (mb_strlen($_POST['name'], 'UTF-8') < 4) { 
            $_SESSION['error'] = 'Имя должно быть больше 4 символов';
            header('Location: /register');
            exit;
        }

        $name = $_POST['name'];
        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `login` = ?");
        $stmt->execute([$name]);
        $stmt = $stmt->fetch();

        if ($stmt) { 
            $_SESSION['error'] = 'Логин занят';
            header('Location: /register');
            exit;
        }

        if ($_POST['password'] != $_POST['password1']) { 
            $_SESSION['error'] = 'Пароли разные';
            header('Location: /register');
            exit;
        }

        $password = $_POST['password'];
        
        $stmt1 = $this->db->prepare("INSERT INTO `users`(`login`, `password`, `role_id`) VALUES (?, ?, ?)");
        $stmt1->execute([$name, password_hash($password, PASSWORD_DEFAULT), 1]);

        $name = $_POST['name'];
        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `login` = ?");
        $stmt->execute([$name]);
        $stmt = $stmt->fetch();

        $this->auth($stmt);

        unset($_SESSION['error']);
        header('Location: /profile');
        exit;
    }

    public function deleteIMG() 
    {
        Image::delete($this->db);

        header('Location: /profile');
        exit;
    }

    public function recoveryIMG() 
    {
        $user_id = $_SESSION['user']['id'];
        $user_name = $_SESSION['user']['login'];
        $white_extension = ['jpg', 'png'];
        $uploadDir = 'assets/img/avatar/';

        $stmt = $this->db->prepare("SELECT COUNT(*) FROM `avatar` WHERE `user_id` = ?");
        $stmt->execute([$user_id]);
        $existsInDB = $stmt->fetchColumn() > 0;

        // Если в базе данных запись есть, то всё хорошо, ничего делать не нужно
        if ($existsInDB) {
            return;
        }

        foreach ($white_extension as $ext) {
            $fileName = $user_name . '.' . $ext;
            $filePath = $uploadDir . $fileName;

            // Если физический файл найден на диске!
            if (file_exists($filePath)) {
                // Автоматически восстанавливаем запись в БД
                $stmt = $this->db->prepare("INSERT INTO `avatar` (`user_id`, `name`) VALUES (?, ?)");
                $stmt->execute([$user_id, $fileName]);

                break; 
            }
        }
    }
}
