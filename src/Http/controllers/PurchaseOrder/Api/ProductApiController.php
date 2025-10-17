<?php

namespace PurchaseOrder\Http\Controllers\PurchaseOrder\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use PurchaseOrder\Http\Requests\PurchaseOrder\StoreProductRequest;
use PurchaseOrder\Http\Requests\PurchaseOrder\UpdateProductRequest;
use PurchaseOrder\Http\Resources\ProductResource;
use PurchaseOrder\Http\Resources\ProductCollection;
use PurchaseOrder\Repositories\Contracts\ProductRepositoryInterface;

class ProductApiController extends Controller
{
    protected ProductRepositoryInterface $repo;

    public function __construct(ProductRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $paginator = $this->repo->paginate(15);
        return new ProductCollection($paginator);
    }

    public function show($id)
    {
        $product = $this->repo->find($id);
        abort_unless($product, 404);
        return new ProductResource($product);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        $product = null;
        DB::transaction(function () use ($data, &$product) {
            $product = $this->repo->create($data);
        });

        return response(new ProductResource($product), 201);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $data = $request->validated();
        $product = $this->repo->update($id, $data);
        abort_unless($product, 404);
        return new ProductResource($product);
    }

    public function destroy($id)
    {
        $deleted = $this->repo->delete($id);
        return response()->json(['deleted' => (bool)$deleted]);
    }
}
