<?php

namespace PurchaseOrder\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;

class UserCollection extends ResourceCollection
{
    public $collects = UserResource::class;

    public function toArray($request)
    {
        $data = [
            'data' => $this->collection,
            'meta' => [
                'count' => $this->collection->count(),
            ],
        ];

        if ($this->resource instanceof AbstractPaginator) {
            $data['meta']['pagination'] = [
                'current_page' => $this->resource->currentPage(),
                'last_page' => $this->resource->lastPage(),
                'per_page' => $this->resource->perPage(),
                'total' => $this->resource->total(),
                'from' => $this->resource->firstItem(),
                'to' => $this->resource->lastItem(),
            ];
        }

        return $data;
    }
}
