<?php

namespace App\Http\Controllers;

use App\Events\SendMail;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    /**
     * Display a listing of the resource for table.
     *
     * @return \Illuminate\Http\Response
     */
    public function allData(Request $request)
    {
        

        if(isset($request->sort)){
            $companies = Company::orderBy($request->sort,$request->order);
        }else{
            $companies = Company::orderBy('id','asc');            
        }

        if(isset($request->search)){
            $companies
                ->where('name','LIKE',"%$request->search%")
                ->orWhere('email','LIKE',"%$request->search%")
                ->orWhere('website','LIKE',"%$request->search%");
                
            $count = $companies->count();
        }else{
            $count = Company::count();           
        }

        $companies
        ->skip($request->offset)
        ->take($request->limit);
        
        return response()->json([
            'total'=>$count,
            'totalNotFiltered'=>Company::count(),
            'rows'=> $companies->get(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('companies.index');
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
    public function store(CompanyStoreRequest $request)
    {
        $validated = $request->validated();

        $logoName = isset($validated['logo']) ? time() . '.' . $validated['logo']->extension() : null;

        if(isset($validated['logo'])){
            $validated['logo']->storeAs('public', $logoName);
        }
        
        $company = new Company();
        $company->name = $validated['name'];
        $company->email = $validated['email'];
        $company->logo = $logoName;
        $company->website = isset($validated['website']) ? $validated['website'] : null;
        $res = $company->save();

        if($res){
            $details = [
                'title' => 'Mail from Elvin',
                'body' => 'New Company '. $company->name . ' is created by ' . Auth::user()->name . ' successfully!'
            ];
           
            SendMail::dispatch($details);
            
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
    public function edit(Company $company)
    {
        return view('companies.edit')->with('company',$company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request,Company $company)
    {
        
        $validated = $request->validated();

        $logoName = isset($validated['logo']) ? time() . '.' . $validated['logo']->extension() : null;

        if(isset($validated['logo'])){
            $validated['logo']->storeAs('public', $logoName);
        }
        
        $company->name = $validated['name'];
        $company->email = $validated['email'];
        $company->logo = $logoName;
        $company->website = isset($validated['website']) ? $validated['website'] : null;
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
    public function destroy(Company $company)
    {        
        $res = $company->delete();
        
        if($res){
            return response()->json(['success'=>200]);
        }else{
            return response()->json(['success'=>400]);
        }
    }
}