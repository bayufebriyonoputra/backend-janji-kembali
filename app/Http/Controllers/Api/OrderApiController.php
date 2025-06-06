<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\OrderHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class OrderApiController extends Controller
{
    public function makeOrder(Request $request){
        $code = uniqid();
        $order = OrderHeader::create([
            'tgl_order' => $request->tgl_order,
            'member_id' => auth()->guard('api')->user()->id,
            'status' => 'new',
            'code' => $request->order_ref,
            'jenis_pembayaran' => $request->jenis_pembayaran, // Assuming jenis_pembayaran is passed in the request
            //TODO: Add implementation of payment id later
        ]);

        $details = collect($request->detail);
        $details = $details->map(function ($item) use ($order, $request){
            $item['header_id'] = $order->id;
            $item['subtotal'] = $request->price * $request->qty;
            return $item;
        });

        $details->each(function ($item){
            OrderDetail::create($item);
        });

        return Response::api(data:['code' => uniqid()], message:'order berhasil dibuat');
    }
}
