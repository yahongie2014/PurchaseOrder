<?php

namespace PurchaseOrder\Repositories\Eloquent;

use PurchaseOrder\Repositories\Contracts\OrderRepositoryInterface;
use App\Models\PurchaseOrder\Order;

class EloquentOrderRepository implements OrderRepositoryInterface
{
    protected Order $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function paginate(int $perPage = 15)
    {
        return $this->model->query()->paginate($perPage);
    }

    public function find(int $id): ?Order
    {
        return $this->model->find($id);
    }

    public function create(array $data): Order
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): ?Order
    {
        $order = $this->find($id);
        if (!$order) {
            return null;
        }
        $order->update($data);
        return $order;
    }

    public function delete(int $id): bool
    {
        $order = $this->find($id);
        if (!$order) {
            return false;
        }
        return (bool) $order->delete();
    }
}
