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
          ['name' => 'data', 'url' => '/dashboard/data', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'data crear', 'url' => '/dashboard/data/create', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'data historial', 'url' => '/dashboard/data/history', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'metas crear', 'url' => '/dashboard/metas/create', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'metas historial', 'url' => '/dashboard/metas', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
      ];

      return $menu;
    }
}