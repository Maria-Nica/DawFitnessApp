<?php

// /app/Controllers/CoreController.php

// NOTa: Daca folositi o clasa de baza (BaseController) care gestioneaza includerea View-urilor,
// ati mosteni acea clasa. Deocamdata, vom include View-ul direct.

class CoreController {

    /**
     * Metoda implicita (default) pentru a afisa pagina principala (Home).
     * Aceasta este asociata rutei GET '/'.
     */
    public function index() {

        // 1. Logica Model: De obicei, aici ati apela un Model pentru a prelua date
        // (ex: lista de clase de fitness, stiri, etc.), dar pentru pagina Home,
        // s-ar putea sa nu fie necesara nicio logica.
        // $classes = $this->classModel->getAllClasses();

        // 2. incarcarea View-ului: Controller-ul include View-ul corect

        // Calea catre View-ul principal.
        // Asigura-te ca PATH-ul este corect fata de locatia acestui Controller.
        $viewPath = __DIR__ . '/../views/home.php';

        if (file_exists($viewPath)) {
            // Daca ati avea date de la Model ($classes), le-ati putea trece aici
            // prin intermediul unui "renderer" sau prin definirea unor variabile locale.

            // ATENtIE: View-ul index.php va avea acces la variabilele de sesiune,
            // deoarece acestea sunt gestionate in Front Controller sau in CoreController.

            require_once $viewPath;

        } else {
            // View-ul nu a fost gasit
            http_response_code(500);
            echo "Error 500: Primary view file not found.";
        }
    }

    /**
     * Metoda optionala pentru a afisa View-uri statice simple (ex: About, Contact).
     * @param string $page Numele fisierului View (ex: 'about.php')
     */
    public function show($page) {
        $viewPath = __DIR__ . '/../../views/' . $page . '.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            // Daca pagina nu exista, afiseaza 404
            http_response_code(404);
            // Puteti include un View 404 dedicat aici
            echo "404 Not Found.";
        }
    }

    /**
     * Afiseaza pagina cu retete
     */
    public function retete() {
        $viewPath = __DIR__ . '/../views/retete.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            http_response_code(500);
            echo "Error 500: Retete view file not found.";
        }
    }

    /**
     * Afiseaza pagina cu antrenamente
     */
    public function antrenamente() {
        $viewPath = __DIR__ . '/../views/antrenamente.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            http_response_code(500);
            echo "Error 500: Antrenamente view file not found.";
        }
    }

    /**
     * Afiseaza pagina cu orar
     */
    public function orar() {
        $viewPath = __DIR__ . '/../views/orar.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            http_response_code(500);
            echo "Error 500: Orar view file not found.";
        }
    }
}