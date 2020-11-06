<?php

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Plan::create([
            'name'=>'Basic',
            'url'=>'basic',
            'price'=>149.99,
            'description'=>'Plano básico'
        ]);

        Plan::create([
            'name'=>'Master',
            'url'=>'master',
            'price'=>349.99,
            'description'=>'Plano Master'
        ]);

        Plan::create([
            'name'=>'Business',
            'url'=>'business',
            'price'=>499.99,
            'description'=>'Plano Empresarial'
        ]);
    }
}
