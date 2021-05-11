<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Coefficient\StoreFormRequest;
use App\Http\Requests\Api\Coefficient\UpdateFormRequest;
use App\Http\Resources\Api\CoefficientResource;
use App\Models\Coefficient;
use App\Models\User;
use App\Services\CoefficientService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CoefficientsController extends Controller
{
    /** @var CoefficientService  */
    protected $coefficientService;

    /**
     * CoefficientsController constructor.
     *
     * @param CoefficientService $coefficientService
     */
    public function __construct(CoefficientService $coefficientService)
    {
        $this->coefficientService = $coefficientService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return CoefficientResource
     * @throws AuthorizationException
     */
    public function index(): CoefficientResource
    {
        /** @var User $user */
        $user = Auth::user();
        $this->authorize('list', [Coefficient::class, $user]);

        /** @var Coefficient $coefficients */
        $coefficients = Coefficient::query()->with('commerceValue')->paginate(10);

        /** @var CoefficientResource $resource */
        $resource = CoefficientResource::collection($coefficients);

        return $resource;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFormRequest   $request
     *
     * @return CoefficientResource
     * @throws AuthorizationException
     */
    public function store(StoreFormRequest $request): CoefficientResource
    {
        /** @var User $user */
        $user = Auth::user();
        $this->authorize('store', [Coefficient::class, $user]);

        /** @var Coefficient $coefficient */
        $coefficient = $this->coefficientService->create($request);

        return CoefficientResource::make($coefficient);
    }

    /**
     * Display the specified resource.
     *
     * @param int $coefficientId
     *
     * @return CoefficientResource
     * @throws AuthorizationException
     */
    public function show(int $coefficientId): CoefficientResource
    {
        /** @var User $user */
        $user = Auth::user();
        $this->authorize('show', [Coefficient::class, $user]);

        /** @var Coefficient $coefficient */
        $coefficient = Coefficient::query()->with('commerceValue')->findOrFail($coefficientId);

        return CoefficientResource::make($coefficient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFormRequest  $request
     * @param int                $coefficientId
     *
     * @return CoefficientResource
     * @throws AuthorizationException
     */
    public function update(UpdateFormRequest $request, int $coefficientId): CoefficientResource
    {
        /** @var User $user */
        $user = Auth::user();
        $this->authorize('update', [Coefficient::class, $user]);

        /** @var Coefficient $coefficient */
        $coefficient = Coefficient::query()->findOrFail($coefficientId);

        $coefficient = $this->coefficientService->update($request, $coefficient);

        return CoefficientResource::make($coefficient);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int                $coefficientId
     *
     * @return Response
     * @throws AuthorizationException
     * @throws \Exception
     */
    public function destroy(int $coefficientId): Response
    {
        /** @var User $user */
        $user = Auth::user();
        $this->authorize('destroy', [Coefficient::class, $user]);

        /** @var Coefficient $coefficient */
        $coefficient = Coefficient::query()->findOrFail($coefficientId);

        $this->coefficientService->delete($coefficient);

        return response('Coefficient deleted!', 200);
    }
}
