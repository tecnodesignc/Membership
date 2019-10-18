<?php

namespace Modules\Membership\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Membership\Transformers\WorkstationTransformer;
use Modules\Membership\Http\Requests\CreateWorkstationRequest;
use Modules\Membership\Http\Requests\UpdateWorkstationRequest;
use Modules\Membership\Repositories\WorkstationRepository;
use Modules\Site\Http\Controllers\Api\BaseApiController;

class WorkstationController extends BaseApiController
{
    /**
     * @var WorkstationRepository
     */
    private $workstation;

    public function __construct(WorkstationRepository $workstation)
    {
        parent::__construct();

        $this->workstation = $workstation;
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
            $dataEntity = $this->workstation->getItemsBy($params);

            //Response
            $response = ["data" => WorkstationTransformer::collection($dataEntity)];

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
            $dataEntity = $this->workstation->getItem($criteria, $params);

            //Break if no found item
            if (!$dataEntity) throw new Exception('Item not found', 204);

            //Response
            $response = ["data" => new WorkstationTransformer($dataEntity)];

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
            $this->validateRequestApi(new CreateWorkstationRequest($data));

            //Create item
            $dataEntity = $this->workstation->create($data);

            //Response
            $response = ["data" => new WorkstationTransformer($dataEntity)];
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
            $this->validateRequestApi(new UpdateWorkstationRequest($data));

            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            $dataEntity = $this->workstation->getItem($criteria, $params);
            $this->workstation->update($dataEntity, $data);


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

            $dataEntity = $this->workstation->getItem($criteria, $params);
            $this->workstation->destroy($dataEntity);


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
