<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use LDAP\Result;

class UserManageController extends Controller
{
    //========================================================== Nhân viên =====================================
    public function vendormanage()
    {
        $vendors = User::where('role', '=', '1')->get();
        return view('admin/manage/vendor', compact('vendors'));
    }
    public function createvendor()
    {
        return view('admin.manage.create_vendor');
    }

    public function insertVendor(Request $request)
    {
        // Validate the input
        $request->validate([
            'vendor_name' => 'required|string|max:255',
            'vendor_email' => 'required|email|unique:users,email',
            'vendor_pass' => 'required|string|min:6',
            'vendor_pass_confirm' => 'required|string|same:vendor_pass',
            'vendor_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            // Đường dẫn mặc định cho ảnh nếu không có ảnh được tải lên
            $imagePath = 'admin_asset/img/photos/blocks.png';

            // Kiểm tra nếu có file ảnh mới được tải lên
            if ($request->hasFile('vendor_img')) {
                $file = $request->file('vendor_img');

                // Tạo tên file duy nhất để tránh xung đột tên
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Đường dẫn đích trong thư mục `public/admin_asset/img/photos/`
                $destinationPath = public_path('admin_asset/img/photos');

                // Sử dụng `tmp_name` để di chuyển file từ thư mục tạm vào thư mục đích
                move_uploaded_file($file->getPathname(), $destinationPath . '/' . $fileName);

                // Cập nhật đường dẫn của ảnh
                $imagePath =  $fileName;
            }

            // Thêm mới dữ liệu nhân viên vào cơ sở dữ liệu
            User::create([
                'name' => $request->vendor_name,
                'email' => $request->vendor_email,
                'role' => 1, // Đặt role cố định thành 1
                'img_user' => $imagePath, // Lưu đường dẫn tương đối vào DB
                'password' => Hash::make($request->vendor_pass_confirm),
            ]);

            // Trả về thông báo thành công
            return redirect()->route('vendor.manage')->with('success', 'Nhân viên đã được thêm thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Lỗi thêm nhân viên');
        }
    }

    public function deletevendor($id)
    {
        $vendor = User::findOrFail($id);

        try {
            $vendor->delete();
            return redirect()->route('vendor.manage')->with(['success' => "Xóa nhân viên của ID $id thành công!"]);
        } catch (Exception $e) {
            echo $e->getMessage();
            return redirect()->back()->with('error', 'Lỗi , không xóa được chuyên mục!');
        }
    }

    public function vendoredit($id)
    {
        $vendor_info = User::find($id);
        return view('admin.manage.edit_vendor', compact('vendor_info'));
    }

    public function vendorupdate(Request $request, $id)
    {
        $vendor = User::findOrFail($id);

        // Validate the input
        $request->validate([
            'vendor_name' => 'required|string|max:255',
            'vendor_email' => 'required|email|unique:users,email,' . $id, // Không bắt trùng email của chính mình
            'vendor_pass' => 'nullable|string|min:6',
            'vendor_pass_confirm' => 'nullable|string|same:vendor_pass',
            'vendor_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            // Đường dẫn mặc định cho ảnh nếu không có ảnh được tải lên
            $imagePath = $vendor->img_user ?? 'admin_asset/img/photos/blocks.png';

            // Kiểm tra nếu có file ảnh mới được tải lên
            if ($request->hasFile('vendor_img')) {
                $file = $request->file('vendor_img');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('admin_asset/img/photos');
                $file->move($destinationPath, $fileName);
                $imagePath = $fileName;
            }

            // Cập nhật dữ liệu nhân viên vào cơ sở dữ liệu
            $vendor->update([
                'name' => $request->vendor_name,
                'email' => $request->vendor_email,
                'role' => 1, // Đặt role cố định thành 1
                'img_user' => $imagePath, // Lưu đường dẫn tương đối vào DB
                'password' => $request->vendor_pass ? Hash::make($request->vendor_pass) : $vendor->password,
            ]);

            return redirect()->route('vendor.manage')->with('success', 'Nhân viên đã được cập nhật thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Lỗi cập nhật nhân viên');
        }
    }

    public function vendorsearch(Request $request)
    {
        $searchTerm = $request->input('search_vendor');

        // Thay đổi điều kiện tìm kiếm để chỉ lấy các user có role = 1
        $vendors = User::where('role', '=', '1')
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchTerm . '%');
            })
            ->get();

