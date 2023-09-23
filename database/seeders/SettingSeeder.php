<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            'currency_name' => 'eur',
            'currency_symbol' => '€',
            'stripe_key' => 'pk_test_51LLNHULHSVdqkxKh7pfEegSRNaPROf6yST9Ajb5Z3dOALI6WItO1mOLkGgmqjkjnYLNNzcoEgzkN9wngAEd4bVPd00cmifQL6i',
            'stripe_secret' => 'sk_test_51LLNHULHSVdqkxKh3dn3DZYIABJGPA3C2R0w36NT27ccqxPfN7ttnnx95MhYVtcl9TnMWs5aUA7bvIdAFKrlLc5r00IXETgCeo',
        ];

        foreach ($settings as $name => $value) {
            Setting::create([
                'key' => $name,
                'value' => $value,
            ]);
        }
    }
}
