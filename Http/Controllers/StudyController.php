<?php

namespace Modules\Membership\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Membership\Entities\Study;
use Modules\Membership\Http\Requests\CreateStudyRequest;
use Modules\Membership\Http\Requests\UpdateStudyRequest;
use Modules\Membership\Repositories\StudyRepository;
use Modules\Core\Http\Controllers\Frontend\BasePublicController;

class StudyController extends BasePublicController
{
    /**
     * @var StudyRepository
     */
    private $study;

    public function __construct(StudyRepository $study)
    {
        parent::__construct();

        $this->study = $study;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$studies = $this->study->all();

        return view('membership::fronted.studies.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('membership::fronted.studies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateStudyRequest $request
     * @return Response
     */
    public function store(CreateStudyRequest $request)
    {
        $this->study->create($request->all());

        return redirect()->route('admin.membership.study.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('membership::studies.title.studies')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Study $study
     * @return Response
     */
    public function edit(Study $study)
    {
        return view('membership::fronted.studies.edit', compact('study'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Study $study
     * @param  UpdateStudyRequest $request
     * @return Response
     */
    public function update(Study $study, UpdateStudyRequest $request)
    {
        $this->study->update($study, $request->all());

        return redirect()->route('admin.membership.study.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('membership::studies.title.studies')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Study $study
     * @return Response
     */
    public function destroy(Study $study)
    {
        $this->study->destroy($study);

        return redirect()->route('admin.membership.study.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('membership::studies.title.studies')]));
    }
}
