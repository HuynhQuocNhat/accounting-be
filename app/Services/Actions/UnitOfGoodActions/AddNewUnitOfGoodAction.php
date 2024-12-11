<?php

namespace App\Services\Actions\UnitOfGoodActions;

use App\Services\Tasks\UnitOfGoodTasks\AddNewUnitOfGoodTask;

class AddNewUnitOfGoodAction
{
    protected $params;

    /**
     * Set name unit of goods
     *
     * @param array $params
     *
     * @return AddNewUnitOfGoodAction
     */
    public function setParams($params): AddNewUnitOfGoodAction
    {
        $this->params = $params;

        return $this;
    }

    public function handle()
    {
        $addUnitOfGoodTask = new AddNewUnitOfGoodTask();

        return $addUnitOfGoodTask->setParams($this->params)
            ->handle();
    }
}
