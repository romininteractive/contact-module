<?php

namespace Modules\Contact\Http\Controllers\Admin;

use DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Contact\Entities\Contact;
use Modules\Contact\Entities\ContactAddress;
use Modules\Contact\Http\Requests\CreateContactRequest;
use Modules\Contact\Http\Requests\UpdateContactRequest;
use Modules\Contact\Repositories\ContactRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Nwidart\Modules\config;

class ContactController extends AdminBaseController
{
    /**
     * @var ContactRepository
     */
    private $contact;
    use ValidatesRequests;
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
        $contact_type = config('asgard.contact.contact-type');
        $salutation = config('asgard.core.user-salution');        

        $user_salution = Collect($salutation);
        return view('contact::admin.contacts.create', compact('contact_type','user_salution'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateContactRequest $request
     * @return Response
     */
    public function store(CreateContactRequest $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'name'          => 'required',
            'sname'         => 'required',
            'address'       => 'required',
            'saddress'      => 'required',
            'billingphone'  => 'required|min:10',
            'sbillingphone' => 'required|min:10',
        ]);

        $conatct = $this->contact->create($request->all());

        $contactaddresss               = new ContactAddress();
        $contactaddresss->contactId    = $conatct->id;
        $contactaddresss->type         = 'billing';
        $contactaddresss->name         = $request->name;
        $contactaddresss->address      = $request->address;
        $contactaddresss->city         = $request->city;
        $contactaddresss->state        = $request->state;
        $contactaddresss->zip_code     = $request->zip_code;
        $contactaddresss->country      = $request->country;
        $contactaddresss->fax          = $request->state;
        $contactaddresss->billingphone = $request->billingphone;

        $shipping_details              = new ContactAddress();
        $shipping_details->contactId    = $conatct->id;
        $shipping_details->type         = 'shipping';
        $shipping_details->name         = $request->sname;
        $shipping_details->address      = $request->saddress;
        $shipping_details->city         = $request->scity;
        $shipping_details->state        = $request->sstate;
        $shipping_details->zip_code     = $request->szip_code;
        $shipping_details->country      = $request->scountry;
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
        // $conatctAddress = contactAddress::where('id', $contact->id)->first();
        $billingConatctAddress  = ContactAddress::where('contactId', $contact->id)->where('type', 'billing')->first();
        $shippingConatctAddress = ContactAddress::where('contactId', $contact->id)->where('type', 'shipping')->first();
        $contact_type           = config('asgard.contact.contact-type');
        $salutation = config('asgard.core.user-salution');        

        $user_salution = Collect($salutation);

        return view('contact::admin.contacts.edit', compact('contact', 'billingConatctAddress', 'shippingConatctAddress', 'contact_type','user_salution'));
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
        // dd($request);
        $this->validate($request, [
            'name'          => 'required',
            'sname'         => 'required',
            'address'       => 'required',
            'saddress'      => 'required',
            'billingphone'  => 'required|min:10',
            'sbillingphone' => 'required|min:10',
        ]);

        $contact = $this->contact->update($contact, $request->all());

        $billingConatctAddress = ContactAddress::where('contactId', $contact->id)->where('type', 'billing')->first();

        $shippingConatctAddress = ContactAddress::where('contactId', $contact->id)->where('type', 'shipping')->first();

        $billingConatctAddress->name         = $request->name;
        $billingConatctAddress->address      = $request->address;
        $billingConatctAddress->city         = $request->city;
        $billingConatctAddress->state        = $request->state;
        $billingConatctAddress->zip_code     = $request->zip_code;
        $billingConatctAddress->country      = $request->country;
        $billingConatctAddress->fax        = $request->fax;
        $billingConatctAddress->billingphone = $request->billingphone;
        $billingConatctAddress->save();

        $shippingConatctAddress->name         = $request->sname;
        $shippingConatctAddress->address      = $request->saddress;
        $shippingConatctAddress->city         = $request->scity;
        $shippingConatctAddress->state        = $request->sstate;
        $shippingConatctAddress->zip_code     = $request->szip_code;
        $shippingConatctAddress->country      = $request->scountry;
        $shippingConatctAddress->fax        = $request->sfax;
        $shippingConatctAddress->billingphone = $request->sbillingphone;
        $shippingConatctAddress->save();

        // DB::table('contact__contactaddresses')
        //     ->where('id', $contact->id)
        //     ->update(['name' => $name, 'city' => $city, 'address' => $address, 'state' => $state, 'zip_code' => $zip_code, 'country' => $country, 'billingphone' => $billingphone]);

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
