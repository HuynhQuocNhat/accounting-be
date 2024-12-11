<?php

namespace App\Services\Tasks\UnitOfGoodTasks;

use App\Models\UnitOfGood;

class UpdateUnitOfGoodsTask
{
    protected $id, $name;

    /**
     * Set ID to update unit
     * @param $id string
     * @return UpdateUnitOfGoodsTask
     */
    public function setId($id): UpdateUnitOfGoodsTask
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set Name to update unit
     * @param $name string
     * @return UpdateUnitOfGoodsTask
     */
    public function setName($name): UpdateUnitOfGoodsTask
    {
        $this->name = $name;

        return $this;
    }

    public function handle()
    {
        $unit = UnitOfGood::find($this->id);
        $unit->name = $this->name;
        return $unit->save();
    }
}
