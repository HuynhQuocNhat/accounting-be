<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\AddGoodRequest;
use App\Http\Requests\UpdateGoodsRequest;
use App\Models\Good;
use App\Services\Actions\Goods\AddNewGoodsAction;
use App\Services\Actions\Goods\DeleteGoodsAction;
use App\Services\Actions\Goods\GetListGoodsBySearchAction;
use App\Services\Actions\Goods\UpdateGoodsAction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $result = (new GetListGoodsBySearchAction())->setParams($request->all())
                ->handle();

            return $this->response("success", 200, $result);
        } catch (\Exception $ex) {
            return $this->response($ex->getMessage(), 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddGoodRequest $request)
    {
        try {
            $params = $request->all();

            $now = Carbon::now()->format('Y-m-d H:i:s');

            DB::beginTransaction();

            $params = array_map(function ($value) use ($now) {
                $value['created_at'] = $now;
                return $value;
            }, $params['goods']);

            $result = (new AddNewGoodsAction())->setData($params)
                ->handle();

            if ($result) {
                DB::commit();
                return $this->response("Đã thêm Hàng Hóa thành công", 200);
            }

            DB::rollBack();
            return $this->response("Some thing wrong", 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response("Some thing wrong", 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Good $good)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGoodsRequest $request, Good $good)
    {
        try {
            if ($good) {
                DB::beginTransaction();
                $result = (new UpdateGoodsAction())->setGoods($good)
                    ->setData($request->all(['code', 'name', 'unit_of_good_id']))
                    ->handle();

                if ($result) {
                    DB::commit();
                    return $this->response("Đã sửa thông tin Hàng {$request->post('name')} .", 200);
                }
            }

            DB::rollBack();
            return $this->response('Something wrong!!!', 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response('Something wrong!!!', 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Good $good)
    {
        try {
            DB::beginTransaction();
            if ($good) {
                $goodsName = $good->name;
                $result = (new DeleteGoodsAction())->setGoods($good)
                    ->handle();
                if ($result) {
                    DB::commit();
                    return $this->response("Đã Xóa Hàng {$goodsName} !!!", 200);
                }
            }

            DB::rollBack();
            return $this->response('Something wrong!!!', 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response('Something wrong!!!', 500);
        }

    }
}
