<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    /**
     * Display a listing of the resource for table.
     *
     * @return \Illuminate\Http\Response
     */
    public function allData(Request $request)
    {
        if( isset($request->sort)){
            $employees = Employee::orderBy($request->sort,$request->order);
        }else{
            $employees = Employee::orderBy('id','asc');            
        }

        if( isset($request->search)){
            $employees
                ->where('firstname','LIKE',"%$request->search%")
                ->orWhere('lastname','LIKE',"%$request->search%")
                ->orWhere('email','LIKE',"%$request->search%")
                ->orWhere('phone','LIKE',"%$request->search%");
                
            $count = $employees->count();
        }else{
            $count = Employee::count();           
        }

        $employees
        ->skip($request->offset)
        ->take($request->limit);
        
        return response()->json([
            'total'=>$count,
            'totalNotFiltered'=>Employee::count(),
            'rows'=> $employees->get(),
        ]);
    }

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
    public function store(EmployeeStoreRequest $request)
    {
        $validated = $request->validated();
        $employee = new Employee();
        $employee->firstname = $validated['firstname'];
        $employee->lastname = $validated['lastname'];
        $employee->phone = $validated['phone'];
        $employee->email = $validated['email'];
        $employee->company_id = isset($validated['company']) ? $validated['company'] : null;
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
    public function edit(Employee $employee)
    {
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
    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $validated = $request->validated();

        $employee->firstname = $validated['firstname'];
        $employee->lastname = $validated['lastname'];
        $employee->phone = $validated['phone'];
        $employee->email = $validated['email'];
        $employee->company_id = isset($validated['company']) ? $validated['company'] : null;
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
    public function destroy(Employee $employee)
    {        
        $res = $employee->delete();
        
        if($res){
            return response()->json(['success'=>200]);
        }else{
            return response()->json(['success'=>400]);
        }
    }
}