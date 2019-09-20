<?php

namespace Modules\Membership\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Membership\Entities\Workstation;
use Modules\Membership\Http\Requests\CreateWorkstationRequest;
use Modules\Membership\Http\Requests\UpdateWorkstationRequest;
use Modules\Membership\Repositories\WorkstationRepository;
use Modules\Core\Http\Controllers\Frontend\BasePublicController;

class WorkstationController extends BasePublicController
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$workstations = $this->workstation->all();

        return view('membership::fronted.workstations.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('membership::fronted.workstations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateWorkstationRequest $request
     * @return Response
     */
    public function store(CreateWorkstationRequest $request)
    {
        $this->workstation->create($request->all());

        return redirect()->route('admin.membership.workstation.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('membership::workstations.title.workstations')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Workstation $workstation
     * @return Response
     */
    public function edit(Workstation $workstation)
    {
        return view('membership::fronted.workstations.edit', compact('workstation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Workstation $workstation
     * @param  UpdateWorkstationRequest $request
     * @return Response
     */
    public function update(Workstation $workstation, UpdateWorkstationRequest $request)
    {
        $this->workstation->update($workstation, $request->all());

        return redirect()->route('admin.membership.workstation.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('membership::workstations.title.workstations')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Workstation $workstation
     * @return Response
     */
    public function destroy(Workstation $workstation)
    {
        $this->workstation->destroy($workstation);

        return redirect()->route('admin.membership.workstation.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('membership::workstations.title.workstations')]));
    }
}
