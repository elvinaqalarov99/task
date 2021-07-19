<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('id','desc')->get();
        return view('companies.index')->with('companies',$companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required|string',
            'email'=>'required|email|unique:companies,email',
            'logo'=> 'image|mimes:png,jpg,jpeg|dimensions:min_width=100,min_height=100|max:2048',
            'website'=>'nullable|string'
        ]);

        if ($validator->fails()){
            return response()->json(['success'=>400,'errors'=>$validator->errors()]);
        }
        
        $company = new Company();

        $logoName = $request->hasFile('logo') ? time() . '.' . $request->logo->extension() : '';

        if($request->hasFile('logo')){
            $request->logo->storeAs('public', $logoName);
        }
        
        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo = $logoName;
        $company->website = $request->website;
        $res = $company->save();

        if($res){
            $details = [
                'title' => 'Mail from Elvin',
                'body' => 'New Company '. $company->name . ' is created by ' . Auth::user()->name . ' successfully!'
            ];
           
            Mail::to('elvin.aqalarov2@gmail.com')->send(new \App\Mail\NewCompanyMail($details));
           
            return response()->json(['success'=>200]);
        }else{
            return response()->json(['success'=>400]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('companies.edit')->with('company',$company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required|string',
            // add an {id} to edit unique field
            'email'=>'required|email|unique:companies,email,'.$id,
            'logo'=> 'image|mimes:png,jpg,jpeg|dimensions:min_width=100,min_height=100|max:2048',
            'website'=>'nullable|string'
        ]);

        if ($validator->fails()){
            return response()->json(['success'=>400,'errors'=>$validator->errors()]);
        }
        
        $company = Company::find($id);

        $logoName = $request->hasFile('logo') ? time() . '.' . $request->logo->extension() : $company->logo;

        if($request->hasFile('logo')){
            $request->logo->storeAs('public', $logoName);
        }
        
        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo = $logoName;
        $company->website = $request->website;
        $res = $company->save();

        if($res){
            return response()->json(['success'=>200]);
        }else{
            return response()->json(['success'=>400]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        
        $res = $company->delete();
        
        if($res){
            return response()->json(['success'=>200]);
        }else{
            return response()->json(['success'=>400]);
        }
    }
}