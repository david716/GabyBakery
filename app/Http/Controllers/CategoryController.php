<?php

namespace App\Http\Controllers;

use App\Category;
use App\Estado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
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
        $category = DB::table('categories as c')
             ->select('c.id', 'c.name', 'c.description', 'e.name as estado', 'p.category_id')
             ->join('estados as e', 'e.id', '=', 'c.estado')
             ->leftJoin('products as p', 'p.category_id', '=', 'c.id')
             ->groupBy('c.id')
             ->get();
     
        return view('Admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $estados = Estado::all();
        return view('Admin.category.create', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $category = Category::create([
            'name'        => ucfirst($request['name']),
            'description' => ucfirst($request['description']),
            'estado'      => $request['estado'],
        ]);

        $category->save();

        return redirect()->action('CategoryController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $estados = Estado::all();
        return view('Admin.category.edit', compact('category', 'estados'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->fill([
            'name'        =>ucwords($request->name), 
            'description' =>ucfirst($request->description), 
            'estado'      => $request['estado'],
            'updated_at'  =>Carbon::now(),
        ])->save();

        return redirect()->action('CategoryController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect()->action('CategoryController@index')->with('eliminar', 'ok');
    }

    
    public function estado($id)
    {
        $estado = Category::findOrFail($id)->estado;
        return $estado;
    }
}
