<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Coefficient\StoreFormRequest;
use App\Http\Resources\Api\CoefficientResource;
use App\Models\Coefficient;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CoefficientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return CoefficientResource
     * @throws AuthorizationException
     */
    public function index()
    {
        $user = Auth::user();
        $this->authorize('list', [Coefficient::class, $user]);

        /** @var Coefficient $coefficients */
        $coefficients = Coefficient::query()->with('commerceValue')->paginate();

        /** @var CoefficientResource $resource */
        $resource = CoefficientResource::collection($coefficients);

        return $resource;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
    }
}
