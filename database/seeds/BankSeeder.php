<?php

use Illuminate\Database\Seeder;

// php artisan db:seed --class=BankSeeder
class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = config('platform.bank_type');

        foreach ($data as $key => $val){
            \App\Models\Bank::create([
                'key' => $key,
                'name' => $val
            ]);
        }
    }
}
