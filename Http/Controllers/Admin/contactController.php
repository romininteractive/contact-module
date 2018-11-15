<?php

namespace Modules\Contact\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Contact\Entities\Contact;
use Modules\Contact\Entities\contactAddress;
use Modules\Contact\Http\Requests\CreateContactRequest;
use Modules\Contact\Http\Requests\UpdateContactRequest;
use Modules\Contact\Repositories\ContactRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ContactController extends AdminBaseController
{
    /**
     * @var ContactRepository
     */
    private $contact;

    public function __construct(ContactRepository $contact)
    {
        parent::__construct();

        $this->contact = $contact;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $contacts = $this->contact->all();

        return view('contact::admin.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('contact::admin.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateContactRequest $request
     * @return Response
     */
    public function store(CreateContactRequest $request)
    {
        $conatct = $this->contact->create($request->all());
    
        
        $contactaddresss               = new contactAddress();
        $contactaddresss->contactId    = $conatct->id;
        $contactaddresss->type         = $request->dtype;
        $contactaddresss->name         = $request->name;
        $contactaddresss->address      = $request->address;
        $contactaddresss->city         = $request->city;
        $contactaddresss->state        = $request->state;
        $contactaddresss->zip_code     = $request->zip_code;
        $contactaddresss->coutry       = $request->coutry;
        $contactaddresss->fax          = $request->state;
        $contactaddresss->billingphone = $request->billingphone;
        $shipping_details              = new contactAddress();

        $shipping_details->contactId    = $conatct->id;
        $shipping_details->type         = $request->sdtype;
        $shipping_details->name         = $request->sname;
        $shipping_details->address      = $request->saddress;
        $shipping_details->city         = $request->scity;
        $shipping_details->state        = $request->sstate;
        $shipping_details->zip_code     = $request->szip_code;
        $shipping_details->coutry       = $request->scoutry;
        $shipping_details->fax          = $request->sstate;
        $shipping_details->billingphone = $request->sbillingphone;
        $contactaddresss->save();
        $shipping_details->save();
        /* dd($contactaddresss, $shipping_details);*/

        return redirect()->route('admin.contact.contact.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('contact::contacts.title.contacts')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Contact $contact
     * @return Response
     */
    public function edit(Contact $contact)
    {
        $conatctAddress = contactAddress::where('id', '=', $contact->id)->first();

        return view('contact::admin.contacts.edit', compact('contact', 'conatctAddress'));
    }

    /**contactAddress
     * Update the specified resource in storage.
     *
     * @param  Contact $contact
     * @param  UpdateContactRequest $request
     * @return Response
     */
    public function update(Contact $contact, UpdateContactRequest $request)
    {
        $contact = $this->contact->update($contact, $request->all());

        $name          = $request->name;
        $address       = $request->address;
        $city          = $request->city;
        $state         = $request->state;
        $zip_code      = $request->zip_code;
        $coutry        = $request->coutry;
        $fax           = $request->state;
        $billingphone  = $request->billingphone;
        $sname         = $request->sname;
        $saddress      = $request->saddress;
        $scity         = $request->scity;
        $sstate        = $request->sstate;
        $szip_code     = $request->szip_code;
        $scoutry       = $request->scoutry;
        $sfax          = $request->sstate;
        $sbillingphone = $request->sbillingphone;

        DB::table('contact__contactaddresses')
            ->where('id', $contact->id)
            ->update(['name' => $name,'city' => $city ,'address' => $address,'state' => $state,'zip_code' => $zip_code,'coutry' => $coutry,'billingphone' => $billingphone]);

        return redirect()->route('admin.contact.contact.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('contact::contacts.title.contacts')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Contact $contact
     * @return Response
     */
    public function destroy(Contact $contact)
    {
        $this->contact->destroy($contact);

        return redirect()->route('admin.contact.contact.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('contact::contacts.title.contacts')]));
    }
}
