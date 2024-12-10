<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use function PHPUnit\Framework\isEmpty;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'message' => 'Categories Fetched Successfully!!',
            'total_categories' => $categories->count(),
            'data' => $categories,
            'status' => 1
        ]);
    }

    public function create(Request $request)
    {
        if (!isEmpty($request->name)) {
            return response()->json([
                'message' => 'Please enter name of the category',
                'status' => 0
            ]);
        } else {
            $category = Category::create([
                'name' => $request->name
            ]);

            return response()->json([
                'message' => 'Category created',
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
            $category = Category::where('id', $request->id)->first();

            if (!$category) {
                return response()->json([
                    'message' => 'No such category found'
                ]);
            } else {
                if (!$request->name) {
                    return response()->json([
                        'message' => 'please enter changes to update'
                    ]);
                } else {
                    $category->name = $request->name;
                    $category->save();
                    return response()->json([
                        'message' => 'Category Updated',
                        'status' => '1'
                    ]);
                }
            }
        }
    }

    public function delete(Request $request)
    {
        $category = Category::where('id', $request->id)->first();                        // fetch the category to delete

        if (!$category) {
            return response()->json([
                'message' => 'No such category found',
                'status' => 0
            ]);
        } else {
            $subCat = SubCategory::where('parent_category_id', $request->id)->count();    // check if there are sub-cat for the this category

            if ($subCat == 0) {
                $category->delete();
                return response()->json([
                    'message' => 'Category deleted successfully',
                    'status' => 1
                ]);
            } else {
                return response()->json([
                    'message' => 'Category can not be deleted, sub-categories for this category exists',
                    'status' => 0
                ]);
            }
        }
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        foreach ($fileContents as $line) {
            $data = str_getcsv($line);

            Category::create([
                'name' => $data[0],
            ]);
        }

        return response()->json([
            'message' => 'File imported, Categories added to table',
            'status' => 1
        ]);
    }
}
