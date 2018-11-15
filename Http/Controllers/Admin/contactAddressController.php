<?php

namespace Modules\Contact\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Contact\Entities\ContactAddress;
use Modules\Contact\Http\Requests\CreateContactAddressRequest;
use Modules\Contact\Http\Requests\UpdateContactAddressRequest;
use Modules\Contact\Repositories\ContactAddressRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ContactAddressController extends AdminBaseController
{
    /**
     * @var ContactAddressRepository
     */
    private $contactaddress;

    public function __construct(ContactAddressRepository $contactaddress)
    {
        parent::__construct();

        $this->contactaddress = $contactaddress;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$contactaddresses = $this->contactaddress->all();

        return view('contact::admin.contactaddresses.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('contact::admin.contactaddresses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateContactAddressRequest $request
     * @return Response
     */
    public function store(CreateContactAddressRequest $request)
    {
        $this->contactaddress->create($request->all());

        return redirect()->route('admin.contact.contactaddress.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('contact::contactaddresses.title.contactaddresses')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ContactAddress $contactaddress
     * @return Response
     */
    public function edit(ContactAddress $contactaddress)
    {
        return view('contact::admin.contactaddresses.edit', compact('contactaddress'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ContactAddress $contactaddress
     * @param  UpdateContactAddressRequest $request
     * @return Response
     */
    public function update(ContactAddress $contactaddress, UpdateContactAddressRequest $request)
    {
        $this->contactaddress->update($contactaddress, $request->all());

        return redirect()->route('admin.contact.contactaddress.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('contact::contactaddresses.title.contactaddresses')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ContactAddress $contactaddress
     * @return Response
     */
    public function destroy(ContactAddress $contactaddress)
    {
        $this->contactaddress->destroy($contactaddress);

        return redirect()->route('admin.contact.contactaddress.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('contact::contactaddresses.title.contactaddresses')]));
    }
}
