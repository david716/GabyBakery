<?php

namespace App\Http\Controllers;

use App\Category;
use App\Invoice;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class DateController extends Controller
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
        $category   = Category::all();
        return view('date', compact('category'));
    }

    public function check_data(){
        $data = DB::select(' SELECT * FROM invoices');
        return count($data);
    }

    public function validate_date($fecha, $hour){
        $date = DB::select(' SELECT purchase_date 
                             FROM invoices 
                             WHERE delivery_date = ?
                            ', [$fecha]);

        $date2 = DB::select('SELECT delivery_date, delivery_hour
                            FROM invoices 
                            WHERE delivery_date = ? AND delivery_hour LIKE ?',
                            [$fecha, $hour]);
                            
        $info = [count($date), count($date2)];

        return  $info;

    }

    public function get_product($id){
        $product = Product::findOrFail($id);
        return $product;
    }

    public function calendar(){
        return view('Admin.invoices.calendar');
    }

    public function event(){
        $event = DB::select('SELECT i.id, p.product_type_id as type, p.product_name as product, u.name as user, 
                            i.delivery_date as date, i.delivery_hour as hour, i.estado
                            FROM products_invoices as pi
                            INNER JOIN invoices as i on i.id = pi.invoice_id
                            INNER JOIN products_standards as p on p.id = pi.product_id
                            INNER JOIN users as u on u.id = i.user_id
        ');

        $event2 = DB::select('SELECT i.id, p.product_type_id as type, p.product_name as product, u.name as user, 
                            i.delivery_date as date, i.delivery_hour as hour, i.estado
                            FROM products_invoices as pi
                            INNER JOIN invoices as i on i.id = pi.invoice_id
                            INNER JOIN prodcut_customs as p on p.id = pi.product_id
                            INNER JOIN users as u on u.id = i.user_id');

        

        foreach ($event as $i => $arr) {
            if($arr->estado == 1){
                $estado = 'info';
            }else if($arr->estado == 2){
                $estado = 'success';
            }else{
                $estado = 'important';
            }
            $info[] = array (
                "title"     => $arr->user."\n".$arr->product."\n".$arr->hour."\n",
                "start"     => $arr->date." ".substr($arr->hour,0,8),
                "url"       => $arr->id.'/'.$arr->type.'/1/edit',
                "allDay"    => false,
                "className" => $estado
            );
        }


        foreach ($event2 as $i => $arr) {
            if($arr->estado == 1){
                $estado = 'info';
            }else if($arr->estado == 2){
                $estado = 'success';
            }else{
                $estado = 'important';
            }
            $info[] = array (
                "title"     => $arr->user."\n".$arr->product."\n".$arr->hour."\n",
                "start"     => $arr->date." ".substr($arr->hour,0,8),
                "url"       => $arr->id.'/'.$arr->type.'/1/edit',
                "allDay"    => false,
                "className" => $estado
            );
        }

        return json_encode($info);
    }
}
