<?php

namespace App\Http\Controllers;

use App\Coverage;
use App\Estado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoverageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coverage = DB::table('coverages as c')
             ->select('c.id', 'c.flavor', 'c.type', 'c.Libra_1', 'c.Libra_3_4', 'c.Libra_1_2', 'c.Libra_1_4', 'e.name as estado', 'p.coverage_id')
             ->join('estados as e', 'e.id', '=', 'c.estado')
             ->leftJoin('products as p', 'p.coverage_id', '=', 'c.id')
             ->groupBy('c.id')
             ->get();


        return view('Admin.cake_coverage.index', compact('coverage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $estados = Estado::all();
        return view('Admin.cake_coverage.create', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $coverage = new Coverage();

        $coverage->flavor     = ucwords($request->flavor);
        $coverage->type       = ucwords($request->type);
        $coverage->Libra_1    = $request->Libra_1;
        $coverage->Libra_3_4  = $request->Libra_3_4;
        $coverage->Libra_1_2  = $request->Libra_1_2;
        $coverage->Libra_1_4  = $request->Libra_1_4;
        $coverage->estado     = $request->estado;

        $coverage->save();

        return redirect()->action('CoverageController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coverage  $coverage
     * @return \Illuminate\Http\Response
     */
    public function edit(Coverage $coverage)
    {   
        $estados = Estado::all();
        return view('Admin.cake_coverage.edit', compact('coverage', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coverage  $coverage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coverage $coverage)
    {
        $coverage->fill([
            'flavor'    => ucwords($request->flavor),
            'type'      => ucwords($request->type),
            'Libra_1'   => $request->Libra_1,
            'Libra_3_4' => $request->Libra_3_4,
            'Libra_1_2' => $request->Libra_1_2,
            'Libra_1_4' => $request->Libra_1_4,
            'estado'    => $request->estado,
            'updated_at'=> Carbon::now(),
        ])->save();

        return redirect()->action('CoverageController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coverage  $coverage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coverage $coverage)
    {
        $coverage->delete();

        return redirect()->action('CoverageController@index')->with('eliminar', 'ok');
    }

    public function estado($id)
    {
        $estado = Coverage::findOrFail($id)->estado;
        return $estado;
    }
}
