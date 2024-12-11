<?php

namespace App\Services\Actions\Goods;

use App\Models\Good;
use App\Services\Tasks\Goods\AddNewGoodsTask;

class AddNewGoodsAction
{
    protected $data;

    /**
     * Set data to add new goods
     * @param array $data
     *
     * @return AddNewGoodsAction
     *
     */
    public function setData($data): AddNewGoodsAction
    {
        $this->data = $data;

        return $this;
    }

    public function handle()
    {
        return (new AddNewGoodsTask())->setData($this->data)
            ->handle();
    }
}
