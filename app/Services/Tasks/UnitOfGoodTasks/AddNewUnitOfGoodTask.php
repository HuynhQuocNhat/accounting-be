<?php

namespace App\Services\Tasks\UnitOfGoodTasks;

use App\Models\UnitOfGood;

class AddNewUnitOfGoodTask
{
    protected $params;

    /**
     * Set name unit of goods
     *
     * @param array $params
     *
     * @return AddNewUnitOfGoodTask
     */
    public function setParams($params): AddNewUnitOfGoodTask
    {
        $this->params = $params;

        return $this;
    }

    public function handle()
    {
        return UnitOfGood::create($this->params);
    }
}
