<?php

namespace App\Services\Tasks\Goods;

use App\Models\Good;

class UpdateGoodsTask
{
    protected $goods;
    protected $data;

    /**
     * @param $goods Good
     */
    public function setGoods($goods): UpdateGoodsTask
    {
        $this->goods = $goods;

        return $this;
    }

    /**
     * @param $data array
     */
    public function setData($data): UpdateGoodsTask
    {
        $this->data = $data;

        return $this;
    }

    public function handle()
    {
        return $this->goods->update($this->data);
    }
}
