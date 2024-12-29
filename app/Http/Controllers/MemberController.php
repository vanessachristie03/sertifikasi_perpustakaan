<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function create()
    {
        return view('members.membership');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
        ]);

        Member::create($validatedData);

        return redirect()->route('books.index')->with('success', 'Membership registration successful!');
    }
    public function index()
{
    $members = Member::all();
    return view('members.index', compact('members'));
}

}
