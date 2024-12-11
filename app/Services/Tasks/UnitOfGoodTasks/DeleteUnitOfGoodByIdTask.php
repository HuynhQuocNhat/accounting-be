<?php

namespace App\Services\Tasks\UnitOfGoodTasks;

use App\Models\UnitOfGood;

class DeleteUnitOfGoodByIdTask
{
    protected $unitId;

    /**
     * Set Id to delete unit of good
     * @param $unitId int
     * @return DeleteUnitOfGoodByIdTask
    */
    public function setUnitId($unitId): DeleteUnitOfGoodByIdTask
    {
        $this->unitId = $unitId;

        return $this;
    }

    public function handle()
    {
        return UnitOfGood::find($this->unitId)->delete();
    }
}
