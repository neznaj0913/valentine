<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LetterSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('letters')->insert([
            'name' => 'Mari',
            'message' => "Dear Mari,

Happy Valentine’s Day!
I just want you to know how special you are to me. 
Your smile brightens my day, and your presence makes everything feel lighter and happier.

Every moment with you is something I truly treasure. 
You bring warmth, kindness, and joy wherever you go, and I’m really grateful to have you in my life.

On this Valentine’s Day, I just want to say thank you for being you. 
You mean more to me than words can fully express.

With love,
Your Valentine",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}