<?php

namespace PurchaseOrder\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\PurchaseOrder\Product;

interface ProductRepositoryInterface
{
    /**
     * Get paginated products.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator;

    /**
     * Find a product by id.
     */
    public function find(int $id): ?Product;

    /**
     * Create a product.
     */
    public function create(array $data): Product;

    /**
     * Update a product.
     */
    public function update(int $id, array $data): ?Product;

    /**
     * Delete a product.
     */
    public function delete(int $id): bool;
}
