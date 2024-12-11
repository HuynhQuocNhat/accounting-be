<?php

namespace App\Services\Tasks\UnitOfGoodTasks;

use App\Models\UnitOfGood;

class GetAllUnitOfGoodsTask
{
    public function handle()
    {
        return UnitOfGood::notYetDeleted()->get();
    }
}
