<?php

namespace Modules\Contact\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Rarv\Table\TableBuilder;
use Modules\Contact\Entities\Contact;
use Modules\Contact\Tables\ContactsTable;
use Modules\Contact\Imports\ContactImport;
use Modules\Contact\Entities\ContactAddress;
use Modules\Contact\Repositories\ContactRepository;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\Contact\Http\Requests\CreateContactRequest;
use Modules\Contact\Http\Requests\UpdateContactRequest;

use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ContactController extends AdminBaseController
{
    use ValidatesRequests;

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
    public function index(Request $request, TableBuilder $builder)
    {
        return $builder->setTable(new ContactsTable('contact.contacts'))->view();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $contact_type = config('asgard.contact.contact-type');
        $salutations  = config('asgard.contact.user-salutation');

        return view('contact::admin.contacts.create', compact('contact_type', 'salutations'));
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

        $rules = [
            'name'         => 'required',
            'address'      => 'nullable|min:3',
            'billingphone' => 'nullable|min:10',
        ];

        if (setting('contact::shipping_details') == 1) {
            $rules = array_merge(
                $rules,
                [
                    'sname'         => 'required',
                    'saddress'      => 'nullable|min:3',
                    'sbillingphone' => 'nullable|min:10',
                ]
            );
        }

        $this->validate($request, $rules);

        $contact = $this->contact->create($request->all());

        $contactaddresss               = new ContactAddress();
        $contactaddresss->contactId    = $contact->id;
        $contactaddresss->type         = 'billing';
        $contactaddresss->name         = $request->name;
        $contactaddresss->address      = $request->get('address', '');
        $contactaddresss->city         = $request->city;
        $contactaddresss->state        = $request->state;
        $contactaddresss->zip_code     = $request->zip_code;
        $contactaddresss->country      = $request->country;
        $contactaddresss->fax          = $request->state;
        $contactaddresss->billingphone = $request->billingphone;
        $contactaddresss->save();

        if (setting('contact::shipping_details') == 1) {
            $shipping_details               = new ContactAddress();
            $shipping_details->contactId    = $contact->id;
            $shipping_details->type         = 'shipping';
            $shipping_details->name         = $request->sname;
            $shipping_details->address      = $request->get('saddress', '');
            $shipping_details->city         = $request->scity;
            $shipping_details->state        = $request->sstate;
            $shipping_details->zip_code     = $request->szip_code;
            $shipping_details->country      = $request->scountry;
            $shipping_details->fax          = $request->sstate;
            $shipping_details->billingphone = $request->sbillingphone;
            $shipping_details->save();
        }

        $messages = trans('core::core.messages.resource created', ['name' => trans('contact::contacts.title.contacts')]);

        return redirect()->route('admin.contact.contact.index', ['type' => $contact->user_type])
            ->withSuccess($messages);
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
        $salutations            = config('asgard.contact.user-salutation');

        return view('contact::admin.contacts.edit', compact('contact', 'billingConatctAddress', 'shippingConatctAddress', 'contact_type', 'salutations'));
    }

    /**
     * contactAddress
     * Update the specified resource in storage.
     *
     * @param  Contact              $contact
     * @param  UpdateContactRequest $request
     * @return Response
     */
    public function update(Contact $contact, UpdateContactRequest $request)
    {
        $rules = [
            'name'         => 'required',
            'address'      => 'nullable|min:3',
            'billingphone' => 'nullable|min:10',
        ];

        if (setting('contact::shipping_details') == 1) {
            $rules = array_merge(
                $rules,
                [
                    'sname'         => 'required',
                    'saddress'      => 'nullable|min:3',
                    'sbillingphone' => 'nullable|min:10',
                ]
            );
        }

        $this->validate($request, $rules);

        $contact = $this->contact->update($contact, $request->all());

        $billingConatctAddress = $contact->billingAddress();

        if (!$billingConatctAddress) {
            $billingConatctAddress       = new ContactAddress;
            $billingConatctAddress->type = 'billing';
        }

        $billingConatctAddress->name         = $request->name;
        $billingConatctAddress->address      = $request->address;
        $billingConatctAddress->city         = $request->city;
        $billingConatctAddress->state        = $request->state;
        $billingConatctAddress->zip_code     = $request->zip_code;
        $billingConatctAddress->country      = $request->country;
        $billingConatctAddress->fax          = $request->fax;
        $billingConatctAddress->billingphone = $request->billingphone;
        $billingConatctAddress->save();

        if (setting('contact::shipping_details') == 1) {
            $shippingConatctAddress               = ContactAddress::where('contactId', $contact->id)->where('type', 'shipping')->first();
            $shippingConatctAddress->name         = $request->sname;
            $shippingConatctAddress->address      = $request->saddress;
            $shippingConatctAddress->city         = $request->scity;
            $shippingConatctAddress->state        = $request->sstate;
            $shippingConatctAddress->zip_code     = $request->szip_code;
            $shippingConatctAddress->country      = $request->scountry;
            $shippingConatctAddress->fax          = $request->sfax;
            $shippingConatctAddress->billingphone = $request->sbillingphone;
            $shippingConatctAddress->save();
        }

        $message = trans('core::core.messages.resource updated', ['name' => trans('contact::contacts.title.contacts')]);

        return redirect()->route('admin.contact.contact.index', ['type' => $contact->user_type])
            ->withSuccess($message);
    }

    public function show(Contact $contact)
    {
        if (!is_module_enabled('Accounting')) {
            return redirect()->route('admin.contact.contact.index', ['type' => $contact->user_type])
                ->withError('Accounting module is disable');
        }
        $invoices          = null;
        $bills             = null;
        $customer_products = null;

        $type                   = $contact->user_type;
        $billingConatctAddress  = ContactAddress::where('contactId', $contact->id)->where('type', 'billing')->first();
        $shippingConatctAddress = ContactAddress::where('contactId', $contact->id)->where('type', 'shipping')->first();
        $contact_type           = config('asgard.contact.contact-type');
        $salutations            = config('asgard.contact.user-salutation');

        if ($contact->user_type == 'customer') {
            $invoices          = $contact->invoices()->get();
            $customer_products = DB::table('contact__contacts')
                ->where('accounting__invoices.customer_id', $contact->id)
                ->join('accounting__invoices', 'contact__contacts.id', 'accounting__invoices.customer_id')
                ->join('accounting__invoiceitems', 'accounting__invoices.id', 'accounting__invoiceitems.invoice_id')
                ->join('product__products', 'accounting__invoiceitems.item_id', 'product__products.id')
                ->select('accounting__invoiceitems.*')
                ->get();
        }

        if ($contact->user_type == 'vendor') {
            $bills = $contact->bills()->get();

            $customer_products = DB::table('contact__contacts')
                ->where('accounting__bills.vendor_id', $contact->id)
                ->join('accounting__bills', 'contact__contacts.id', 'accounting__bills.vendor_id')
                ->join('accounting__billitems', 'accounting__bills.id', 'accounting__billitems.bill_id')
                ->join('product__products', 'accounting__billitems.item_id', 'product__products.id')
                ->select('accounting__billitems.*')
                ->get();
        }
        return view('contact::admin.contacts.show', compact('contact', 'billingConatctAddress', 'shippingConatctAddress', 'contact_type', 'salutations', 'invoices', 'type', 'customer_products', 'bills'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Contact $contact
     * @return Response
     */
    public function destroy(Contact $contact)
    {
        try {
            $this->contact->destroy($contact);
        } catch (\Exception $e) {
            return redirect()->route('admin.contact.contact.index')
                ->withError('Not allowed to delete! Customer has invoice or bill');
        }

        return redirect()->route('admin.contact.contact.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('contact::contacts.title.contacts')]));
    }

    public function importContact()
    {
        return view('contact::admin.contacts.import');
    }
    public function postImportContact(Request $request)
    {
        $file = $request->file('contact');

        Excel::import(new ContactImport, $file);

        return redirect()->route('admin.contact.contacts.index')->withSuccess('Contacts has been imported successfully.');
    }
}
