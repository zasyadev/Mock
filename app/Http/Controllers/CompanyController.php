<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Companies;

class CompanyController extends Controller
{
    public function __construct()
    {
        view()->share('type', 'company');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('site.company.select')->with([ 'type' => 'create' ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $company            = new Companies;
        $company->name      = $request->name;
        $company->email     = $request->email; 

        if ( $request->hasFile('logo') ) {
            $name = time().'.'.$request->logo->getClientOriginalExtension();
            $request->file('logo')->storeAs('logos', $name );
            $company->logo = $name;
        }

        if ( $company->save() ) {
            sendMail($company);
            return redirect()->to('/company')->with('success', 'Company saved successfully');
        }
        return redirect()->back()->with('error', 'Oop\'s somthing went wrong.');
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
            $company = Companies::where('id', $id)->first();
            
            return view('site.company.select')->with([ 'type' => 'update', 'company' => $company ]);
        }
        return redirect()->back()->with('error', 'Invalid id for company.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        if ( $id && Companies::where('id', $id)->exists() ) {
            $company = Companies::where('id', $id)->first();
            $company->name = $request->name;
            $company->email = $request->email;

            if ( $request->hasFile('logo') ) {
                \Storage::delete('logos/'.$company->logo);
                $name = time().'.'.$request->logo->getClientOriginalExtension();
                $request->file('logo')->storeAs('logos', $name );
                $company->logo = $name;
            }

            if ( $company->save() ) {
                return redirect()->to('/company')->with('success', 'Compnay updated');
            }
        }

        return redirect()->back()->with('error', 'Unable to process this request');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( $id && Companies::where('id', $id)->delete() ) {
            return redirect()->back();
        }
        return redirect()->back()->with('error', 'Oop\'s something went wrong');
    }
    
    /**
     * To fetch company data for table
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

        if ( isset( $search['value'] ) && !empty( $search['value'] ) ) {
            $value = $search['value'];
            $data = Companies::where(function( $query ) use($value) {
                $query->where('name', 'like', '%'.$value.'%')
                        ->orWhere('email', 'like', '%'.$value.'%');
            })->get();
        } else {
            $data = Companies::get();
        }

        $count = $data->count();

        return response()->json([
            "draw" => 1,
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => $data
        ]);
    }

}
