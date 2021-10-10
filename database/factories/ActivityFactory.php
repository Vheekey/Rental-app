<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Book;
use App\Models\Equipment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'item_type' => $this->faker->randomElement([Equipment::class, Book::class]),
            'item_id' => $this->faker->unique()->numberBetween(1,10),
            'status' => $this->faker->randomElement([Activity::RENTED, Activity::RETURNED])
        ];
    }
}
