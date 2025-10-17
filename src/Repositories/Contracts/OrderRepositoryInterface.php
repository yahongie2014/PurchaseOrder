<?php

namespace PurchaseOrder\Repositories\Contracts;

use App\Models\PurchaseOrder\Order;

interface OrderRepositoryInterface
{
    public function paginate(int $perPage = 15);

    public function find(int $id): ?Order;

    public function create(array $data): Order;

    public function update(int $id, array $data): ?Order;

    public function delete(int $id): bool;
}
