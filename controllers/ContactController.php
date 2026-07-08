<?

namespace App\Controllers;

use Core\Controller;

class ContactController extends Controller
{
    public function contact()
    {
        $this->render('contact', [
            'title' => 'Контакты',
        ]);
    }
}
