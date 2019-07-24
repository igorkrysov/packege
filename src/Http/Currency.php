<?php

namespace Techsmart\Currency\Http;

use Illuminate\Database\Eloquent\Model;
use \File;
use \Storage;

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
        if (Storage::disk('local')->exists($file)) {
            $file = File::get(storage_path('app/'.$file));
            $data = [];

            $lines = explode("\n", $file);
            foreach ($lines as $line) {
                if ($header) {
                    $header = false;
                    continue;
                } else {
                    $csv = explode(";", $line);                    
                    $currency = isset($csv[0]) ? $csv[0] : 'NONAME';
                    if (empty($currency)) { 
                        continue; 
                    }
                    $time = isset($csv[3]) ? $csv[3] : 0;
                    $date = isset($csv[2]) ? $csv[2] : 0;
                    $open = isset($csv[4]) ? $csv[4] : 0;
                    $close = isset($csv[7]) ? $csv[7] : 0;
                    $data[] = [
                            'currency' => $currency,
                            'open' => $open,
                            'close' => $close,
                            'date' => new \DateTime(
                                            $date[0] . $date[1] . $date[2] . $date[3] . "-" . $date[4] . $date[5] . "-" . $date[6] . $date[7] . " " . 
                                            $time[0] . $time[1] . ":" . $time[2] . $time[3] . ":" . $time[4] . $time[5])
                    ];
                    // self::create($data);
                }
            }
            // dd($data);
            if (count($data) > 0) {
                self::insert($data);

                return $data[0]['currency'];
            }
        } 
        

        return '';
    }
}
