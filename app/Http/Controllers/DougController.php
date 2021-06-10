<?php

namespace App\Http\Controllers;

use App\Doug;
use App\Estado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DougController extends Controller
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
        $doug = DB::table('dougs as d')
             ->select('d.id', 'd.flavor', 'd.type', 'd.Libra_1', 'd.Libra_3_4', 'd.Libra_1_2', 'd.Libra_1_4', 'e.name as estado','p.dough_id', 'p1.dough_1_2_id', 'p2.dough_3_4_id')
             ->join('estados as e', 'e.id', '=', 'd.estado')
             ->leftJoin('products as p', 'p.dough_id', '=', 'd.id')
             ->leftJoin('products as p1', 'p1.dough_1_2_id', '=', 'd.id')
             ->leftJoin('products as p2', 'p2.dough_3_4_id', '=', 'd.id')
             ->groupBy('d.id')
             ->get();
        return view('Admin.doughs.index', compact('doug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $estados = Estado::all();
        return view('Admin.doughs.create', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $doug = new Doug();

        $doug->flavor     = ucwords($request->flavor);
        $doug->type       = ucwords($request->type);
        $doug->Libra_1    = $request->Libra_1;
        $doug->Libra_3_4  = $request->Libra_3_4;
        $doug->Libra_1_2  = $request->Libra_1_2;
        $doug->Libra_1_4  = $request->Libra_1_4;
        $doug->estado     = $request->estado;

        $doug->save();
        return redirect()->action('DougController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doug  $doug
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doug = Doug::findOrFail($id);
        $estados = Estado::all();
        return view('Admin.doughs.edit', compact('doug', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doug  $doug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $doug = Doug::findOrFail($id);

        $doug->fill([
            'flavor'    => ucwords($request->flavor),
            'type'      => ucwords($request->type),
            'Libra_1'   => $request->Libra_1,
            'Libra_3_4' => $request->Libra_3_4,
            'Libra_1_2' => $request->Libra_1_2,
            'Libra_1_4' => $request->Libra_1_4,
            'estado'    => $request->estado,
            'updated_at'=> Carbon::now(),
        ])->save();

        return redirect()->action('DougController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doug  $doug
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doug = Doug::findOrFail($id);

        $doug->delete();

        return redirect()->action('DougController@index')->with('eliminar', 'ok');

    }

    public function estado($id)
    {
        $estado = Doug::findOrFail($id)->estado;
        return $estado;
    }
}
