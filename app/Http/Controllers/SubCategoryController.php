<?php

namespace App\Http\Controllers;

use App\Exports\SubCategoryExport;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\isEmpty;

class SubCategoryController extends Controller
{
    public function index()
    {
        $sub_categories = SubCategory::all();

        return response()->json([
            'message' => 'Sub Categories Fetched Successfully!!',
            'total_subcategories' => $sub_categories->count(),
            'data' => $sub_categories,
            'status' => 1
        ]);
    }

    public function create(Request $request)
    {
        if (!$request->name) {
            return response()->json([
                'message' => 'Please enter name of the Sub category',
                'status' => 0
            ]);
        } else {
            $sub_category = SubCategory::create([
                'parent_category_id' => $request->category_id,
                'name' => $request->name
            ]);

            return response()->json([
                'message' => 'Sub category created successfully',
                'data' => $sub_category,
                'status' => '1'
            ]);
        }
    }

    public function update(Request $request)
    {
        if (!isEmpty($request->id)) {
            return response()->json([
                'message' => 'Please select a category',
                'status' => 0
            ]);
        } else {
            $sub_category = SubCategory::where('id', $request->id)->first();

            if (!$sub_category) {
                return response()->json([
                    'message' => 'No such sub category found'
                ]);
            } else {
                if (!$request->name && !$request->category_id) {
                    return response()->json([
                        'message' => 'please enter changes to update'
                    ]);
                } else {
                    $sub_category->name = $request->name;
                    $sub_category->parent_category_id = $request->category_id;
                    $sub_category->save();
                    return response()->json([
                        'message' => 'Sub Category Updated',
                        'status' => '1'
                    ]);
                }
            }
        }
    }

    public function delete(Request $request)
    {
        $sub_category = SubCategory::where('id', $request->id)->first();

        if (!$sub_category) {
            return response()->json([
                'message' => 'No such Sub category found',
                'status' => 0
            ]);
        } else {
            $sub_category->delete();
            return response()->json([
                'message' => 'Sub Category deleted successfully',
                'status' => 1
            ]);
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new SubCategoryExport, 'subcategory.xlsx');
    }
}
