<?php

namespace App\Http\Controllers;

use App\BlondaShape;
use App\Product;
use App\Category;
use App\Coverage;
use App\Doug;
use App\Estado;
use App\Filler;
use App\ProductShape;
use App\TypeProduct;
use App\Weigth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use SebastianBergmann\Environment\Console;
use Swift;

class ProductController extends Controller
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
        $product = DB::table('products as p')
        ->select(
            'p.id', 'p.product_name', 't_p.name as product_type', 'p.rating', 
            'sl.name as slice', 'p_s.name as product_shape', 'c.name as category', 'w.name as weight',
            'b.name as blonda', 'e.name as estado', 'p.total_value'
        )
        ->join('categories as c', 'c.id', '=' ,'p.category_id')
        ->join('type_products as t_p', 't_p.id', '=' ,'p.product_type_id')
        ->join('product_shapes as p_s', 'p_s.id', '=' ,'p.product_shape_id')
        ->join('weigths as w', 'w.id', '=' ,'p.weight_id')
        ->join('blonda_shapes as b', 'b.id', '=' ,'p.blonda_id')
        ->join('estados as e', 'e.id', '=' ,'p.estado_id')
        ->join('slices as sl', 'sl.id', '=' ,'p.slice_id')
        ->get();
        
        return view('Admin.products.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $category       = Category::all();
        $coverage       = Coverage::all();
        $doug           = Doug::all();
        $filler         = Filler::all();
        $type_product   = TypeProduct::all();
        $esatdos         = Estado::all();
        $blonda         = BlondaShape::all();
        $shape_product  = ProductShape::all();
        $weigth         = Weigth::all();

        return view('Admin.products.create', compact( 'category', 'coverage', 'doug', 'filler', 'type_product', 'esatdos', 'blonda', 'shape_product', 'weigth'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){        
        $product = new Product();
        
       /* $product_images = $request->file('images')->store('public/product_images');
        $url = Storage::url($product_images);*/

        $path = $request->file('images')->store('public/product_images');
        $url = Storage::url($path);
        //$fileName = collect(explode('/', $path))->last();
        $image = Image::make(Storage::get($path));
        $image->resize(1920, 1280);
        Storage::put($path, (string) $image->encode('jpg', 30));

        $product->product_name        = $request->product_name;
        $product->product_shape_id    = $request->product_shape;
        $product->product_type_id     = $request->product_type;
        $product->weight_id           = $request->weight;
        $product->slice_id            = $request->slice_id;
        $product->estado_id           = $request->estado;
        $product->blonda_id           = $request->blonda;
        $product->category_id         = $request->category;
        $product->coverage_id         = $request->coverage;
        $product->dough_id            = $request->dough;
        $product->dough_1_2_id        = $request->dough_1_2;
        $product->dough_3_4_id        = $request->dough_3_4;
        $product->filler_id           = $request->filler;
        $product->filler_1_id         = $request->filler_1;
        $product->filler_2_id         = $request->filler_2;
        $product->Libra_1             = $request->Libra_1;
        $product->Libra_3_4           = $request->Libra_3_4;
        $product->Libra_1_2           = $request->Libra_1_2;
        $product->Libra_1_4           = $request->Libra_1_4;
        $product->images              = $url;
        $product->rating              = $request->rating;
        $product->description         = $request->description;
        $product->sub_value           = $request->value;
        $product->total_value         = $request->total_value;

        $product->save();   

        return redirect()->action('ProductController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product        = Product::findOrFail($id);
        $category       = Category::all();
        $coverage       = Coverage::all();
        $doug           = Doug::all();
        $filler         = Filler::all();
        $type_product   = TypeProduct::all();
        $esatdos        = Estado::all();
        $blonda         = BlondaShape::all();
        $shape_product  = ProductShape::all();
        $weigth         = Weigth::all();
        

        return view('Admin.products.edit', compact('product', 'category', 'coverage', 'doug', 'filler', 'type_product', 'esatdos', 'blonda', 'shape_product', 'weigth'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if($request->file('images')){
            $path = $request->file('images')->store('public/product_images');
            $url = Storage::url($path);
            $image = Image::make(Storage::get($path));
            $image->resize(1920, 1280);
            Storage::put($path, (string) $image->encode('jpg', 30));
        }else{
            $product = Product::findOrFail($id);
            $url = $product->images;
        }

        $product->fill([
            'product_name'     => $request->product_name,
            'product_shape_id' => $request->product_shape,
            'product_type_id'  => $request->product_type,
            'weight_id'        => $request->weight,
            'slice_id'         => $request->slice_id,
            'estado_id'        => $request->estado,
            'blonda_id'        => $request->blonda,
            'category_id'      => $request->category,
            'coverage_id'      => $request->coverage,
            'dough_id'         => $request->dough,
            'dough_1_2_id'     => $request->dough_1_2,
            'dough_3_4_id'     => $request->dough_3_4,
            'filler_id'        => $request->filler,
            'filler_1_id'      => $request->filler_1,
            'filler_2_id'      => $request->filler_2,
            'Libra_1'          => $request->Libra_1,
            'Libra_3_4'        => $request->Libra_3_4,
            'Libra_1_2'        => $request->Libra_1_2,
            'Libra_1_4'        => $request->Libra_1_4,
            'estado'           => $request->estado,
            'images'           => $url,
            'rating'           => $request->rating,
            'description'      => $request->description,
            'sub_value'        => $request->value,
            'total_value'      => $request->total_value
        ])->save();
        
        return redirect()->action('ProductController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->action('ProductController@index')->with('eliminar', 'ok');
    }

    public function edit_js($id){
        $product = Product::findOrFail($id);
        return  json_encode($product);
    }

    public function slice($id){
        $slice = DB::table('slices')
        ->select('id','name')
        ->where('weigth', '=', $id)
        ->get();

        return $slice;
    }

    public function calculated_value($id, $id_product, $id_topper){
        switch ($id) {
            case '1':
                $coverage = DB::table('coverages')
                ->select('id','flavor','Libra_1 as value_doug')
                ->get();
                $dougs = DB::table('dougs')
                ->select('id','flavor','Libra_1 as value_doug')
                ->get();
                $filler = DB::table('fillers')
                ->select('id','flavor','Libra_1 as value_doug')
                ->get();
                $extra = DB::table('extras')
                ->select('id','blonda','box', 'sticker')
                ->where('weigth', '=', 1)
                ->get();
                if($id_product != 0){
                    $product = DB::table('products')
                    ->select('Libra_1 as val_product')
                    ->where('id', '=', $id_product)
                    ->get();
                }
            break;
            case '2':
                $coverage = DB::table('coverages')
                ->select('id','flavor','Libra_3_4 as value_doug')
                ->get();
                $dougs = DB::table('dougs')
                ->select('id','flavor','Libra_3_4 as value_doug')
                ->get();
                $filler = DB::table('fillers')
                ->select('id','flavor','Libra_3_4 as value_doug')
                ->get();
                $extra = DB::table('extras')
                ->select('id','blonda','box', 'sticker')
                ->where('weigth', '=', 2)
                ->get();
                if($id_product != 0){
                    $product = DB::table('products')
                    ->select('Libra_3_4 as val_product')
                    ->where('id', '=', $id_product)
                    ->get();
                }
            break;
            case '3':
                $coverage = DB::table('coverages')
                ->select('id','flavor','Libra_1_2 as value_doug')
                ->get();
                $dougs = DB::table('dougs')
                ->select('id','flavor','Libra_1_2 as value_doug')
                ->get();
                $filler = DB::table('fillers')
                ->select('id','flavor','Libra_1_2 as value_doug')
                ->get();
                $extra = DB::table('extras')
                ->select('id','blonda','box', 'sticker')
                ->where('weigth', '=', 3)
                ->get();
                if($id_product != 0){
                    $product = DB::table('products')
                    ->select('Libra_1_2 as val_product')
                    ->where('id', '=', $id_product)
                    ->get();
                }
            break;
            case '4':
                $coverage = DB::table('coverages')
                ->select('id','flavor','Libra_1_4 as value_doug')
                ->get();
                $dougs = DB::table('dougs')
                ->select('id','flavor','Libra_1_4 as value_doug')
                ->get();
                $filler = DB::table('fillers')
                ->select('id','flavor','Libra_1_4 as value_doug')
                ->get();
                $extra = DB::table('extras')
                ->select('id','blonda','box', 'sticker')
                ->where('weigth', '=', 4)
                ->get();
                if($id_product != 0){
                    $product = DB::table('products')
                    ->select('Libra_1_4 as val_product')
                    ->where('id', '=', $id_product)
                    ->get();
                }
            break;
        }
        if($id_topper != 0){
            $topper = DB::table('toppers')
            ->select('value')
            ->where('id', '=', $id_topper)
            ->get();
            $val_topper = $topper[0]->value;
        }else{
            $val_topper = 0;
        }

        foreach ($coverage as $value) {
            $arr_coverages[$value->id] = [$value->value_doug];
        }
        foreach ($dougs as $value) {
            $arr_dougs[$value->id] = [$value->value_doug];
        }
        foreach ($filler as $value) {
            $arr_fillers[$value->id] = [$value->value_doug];
        }
        foreach ($extra as $value) {
           $extras_value = $value->blonda+$value->box+$value->sticker;
        }
        if($id_product == 0)
            $arr = [$arr_coverages, $arr_dougs, $arr_fillers, ($extras_value+$val_topper)];
        else
            $arr = [$arr_coverages, $arr_dougs, $arr_fillers, ($extras_value+$val_topper), $product[0]->val_product];

        return $arr;
    }
    
}
