<?php

namespace App\Services\Actions\UnitOfGoodActions;

use App\Services\Tasks\UnitOfGoodTasks\GetAllUnitOfGoodsTask;

class GetAllUnitOfGoodAction
{
    public function handle()
    {
        return (new GetAllUnitOfGoodsTask())->handle();
    }
}
