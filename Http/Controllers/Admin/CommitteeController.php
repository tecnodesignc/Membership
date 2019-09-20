<?php

namespace Modules\Membership\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Membership\Entities\Committee;
use Modules\Membership\Http\Requests\CreateCommitteeRequest;
use Modules\Membership\Http\Requests\UpdateCommitteeRequest;
use Modules\Membership\Repositories\CommitteeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CommitteeController extends AdminBaseController
{
    /**
     * @var CommitteeRepository
     */
    private $committee;

    public function __construct(CommitteeRepository $committee)
    {
        parent::__construct();

        $this->committee = $committee;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$committees = $this->committee->all();

        return view('membership::admin.committees.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('membership::admin.committees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCommitteeRequest $request
     * @return Response
     */
    public function store(CreateCommitteeRequest $request)
    {
        $this->committee->create($request->all());

        return redirect()->route('admin.membership.committee.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('membership::committees.title.committees')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Committee $committee
     * @return Response
     */
    public function edit(Committee $committee)
    {
        return view('membership::admin.committees.edit', compact('committee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Committee $committee
     * @param  UpdateCommitteeRequest $request
     * @return Response
     */
    public function update(Committee $committee, UpdateCommitteeRequest $request)
    {
        $this->committee->update($committee, $request->all());

        return redirect()->route('admin.membership.committee.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('membership::committees.title.committees')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Committee $committee
     * @return Response
     */
    public function destroy(Committee $committee)
    {
        $this->committee->destroy($committee);

        return redirect()->route('admin.membership.committee.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('membership::committees.title.committees')]));
    }
}
