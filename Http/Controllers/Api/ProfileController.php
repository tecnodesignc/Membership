<?php

namespace Modules\Membership\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Membership\Entities\Profile;
use Modules\Membership\Http\Requests\CreateProfileRequest;
use Modules\Membership\Http\Requests\UpdateProfileRequest;
use Modules\Membership\Repositories\ProfileRepository;
use Modules\Site\Http\Controllers\Api\BaseApiController;

class ProfileController extends BaseApiController
{
    /**
     * @var ProfileRepository
     */
    private $profile;

    public function __construct(ProfileRepository $profile)
    {
        parent::__construct();

        $this->profile = $profile;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$profiles = $this->profile->all();

        return view('membership::admin.profiles.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('membership::admin.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProfileRequest $request
     * @return Response
     */
    public function store(CreateProfileRequest $request)
    {
        $this->profile->create($request->all());

        return redirect()->route('admin.membership.profile.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('membership::profiles.title.profiles')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Profile $profile
     * @return Response
     */
    public function edit(Profile $profile)
    {
        return view('membership::admin.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Profile $profile
     * @param  UpdateProfileRequest $request
     * @return Response
     */
    public function update(Profile $profile, UpdateProfileRequest $request)
    {
        $this->profile->update($profile, $request->all());

        return redirect()->route('admin.membership.profile.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('membership::profiles.title.profiles')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Profile $profile
     * @return Response
     */
    public function destroy(Profile $profile)
    {
        $this->profile->destroy($profile);

        return redirect()->route('admin.membership.profile.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('membership::profiles.title.profiles')]));
    }
}
