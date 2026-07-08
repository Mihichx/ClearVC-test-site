<?

namespace App\Controllers;

use Core\Controller;

class AboutController extends Controller
{
    public function about()
    {
        $this->render('about', [
            'title' => 'О нас'
        ]);
    }
}
