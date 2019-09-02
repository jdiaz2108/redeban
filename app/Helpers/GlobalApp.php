<?php

namespace App\Helpers;

class GlobalApp
{
    public static function menu()
    {
      $menu = [
          // Menu with multiple roles 
          ['name' => 'Inicio', 'url' => '/', 'current' => 'home' , 'icon' => 'dashboard', 'roles' => ['admin','user']],
          
          // Menu just for user
          ['name' => 'Actualizar datos', 'url' => '/update-data', 'current' => 'home' , 'icon' => 'dashboard', 'roles' => ['user']],
          ['name' => 'catalogo', 'url' => '/prizes', 'current' => 'campana.index' , 'icon' => 'add_box', 'roles' => ['user']],
          ['name' => 'historial puntos', 'url' => '/points', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['user']],
          
          // Menu just for admin
          ['name' => 'premios', 'url' => '/dashboard/prizes', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'usuarios', 'url' => '/dashboard/users', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'metas crear', 'url' => '/dashboard/fulfillments/create', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'metas historial', 'url' => '/dashboard/fulfillments', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
      ];

      return $menu;
    }
}