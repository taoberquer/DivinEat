<?php

namespace App\Controllers\Admin;

use App\Core\Controller\Controller;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\View;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $configTableMenu = Menu::getShowMenuTable();
        $myView = new View("admin.menu.index", "admin");
        $myView->assign("configTableMenu", $configTableMenu);
    }

    public function create(Request $request, Response $response)
    {
        $configFormMenu = Menu::getAddMenuForm();

        $myView = new View("admin.menu.create", "admin");
        $myView->assign("configFormMenu", $configFormMenu);
    }

    public function store(Request $request, Response $response)
    {
        echo 'store';
    }

    public function show(Request $request, Response $response, array $args)
    {
        echo 'show';
    }

    public function edit(Request $request, Response $response, array $args)
    {
        $configFormMenu = Menu::getAddMenuForm();

        $myView = new View("admin.menu.edit", "admin");
        $myView->assign("configFormMenu", $configFormMenu);
    }

    public function update(Request $request, Response $response, array $args)
    {
        echo 'update';
    }

    public function destroy(Request $request, Response $response, array $args)
    {
        echo 'destroy';
    }
}