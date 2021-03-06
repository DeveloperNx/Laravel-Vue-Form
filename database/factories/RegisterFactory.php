<?php

namespace Database\Factories;

use App\Models\Register;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegisterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Register::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => Register::factory(),
            'firstname' => $this->faker->name,
            'lastname' => $this->faker->name,
            'address'=>$this->faker->text,
            // 'contactnumber'=>$this->faker->contactnumber,
            'email'=>$this->faker->unique()->email,
            // 'gender'=>$this->faker->gender,
        ];
    }
}
