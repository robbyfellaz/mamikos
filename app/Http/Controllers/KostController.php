<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kost;
use Auth;

class KostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kost = Kost::all();

        return view('kost', ['kost' => $kost]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|max:255',
            'description' => 'required',
            'location' => 'required',
            'price' => 'required',
            'available_room' => 'required',
            'image' => 'required',
        ]);
  
        $kost = Kost::updateOrCreate(['id' => $request->id], [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'location' => $request->location,
            'available_room' => $request->available_room,
            'image' => $request->image
        ]);
  
        return response()->json([
            'code'=>200, 
            'message'=>'Kost Created successfully',
            'data' => $kost], 
            200
        );
    }

    public function show($id)
    {
        $kost = Kost::find($id);

        return response()->json($kost);
    }

    public function destroy($id)
    {
        $kost = Kost::find($id)->delete();

        return response()->json(['success'=>'Kost Deleted successfully']);
    }
}
