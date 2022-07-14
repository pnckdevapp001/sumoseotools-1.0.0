<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DateTime;
use App\Models\Admin\Captcha;

class CaptchaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Captcha::create(array(
            "id"         => 1,
            "status"     => false,
            "site_key"   => null,
            "secret_key" => null,
            "updated_at" => new DateTime(),
            "created_at" => new DateTime()
          ));
    }
}
