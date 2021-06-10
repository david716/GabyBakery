<?php

namespace App\Http\Controllers;

use App\Extras;
use App\Weigth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exact;

class ExtraController extends Controller
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
        $extras = DB::table('extras as e')
            ->select('e.id', 'w.name as weigth', 'e.blonda', 'e.box', 'e.sticker')
            ->join('weigths as w', 'w.id', '=', 'e.weigth')
            ->get();
        
        return view('Admin.extras.index', compact('extras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $weigths    = Weigth::all();
        return view('Admin.extras.create',compact('weigths'));
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $extras = new Extras();

        $extras->weigth    = $request->weigth;
        $extras->blonda    = $request->blonda;
        $extras->box       = $request->box;
        $extras->sticker   = $request->sticker;

        $extras->save();
        return redirect()->action('ExtraController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $extras     = Extras::findOrFail($id);
        $weigths    = Weigth::all();

        return view('Admin.extras.edit', compact('extras', 'weigths'));
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
        $extra = Extras::findOrFail($id);

        $extra->fill([
            'weigth'    => $request->weigth, 
            'blonda'    => $request->blonda, 
            'box'       => $request->box, 
            'sticker'   => $request->sticker, 
            'updated_at'=> Carbon::now(),
        ])->save();

        return redirect()->action('ExtraController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $extra = Extras::findOrFail($id);

        $extra->delete();

        return redirect()->action('ExtraController@index')->with('eliminar', 'ok');
    }

    public function validate_weigth(){
        
        $weigths = DB::table('extras')
                ->select('weigth')
                ->get();
        
        foreach ($weigths as $key => $value) {
            $arr [] = $value->weigth;
        }

        return $arr;
    }

    public function weigth_extras($id){
        $extra = Extras::findOrFail($id)->weigth;
        return $extra;
    }
}
