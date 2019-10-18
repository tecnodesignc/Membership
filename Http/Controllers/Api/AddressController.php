<?php

namespace Modules\Membership\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Membership\Transformers\AddressTransformer;
use Modules\Membership\Http\Requests\CreateAddressRequest;
use Modules\Membership\Http\Requests\UpdateAddressRequest;
use Modules\Membership\Repositories\AddressRepository;
use Modules\Site\Http\Controllers\Api\BaseApiController;

class AddressController extends BaseApiController
{
    /**
     * @var AddressRepository
     */
    private $address;

    public function __construct(AddressRepository $address)
    {
        parent::__construct();

        $this->address = $address;
    }

    public function index(Request $request)
    {
        try {
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);
            //Request to Repository
            $dataEntity = $this->address->getItemsBy($params);
            //Response
            $response = ["data" => AddressTransformer::collection($dataEntity)];
            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
        } catch (\Exception $e) {
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }
        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * show item
     * @param $criteria
     * @return mixed
     */
    public function show($criteria, Request $request)
    {
        try {
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);
            //Request to Repository
            $dataEntity = $this->address->getItem($criteria, $params);
            //Break if no found item
            if (!$dataEntity) throw new Exception('Item not found', 204);
            //Response
            $response = ["data" => new AddressTransformer($dataEntity)];
            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
        } catch (\Exception $e) {
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }
        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * create item
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
            $this->validateRequestApi(new CreateAddressRequest($data));
            //Create item
            $dataEntity = $this->address->create($data);
            //Response
            $response = ["data" => new AddressTransformer($dataEntity)];
            \DB::commit(); //Commit to Data Base
        } catch (\Exception $e) {
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }
        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * update item
     *
     * @param $criteria
     * @param Request $request
     * @return mixed
     */
    public function update($criteria, Request $request)
    {
        \DB::beginTransaction();
        try {

            $data = $request->input('attributes') ?? [];
            $this->validateRequestApi(new UpdateAddressRequest($data));
            $params = $this->getParamsRequest($request);
            $dataEntity = $this->address->getItem($criteria, $params);
            $this->address->update($dataEntity, $data);
            $response = ["data" => 'Item Updated'];
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * delete an item
     *
     * @param $criteria
     * @return mixed
     */
    public function delete($criteria, Request $request)
    {
        \DB::beginTransaction();
        try {
            $params = $this->getParamsRequest($request);
            $dataEntity = $this->address->getItem($criteria, $params);
            $this->address->destroy($dataEntity);
            $response = ["data" => "Item deleted"];
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }
        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }
}
