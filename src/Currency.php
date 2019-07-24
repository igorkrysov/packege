<?php

namespace Techsmart\Currency;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    //
    protected $fillable = [ 'currency', 'aks', 'bid', 'date' ];

    /**
     * Store data from csv to db
     * 
     * @return currency | EURUSD
     */
    public static function loadFromFile($file, $header = false) {
        $handle = fopen($file, "r");
        $data = [];

        while ($csvLine = fgetcsv($handle, 1000, ";")) {

            if ($header) {
                $header = false;
            } else {
                $currency = isset($csvLine[0]) ? $csvLine[0] : 'NONAME';
                $bid = isset($csvLine[1]) ? $csvLine[1] : 0;
                $ask = isset($csvLine[2]) ? $csvLine[2] : 0;
                $time = isset($csvLine[3]) ? $csvLine[3] : 0;
                $data[] = [
                    'currency' => $currency,
                    'ask' => $ask,
                    'bid' => $bid,
                    'time' => $time
                ];
            }
        }

        if (count($data) > 0) {
            self::create($data);

            return $data[0][0];
        }

        return '';
    }
}
