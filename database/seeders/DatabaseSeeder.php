<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\TicketFactory;
use App\Models\Ticket;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        Ticket::factory(70)->create();
    }
}
