<?php

namespace Techsmart\Currency\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Techsmart\Currency\Http\Currency;

class CurrencyController extends Controller
{
    /**
     * Upload view
     * 
     * @return Response
     */
    public function upload() {        
        return view('vendor.techsmart.currency.upload');
    }

    /**
     * Store
     * 
     * @return Response
     */
    public function store(Request $request) {
        
        if ($request->hasFile('file')) {
            $filename = 'currency' . time() . '.csv';
            $file = $request->file('file');
            $file->storeAs('', $filename);
            $currency = Currency::loadFromFile($filename);
            return redirect()->route('currency.show', $currency);
        }
        
        return redirect()->back();
    }

    /**
     * Show currency
     * 
     * @return Response
     */
    public function show($currency) {
        $currencies = Currency::where('currency', $currency)->orderBy('date')->get();

        return view('vendor.techsmart.currency.show', ['currencies' => $currencies]);
    }
}
