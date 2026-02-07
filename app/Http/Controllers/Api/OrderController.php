<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['table', 'orderItems.food'])->orderBy('created_at', 'desc')->get();
        return response()->json(['success' => true, 'data' => $orders]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'items' => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'table_id' => $request->table_id,
                'total_price' => 0, 
                'status' => 'pending'
            ]);
            $totalPrice = 0;

            foreach ($request->items as $item) {
                $food = \App\Models\Food::find($item['food_id']);
                $subtotal = $food->price * $item['quantity'];
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'food_id'  => $food->id,
                    'quantity' => $item['quantity'],
                    'price'    => $food->price
                ]);

                $totalPrice += $subtotal;
            }

            $order->update(['total_price' => $totalPrice]);
            Table::where('id', $request->table_id)->update(['status' => 'occupied']);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Order Berhasil!', 'data' => $order], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function completeOrder($id)
    {
        $order = Order::find($id);
        if (!$order) return response()->json(['message' => 'Order ga ada'], 404);

        $order->update(['status' => 'completed']);
        Table::where('id', $order->table_id)->update(['status' => 'available']);

        return response()->json([
            'success' => true, 
            'message' => 'Pesanan Selesai & Meja Kosong!',
            'total_bayar' => $order->total_price
        ]);
    }
}