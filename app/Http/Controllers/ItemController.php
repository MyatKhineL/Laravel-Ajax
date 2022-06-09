<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(){
        return view('item.create');
    }

    public function allData(){
          $data = Item::all();
          return response()->json($data);
    }
    public function storeData(Request $request){
          $request->validate([
             'title'=>'required',
             'price'=>'required'
          ]);

          $data = new Item();
          $data->title = $request->title;
          $data->price = $request->price;
          $data->save();

          return response()->json($data);
    }
}
