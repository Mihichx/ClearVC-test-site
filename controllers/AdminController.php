<?

namespace App\Controllers;

use Core\Controller;

class AdminController extends Controller
{
    public function admin()
    {
        if ($_SESSION['user']['role'] != 'admin') header('Location: /');

        $this->render('admin', [
            'title' => 'Админка',
        ]);
    }
}
