<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Employee;
use App\Http\Resources\Employee as EmployeeResources;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Employee::paginate(10);

        return new EmployeeResources::collection($company);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = if($request->isMethod('put')) ? 
        Employee::findOrFail($request->id) : new Employee();

        $company->name = $request->input('name');

        if($company->save()) {
            return new EmployeeResources($company);
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
        $company = Company::findOrFail($id);

        return new CompanyResources($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
