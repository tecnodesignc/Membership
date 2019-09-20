<?php

namespace Modules\Membership\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Membership\Entities\Address;
use Modules\Membership\Http\Requests\CreateAddressRequest;
use Modules\Membership\Http\Requests\UpdateAddressRequest;
use Modules\Membership\Repositories\AddressRepository;
use Modules\Core\Http\Controllers\BasePublicController;

class AddressController extends BasePublicController
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

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $addresses = $this->address->all();

        return view('membership::fronted.addresses.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('membership::fronted.addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAddressRequest $request
     * @return Response
     */
    public function store(CreateAddressRequest $request)
    {
        $this->address->create($request->all());

        return redirect()->route('admin.membership.address.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('membership::addresses.title.addresses')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Address $address
     * @return Response
     */
    public function edit(Address $address)
    {
        return view('membership::fronted.addresses.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Address $address
     * @param  UpdateAddressRequest $request
     * @return Response
     */
    public function update(Address $address, UpdateAddressRequest $request)
    {
        $this->address->update($address, $request->all());

        return redirect()->route('admin.membership.address.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('membership::addresses.title.addresses')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Address $address
     * @return Response
     */
    public function destroy(Address $address)
    {
        $this->address->destroy($address);

        return redirect()->route('admin.membership.address.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('membership::addresses.title.addresses')]));
    }
}
