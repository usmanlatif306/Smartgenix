<?php

namespace App\Console\Commands;

use App\Models\ExchangeRate;
use Illuminate\Console\Command;

class ExchangeRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange:rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will fetch exchange rates of different conntries and save today exchange rate';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $countries = ExchangeRate::get()->unique('currency_code');

        foreach ($countries as $country) {
            $response = exchange_rate()->convert($country->currency_code);
            if (isset($response['success'])) {
                if ($response['success']) {
                    if ($country->currency_code === 'EUR') {
                        ExchangeRate::where('currency_code', 'EUR')->update(['rate' => number_format($response['result'], 3)]);
                    } else {
                        $country->update(['rate' => number_format($response['result'], 3)]);
                    }
                }
            }
        }

        $this->info('Exchange rates saved successfully!');
    }
}
