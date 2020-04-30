<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Purchase\StoreFormRequest;
use App\Http\Resources\Api\PurchaseResource;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\User;
use App\Services\CustomerService;
use App\Services\PurchaseService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class PurchasesController extends Controller
{
    /** @var CustomerService  */
    protected $customerService;

    /** @var PurchaseService  */
    protected $purchaseService;

    public function __construct(CustomerService $customerService, PurchaseService $purchaseService)
    {
        $this->customerService = $customerService;
        $this->purchaseService = $purchaseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return PurchaseResource
     * @throws AuthorizationException
     */
    public function index(): PurchaseResource
    {
        /** @var User $user */
        $user = Auth::user();
        $this->authorize('list', [Purchase::class, $user]);

        /** @var Purchase $purchases */
        $purchases = Purchase::query()->with([
                                                'customer',
                                                'currency',
                                                'exchangeCurrency',
                                    ])->paginate(10);

        /** @var PurchaseResource $resource */
        $resource = PurchaseResource::collection($purchases);

        return $resource;
    }

    /**
     * @param StoreFormRequest $request
     *
     * @return PurchaseResource
     * @throws AuthorizationException
     */
    public function store(StoreFormRequest $request): PurchaseResource
    {
        $this->authorize('store', Purchase::class);

        /** @var Customer $customer */
        $customer = $this->customerService->findOrCreate($request->getCustomerData());

        $purchase = $this->purchaseService->create(
                                                    $customer,
                                                    $request->getPurchaseData(),
                                                    $request->getCurrencyId(),
                                                    $request->getExchangeCurrencyId()
        );

        return PurchaseResource::make($purchase);
    }

    /**
     * @param int $id
     *
     * @return PurchaseResource
     * @throws AuthorizationException
     */
    public function show(int $id): PurchaseResource
    {
        /** @var User $user */
        $user = Auth::user();
        $this->authorize('show', [Purchase::class, $user]);

        /** @var Purchase $purchase */
        $purchase = Purchase::query()->findOrFail($id);

        return PurchaseResource::make($purchase);
    }
}
