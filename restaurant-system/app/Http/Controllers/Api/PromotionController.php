<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promotion;

class PromotionController extends Controller
{
    public function active()
    {
        $promotion = Promotion::where('valid_from', '<=', now())
            ->where('valid_until', '>=', now())
            ->first();

        return response()->json($promotion);
    }
}
