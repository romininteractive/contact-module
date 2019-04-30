<?php

namespace Modules\Contact\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Contact\Entities\Contact;
use Modules\Contact\Repositories\ContactRepository;

/**
 * @author Daksh Mehta <dm@rimail.in>
 */
class ContactsController extends Controller
{
    private $contactsRepo;

    public function __construct(ContactRepository $contactsRepo)
    {
        $this->contactsRepo = $contactsRepo;
    }

    public function index(Request $request)
    {
        $contacts = $this->contactsRepo->allWithBuilder();

        if ($request->has('type') && $request->get('type') !=null) {
            $type = $request->get('type');
            $contacts = $contacts->whereUserType($type);
        }

        $contacts = $contacts->get();
        return $contacts;
    }

    public function show(Request $request, $id)
    {
        return $this->contactsRepo->find($id);
    }

    public function store(request $request)
    {
        $input = $request->all();

        $input['salutation'] = 'mr';
        $contact = $this->contactsRepo->create($input);

        return response()->json([
            'errors' => false,
            'message' => trans('contact created'),
            'data' => $contact,
            'fullnamephone' => $contact->full_name_phone,
        ]);
    }
}
