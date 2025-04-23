<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProductApiController extends Controller
{
    public function getAllProduct(Request $request)
    {

        $take = $request->input('take');
        $product = Product::latest()->when($take, function ($q) use ($take) {
            $q->take($take);
        })->get();
        $product = $product->map(function ($val) {
            $val->image = asset('storage/' . $val->image);
            return $val;
        });

        return Response::api(data: $product);
    }

    public function getProductById($id)
    {
        
        $product = Product::find($id);
        if (!$product) {
            return Response::api(statusCode: 404, data: [], message:"Product Not Found");
        } else {
            return Response::api(data: $product);
        }
    }
}
