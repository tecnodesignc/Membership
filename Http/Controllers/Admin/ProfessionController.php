<?php

namespace Modules\Membership\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Membership\Entities\Profession;
use Modules\Membership\Http\Requests\CreateProfessionRequest;
use Modules\Membership\Http\Requests\UpdateProfessionRequest;
use Modules\Membership\Repositories\ProfessionRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ProfessionController extends AdminBaseController
{
    /**
     * @var ProfessionRepository
     */
    private $profession;

    public function __construct(ProfessionRepository $profession)
    {
        parent::__construct();

        $this->profession = $profession;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$professions = $this->profession->all();

        return view('membership::admin.professions.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('membership::admin.professions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProfessionRequest $request
     * @return Response
     */
    public function store(CreateProfessionRequest $request)
    {
        $this->profession->create($request->all());

        return redirect()->route('admin.membership.profession.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('membership::professions.title.professions')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Profession $profession
     * @return Response
     */
    public function edit(Profession $profession)
    {
        return view('membership::admin.professions.edit', compact('profession'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Profession $profession
     * @param  UpdateProfessionRequest $request
     * @return Response
     */
    public function update(Profession $profession, UpdateProfessionRequest $request)
    {
        $this->profession->update($profession, $request->all());

        return redirect()->route('admin.membership.profession.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('membership::professions.title.professions')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Profession $profession
     * @return Response
     */
    public function destroy(Profession $profession)
    {
        $this->profession->destroy($profession);

        return redirect()->route('admin.membership.profession.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('membership::professions.title.professions')]));
    }
}
