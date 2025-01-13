<?php

namespace App\Services\Actions\Goods;

use App\Models\Good;
use App\Services\Tasks\Goods\DeleteGoodsTask;

class DeleteGoodsAction
{
    /**
     * @var Good
    */
    protected $goods;

    public function setGoods($goods): DeleteGoodsAction
    {
        $this->goods = $goods;

        return $this;
    }

    public function handle()
    {
        return (new DeleteGoodsTask())->setGoods($this->goods)
            ->handle();
    }
}
