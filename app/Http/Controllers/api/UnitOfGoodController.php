<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\AddUnitOfGoodRequest;
use App\Http\Requests\UpdateUnitOfGoodRequest;
use App\Http\Resources\UnitOfGoodResource;
use App\Services\Actions\UnitOfGoodActions\AddNewUnitOfGoodAction;
use App\Services\Actions\UnitOfGoodActions\DeleteUnitOfGoodByIdAction;
use App\Services\Actions\UnitOfGoodActions\GetAllUnitOfGoodAction;
use App\Services\Actions\UnitOfGoodActions\UpdateUnitOfGoodAction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UnitOfGoodController extends Controller
{
    public function store(AddUnitOfGoodRequest $request)
    {
        $param = array_filter($request->all());

        $now = Carbon::now()->format('Y-m-d H:i:s');

        $param = array_map(function ($value) use ($now) {
            $data['name'] = ucfirst($value);
            $data['created_at'] = $now;
            return $data;
        }, $param['unit']);

        $result = (new AddNewUnitOfGoodAction())->setParams($param[0])
            ->handle();

        if ($result) {
            return $this->response('success', 200, new UnitOfGoodResource($result));
        } else {
            return $this->response('Some thing wrong !!!', 400);
        }
    }

    public function show()
    {
        $result = (new GetAllUnitOfGoodAction())->handle();

        return $this->response('success', 200, UnitOfGoodResource::collection($result));
    }

    public function update(UpdateUnitOfGoodRequest $request)
    {
        try {
            $params = $request->all();
            DB::beginTransaction();

            $result = (new UpdateUnitOfGoodAction())->setId($params['id'])
                ->setName(ucfirst($params['name']))
                ->handle();

            if ($result) {
                DB::commit();

                return $this->response('Sửa ĐVT thành công', 200);
            }

            DB::rollBack();
            return $this->response('Something Wrong', 500);

        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function destroy($id)
    {
        try {
            if (!$id) {
                return $this->response('Something Wrong', 500);
            } else {
                DB::beginTransaction();
                $result = (new DeleteUnitOfGoodByIdAction())->setUnitId($id)
                    ->handle();

                if ($result) {
                    DB::commit();
                    return $this->response('Đã xóa', 200);
                }

                DB::rollBack();
                return $this->response('Something Wrong', 500);
            }
        } catch (\Exception $e) {
            return $this->response('Something Wrong', 500);
            DB::rollBack();
        }
    }
}
