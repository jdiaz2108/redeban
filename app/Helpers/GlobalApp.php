<?php

namespace App\Helpers;

class GlobalApp
{
    public static function menu()
    {
      $menu = [
          // Menu for user
          ['name' => 'Inicio', 'url' => '/', 'icon' => 'dashboard', 'roles' => ['user']],
          ['name' => '¿Qué es?', 'url' => '/about', 'icon' => 'add_box', 'roles' => ['user']],
          ['name' => 'historial de puntos', 'url' => '/points', 'icon' => 'add_box', 'roles' => ['user']],
          ['name' => 'historial de transacciones', 'url' => '/transactions', 'icon' => 'add_box', 'roles' => ['user']],
          //['name' => 'trivias', 'url' => '/trivias', 'icon' => 'add_box', 'roles' => ['user']],
          ['name' => 'términos y condiciones', 'url' => '/terms', 'icon' => 'add_box', 'roles' => ['user']],

          // Menu for admin
          ['name' => 'Inicio', 'url' => '/dashboard', 'icon' => 'dashboard', 'roles' => ['admin']],
          ['name' => 'premios', 'url' => '/dashboard/prizes', 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'usuarios', 'url' => '/dashboard/users', 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'metas', 'url' => '/dashboard/fulfillments', 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'historial carga', 'url' => '/dashboard/histories', 'icon' => 'add_box', 'roles' => ['admin']],
          ['name' => 'puntos', 'url' => '/dashboard/points', 'icon' => 'add_box', 'roles' => ['admin']],
      ];

      return $menu;
    }
}
