<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\ApiKeys;
use DateTime;

class ApiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          ApiKeys::create(array(
            "id"                                => 1,
            "created_at"                        => new DateTime()
          ));
    }
}
