<?php
class SessionController extends Controller {

    private $userSession;
    private $correo;
    private $idUser;

    private $session;
    private $sites;
    private $defaultSites;

    private $user;

    public function __construct() {
        parent::__construct();

        $this->init();
    }

    public function init() {
        $this->session = new Session();

        $json = $this->getJsonFileConfig();

        $this->sites = $json['sites'];
        $this->defaultSites = $json['default-sites'];

        $this->validateSession();
    }

    private function getJsonFileConfig() {
        $string = file_get_contents('config/access.json');
        $json = json_decode($string, true);

        return $json;
    }

    public function validateSession() {
        if ($this->existsSession()) {
            $rol = $this->getUserSessionData()->getRol();

            //si la pagina es publica
            if ($this->isPublic()) {
                $this->redirectDefaultSiteByRol($rol);
            } else {
                if ($this->isAuthorized($rol)) {
                    
                } else {
                    $this->redirectDefaultSiteByRol($rol);
                }
            }
        } else {
            //no existe la sesion
            if ($this->isPublic()) {
                //no pasa nada lo deja entrar
            } else {
                header('location:' . constant('URL') . '');
            }
        }
    }

    public function existsSession() {
        if ($this->session->exists()) {
            return false;
        }

        if ($this->session->getCurrentUser() == null) {
            return false;
        }

        $idUser = $this->session->getCurrentUser();

        if ($idUser) {
            return true;
        }

        return false;
    }

    public function getUserSessionData() {
        $idUser = $this->idUser;
        $this->user = new UserModel;
        $this->user->getById($idUser);

        return $this->user;
    }

    function isPublic() {
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace("/\?.*/", "", $currentURL);

        for ($i = 0; $i < sizeof($this->sites); $i++) {
            if ($currentURL == $this->sites[$i]['site'] && $this->sites[$i]['access'] == 'public') {
                return true;
            }
        }

        return false;
    }

    public function getCurrentPage() {
        $actualLink = trim($_SERVER['REQUEST_URI']);
        $url = explode('/', $actualLink);

        return $url[2];
    }

    private function redirectDefaultSiteByRol($rol) {
        $url = '';
        for ($i = 0; $i < sizeof($this->sites); $i++) {
            if ($this->sites[$i]['rol'] == $rol) {
                $url = '/TFC/' . $this->sites[$i]['site'];
                break;
            }
        }
        header('location:' . constant('URL') . $url);
    }

    private function isAuthorized($rol) {
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace("/\?.*/", "", $currentURL);

        for ($i = 0; $i < sizeof($this->sites); $i++) {
            if ($currentURL == $this->sites[$i]['site'] && $this->sites[$i]['rol'] == $rol) {
                return true;
            }
        }

        return false;
    }

    public function initialize($user) {
        $this->session->setCurrentUser($user->getIdUser());
        $this->authorizedAccess($user->getRol());
    }

    public function authorizedAccess($rol) {
        switch ($rol) {
            case 'user':
                $this->redirect($this->defaultSites['user'], []);
                break;
            case 'admin':
                $this->redirect($this->defaultSites['admin'], []);
                break;
        }
    }

    public function logOut() {
        $this->session->closeSession();
    }
}
