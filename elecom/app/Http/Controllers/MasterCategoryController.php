<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class MasterCategoryController extends Controller
{
    public function storecat(Request $request)
    {
        $validate_data = $request->validate([
            'category_name' => 'unique:categories|max:100|min:2'
        ]);

        // Lưu dữ liệu vào bảng categories
        try {
            Category::create($validate_data);
            return redirect()->back()->with('success', 'Thêm chuyên mục thành công!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Lỗi , không thêm được chuyên mục!');
        }
    }


    public function showcat($id)
    {
        $category_info = Category::find($id);
        return view('admin.category.edit', compact('category_info'));
    }

    public function updatecat(Request $request, $id)
    {
        $category = category::findOrFail($id);
        $validate_data = $request->validate([
            'category_name' => 'unique:categories|max:100|min:2'
        ]);

        try {
            $category->update($validate_data);
            return redirect()->route('category.manage')->with(['success' => "Cập nhật chuyên mục của ID $id thành công!"]);
        } catch (Exception $e) {
            echo $e->getMessage();
            return redirect()->back()->with('error', 'Lỗi , không cập nhật được chuyên mục!');
        }
    }

    public function deletecat($id)
    {
        $category = category::findOrFail($id);

        try {
            $category->delete();
            return redirect()->route('category.manage')->with(['success' => "Xóa chuyên mục của ID $id thành công!"]);
        } catch (Exception $e) {
            echo $e->getMessage();
            return redirect()->back()->with('error', 'Lỗi , không xóa được chuyên mục!');
        }
    }

    public function searchcat(Request $request)
    {
        $searchTerm = $request->input('search_category');
        $categories = Category::where('category_name', 'LIKE', '%' . $searchTerm . '%')->get();

        if ($categories->isEmpty()) {
            return response('<tr><td colspan="3">Không tìm thấy danh mục nào</td></tr>');
        } else {
            $output = '';
            foreach ($categories as $category) {
                $output .= '
            <tr>
                <td>' . $category->id . '</td>
                <td>' . $category->category_name . '</td>
                <td>
                    <form action="' . route('delete.cat', $category->id) . '" method="post" class="d-inline">
                        ' . csrf_field() . '
                        ' . method_field('delete') . '
                        <input type="submit" value="Xóa" class="btn btn-danger">
                    </form>
                    <a href="' . route('show.cat', $category->id) . '" class="btn btn-success">Cập nhật</a>
                </td>
            </tr>';
            }
            return response($output);
        }
    }
}
