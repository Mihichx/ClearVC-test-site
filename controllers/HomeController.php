<?

namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $stmt = $this->db->query("SELECT * FROM stock");
        $stock = $stmt->fetchAll();

        $stmt = $this->db->query("SELECT * FROM about");
        $about = $stmt->fetchAll();

        $stmt = $this->db->query("SELECT * FROM items WHERE popular = 1");
        $items = $stmt->fetchAll();

        $stmt = $this->db->query("SELECT * FROM items WHERE new = 1");
        $items1 = $stmt->fetchAll();

        $stmt = $this->db->query("SELECT * FROM reviews WHERE agreed = 1 ORDER BY `reviews`.`id` DESC LIMIT 3");
        $reviews = $stmt->fetchAll();
        
        $this->render('home', [
            'title' => 'Главная',
            'stock' => $stock,
            'about' => $about,
            'items' => $items,
            'items1' => $items1,
            'reviews' => $reviews,
        ]);
    }

    public function store() {
        if (!empty($_POST['name']) && !empty($_POST['number'])) {
            $name = $_POST['name'];
            $number = $_POST['number'];
            
            $stmt = $this->db->prepare("INSERT INTO `help`(`name`, `number`) VALUES (?, ?)");
            $stmt->execute([$name, $number]);

            header('Location: /');
            exit;
        } else {
            header('Location: /');
            exit;
        }
    }

    public function store1() {
        if (!empty($_POST['id_product'])) {
            $id_product = $_POST['id_product'];
            
            $stmt = $this->db->prepare("INSERT INTO `help`(`name`, `number`) VALUES (?, ?)");
            $stmt->execute([$name, $number]);

            header('Location: /');
            exit;
        } else {
            header('Location: /');
            exit;
        }
    }
}
