<?php

namespace Modules\Membership\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Membership\Entities\Congregation;
use Modules\Membership\Http\Requests\CreateCongregationRequest;
use Modules\Membership\Http\Requests\UpdateCongregationRequest;
use Modules\Membership\Repositories\CongregationRepository;
use Modules\Site\Http\Controllers\Api\BaseApiController;

class CongregationController extends BaseApiController
{
    /**
     * @var CongregationRepository
     */
    private $congregation;

    public function __construct(CongregationRepository $congregation)
    {
        parent::__construct();

        $this->congregation = $congregation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$congregations = $this->congregation->all();

        return view('membership::admin.congregations.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('membership::admin.congregations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCongregationRequest $request
     * @return Response
     */
    public function store(CreateCongregationRequest $request)
    {
        $this->congregation->create($request->all());

        return redirect()->route('admin.membership.congregation.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('membership::congregations.title.congregations')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Congregation $congregation
     * @return Response
     */
    public function edit(Congregation $congregation)
    {
        return view('membership::admin.congregations.edit', compact('congregation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Congregation $congregation
     * @param  UpdateCongregationRequest $request
     * @return Response
     */
    public function update(Congregation $congregation, UpdateCongregationRequest $request)
    {
        $this->congregation->update($congregation, $request->all());

        return redirect()->route('admin.membership.congregation.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('membership::congregations.title.congregations')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Congregation $congregation
     * @return Response
     */
    public function destroy(Congregation $congregation)
    {
        $this->congregation->destroy($congregation);

        return redirect()->route('admin.membership.congregation.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('membership::congregations.title.congregations')]));
    }
}
