<?php

namespace App\Services\Actions\UnitOfGoodActions;

use App\Models\UnitOfGood;
use App\Services\Tasks\UnitOfGoodTasks\UpdateUnitOfGoodsTask;

class UpdateUnitOfGoodAction
{
    protected $id, $name;

    /**
     * Set ID to update unit
     * @param $id string
     * @return UpdateUnitOfGoodAction
     */
    public function setId($id): UpdateUnitOfGoodAction
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set Name to update unit
     * @param $name string
     * @return UpdateUnitOfGoodAction
     */
    public function setName($name): UpdateUnitOfGoodAction
    {
        $this->name = $name;

        return $this;
    }

    public function handle()
    {
        return (new UpdateUnitOfGoodsTask())->setId($this->id)
            ->setName($this->name)
            ->handle();
    }
}
