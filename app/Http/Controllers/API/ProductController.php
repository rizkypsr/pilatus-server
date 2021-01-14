<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Helpers\ResponseFormatter;

class ProductController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $category = $request->input('category_id');

        if($id)
        {
            $product = Product::find($id);

            if($product)
                return ResponseFormatter::success(
                    $product,
                    'Data produk berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data produk tidak ada',
                    404
                );
        }

        $product = Product::query();

        if($name)
            $product->where('name', 'like', '%' . $name . '%');

        if($category)
            $product->where('category_id', $category);

        return ResponseFormatter::success(
            $product->get(),
        );
    }
}
