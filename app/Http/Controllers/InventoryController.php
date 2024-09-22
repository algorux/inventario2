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
use App\Models\Bodega;
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
            $compras = Compra::where('cat_item_id',$elemento->id)->where('status', 'Entregado')->sum('cantidad');
            $compras_por_elemento->descripcion_compra=$elemento->descripcion_compra;
            $compras_por_elemento->cantidad_ocupada = $compras;
            $compras_por_elemento->max_cap = $elemento->max_cap;
            $compras_por_elemento->color = InventoryController::rand_color();
            $compras_por_elemento->id=$elemento->id;
            $compras_por_elemento->at=$elemento->at_no;
            $compras_por_elemento->tipo=$elemento->descripcion;
            $compras_por_elemento->responsable=$elemento->responsable;
            $compras_por_elemento->inv_no=$elemento->inv_no;

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
            'inv_no' => 'required|max:255',
            'descrpcion' => 'required',
            'type' => 'required',
            'max' => 'required',
            'responsable' => 'required|max:255',
            'inv_no' => 'required|max:255',
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
         $item->responsable = $request->input('responsable');
         $item->inv_no = $request->input('inv_no');
         $item->save();
         if($request->ajax()){
                return $item->toJson();
         }
         $elementos = Item::all();

         return Redirect::route('registrar.view')->with(['alert_element' => 'Success', 'elementos'=> $elementos]);
    }
    public function registerStoreAdq(Request $request){
        //$fcompra= $request->input('f_compra');
        //var_dump($fcompra); 
        //die();

        $id = $request->input('id');
        if (isset($id) && $id>0) {
            $compra = Compra::find($id);
         }
         else{
            $compra = new Compra;
         }  
        if (null != $request->input('cantidad')&& null != $request->input('cat_item_id')) 
        {

            $cat_item_id = $request->input('cat_item_id');
            $item = Item::find($cat_item_id);
            $compras = Compra::where('cat_item_id',$cat_item_id)->sum('cantidad');
            $out = $item->max_cap-$compras;
            if (isset($id) && $id>0) {
                $out += $compra->cantidad;
            }
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
         
         
         $compra->cat_item_id = $request->input('cat_item_id');
         $compra->cantidad = $request->input('cantidad');
         $date = Carbon::parse($request->input('f_compra'));
         $compra->f_compra = $date->format('Y-m-d');
         if ($request->has('f_estimada_ent') && $request->input('f_estimada_ent') != "") {
             $date = Carbon::parse($request->input('f_estimada_ent'));
            $compra->f_estimada_ent = $date->format('Y-m-d');
         }
         if ($request->has('f_entrega')&& $request->input('f_entrega') != "") {
             $date = Carbon::parse($request->input('f_entrega'));
            $compra->f_entrega = $date->format('Y-m-d');
         }

         if ($request->has('status')) {
             $compra->status = $request->input('status');
         }
         if ($request->has('bodega_id')) {
             $compra->bodega_id = $request->input('bodega_id');
         }
         $compra->save();
         if($request->ajax()){
                return $compra->toJson();
         }
         $elementos = Item::all();
         
         return Redirect::route('registrar.view')->with(['alert_adq' => 'Success', 'elementos'=> $elementos]);

    }

    public function componentView(Request $request, $id){
        $item = Item::with('compras')->find($id);
        $cat_bodegas = Bodega::all();
        return view('compras', ['item'=>$item, 'bodegas' => $cat_bodegas]);
    }
    public function compraDelete(Request $request, $id){
        Compra::where('id',$id)->delete();
        return '{"Result":"ok"}';
    }
    public function compraGet(Request $request, $id){
        $compra = Compra::find($id);
        return $compra->toJson();
    }
    public function componenteGet(Request $request, $id){
        $compra = Item::find($id);
        return $compra->toJson();
    }

    public function registerBodega(Request $request){
        $id = $request->input('id');
         $validated = $request->validate([
            'nombre' => 'required|max:255',
            'direccion' => 'required|max:255',
            ]);
         if (isset($id) && $id>0) {
            $bodega = Bodega::find($id);
         }
         else{
            $bodega = new Bodega;
         }  
         
         $bodega->nombre = $request->input('nombre');
         $bodega->direccion = $request->input('direccion');
         $bodega->save();
         $elementos = Item::all();
         return Redirect::route('registrar.view')->with(['alert_bodega' => 'Success', 'elementos'=> $elementos]);
    }

    public function moreData(){
        //echo date("d/m/Y",strtotime('01-07-2024'));
        //die();
        $compras = Compra::all();
        $faltantes= $total_compras = Item::all()->sum('max_cap');
        $statuses = [];
        $entregados = $comprados = $transito = 0;
        $b_comprados = $b_transito = $b_entregados= [0,0,0,0,0,0];
        $meses = [
            //mes[0] -> fecha_inicial
            //mes[1] -> fecha_final
            //mes[2] -> comprados
            //mes[3] -> transito
            //mes[4] -> entregados
            'Julio'=>[strtotime('01-07-2024'), strtotime('31-07-2024'),0,0,0],
            'Agosto'=>[strtotime('01-08-2024'), strtotime('31-08-2024'),0,0,0],
            'Septiembre'=>[strtotime('01-09-2024'), strtotime('30-09-2024'),0,0,0],
            'Octubre'=>[strtotime('01-10-2024'), strtotime('31-10-2024'),0,0,0],
            'Noviembre'=>[strtotime('01-11-2024'), strtotime('30-11-2024'),0,0,0],
            'Diciembre'=>[strtotime('01-11-2024'), strtotime('31-11-2024'),0,0,0],
        ];
        
        foreach($compras as $compra){
            
            if ($compra->status == "Entregado") {
                $entregados += $compra->cantidad;
                $conta_meses=0;
                foreach($meses as $mes=>$data){
                    if (strtotime($compra->f_entrega)>$data[0] && strtotime($compra->f_entrega)<$data[1]) {
                        $meses[$mes][4] += intval($compra->cantidad);
                        $b_entregados[$conta_meses] += intval($compra->cantidad);
                    }
                    $conta_meses++;
                }
            }
            else if ($compra->status == "Comprado") {
                $comprados += $compra->cantidad;
                $conta_meses=0;
                foreach($meses as $mes=>$data){
                    if (strtotime($compra->f_estimada_ent)>$data[0] && strtotime($compra->f_estimada_ent)<$data[1]) {
                        $meses[$mes][2] += intval($compra->cantidad);
                        $b_comprados[$conta_meses]+= intval($compra->cantidad);
                    }
                    $conta_meses++;
                }
            }
            else if ($compra->status == "En tránsito") {
                $transito += $compra->cantidad;
                $conta_meses =0;
                foreach($meses as $mes=>$data){
                    if (strtotime($compra->f_compra)>$data[0] && strtotime($compra->f_compra)<$data[1]) {
                        $meses[$mes][3] += intval($compra->cantidad);
                        $b_transito[$conta_meses] += intval($compra->cantidad);
                    }
                    $conta_meses++;
                }
            }
            
            $total_compras -= $compra->cantidad;

        }
        
        echo "<pre>";
        var_dump($meses);
        echo "</pre>";
        die();
        $t_compras = Compra::where('status', "Comprado")->with('item')->get();
        $t_transito = Compra::where('status', "En tránsito")->with('item')->get();
        $t_entregado = Compra::where('status', "Entregado")->with('item')->get();
        $totales =  [$comprados, $transito, $entregados, $faltantes];
        return view('more_data', [
            'status_data'=>$totales, 
            'b_comprados'=> $b_comprados,
            'b_transito'=> $b_transito,
            'b_entregados'=> $b_entregados, 
            't_compras' => $t_compras,
            't_transito' => $t_transito,
            't_entregado' => $t_entregado,
        ]);
    }
}
