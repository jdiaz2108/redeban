<?php

namespace App\Helpers;

class GlobalApp
{
    public static function menu()
    {
      $menu = [
          // Menu for user
          ['name' => 'Inicio', 'url' => '/', 'icon' => 'dashboard', 'roles' => ['user']],
          ['name' => 'Que es?', 'url' => '/about', 'icon' => 'add_box', 'roles' => ['user']],
          ['name' => 'Actualizar datos', 'url' => '/update-data', 'icon' => 'dashboard', 'roles' => ['user']],
          ['name' => 'historial de puntos', 'url' => '/points', 'icon' => 'add_box', 'roles' => ['user']],
          ['name' => 'historial de transacciones', 'url' => '/transactions', 'icon' => 'add_box', 'roles' => ['user']],
          ['name' => 'trivias', 'url' => '/trivias', 'icon' => 'add_box', 'roles' => ['user']],
          ['name' => 'términos y condiciones', 'url' => '/terminos', 'icon' => 'add_box', 'roles' => ['user']],

          // Menu for admin
          ['name' => 'Inicio', 'url' => '/dashboard', 'current' => 'home' , 'icon' => 'dashboard', 'roles' => ['admin']],
          ['name' => 'premios', 'url' => '/dashboard/prizes', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'usuarios', 'url' => '/dashboard/users', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'metas historial', 'url' => '/dashboard/fulfillments', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'metas cargar', 'url' => '/dashboard/fulfillments/create', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['admin']],
      ];

      return $menu;
    }
}
