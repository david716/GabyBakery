<?php

namespace App\Http\Controllers;

use App\Estado;
use App\Filler;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FillerController extends Controller
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
        $filler = DB::table('fillers as f')
                ->select('f.id', 'f.flavor', 'f.type', 'f.Libra_1', 'f.Libra_3_4', 'f.Libra_1_2', 'f.Libra_1_4', 'e.name as estado', 'p.filler_id', 'p1.filler_1_id', 'p2.filler_2_id')
                ->join('estados as e', 'e.id', '=', 'f.estado')
                ->leftJoin('products as p', 'p.filler_id', '=', 'f.id')
                ->leftJoin('products as p1', 'p1.filler_1_id', '=', 'f.id')
                ->leftJoin('products as p2', 'p2.filler_2_id', '=', 'f.id')
                ->groupBy('f.id')
                ->get();
        return view('Admin.fillers.index', compact('filler'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $estados = Estado::all();
        return view('Admin.fillers.create', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $filler = new Filler();

        $filler->flavor     = ucwords($request->flavor);
        $filler->type       = ucwords($request->type);
        $filler->Libra_1    = $request->Libra_1;
        $filler->Libra_3_4  = $request->Libra_3_4;
        $filler->Libra_1_2  = $request->Libra_1_2;
        $filler->Libra_1_4  = $request->Libra_1_4;
        $filler->estado     = $request->estado;

        $filler->save();

        return redirect()->action('FillerController@index');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Filler  $filler
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $filler = Filler::findOrFail($id);
        $estados = Estado::all();
        return view('Admin.fillers.edit', compact('filler', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Filler  $filler
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $filler = Filler::findOrFail($id);

        $filler->fill([
            'flavor'    => ucwords($request->flavor),
            'type'      => ucwords($request->type),
            'Libra_1'   => $request->Libra_1,
            'Libra_3_4' => $request->Libra_3_4,
            'Libra_1_2' => $request->Libra_1_2,
            'Libra_1_4' => $request->Libra_1_4,
            'estado'    => $request->estado,
            'updated_at'=> Carbon::now(),
        ])->save();

        return redirect()->action('FillerController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Filler  $filler
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $filler = Filler::findOrFail($id);

        $filler->delete();

        return redirect()->action('FillerController@index')->with('eliminar', 'ok');
    }

    public function estado($id)
    {
        $estado = Filler::findOrFail($id)->estado;
        return $estado;
    }
}
