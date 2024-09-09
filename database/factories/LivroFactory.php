<?php

namespace Database\Factories;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Factories\Factory;

class LivroFactory extends Factory
{
    protected $model = Livro::class;

    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(3), 
            'editora' => $this->faker->company(), 
            'edicao' => $this->faker->numberBetween(1, 10),  
            'anoPublicacao' => $this->faker->year(),  
            'valor' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
