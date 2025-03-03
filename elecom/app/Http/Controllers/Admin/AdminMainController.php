<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shipper;

class AdminMainController extends Controller
{
    public function index(){
        $products = Product::all()->count();
        $orders = Orders::where('orders_censor','=','Đang kiểm duyệt')->count();
        $vendors = User::where('role' , '=' ,'1')->count();
        $total_price = Shipper::sum('ship_price');
        return view('admin/admin' , compact('products' ,'orders' ,'vendors','total_price'));
    }

    public function setting(){
        return view('admin/settings');
    }

    public function manage_user(){
        return view('admin/manage/user');
    }

    public function manage_stores(){
        return view('admin/manage/store');
    }

    public function edit_admin_img(Request $request , $id){
        $seller_img = User::findOrFail($id);
        $request->validate([
           'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);



             $imagePath = $seller_img->img_user ?? 'admin_asset/img/photos/blocks.png';

             // Kiểm tra nếu có file ảnh mới được tải lên
             if ($request->hasFile('profile_img')) {
                 $file = $request->file('profile_img');
                 $fileName = time() . '_' . $file->getClientOriginalName();
                 $destinationPath = public_path('admin_asset/img/photos');
                 $file->move($destinationPath, $fileName);
                 $imagePath = $fileName;
             }

             $seller_img->update([
                 'img_user' => $imagePath
             ]);

             return redirect()->route('admin.settings')->with('success', "Bạn $seller_img->name đã được cập nhật hình ảnh thành công.");

    }
}