        if ($vendors->isEmpty()) {
            return response('<tr><td colspan="6">Không tìm thấy nhân viên nào</td></tr>');
        } else {
            $output = '';
            foreach ($vendors as $vendor) {
                $imgPath = $vendor->img_user == null
                    ? asset('admin_asset/img/photos/blocks.png')
                    : asset("admin_asset/img/photos/{$vendor->img_user}");

                $output .= '
            <tr>
                <td>' . $vendor->name . '</td>
                <td>' . $vendor->email . '</td>
                <td>
                    <img src="' . $imgPath . '" alt="" class="img_user">
                </td>
                <td>
                    <a href="' . route('vendor.edit' , $vendor->id) . '" class="btn btn-success">Cập nhật hình ảnh khách hàng</a>
                </td>
                <td>
                    <form action="' . route('vendor.delete', $vendor->id) . '" method="post" class="d-inline">
                        ' . csrf_field() . '
                        ' . method_field('delete') . '
                        <input type="submit" value="Xóa" class="btn btn-danger">
                    </form>
                </td>
            </tr>';
            }
            return response($output);
        }
    }




    //==================================================== Khách hàng ==============================================
    public function clientmanage()
    {
        $clients = User::where('role', '=', '2')->get();
        return view('admin/manage/user', compact('clients'));
    }

    public function clientsearch(Request $request)
    {
        $searchTerm = $request->input('search_client');

        // Thay đổi điều kiện tìm kiếm để chỉ lấy các user có role = 2
        $clients = User::where('role', '=', '2')
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchTerm . '%');
            })
            ->get();

        if ($clients->isEmpty()) {
            return response('<tr><td colspan="3">Không tìm thấy khách hàng nào</td></tr>');
        } else {
            $output = '';
            foreach ($clients as $client) {
                $imgPath = $client->img_user == null
                    ? asset('admin_asset/img/photos/blocks.png')
                    : asset("admin_asset/img/photos/{$client->img_user}");

                $output .= '
            <tr>
                <td>' . $client->id . '</td>
                <td>' . $client->name . '</td>
                <td>' . $client->email . '</td>
                <td>
                    <img src="' . $imgPath . '" alt="" class="img_user">
                </td>
                <td>
                    <a href="' . route("show.client", $client->id) . '" class="btn btn-success">Cập nhật hình ảnh khách hàng</a>
                </td>
            </tr>';
            }

            return response($output);
        }
    }

    public function showclient($id)
    {
        $client = User::find($id);
        return view('admin.manage.edit_user_img', compact('client'));
    }

    public function updateimgclient(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate file upload
        $request->validate([
            'img_user' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Chỉ cho phép các định dạng hình ảnh
        ]);

        // Xử lý tệp hình ảnh mới nếu có
        if ($request->hasFile('img_user')) {
            $file = $request->file('img_user');

            // Lấy đường dẫn tạm của file (tmp_name)
            $tmpFilePath = $file->getPathname();

            // Tạo tên file mới để lưu, tránh xung đột tên
            $fileName = time() . $file->getClientOriginalName();

            // Đường dẫn đích để lưu file mới
            $destinationPath = public_path('admin_asset/img/photos/' . $fileName);

            // Di chuyển file từ thư mục tạm vào thư mục đích
            if (move_uploaded_file($tmpFilePath, $destinationPath)) {

                // Xóa hình ảnh cũ nếu không phải là mặc định và có tồn tại
                if ($user->img_user && $user->img_user !== 'blocks.png') {
                    $oldImagePath = public_path('admin_asset/img/photos/' . $user->img_user);

                    // Kiểm tra xem đường dẫn cũ có phải là tệp và tồn tại không
                    if (is_file($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Cập nhật tên hình ảnh mới trong cơ sở dữ liệu
                $user->img_user = $fileName;
            } else {
                return redirect()->back()->with('error', 'Lỗi , không thể di chuyển hình ảnh!');
            }
        }

        try {
            $user->save();
            return redirect()->route('client.manage')->with(['success' => "Cập nhật hình ảnh của ID $id thành công!"]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Lỗi , không cập nhật được hình ảnh!');
        }
    }
}
