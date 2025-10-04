<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Country;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('Fetching countries from REST API...');

        $response = Http::get('https://restcountries.com/v3.1/all?fields=cca2,name,idd');

        if ($response->failed()) {
            $this->command->error('Failed to fetch countries from REST API.');
            return;
        }

        $countries = $response->json();

        foreach ($countries as $country) {
            $code = $country['cca2'] ?? null;
            $name = $country['name']['common'] ?? null;
            $phonecode = null;

            if (isset($country['idd']['root'], $country['idd']['suffixes']) && count($country['idd']['suffixes']) > 0) {
                $phonecode = (int) str_replace('+', '', $country['idd']['root'] . $country['idd']['suffixes'][0]);
            }

            if ($code && $name) {
                Country::updateOrCreate(
                    ['code' => $code],
                    [
                        'name' => $name,
                        'phonecode' => $phonecode
                    ]
                );
            }
        }

        $this->command->info('Countries table seeded successfully!');
    }
}
