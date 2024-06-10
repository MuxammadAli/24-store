<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Администратор',
            'permissions' => [
                'users' => [
                    'view' => true,
                    'update' => true,
                ],

                'staffs' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'roles' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'products' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'compilations' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'orders' => [
                    'view' => true
                ],

                'branches' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'partners' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'posts' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'sliders' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'categories' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'special-offers' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'pages' => [
                    'create' => true,
                    'update' => true,
                ],

                'feedback' => [
                    'view' => true,
                    'update' => true,
                    'delete' => true
                ],

                'comments' => [
                    'view' => true,
                    'update' => true,
                    'delete' => true
                ],

                'billings' => [
                    'view' => true,
                ],

                'colors' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'regions' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'cities' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'files' => [
                    'view' => true,
                    'create' => true,
                    'delete' => true
                ],

                'currencies' => [
                    'view' => true,
                    'create' => true,
                ],

                'settings' => [
                    'update' => true,
                ],
            ]
        ]);

        Role::create([
            'name' => 'Клиент',
            'permissions' => [
                'users' => [
                    'view' => false,
                    'update' => false,
                ],

                'branches' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'staffs' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'roles' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'products' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'compilations' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'orders' => [
                    'view' => false
                ],

                'brands' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'partners' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'posts' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'sliders' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'categories' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'special-offers' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'pages' => [
                    'create' => false,
                    'update' => false,
                ],

                'feedback' => [
                    'view' => false,
                    'update' => false,
                    'delete' => false
                ],

                'comments' => [
                    'view' => false,
                    'update' => false,
                    'delete' => false
                ],

                'billings' => [
                    'view' => false,
                ],

                'colors' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'regions' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'cities' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'files' => [
                    'view' => false,
                    'create' => false,
                    'delete' => false
                ],

                'currencies' => [
                    'view' => false,
                    'create' => false,
                ],

                'settings' => [
                    'update' => false,
                ],
            ]
        ]);

        Role::create([
            'name' => 'Контент менеджер',
            'permissions' => [
                'users' => [
                    'view' => false,
                    'update' => false,
                ],

                'staffs' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'roles' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'products' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'compilations' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'orders' => [
                    'view' => false
                ],

                'brands' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'branches' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'partners' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'posts' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'sliders' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'categories' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'special-offers' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'pages' => [
                    'create' => true,
                    'update' => true,
                ],

                'feedback' => [
                    'view' => false,
                    'update' => false,
                    'delete' => false
                ],

                'comments' => [
                    'view' => false,
                    'update' => false,
                    'delete' => false
                ],

                'billings' => [
                    'view' => false,
                ],

                'colors' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'regions' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'cities' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true
                ],

                'files' => [
                    'view' => true,
                    'create' => true,
                    'delete' => true
                ],

                'currencies' => [
                    'view' => true,
                    'create' => true,
                ],

                'settings' => [
                    'update' => true,
                ],
            ]
        ]);

        Role::create([
            'name' => 'Модератор',
            'permissions' => [
                'users' => [
                    'view' => false,
                    'update' => false,
                ],

                'staffs' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'roles' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'products' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'compilations' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'orders' => [
                    'view' => true
                ],

                'brands' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'branches' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'partners' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'posts' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'sliders' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'categories' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'special-offers' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'pages' => [
                    'create' => false,
                    'update' => false,
                ],

                'feedback' => [
                    'view' => true,
                    'update' => true,
                    'delete' => true
                ],

                'comments' => [
                    'view' => true,
                    'update' => true,
                    'delete' => true
                ],

                'billings' => [
                    'view' => false,
                ],

                'colors' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'regions' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'cities' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false
                ],

                'files' => [
                    'view' => false,
                    'create' => false,
                    'delete' => false
                ],

                'currencies' => [
                    'view' => false,
                    'create' => false,
                ],

                'settings' => [
                    'update' => false,
                ],
            ]
        ]);
    }
}
