<?php

namespace App\Services\Actions\UnitOfGoodActions;

use App\Services\Tasks\UnitOfGoodTasks\DeleteUnitOfGoodByIdTask;

class DeleteUnitOfGoodByIdAction
{

    /**
     * @props $unitId
    */
    protected $unitId;

    /**
     * Set Id to delete unit of good
     * @param $unitId Int
     * @return DeleteUnitOfGoodByIdAction
     */
    public function setUnitId($unitId): DeleteUnitOfGoodByIdAction
    {
        $this->unitId = $unitId;

        return $this;
    }

    public function handle()
    {
        return (new DeleteUnitOfGoodByIdTask())->setUnitId($this->unitId)
            ->handle();
    }
}
