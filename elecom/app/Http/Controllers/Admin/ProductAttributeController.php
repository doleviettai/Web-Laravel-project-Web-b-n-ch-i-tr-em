<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Models\DefaultAttribute;
use App\Http\Controllers\Controller;

class ProductAttributeController extends Controller
{
    public function index(){
        return view('admin.product_attribute.create');
    }

    public function manage(){
        $allattribute = DefaultAttribute::all();
        return view('admin.product_attribute.manage' , compact('allattribute'));
    }

    public function createattribute(Request $request){
        $validate_data = $request->validate([
            'attribute_value'=>'unique:default_attributes|max:100'
        ]);

        DefaultAttribute::create($validate_data);
        return redirect()->back()->with('success','Thêm dữ liệu ban đầu của sản phẩm thành công');
    }

    public function showattribute($id)
    {
        $attribute_info = DefaultAttribute::find($id);
        return view('admin.product_attribute.edit', compact('attribute_info'));
    }

    public function updateattribute(Request $request, $id)
    {
        $attribute = DefaultAttribute::findOrFail($id);
        $validate_data = $request->validate([
            'attribute_value'=>'unique:default_attributes|max:100'
        ]);

        try {
            $attribute->update($validate_data);
            return redirect()->route('productattribute.manage')->with(['success' => "Cập nhật dữ liệu ban đầu của ID $id thành công!"]);
        } catch (Exception $e) {
            echo $e->getMessage();
            return redirect()->back()->with('error', 'Lỗi , không cập nhật được dữ liệu!');
        }
    }

    public function deleteattribute($id)
    {
        $attribute = DefaultAttribute::findOrFail($id);

        try {
            $attribute->delete();
            return redirect()->route('productattribute.manage')->with(['success' => "Xóa dữ liệu ban đầu của ID $id thành công!"]);
        } catch (Exception $e) {
            echo $e->getMessage();
            return redirect()->back()->with('error', 'Lỗi , không xóa được dữ liệu ban đầu!');
        }
    }

    public function searchattribute(Request $request)
    {
        $searchTerm = $request->input('search_attribute');
        $attributies = DefaultAttribute::where('attribute_value', 'LIKE', '%' . $searchTerm . '%')->get();

        if ($attributies->isEmpty()) {
            return response('<tr class="alert alert-danger"><td colspan="5"><center>Không tìm thấy danh mục nào</center></td></tr>');
        } else {
            $output = '';
            foreach ($attributies as $attribute) {
                $output .= '
            <tr>
                <td>' . $attribute->id . '</td>
                <td>' . $attribute->attribute_value. '</td>
                <td>
                    <form action="' . route('delete.attribute', $attribute->id) . '" method="post" class="d-inline">
                        ' . csrf_field() . '
                        ' . method_field('delete') . '
                        <input type="submit" value="Xóa" class="btn btn-danger">
                    </form>
                </td>
                <td>
                <a href="' . route('show.attribute', $attribute->id) . '" class="btn btn-success">Cập nhật</a>
                </td>
            </tr>';
            }
            return response($output);
        }
    }
}
