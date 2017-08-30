<?php

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countriesFilePath = base_path('vendor/mledoze/countries/dist/countries.json');
        if (file_exists($countriesFilePath)) {
            $content = file_get_contents($countriesFilePath);
            $countries = json_decode($content);
            if (!is_null($countries) && json_last_error() === JSON_ERROR_NONE) {
                $countries = collect($countries);

                $countries->each(function ($country) {
                    $newCountry = new \App\Models\Location\Country();
                    $newCountry->name = $country->name->common;
                    $newCountry->official = empty($country->name->official) ? null : $country->name->official;
                    $newCountry->iso_alpha_2 = empty($country->cca2) ? null : $country->cca2;
                    $newCountry->iso_alpha_3 = empty($country->cca3) ? null : $country->cca3;
                    $newCountry->iso_numeric = empty($country->ccn3) ? null : $country->ccn3;
                    $newCountry->save();
                });
            }
        }
    }
}
