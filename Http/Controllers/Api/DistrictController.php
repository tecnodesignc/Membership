<?php

namespace Modules\Membership\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Membership\Transformers\DistrictTransformer;
use Modules\Membership\Http\Requests\CreateDistrictRequest;
use Modules\Membership\Http\Requests\UpdateDistrictRequest;
use Modules\Membership\Repositories\DistrictRepository;
use Modules\Site\Http\Controllers\Api\BaseApiController;

class DistrictController extends BaseApiController
{
    /**
     * @var DistrictRepository
     */
    private $district;

    public function __construct(DistrictRepository $district)
    {
        parent::__construct();

        $this->district = $district;
    }

    /**
     * GET ITEMS
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        try {
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->district->getItemsBy($params);

            //Response
            $response = ["data" => DistrictTransformer::collection($dataEntity)];

            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
        } catch (\Exception $e) {
             \Log::error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * GET A ITEM
     *
     * @param $criteria
     * @return mixed
     */
    public function show($criteria, Request $request)
    {
        try {
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->district->getItem($criteria, $params);

            //Break if no found item
            if (!$dataEntity) throw new Exception('Item not found', 204);

            //Response
            $response = ["data" => new DistrictTransformer($dataEntity)];

            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
        } catch (\Exception $e) {
             \Log::error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }


    /**
     * CREATE A ITEM
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        \DB::beginTransaction();
        try {
            $data = $request->input('attributes') ?? [];//Get data  
            //Validate Request
            $this->validateRequestApi(new CreateDistrictRequest($data));

            //Create item
            $dataEntity = $this->district->create($data);

            //Response
            $response = ["data" => new DistrictTransformer($dataEntity)];
            \DB::commit(); //Commit to Data Base
        } catch (\Exception $e) {
             \Log::error($e);
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }
        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * UPDATE ITEM
     *
     * @param $criteria
     * @param Request $request
     * @return mixed
     */
    public function update($criteria, Request $request)
    {
        \DB::beginTransaction(); //DB Transaction
        try {
            //Get data
            $data = $request->input('attributes') ?? [];//Get data

            //Validate Request
            $this->validateRequestApi(new UpdateDistrictRequest($data));

            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            $dataEntity = $this->district->getItem($criteria, $params);
            $this->district->update($dataEntity, $data);


            //Response
            $response = ["data" => 'Item Updated'];
            \DB::commit();//Commit to DataBase
        } catch (\Exception $e) {
             \Log::error($e);
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * DELETE A ITEM
     *
     * @param $criteria
     * @return mixed
     */
    public function delete($criteria, Request $request)
    {
        \DB::beginTransaction();
        try {
            //Get params
            $params = $this->getParamsRequest($request);

            $dataEntity = $this->district->getItem($criteria, $params);
            $this->district->destroy($dataEntity);


            //Response
            $response = ["data" => "Item deleted"];
            \DB::commit();//Commit to Data Base
        } catch (\Exception $e) {
             \Log::error($e);
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

}
