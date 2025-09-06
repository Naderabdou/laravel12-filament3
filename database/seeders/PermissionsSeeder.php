<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define the models
        $models = [


            'Blog',
            'Category',
            'City',
            'ContactUs',

            'Estate',

            'Order',


            'Service',
            'Setting',
            'ServiceOrder'



        ];

        // Loop through each model and create permissions
        foreach ($models as $model) {
            Permission::create(['name' => "create {$model}"]);
            Permission::create(['name' => "view {$model}"]);
            Permission::create(['name' => "update {$model}"]);
            Permission::create(['name' => "delete {$model}"]);
        }
    }
}
//path:
