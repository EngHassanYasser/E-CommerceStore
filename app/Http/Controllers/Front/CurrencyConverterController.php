<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CurrencyConverterRequest;
use App\Services\CurrencyConverterService;

class CurrencyConverterController extends Controller
{
    public function __construct(protected CurrencyConverterService $currencyConverterService) {}
    public function store(CurrencyConverterRequest $request)
    {
       $this->currencyConverterService->store($request->validated());
       
        return redirect()->back();
    }
}
