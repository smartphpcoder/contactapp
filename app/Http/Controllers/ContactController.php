<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $contacts = Contact::latestFirst()->paginate(10);

        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');

        return view("contacts.index", compact('contacts', 'companies'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $contact = new Contact();
        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');

        return view("contacts.create", compact('companies', 'contact'));
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'company_id' => 'required|exists:companies,id'
        ]);

        Contact::create($request->all());

        return redirect()->route('contacts.index')->with('message', 'Contact has been added successfully!');
    }

    /**
     * @param Contact $contact
     * @return View
     */
    public function edit(Contact $contact): View
    {
        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');

        return view("contacts.edit", compact('companies', 'contact'));
    }

    /**
     * @param Request $request
     * @param Contact $contact
     * @return RedirectResponse
     */
    public function update(Request $request, Contact $contact): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'company_id' => 'required|exists:companies,id'
        ]);

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
