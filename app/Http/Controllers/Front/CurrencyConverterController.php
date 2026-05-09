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
       $data= $request->validated();

       $this->currencyConverterService->store($data);
       
        return redirect()->back();
    }
}
