<?php

namespace App\Services\Tasks\Goods;

use App\Models\Good;

class AddNewGoodsTask
{
    protected $data;

    /**
     * Set data to add new goods
     * @param array $data
     *
     * @return AddNewGoodsTask
     *
    */
    public function setData($data): AddNewGoodsTask
    {
        $this->data = $data;

        return $this;
    }

    public function handle()
    {
        return Good::insert($this->data);
    }
}
