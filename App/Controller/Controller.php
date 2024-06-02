<?php 

namespace App\Controller;

class Controller 
{
    public function route(): void 
    {
        try 
        {
            if (isset($_GET['controller']))
            {
                switch ($_GET['controller'])
                {
                    case 'home':
                        $controller = new PageController();
                        $controller->route();
                        break;
                    case 'services':
                        $controller = new ServiceController();
                        $controller->route();
                        break;
                    case 'insectes':
                        $controller = new InsecteController();
                        $controller->route();
                        break;
                    case 'contact':
                        $controller = new ContactController();
                        $controller->route();
                        break;
                    case 'devis':
                        $controller = new DevisController();
                        $controller->route();
                        break;
                    default:
                        throw new \Exception("Le controleur n'existe pas");
                        break;
                }
            } else {
                $controller = new PageController();
                $controller->home();
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
    
    protected function render(string $path, array $params = []): void
    {
        $filePath = _ROOTPATH_ . '/templates/' . $path . '.php';

        try {
            if (!file_exists($filePath)) {
                throw new \Exception("Fichier non trouvé : " . $filePath);
            } else {
                // Extrait chaque ligne du tableau et crée des variables pour chacune
                extract($params);
                require_once $filePath;
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }


}