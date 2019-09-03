<?php

namespace App\Helpers;

class GlobalApp
{
    public static function menu()
    {
      $menu = [
          // Menu for user
          ['name' => 'Inicio', 'url' => '/', 'current' => 'home' , 'icon' => 'dashboard', 'roles' => ['user']],
          ['name' => 'Actualizar datos', 'url' => '/update-data', 'current' => 'home' , 'icon' => 'dashboard', 'roles' => ['user']],
          ['name' => 'catalogo', 'url' => '/prizes', 'current' => 'campana.index' , 'icon' => 'add_box', 'roles' => ['user']],
          ['name' => 'historial puntos', 'url' => '/points', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['user']],

          // Menu for admin
          ['name' => 'Inicio', 'url' => '/dashboard', 'current' => 'home' , 'icon' => 'dashboard', 'roles' => ['admin']],
          ['name' => 'premios', 'url' => '/dashboard/prizes', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'usuarios', 'url' => '/dashboard/users', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'usuarios cargar', 'url' => '/dashboard/users/create', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'metas historial', 'url' => '/dashboard/fulfillments', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'metas cargar', 'url' => '/dashboard/fulfillments/create', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
      ];

      return $menu;
    }
}
