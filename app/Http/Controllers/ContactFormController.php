<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    // public function index()
    // {
    //     $contacts = Contact::orderBy('id', 'asc')->get();
    //     return view('contact.index', compact('contacts'));
    // }


    public function create()
    {
        return view('contact.create');
    }


    public function store(Request $request)
    {
        $inputs = $request->validate([
            'name' => 'required|string|max:30',
            'title'=>'required|max:50',
            'text'=>'required|string|max:500',
            'email'=>'required|email|max:255',
        ]);

        Contact::create($inputs);
        return back()->with('message', 'お問合せを送信しました。');
    }
}
