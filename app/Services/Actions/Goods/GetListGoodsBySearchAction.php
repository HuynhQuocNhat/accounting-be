<?php

namespace App\Services\Actions\Goods;

use App\Http\Resources\GoodCollection;
use App\Services\Tasks\Goods\GetListGoodsBySearchTask;
use Illuminate\Database\Eloquent\Collection;

class GetListGoodsBySearchAction
{
    protected $params;

    /**
     * Set params to search list of goods
     *
     * @param array $params
     *
     * @return GetListGoodsBySearchAction
    */
    public function setParams($params): GetListGoodsBySearchAction
    {
        $this->params = $params;

        return $this;
    }

    public function handle(): GoodCollection
    {
        return (new GetListGoodsBySearchTask())->setParams($this->params)
            ->handle();
    }
}
