<?php

namespace App\Services\Actions\Goods;

use App\Services\Tasks\Goods\UpdateGoodsTask;

class UpdateGoodsAction
{
    protected $goods;
    protected $data;

    /**
     * @param $goods Good
     */
    public function setGoods($goods): UpdateGoodsAction
    {
        $this->goods = $goods;

        return $this;
    }

    /**
     * @param $data array
     */
    public function setData($data): UpdateGoodsAction
    {
        $this->data = $data;

        return $this;
    }

    public function handle()
    {
        return (new UpdateGoodsTask())->setGoods($this->goods)
            ->setData($this->data)
            ->handle();
    }
}
