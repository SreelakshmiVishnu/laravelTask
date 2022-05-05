<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Candidate;
use Hash;

class CandidateController extends Controller
{
    public function store()
    {
        return view('can_register');
    } 
    public function view()
    {
        $data = Candidate::all();
        //dd($data);
        return view('can_view',compact('data'));
    }  
    public function storeData(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'resume' => 'required',
        ]);
    
        Candidate::create($request->all());
     
        return view('can_register')
                        ->with('success','created successfully.');
    }

    public function show(Candidate $candidate)
    {
        return view('candidate_show',compact('candidate'));
    }
    public function edit(Candidate $candidate)
    {
        return view('candidate_edit',compact('candidate'));
    }



    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
    
        return view('dashboard');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'resume' => 'required',
            ]);
            $candidate = Candidate::find($id);
            $candidate->name = $request->name;
            $candidate->email = $request->email;
            $candidate->phone = $request->phone;
            $candidate->dob = $request->dob;
            $candidate->address = $request->address;
            $candidate->resume = $request->resume;
            $candidate->save();
     
        return view('dashboard')
                        ->with('success','created successfully.');
    }

    
}
