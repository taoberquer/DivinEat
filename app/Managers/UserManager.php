<?php
namespace App\Managers;

use App\Core\Manager;
use App\Models\User;

class UserManager extends Manager {
    
    public function __construct(){
        parent::__construct(User::class, 'users');
    }
}