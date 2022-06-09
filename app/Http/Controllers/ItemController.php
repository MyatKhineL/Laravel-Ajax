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

    public function editData($id){
        $data = Item::findorFail($id);
        return response()->json($data);
    }

    public function updateData(Request $request,$id){
        $request->validate([
            'title'=>'required',
            'price'=>'required'
        ]);
        $data = Item::findorFail($id);
        $data->title = $request->title;
        $data->price = $request->price;
        $data->update();

        return response()->json($data);

    }

    public function destroyData($id){
        $data = Item::findorFail($id);
        $data->delete();
        return response()->json($data);
    }
}
