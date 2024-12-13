<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Appointment::class;

    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'phone' => $this->faker->phoneNumber(),
            'localisation' => $this->faker->address(),
            'email' => $this->faker->email(),
            'city_id' => City::factory(),
            'address' => $this->faker->streetAddress(),
            'client_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'admin_date' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
