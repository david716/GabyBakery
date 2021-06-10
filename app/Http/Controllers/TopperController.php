<?php

namespace App\Http\Controllers;

use App\Estado;
use App\Topper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topper = DB::table('toppers as t')
             ->select('t.id', 't.name', 't.value', 'e.name as estado')
             ->join('estados as e', 'e.id', '=', 't.estado')
             ->get();
        return view('Admin.toppers.index', compact('topper'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::all();

        return view('Admin.toppers.create', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $topper = Topper::create([
            'name'   => ucfirst($request['name']),
            'value'  => $request['value'],
            'estado' => $request['estado'],
        ]);
        $topper->save();

        return redirect()->action('TopperController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topper = Topper::findOrFail($id);
        $estados = Estado::all();

        return view('Admin.toppers.edit', compact('topper', 'estados'));
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
        $topper = Topper::findOrFail($id);

        $topper->fill([
            'name'      => ucwords($request->name),
            'value'     => $request->value,
            'estado'    => $request->estado,
            'updated_at'=> Carbon::now(),
        ])->save();

        return redirect()->action('TopperController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $topper = Topper::findOrFail($id);
        $topper->delete();
        
        return redirect()->action('TopperController@index')->with('eliminar', 'ok');
    }

    public function estado($id)
    {
        $estado = Topper::findOrFail($id)->estado;
        return $estado;
    }
}
