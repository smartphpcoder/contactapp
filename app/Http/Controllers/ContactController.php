<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\StoreContactRequest;
use App\Http\Requests\Contact\UpdateContactRequest;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $contacts = auth()->user()->contacts()->latestFirst()->paginate(10);

        $companies = Company::userCompanies();

        return view("contacts.index", compact('contacts', 'companies'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $contact = new Contact();
        $companies = Company::userCompanies();

        return view("contacts.create", compact('companies', 'contact'));
    }


    /**
     * @param StoreContactRequest $request
     * @return RedirectResponse
     */
    public function store(StoreContactRequest $request): RedirectResponse
    {

        $request->user()->contacts()->create($request->all());

        return redirect()->route('contacts.index')->with('message', 'Contact has been added successfully!');
    }

    /**
     * @param Contact $contact
     * @return View
     */
    public function edit(Contact $contact): View
    {
        $companies = Company::userCompanies();

        return view("contacts.edit", compact('companies', 'contact'));
    }

    /**
     * @param UpdateContactRequest $request
     * @param Contact $contact
     * @return RedirectResponse
     */
    public function update(UpdateContactRequest $request, Contact $contact): RedirectResponse
    {
        $contact->update($request->all());

        return redirect()->route('contacts.index')->with('message', 'Contact has been updated successfully!');
    }

    /**
     * @param Contact $contact
     * @return View
     */
    public function show(Contact $contact): View
    {
        return view("contacts.show", compact('contact'));
    }

    /**
     * @param Contact $contact
     * @return RedirectResponse
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return back()->with('message', 'Contact has been deleted successfully!');
    }
}
