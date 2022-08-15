<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->title(),
            'user_id'=>$this->faker->numberBetween(1,10),
            'category_id'=>$this->faker->numberBetween(1,4),
            'open'=>$this->faker->numberBetween(1,3),
            'status'=>$this->faker->numberBetween(4,6),
            'priority'=>$this->faker->numberBetween(7,9),
            "ticket_contents"=>$this->faker->realText(80),
        ];
    }
}
