<?php
class Dashboard extends SessionController {
    public function __construct() {
        parent::__construct();
    }

    public function render() {
        $this->view->render('dashboard/index');
    }

    public function getFichajes() {
        
    }

    
}
