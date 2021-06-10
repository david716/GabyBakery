<?php

namespace App\Http\Controllers;

use App\Estado;
use App\Weigth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WeigthController extends Controller
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
        $weigths = Weigth::all();

        return view('Admin.weigths.index', compact('weigths'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::all();

        return view('Admin.weigths.create', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $weigth = Weigth::create([
            'name'   => ucfirst($request['name']),
            'estado' => $request['estado'],
        ]);

        $weigth->save();

        return redirect()->action('WeigthController@index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $weigth = Weigth::findOrFail($id);
        $estados = Estado::all();

        return view('Admin.weigths.edit', compact('weigth', 'estados'));
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
        $weigth = Weigth::findOrFail($id);

        $weigth->fill([
            'name'      => ucwords($request->name),
            'estado'    => $request->estado,
            'updated_at'=> Carbon::now(),
        ])->save();

        return redirect()->action('WeigthController@index');
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

    public function estado($id)
    {
        $estado = Weigth::findOrFail($id)->estado;
        return $estado;
    }
}
