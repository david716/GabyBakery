<?php

namespace App\Http\Controllers;

use App\Coverage;
use App\Doug;
use App\Filler;
use App\Invoice;
use App\Prodcut_custom;
use App\User;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
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
        
        return view('Admin.invoices.index', compact('invoice', 'invoice_custom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $type, $n)
    {   
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

        return view('Admin.invoices.edit', compact('info', 'coverage', 'doug', 'filler'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        $invoice->fill($request->all())->save();

        return redirect()->action('InvoiceController@index');
    }

    public function estado_update($id)
    {
        $invoice = Invoice::findOrFail($id);
        
        if($invoice->estado == 1){
            $estado = 2;
        }else if($invoice->estado == 2){
            $estado = 0;
        }elseif($invoice->estado == 0){
            $estado = 1;
        }

        $invoice->fill([
            'estado'     => $estado,
        ])->save();
        
        return redirect()->action('InvoiceController@index');
    }
}
