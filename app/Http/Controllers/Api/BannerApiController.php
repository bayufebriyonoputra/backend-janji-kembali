<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BannerApiController extends Controller
{
    public function list()
    {
        $banners = Banner::all();
        $banners = $banners->map(function($item){
            $item->image = asset('storage/'. $item->image);
            return $item;
        });
        return Response::api(data: $banners);
    }
}
