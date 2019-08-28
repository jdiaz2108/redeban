<?php

namespace App\Helpers;

class GlobalApp
{
    public static function menu()
    {
      $menu = [
          ['name' => 'Inicio', 'url' => '/', 'current' => 'home' , 'icon' => 'dashboard', 'roles' => ['Admin','Consultant','Data']],
          ['name' => 'Ver Campañas', 'url' => '/campana', 'current' => 'campana.index' , 'icon' => 'add_box', 'roles' => ['Admin','Consultant','Data']],
          ['name' => 'Crear Campaña', 'url' => '/campana/create', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['Admin','Consultant','Data']],
          ['name' => 'prizes', 'url' => '/prizes', 'current' => 'campana.index' , 'icon' => 'add_box', 'roles' => ['Admin','Consultant','Data']],
          ['name' => 'Dashboard prizes', 'url' => '/dashboard/prizes', 'current' => 'campana.create' , 'icon' => 'add_box', 'roles' => ['Admin','Consultant','Data']],
      ];

      return $menu;
    }
}