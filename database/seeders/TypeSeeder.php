<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::create([
            'name'=>'coiffure',
            'title'=>'Les meilleurs salons et instituts aux alentours de',
            'description'=>'Je suis gérant d’un salon de coiffure',
        ]);
        Type::create([
            'name'=>'barbiers',
            'title'=>'Les meilleurs salons et instituts aux alentours de',
            'description'=>'Je suis gérant d’un salon de barbiers',
        ]);
        Type::create([
            'name'=>'manucure',
            'title'=>'Les meilleurs salons et instituts aux alentours de',
            'description'=>'Je suis gérant d’un salon de manucure.',
        ]);
        Type::create([
            'name'=>'beauté',
            'title'=>'Les meilleurs salons et instituts aux alentours de',
            'description'=>'Je suis gérant d’un salon beauté.',
        ]);
        Type::create([
            'name'=>'spa',
            'title'=>'Les meilleurs salons et instituts aux alentours de',
            'description'=>'Je suis gérant d’un spa.',
        ]);
    }
}
