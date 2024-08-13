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
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function registerView(Request $request): View
    {
        $elementos = Item::all();
        return view('registrar_view', ['elementos'=>$elementos]);
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
         return view('registrar_view', ['alert_element' => 'Success', 'elementos'=> $elementos]);
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
         return view('registrar_view', ['alert_element' => 'Success', 'elementos'=> $elementos]);

    }
}
