<?php
namespace App\Managers;

use App\Core\Manager;
use App\Models\User;

class MenuManager extends Manager {
    
    public function __construct(){
        parent::__construct(Menu::class, 'menus');
    }
}