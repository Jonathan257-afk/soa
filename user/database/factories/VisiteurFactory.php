<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Visiteur;

class VisiteurFactory extends Factory
{
    protected $model = Visiteur::class;

    public function definition()
    {
       
        return [
            'ip' => $this->faker->ipv4,
            "created_at" => $this->faker->date,
        ];
        
    }
}
