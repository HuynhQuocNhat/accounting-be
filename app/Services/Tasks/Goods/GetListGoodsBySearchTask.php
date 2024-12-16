<?php

namespace App\Services\Tasks\Goods;

use App\Http\Resources\GoodCollection;
use App\Models\Good;

class GetListGoodsBySearchTask
{
    protected $params;

    /**
     * Set params to search list of goods
     *
     * @param array $params
     *
     * @return GetListGoodsBySearchTask
    */
    public function setParams($params): GetListGoodsBySearchTask
    {
        $this->params = $params;
        return $this;
    }

    public function handle(): GoodCollection
    {
        $goods = Good::notYetDeleted();
        $offset = $this->params['offset'] ?? 0;
        $limit = $this->params['limit'] ?? 25;

        if (isset($this->params['code']) && $this->params['code']) {
            $codes = array_filter(array_map('trim', explode(',', $this->params['code'])));
            $goods->where(function ($query) use ($codes) {
                foreach ($codes as $code) {
                    $query->orWhere('code', 'like', '%' . $code . '%');
                }
            });
        }

        if (isset($this->params['name']) && $this->params['name']) {
            $names = array_filter(array_map('trim', explode(',', $this->params['name'])));
            $goods->where(function ($query) use ($names) {
                foreach ($names as $name) {
                    $query->orWhere('name', 'like', '%' . $name . '%');
                }
            });
        }

        if (isset($this->params['unit_of_good_ids']) && $this->params['unit_of_good_ids']) {
            $goods->whereIn('unit_of_good_id', $this->params['unit_of_good_ids']);
        }

        if (($this->params['order'] ?? '') === 'unit_of_goods') {
            $goods->join('unit_of_goods', 'goods.unit_of_good_id', '=', 'unit_of_goods.id')
                ->orderBy('unit_of_goods.name', $this->params['sort'] ?? 'asc');
        } else if (isset($this->params['order']) && $this->params['order']) {
            $goods->orderBy($this->params['order'], $this->params['sort'] ?? 'asc');
        }

        $goods->select('goods.*')->with(['unitOfGood' => function ($query) {
            $query->selectRaw('unit_of_goods.id, unit_of_goods.name');
        }]);

        $total = $goods->count();
        $goods = $goods->offset($offset)
            ->limit($limit)
            ->get();

        return new GoodCollection($goods, $total);


    }
}
