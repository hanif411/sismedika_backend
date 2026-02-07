<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;

class TableController extends Controller
{
    public function GetAllTable()
    {
        $tables= Table::all();

        return response()->json([
            'success'=>true,
            'message'=>'success get all table',
            'data'=>$tables
        ],200);
    }
}
