<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employees;
use App\Http\Requests\EmployeeRequest;
use App\Companies;

class EmployeeController extends Controller
{
    /**
     * Constructor for the EmployeeController package
     */
    public function __construct()
    {
        view()->share('module', 'employee');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        if ( isset($request->company_id) ) {
            $request->session()->put('company_id', $request->company_id);
        } else {
            $request->session()->put('company_id', 0);
        }
        
        return view('site.employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('site.employee.select', [ 'type' => 'create', 'companies' => Companies::all() ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $employee               = new Employees;
        $employee->first_name   = $request->first_name;
        $employee->last_name    = $request->last_name;
        $employee->email        = $request->email;
        $employee->company_id   = $request->company_id;
        $employee->phone        = $request->phone;
        if ( $employee->save() ) {
            return redirect()->to('/employee')->with('success', 'Employee added successfully');
        }
        return back()->with('Oop\'s Something went wrong.');
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
        if ( $id ) {
            $employee = Employees::where('id', $id)->first();
            
            return view('site.employee.select')->with([ 'type' => 'update', 'employee' => $employee, 'companies' => Companies::all() ]);
        }
        return redirect()->back()->with('error', 'Invalid id for employee.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        if ( $id && Employees::where('id', $id)->exists() ) {
            $employee               = Employees::where('id', $id)->first();
        } else {
            $employee               = new Employees;
        }
        
        $employee->first_name   = $request->first_name;
        $employee->last_name    = $request->last_name;
        $employee->email        = $request->email;
        $employee->company_id   = $request->company_id;
        $employee->phone        = $request->phone;
        if ( $employee->save() ) {
            return redirect()->to('/employee')->with('success', 'Employee updated successfully');
        }
        return back()->with('Oop\'s Something went wrong.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( $id && Employees::where('id', $id)->delete() ) {
            return redirect()->back();
        }
        return redirect()->back()->with('error', 'Oop\'s something went wrong');
    }

    /**
     * To fetch Employee data for table
     */
    public function data(Request $request) 
    {   
        //Fetching all inputs from request
        $draw   = $request->input( 'draw' );
        $order  = $request->input( 'order' );
        $start  = $request->input( 'start', 0 );
        $length = $request->input( 'length' );
        $search = $request->input( 'search' );
        $secho  = $request->input( 'sEcho' );
        $date   = $request->input( 'date' );
        $status   = $request->input( 'status' );

        $order_column    = $order[ 0 ][ 'column' ];
        $order_direction = $order[ 0 ][ 'dir' ];

        if ( empty( $order_column ) ) {
            $order_column = '0';
        }
        if ( empty( $order_direction ) ) {
            $order_direction = 'asc';
        }

        if ($request->session()->has('company_id') && $request->session()->get('company_id')) {
            $employees = Employees::where('company_id', $request->session()->get('company_id'));
        } else {
            $employees = new Employees;
        }
        
        if ( isset( $search['value'] ) && !empty( $search['value'] ) ) {
            $value = $search['value'];
            $data = -$employees->where(function( $query ) use($value) {
                $query->where('name', 'like', '%'.$value.'%')
                        ->orWhere('email', 'like', '%'.$value.'%');
            })->get();
        } else {
            $data = $employees->get();
        }
        $data = $data->map(function($value) {
            return [
                'id'        => $value->id,
                'name'      => $value->name,
                'company'   => $value->company->name,
                'email'     => $value->email,
                'phone'     => $value->phone
            ];
        });
        $count = count($data);

        return response()->json([
            "draw" => 1,
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => $data
        ]);
    }
}
