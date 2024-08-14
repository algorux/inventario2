<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Item;
use App\Models\Compra;
use Carbon\Carbon;

class InventoryController extends Controller
{

    public function registerView(Request $request): View
    {
        $elementos = Item::all();
        return view('registrar_view', ['elementos'=>$elementos]);
    }

    public function resumen (Request  $request) {
        
        $elementos = Item::all();
        $compras_por_elemento = new \stdClass();
        $compras_totales = [];
        foreach ($elementos as $elemento) {
            $compras_por_elemento = new \stdClass();
            $compras = Compra::where('cat_item_id',$elemento->id)->sum('cantidad');
            $compras_por_elemento->descripcion_compra=$elemento->descripcion_compra;
            $compras_por_elemento->cantidad_ocupada = $compras;
            $compras_por_elemento->max_cap = $elemento->max_cap;
            $compras_por_elemento->color = InventoryController::rand_color();
            $compras_por_elemento->id=$elemento->id;
            $compras_por_elemento->at=$elemento->at_no;
            $compras_por_elemento->tipo=$elemento->descripcion;

            array_push($compras_totales, $compras_por_elemento);

        }
        return view('resumen', ['compras' => $compras_totales] );
    }

    public function rand_color() {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }

    public function registerStoreElem(Request $request){
         $id = $request->input('id');
         $validated = $request->validate([
            'at' => 'required|max:255',
            'descrpcion' => 'required',
            'type' => 'required',
            'max' => 'required',
            ]);
         if (isset($id) && $id>0) {
            $item = Item::find($id);
         }
         else{
            $item = new Item;
         }  
         
         $item->at_no = $request->input('at');
         $item->descripcion_compra = $request->input('descrpcion');
         $item->descripcion = $request->input('type');
         $item->max_cap = $request->input('max');
         $item->save();
         $elementos = Item::all();
         return Redirect::route('registrar.view')->with(['alert_element' => 'Success', 'elementos'=> $elementos]);
    }
    public function registerStoreAdq(Request $request){
        //$fcompra= $request->input('f_compra');
        //var_dump($fcompra); 
        //die();

        $id = $request->input('id');
        
        if (null != $request->input('cantidad')&& null != $request->input('cat_item_id')) 
        {

            $cat_item_id = $request->input('cat_item_id');
            $item = Item::find($cat_item_id);
            $compras = Compra::where('cat_item_id',$cat_item_id)->sum('cantidad');
            $out = $item->max_cap-$compras;
        }
        else
        {
            $out =0;
        }
         $validated = $request->validate([
            'cat_item_id' => 'required',
            'cantidad' => 'required|integer|max:'.$out,
            'f_compra' => 'required',
            ]);
         if (isset($id) && $id>0) {
            $compra = Compra::find($id);
         }
         else{
            $compra = new Compra;
         }  
         
         $compra->cat_item_id = $request->input('cat_item_id');
         $compra->cantidad = $request->input('cantidad');
         $date = Carbon::parse($request->input('f_compra'));
         $compra->f_compra = $date->format('Y-m-d');
         $compra->save();
         $elementos = Item::all();
         return Redirect::route('registrar.view')->with(['alert_adq' => 'Success', 'elementos'=> $elementos]);

    }

    public function componentView(Request $request, $id){
        $item = Item::with('compras')->find($id);
        return view('compras', ['item'=>$item]);
    }
}
