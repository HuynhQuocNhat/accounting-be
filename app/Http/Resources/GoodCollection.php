<?php

namespace App\Http\Resources;

use App\Models\Good;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GoodCollection extends ResourceCollection
{
    private $total;

    public function __construct($resource, $total = null)
    {
        parent::__construct($resource);
        $this->total = $total;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $result = [
            'data' => $this->collection
        ];

        if ($this->total) {
            $result['total'] = $this->total;
        }

        return $result;
    }
}
