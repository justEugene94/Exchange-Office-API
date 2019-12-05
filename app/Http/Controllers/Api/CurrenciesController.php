<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CurrencyResource;
use App\Models\Currency;

class CurrenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return CurrencyResource
     */
    public function index()
    {
        /** @var Currency $currencies */
        $currencies = Currency::query()->get();

        /** @var CurrencyResource $resource */
        $resource = CurrencyResource::collection($currencies);

        return $resource;
    }
}
