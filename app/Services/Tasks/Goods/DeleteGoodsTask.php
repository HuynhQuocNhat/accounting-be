<?php

namespace App\Services\Tasks\Goods;

use App\Models\Good;

class DeleteGoodsTask
{
    /**
     * @var Good
    */
    protected $goods;

    public function setGoods($goods): DeleteGoodsTask
    {
        $this->goods = $goods;

        return $this;
    }

    public function handle()
    {
        return $this->goods->delete();
    }
}
