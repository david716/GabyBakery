<?php

namespace App\Http\Controllers;

use App\Coverage;
use App\Doug;
use App\Filler;
use App\Invoice;
use App\Prodcut_custom;
use App\Product;
use App\Products_invoices;
use App\Products_standard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Product_customController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $id = $request->user_id.$request->product_id.str_replace('-','',$request->purchase_date).str_replace(':','',substr($request->purchase_hour, 0,8));
        if($request->estado_id == 1 ){
            $info_product = Product::findOrFail($request->product_id);

            $product = new Products_standard();

            $product->id                  = $id;
            $product->product_name        = $info_product->product_name;
            $product->product_shape_id    = $info_product->product_shape_id;
            $product->product_type_id     = $info_product->product_type_id;
            $product->weight_id           = $info_product->weight_id;
            $product->slice_id            = $info_product->slice_id;
            $product->blonda_id           = $info_product->blonda_id;
            $product->category_id         = $info_product->category_id;

            $product->coverage            = $info_product->coverage_id;
            
            if($info_product->weight_id == 1){
                $product->dough_1_2           = $info_product->dough_1_2_id;
                $product->dough_3_4           = $info_product->dough_3_4_id;
                $product->filler              = $info_product->filler_id;
            }else{
                $product->dough               = $info_product->dough_id;
                $product->filler_1            = $info_product->filler_1_id;
                $product->filler_2            = $info_product->filler_2_id;
            }

            $product->images              = $info_product->images;
            $product->rating              = $info_product->rating;
            $product->description         = $info_product->description;
            $product->total_value         = $info_product->total_value;
            $total_value = $info_product->total_value;
            
        }else if($request->estado_id == 2){
            $info_product = Product::findOrFail($request->product_id);
            $id = $request->user_id.$request->product_id.str_replace('-','',$request->purchase_date).str_replace(':','',substr($request->purchase_hour, 0,8));

            $product = new Prodcut_custom();
            
            $product->id                  = $id;
            $product->product_name        = $info_product->product_name."_Mod.";
            $product->product_shape_id    = $info_product->product_shape_id;
            $product->product_type_id     = $info_product->product_type_id;
            $product->weight_id           = $request->weight;
            $product->slice_id            = $request->slice_id;
            $product->blonda_id           = $info_product->blonda_id;
            $product->category_id         = $info_product->category_id;

            $product->coverage            = $request->coverage;
            if($request->weight == 1){
                $product->dough_1_2           = $request->dough_1_2;
                $product->dough_3_4           = $request->dough_3_4;
                $product->filler              = $request->filler;
            }else{
                $product->dough               = $request->dough;
                $product->filler_1            = $request->filler_1;
                $product->filler_2            = $request->filler_2;
            }            
            
            $product->topper              = $request->topper;
            $product->topper_color        = $request->color;
            
            if($request->topper == 1){
                $product->topper_value    = $request->vela;
            }

            $product->images              = $info_product->images;
            $product->rating              = $info_product->rating;
            $product->description         = $info_product->description;
            $product->total_value         = $request->total_value;
            
        }else{  

            $product = new Prodcut_custom();
            if($request->file('images')){
                $product_images = $request->file('images')->store('public/product_images');
                $url = Storage::url($product_images);
            }else{
                $url = null;
            }
            $product->id                  = $id;
            $product->product_name        = "Personalizado";
            $product->product_shape_id    = $request->product_shape;
            $product->product_type_id     = 3;
            $product->weight_id           = $request->weight;
            $product->blonda_id           = $request->blonda;
            $product->blonda_color        = $request->blonda_color;
            $product->coverage            = $request->id_coverage;

            if($request->weight == 1){
                
                $product->dough_1_2           = $request->id_doug_1_2;
                $product->dough_3_4           = $request->id_doug_3_4;
                $product->filler              = $request->id_filler;
            
            }else{

                $product->dough               = $request->id_doug;
                $product->filler_1            = $request->id_filler_1;
                $product->filler_2            = $request->id_filler_2;
            }
       
            $product->edge          = $request->edge;
            $product->egde_flavor   = $request->edge_flavor;
            $product->topper        = ($request->candle == '' ? null : 1);
            $product->topper_value  = $request->candle;
            $product->topper_color  = $request->candle_color;
            $product->message       = ($request->message == '' ? null :str_replace('_', ' ', ucwords($request->message)));
            $product->message_color = $request->message_color;
            $product->images        = $url;
            $product->description   = ($request->description == '' ? null : ucfirst($request->description));
            $product->total_value   = $request->total_value;        
           
        }
       
        $invoice = new Invoice();

        $invoice->user_id       = $request->user_id;
        $invoice->purchase_date = $request->purchase_date;
        $invoice->delivery_date = $request->delivery_date;
        $invoice->purchase_hour = $request->purchase_hour;
        $invoice->delivery_hour = $request->delivery_hour;
        $invoice->estado        = 1;
        if($request->estado_id == 1)
            $invoice->value         = $total_value;
        else
            $invoice->value         = $request->total_value;

        $product->save();
        $invoice->save();

        $product_invoice = new Products_invoices();
        
        $product_invoice->product_id = $product->id;
        $product_invoice->invoice_id = $invoice->id;
        
        $product_invoice->save();

        return redirect()->action('HomeController@index');
    }
}