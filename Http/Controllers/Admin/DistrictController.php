<?php

namespace Modules\Membership\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Membership\Entities\District;
use Modules\Membership\Http\Requests\CreateDistrictRequest;
use Modules\Membership\Http\Requests\UpdateDistrictRequest;
use Modules\Membership\Repositories\DistrictRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class DistrictController extends AdminBaseController
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$districts = $this->district->all();

        return view('membership::admin.districts.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('membership::admin.districts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateDistrictRequest $request
     * @return Response
     */
    public function store(CreateDistrictRequest $request)
    {
        $this->district->create($request->all());

        return redirect()->route('admin.membership.district.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('membership::districts.title.districts')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  District $district
     * @return Response
     */
    public function edit(District $district)
    {
        return view('membership::admin.districts.edit', compact('district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  District $district
     * @param  UpdateDistrictRequest $request
     * @return Response
     */
    public function update(District $district, UpdateDistrictRequest $request)
    {
        $this->district->update($district, $request->all());

        return redirect()->route('admin.membership.district.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('membership::districts.title.districts')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  District $district
     * @return Response
     */
    public function destroy(District $district)
    {
        $this->district->destroy($district);

        return redirect()->route('admin.membership.district.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('membership::districts.title.districts')]));
    }
}
