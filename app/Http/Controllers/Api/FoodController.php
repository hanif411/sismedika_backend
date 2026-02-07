<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index()
    {
        $foods= Food::all();
        return response()->json([
            'success'=>true,
            'message'=>'succes get all food',
            'data'=>$foods,
            ],200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'price'=>'required|numeric',
            'stock'=>'required|integer'
        ]);

        $food = Food::create($request->all());
        return response()->json([
            'success'=>true,
            'message'=>"Success create food",
            'data'=>$food,
        ],201);
    }

    public function show($id)
    {
        $food = Food::find($id);
        if (!$food) return response()->json(['status'=>true,'message'=>"food not found"],404);

        return response()->json([
            'status'=> true,
            'message'=>"succes get found by id",
            'data'=>$food
        ],200);
    }

    public function update(Request $request, $id)
    {
        $food = Food::find($id);
        if (!$food) return response()->json(['success'=>true,'message' => 'food not found'], 404);

        $food->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Success update food',
            'data' => $food
        ]);
    }

    public function destroy($id)
    {
        $food = Food::find($id);
        if (!$food) return response()->json(['succes'=>true,'message' => 'food not found'], 404);
        $food->delete();

        return response()->json([
            'success' => true,
            'message' => 'succes delete food'
        ]);
    }
}
