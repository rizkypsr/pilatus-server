<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');

        if($id)
        {
            $category = Category::find($id);

            if($category){
                return ResponseFormatter::success(
                    $category,
                    'Data category berhasil diambil'
                );
            }
            else
            {
                return ResponseFormatter::error(
                    null,
                    'Data category tidak ada',
                    404
                );
            }
        }

        $category = Category::query();

        return ResponseFormatter::success(
            $category->get(),
            'Data list category berhasil diambil'
        );

    }
}
