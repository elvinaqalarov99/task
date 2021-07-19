<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $employees = Employee::orderBy('id','desc')->get();
        return view('employees.index')->with('employees',$employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::orderBy('id','desc')->get();
        return view('employees.create')->with('companies',$companies);
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
            'firstname'=> 'required|string',
            'lastname'=>'required|string',
            'email'=>'required|email|unique:employees,email',
            'phone'=> 'nullable|string|unique:employees,phone',
            'company'=>'nullable|integer'
        ]);

        if ($validator->fails()){
            return response()->json(['success'=>400,'errors'=>$validator->errors()]);
        }
        
        $employee = new Employee();
        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->company_id = $request->company;
        $res = $employee->save();

        if($res){
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
        $employee = Employee::find($id);
        $companies = Company::orderBy('id','desc')->get();
        return view('employees.edit',compact('employee','companies'));
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
            'firstname'=> 'required|string',
            'lastname'=>'required|string',
            'email'=>'email|unique:employees,email',
            'phone'=> 'sometimes|string|unique:employees,phone',
            'company'=>'required|integer'
        ]);

        if ($validator->fails()){
            return response()->json(['success'=>400,'errors'=>$validator->errors()]);
        }
        
        $employee = Employee::find($id);
        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->company_id = $request->company;
        $res = $employee->save();

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
        $employee = Employee::find($id);
        
        $res = $employee->delete();
        
        if($res){
            return response()->json(['success'=>200]);
        }else{
            return response()->json(['success'=>400]);
        }
    }
}