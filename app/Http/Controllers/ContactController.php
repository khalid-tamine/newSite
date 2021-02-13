<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;

class ContactController extends Controller
{
    public function newContact(){
        $newContact = new Contact();
        $newContact->name = "test";
        $newContact->email = "tester";
        $newContact->message = "testerrr";

        $newContact->save();

    }
    public function  listContacts() {
        $contacts = Contact::all();

        return view('contacts' , ['contacts' => $contacts]);
    }

}
