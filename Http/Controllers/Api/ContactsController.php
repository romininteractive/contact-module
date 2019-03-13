<?php

namespace Modules\Contact\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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

		$contacts = $contacts->get();
		$contact_val = [];
		foreach ($contacts as $key => $contact) {
			$contact_val[$key]['value'] = $contact['full_name_phone'];
			$contact_val[$key]['link'] = $contact['full_name_phone'];			
		}
		return $contact_val;
	}

	public function show(Request $request, $id)
	{
		return $this->contactsRepo->find($id);
	}

    public function store(request $request)
    {
    	$input = $request->all();
    	$input['salutation'] = 'mr';
    	$input['user_type'] = 'customer';    	
    	// $input['last_name'] = $input['name'];
        $contact = $this->contactsRepo->create($input);

        return response()->json([
            'errors' => false,
            'message' => trans('contact created'),
            'data' => $contact,
            'fullnamephone' => $contact->full_name_phone,
        ]);
    }	
}