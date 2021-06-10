<?php

namespace App\Http\Controllers;

use App\BlondaShape;
use App\Product;
use Illuminate\Http\Request;

use App\Category;
use App\Color;
use App\Coverage;
use App\Doug;
use App\Filler;
use App\Decoration;
use App\ProductShape;
use App\Topper;
use App\Weigth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use stdClass;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id = '0')
    {   
        
        if($id != 0){
            $products = Product::where('category_id', $id)
            ->where('estado_id', '1')
            ->orderby('product_type_id', 'DESC')
            ->orderby('rating', 'DESC')
            ->paginate(9);
        }else{
            $products = Product::where('estado_id', '1')
            ->orderby('product_type_id', 'DESC')
            ->orderby('rating', 'DESC')
            ->paginate(9);
        }
        
        $last_products = DB::select(
            'SELECT *
            FROM products
            WHERE estado_id = 1
            ORDER BY rating DESC
            LIMIT 4'
        );
        
        $category = Category::all();

        return view('home', compact('products', 'last_products', 'category'));
    }

    public function customizeProduct()
    {
        $category       = Category::all();
        $coverage       = Coverage::all();
        $doug           = Doug::all();
        $filler         = Filler::all();
        $product_shapes = ProductShape::all();    
        $weigth         = Weigth::all();
        $blonda_shapes  = BlondaShape::all();
        $colors         = Color::all()->where('estado_custom', '=', 1);

        foreach ($coverage as  $value) {
            if($value->id >= 1 && $value->id <= 4){
                $coverage_1[] = (object) array(
                    "id" => $value->id,
                    "flavor" => substr(str_replace(' ', '_', $value->flavor), 12)
                );
            }
            if(($value->id >= 5 && $value->id <= 9 && $value->id != 7)){
                $coverage_2[] = (object) array(
                    "id" => $value->id,
                    "flavor" => substr(str_replace(' ', '_', $value->flavor), 12)
                );
            }
            if($value->id != 7 && $value->id != 10){
                $edge[] = (object) array(
                    "id" => $value->id,
                    "flavor" => substr($value->flavor, 12)
                );
            }
        }

        foreach ($doug as  $value) {
            if($value->id >= 1 && $value->id <= 4){
                $doug_1[] = (object) array(
                    "id" => $value->id,
                    "flavor" => substr(str_replace(' ', '_', $value->flavor), 8)
                );
            }
            if(($value->id >= 5 && $value->id <= 7)){
                $doug_2[] = (object) array(
                    "id" => $value->id,
                    "flavor" => substr(str_replace(' ', '_', $value->flavor), 8)
                );
            }
        }

        foreach ($filler as  $value) {
            if($value->id >= 1 && $value->id <= 4){
                $filler_1[] = (object) array(
                    "id" => $value->id,
                    "flavor" => substr(str_replace(' ', '_', $value->flavor), 11)
                );
            }
            if(($value->id >= 5 && $value->id <= 8 && $value->id != 7)){
                $filler_2[] = (object) array(
                    "id" => $value->id,
                    "flavor" => substr(str_replace(' ', '_', $value->flavor), 11)
                );
            }
            if(($value->id >= 9 && $value->id <= 10)){
                $filler_3[] = (object) array(
                    "id" => $value->id,
                    "flavor" => substr(str_replace(' ', '_', $value->flavor), 11)
                );
            }
        }
         
        return view('customize',compact(
            'category', 'coverage', 'edge',
            'product_shapes', 'weigth', 'blonda_shapes', 'colors',
            'coverage_1', 'coverage_2', 'doug_1', 'doug_2','filler_1', 'filler_2', 'filler_3'
            )
        );
    }

    public function customize($id)
    {
       // $product = Product::findOrFail($id);

        $product = DB::table('products as p')
        ->select(
            'p.id', 'p.product_name', 't_p.name as product_type', 'sl.name as slice', 'c.name as category', 'p.weight_id',
            'p.coverage_id', 'p.dough_id', 'p.dough_1_2_id', 'p.dough_3_4_id', 'p.filler_id', 'p.filler_1_id', 'p.filler_2_id',
            'p.images', 'p.description', 'p.total_value'
        )
        ->join('categories as c', 'c.id', '=' ,'p.category_id')
        ->join('type_products as t_p', 't_p.id', '=' ,'p.product_type_id')
        ->join('slices as sl', 'sl.id', '=' ,'p.slice_id')
        ->where('p.id', '=', $id)
        ->get();
        
        $category   = Category::all();
        $coverage   = Coverage::all();
        $doug       = Doug::all();
        $filler     = Filler::all();
        $weigth     = Weigth::all();
        $topper     = Topper::all();
        $color      = Color::all();

        return view('customizeProduct', compact('product','category', 'coverage', 'doug', 'filler', 'weigth', 'topper', 'color'));
    }

    public function standar ($id){
        $product = DB::table('products as p')
        ->select(
            'p.id', 'p.product_name', 't_p.name as product_type', 'sl.name as slice',  'co.flavor as coverage',
            'd.flavor as dough', 'd1.flavor as dough_1_2', 'd2.flavor as dough_3_4',
            'f.flavor as filler', 'f1.flavor as filler_1', 'f2.flavor as filler_2',
            'c.name as category', 'w.name as weight', 'p.weight_id', 'p.images', 'p.description', 'p.total_value'
        )
        ->join('categories as c', 'c.id', '=' ,'p.category_id')
        ->join('type_products as t_p', 't_p.id', '=' ,'p.product_type_id')
        ->join('weigths as w', 'w.id', '=' ,'p.weight_id')
        ->join('coverages as co', 'co.id', '=' ,'p.coverage_id')
        ->leftJoin('dougs as d', 'd.id', '=' ,'p.dough_id')
        ->leftJoin('dougs as d1', 'd1.id', '=' ,'p.dough_1_2_id')
        ->leftJoin('dougs as d2', 'd2.id', '=' ,'p.dough_3_4_id')
        ->leftJoin('fillers as f', 'f.id', '=' ,'p.filler_id')
        ->leftJoin('fillers as f1', 'f1.id', '=' ,'p.filler_1_id')
        ->leftJoin('fillers as f2', 'f2.id', '=' ,'p.filler_2_id')
        ->join('estados as e', 'e.id', '=' ,'p.estado_id')
        ->join('slices as sl', 'sl.id', '=' ,'p.slice_id')
        ->where('p.id', '=', $id)
        ->get();
        $category   = Category::all();
        return view('standarProduct', compact('product', 'category'));
    }

    public function invoice($id)
    {   
        $invoice = DB::table('products_invoices as pi')
        ->select(
            'i.id', 'i.purchase_date', 'i.purchase_hour', 'i.delivery_date', 'i.delivery_hour', 'ps.product_name',
            'ps.product_type_id', 'u.name as user', 'ei.name as estado', 'i.value'
        )
        ->join('invoices as i', 'i.id', '=', 'pi.invoice_id')
        ->join('products_standards as ps', 'ps.id', '=', 'pi.product_id')
        ->join('users as u', 'u.id', '=', 'i.user_id')
        ->join('estado_invoices as ei', 'ei.id', '=', 'i.estado')
        ->orderby('i.id', 'DESC')
        ->get();

        $invoice_custom = DB::table('products_invoices as pi')
        ->select(
            'i.id', 'i.purchase_date', 'i.purchase_hour', 'i.delivery_date', 'i.delivery_hour', 'pc.product_name',
            'pc.product_type_id', 'u.name as user', 'ei.name as estado', 'i.value'
        )
        ->join('invoices as i', 'i.id', '=', 'pi.invoice_id')
        ->join('prodcut_customs as pc', 'pc.id', '=', 'pi.product_id')
        ->join('users as u', 'u.id', '=', 'i.user_id')
        ->join('estado_invoices as ei', 'ei.id', '=', 'i.estado')
        ->orderby('i.id', 'DESC')
        ->get();

        $category   = Category::all();
        return view('invoice', compact('category', 'invoice', 'invoice_custom'));
    }

    public function invoice_detail($id, $type, $n){
        if($type != 3){
            $info = DB::table('products_invoices as pi')
            ->select(
                'u.name as user', 'c.name as category', 'ei.name as estado', 'b_s.name as blonda', 'sl.name as slice', 
                'i.id', 'i.purchase_date', 'i.purchase_hour', 'i.delivery_date', 'i.delivery_hour' ,'i.value', 
                'p.product_name', 'p.product_type_id', 'p.weight_id', 'w.name as weight', 'p_s.name as product_shape', 'p.images',
                'co.flavor as coverage','d.flavor as dough', 'd1.flavor as dough_1_2', 'd2.flavor as dough_3_4',
                'f.flavor as filler', 'f1.flavor as filler_1', 'f2.flavor as filler_2',
            )
            ->join('invoices as i', 'i.id', '=', 'pi.invoice_id')
            ->join(($n == 1 ? 'products_standards as p' : 'prodcut_customs as p'), 'p.id', '=', 'pi.product_id')
            ->join('users as u', 'u.id', '=', 'i.user_id')
            ->join('estado_invoices as ei', 'ei.id', '=', 'i.estado')
            ->join('product_shapes as p_s', 'p_s.id', '=', 'p.product_shape_id')
            ->join('weigths as w', 'w.id', '=' ,'p.weight_id')
            ->join('slices as sl', 'sl.id', '=' ,'p.slice_id')
            ->join('coverages as co', 'co.id', '=' ,'p.coverage')
            ->leftJoin('dougs as d', 'd.id', '=' ,'p.dough')
            ->leftJoin('dougs as d1', 'd1.id', '=' ,'p.dough_1_2')
            ->leftJoin('dougs as d2', 'd2.id', '=' ,'p.dough_3_4')
            ->leftJoin('fillers as f', 'f.id', '=' ,'p.filler')
            ->leftJoin('fillers as f1', 'f1.id', '=' ,'p.filler_1')
            ->leftJoin('fillers as f2', 'f2.id', '=' ,'p.filler_2')
            ->join('categories as c', 'c.id', '=' ,'p.category_id')
            ->join('blonda_shapes as b_s', 'b_s.id', '=' ,'p.blonda_id')
            ->where('pi.id', '=', $id)
            ->get();
        }else{    
            $info = DB::table('products_invoices as pi')
            ->select(
                'u.name as user', 'ei.name as estado', 'b_s.name as blonda', 
                'i.id', 'i.purchase_date', 'i.purchase_hour', 'i.delivery_date', 'i.delivery_hour' ,'i.value', 
                'p.product_name', 'p.product_type_id', 'p.weight_id', 'w.name as weight', 'p_s.name as product_shape', 'p.images',
                'co.flavor as coverage','d.flavor as dough', 'd1.flavor as dough_1_2', 'd2.flavor as dough_3_4',
                'f.flavor as filler', 'f1.flavor as filler_1', 'f2.flavor as filler_2',
                'c.name as blonda_color', 'p.edge', 'cov.flavor as egde_flavor', 't.name as topper', 'p.topper_value', 'col.name as topper_color',
                'p.message', 'colo.name as message_color', 'p.description'
            )
            ->join('invoices as i', 'i.id', '=', 'pi.invoice_id')
            ->join('prodcut_customs as p', 'p.id', '=', 'pi.product_id')
            ->join('users as u', 'u.id', '=', 'i.user_id')
            ->join('estado_invoices as ei', 'ei.id', '=', 'i.estado')
            ->join('product_shapes as p_s', 'p_s.id', '=', 'p.product_shape_id')
            ->join('weigths as w', 'w.id', '=' ,'p.weight_id')
            ->join('coverages as co', 'co.id', '=' ,'p.coverage')
            ->leftJoin('dougs as d', 'd.id', '=' ,'p.dough')
            ->leftJoin('dougs as d1', 'd1.id', '=' ,'p.dough_1_2')
            ->leftJoin('dougs as d2', 'd2.id', '=' ,'p.dough_3_4')
            ->leftJoin('fillers as f', 'f.id', '=' ,'p.filler')
            ->leftJoin('fillers as f1', 'f1.id', '=' ,'p.filler_1')
            ->leftJoin('fillers as f2', 'f2.id', '=' ,'p.filler_2')
            ->join('blonda_shapes as b_s', 'b_s.id', '=' ,'p.blonda_id')
            ->join('colors as c', 'c.id', '=' , 'p.blonda_color')
            ->leftJoin('colors as col', 'col.id', '=' , 'p.topper_color')
            ->leftJoin('colors as colo', 'colo.id', '=' , 'p.message_color')
            ->leftJoin('coverages as cov', 'cov.id', '=' ,'p.egde_flavor')
            ->leftJoin('toppers as t', 't.id', '=' ,'p.topper')
            ->where('pi.id', '=', $id)
            ->get();
        }

        
        $coverage   = Coverage::all();
        $doug       = Doug::all();
        $filler     = Filler::all();
        $category   = Category::all();
        return view('invoice_detail', compact('info', 'coverage', 'doug', 'filler', 'category'));
    }
}
