<?php

namespace Techsmart\Currency;

use Illuminate\Http\Request;
use Currency;

class CurrencyController extends Controller
{
    /**
     * Upload view
     * 
     * @return Response
     */
    public function upload() {
        return view('techsmart.currency.upload');
    }

    /**
     * Store
     * 
     * @return Response
     */
    public function store(Request $request) {
        if ($request->hasFile('file')) {
            $filename = 'currency' . time() . '.cvs';
            $path = $request->file('file')->store($filename);
            $currency = Currency::loadFromFile($filename);

            return route('currency.show', $currency);
        }

        return redirect()->back();
    }

    /**
     * Show currency
     * 
     * @return Response
     */
    public function show($currency) {
        $currencies = Currency::where('currency', $currency)->get();

        return view('techsmart.currency.show', ['currencies' => $currencies]);
    }
}
