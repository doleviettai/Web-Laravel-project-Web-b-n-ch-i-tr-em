<?php

namespace App\Http\Controllers\Seller;

use App\Models\User;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Shipper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
// use Illuminate\Support\Facades\Auth;

class SellerMainController extends Controller
{
    public function index() {
        $products = Product::count();
        $orders = Orders::where('orders_censor', 'Đang kiểm duyệt')->count();
        $vendors = User::where('role', '1')->count();
        $total_price = Shipper::sum('ship_price');

        // Lấy dữ liệu biểu đồ từ Shipper
        $ship_data = Shipper::select('ship_price', 'created_at')->get();

        return view('seller.dashboard', compact('products', 'orders', 'vendors', 'total_price', 'ship_data'));
    }



    public function orderhistory(){
        return view('seller.orderhistory');
    }

    public function edit_img(Request $request , $id){
        // Auth::id();
       $seller_img = User::findOrFail($id);
       $request->validate([
        //   'profile_name' => 'required|string|max:255',
        //   'profile_id' => 'required|integer',
        //   'profile_email' => 'required|email',
        //   'profile_role' => 'required|integer',
          'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
       ]);


        try{
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

            return redirect()->route('vendor.order.history')->with('success', "Nhân viên $seller_img->name đã được cập nhật hình ảnh thành công.");
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Lỗi cập nhật hình ảnh');
        }
    }
}
