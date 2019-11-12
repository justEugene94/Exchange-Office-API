<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp;

class IndexController extends Controller
{
    /** @var GuzzleHttp\Client */
    protected $client;

    public function __construct(GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        $res = $this->client->get('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');

        return response($res->getBody());
    }
}
