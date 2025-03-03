<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class MasterSubcategoryController extends Controller
{
    public function storesubcat(Request $request)
    {
        $validate_data = $request->validate([
            'subcategory_name' => 'unique:subcategories|max:100|min:2',
            'category_id' => 'required|exists:categories,id'
        ]);

        // Lưu dữ liệu vào bảng categories
        try {
            Subcategory::create($validate_data);
            return redirect()->back()->with('success', 'Thêm chuyên mục nhỏ thành công!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Lỗi , không thêm được chuyên mục!');
        }
    }

    public function showsubcat($id)
    {
        $subcategory_info = Subcategory::find($id);
        return view('admin.sub_category.edit', compact('subcategory_info'));
    }

    public function updatesubcat(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $validate_data = $request->validate([
            'subcategory_name' => 'unique:subcategories|max:100|min:2',
        ]);

        try {
            $subcategory->update($validate_data);
            return redirect()->route('subcategory.manage')->with(['success' => "Cập nhật chuyên mục nhỏ của ID $id thành công!"]);
        } catch (Exception $e) {
            //Log::error($e); // Ghi lại lỗi để kiểm tra trong file log
            //->withErrors($e->getMessage())
            return redirect()->back()->with('error', 'Lỗi: không cập nhật được chuyên mục!');
        }
    }

    public function deletesubcat($id)
    {
        $Subcategory = Subcategory::findOrFail($id);

        try {
            $Subcategory->delete();
            return redirect()->route('subcategory.manage')->with(['success' => "Xóa chuyên mục nhỏ của ID $id thành công!"]);
        } catch (Exception $e) {
            echo $e->getMessage();
            //->withErrors($e->getMessage())
            return redirect()->back()->with('error', 'Lỗi , không xóa được chuyên mục!');
        }
    }

    public function searchsubcat(Request $request)
    {
        $searchTerm = $request->input('search_subcategory');

        // Tìm kiếm trên subcategory và liên kết với category
        $subcategories = Subcategory::where('subcategory_name', 'LIKE', '%' . $searchTerm . '%')
            ->orWhereHas('category',function ($query) use ($searchTerm) {
                $query->where('category_name', 'LIKE', '%' . $searchTerm . '%');
            })->get();

        if ($subcategories->isEmpty()) {
            return response('<tr class="alert alert-danger"><td colspan="5"><center>Không tìm thấy danh mục nào</center></td></tr>');
        } else {
            $output = '';
            foreach ($subcategories as $subcategory) {
                $output .= '
        <tr>
            <td>' . $subcategory->id . '</td>
            <td>' . $subcategory->subcategory_name . '</td>
            <td>' . $subcategory->category->category_name . '</td>
            <td>
                <form action="' . route('delete.subcat', $subcategory->id) . '" method="post" class="d-inline">
                    ' . csrf_field() . '
                    ' . method_field('delete') . '
                    <input type="submit" value="Xóa" class="btn btn-danger">
                </form>
            </td>
            <td>
                <a href="' . route('show.subcat', $subcategory->id) . '" class="btn btn-success">Cập nhật</a>
            </td>
        </tr>';
            }
            return response($output);
        }
    }
}
