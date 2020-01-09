<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CoefficientService;
use App\Services\CurrencyService;
use App\Services\PurchaseService;
use GuzzleHttp;

class IndexController extends Controller
{
    /** @var GuzzleHttp\Client */
    protected $client;

    /** @var CurrencyService  */
    protected $currencyService;

    /** @var PurchaseService  */
    protected $purchaseService;

    /** @var CoefficientService  */
    protected $coefficientService;

    public function __construct(
                                GuzzleHttp\Client $client,
                                CurrencyService $currencyService,
                                PurchaseService $purchaseService,
                                CoefficientService $coefficientService
    )
    {
        $this->client = $client;
        $this->currencyService = $currencyService;
        $this->purchaseService = $purchaseService;
        $this->coefficientService = $coefficientService;
    }

    public function index()
    {
        $res = $this->client->get('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');

        $content = json_decode($res->getBody()->getContents(), true);

        foreach ($content as &$course) {

            if ($course['ccy'] !== 'BTC') {
                $currency = $this->currencyService->get($course['ccy']);

                $arrayOfBuyAndSalesSums = $this->purchaseService->getArrayOfBuyAndSaleSums($currency);

                $coefficientForBuy  = $this->coefficientService->getBySumOfPurchaseAmounts($arrayOfBuyAndSalesSums['buy'], 'buy');

                $coefficientForSale = $this->coefficientService->getBySumOfPurchaseAmounts($arrayOfBuyAndSalesSums['sale'], 'sale');

                if ($coefficientForBuy)
                {
                    $course['buy'] *= $coefficientForBuy->percent;
                }

                if ($coefficientForSale)
                {
                    $course['sale'] *= $coefficientForSale->percent;
                }
            }
        }

        return response($content);
    }
}
