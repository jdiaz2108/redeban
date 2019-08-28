<?php

namespace App\Helpers;

class GlobalApp
{
    public static function menu()
    {
      $menu = [
          ['name' => 'Inicio', 'url' => '/update-data', 'current' => 'home' , 'icon' => 'dashboard', 'roles' => ['admin','user']],
          ['name' => 'catalogo', 'url' => '/prizes', 'current' => 'campana.index' , 'icon' => 'add_box', 'roles' => ['user']],
          ['name' => 'premios', 'url' => '/dashboard/prizes', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
      ];

      return $menu;
    }
}