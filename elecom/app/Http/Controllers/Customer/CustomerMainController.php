<?php

namespace App\Http\Controllers\Customer;

use Exception;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CartCus;
use App\Models\Orders;
use App\Models\Shipper;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class CustomerMainController extends Controller
{
    public function index()
    {
        return view('customer.dashboard');
    }

    public function introduce()
    {
        return view('customer.introduce');
    }

    public function contract()
    {
        return view('customer.lienhe');
    }

    public function countcartpro($id)
    {
        $cart_pro_count = CartCus::where('user_id', '=', $id)->count();
        $cart_pro = CartCus::where('user_id', '=', $id)->with('product')->get(); // Include product relationship
        return response()->json(['cart_pro_count' => $cart_pro_count, 'cart_pro' => $cart_pro]);
        // return view('customer.layouts.layout' , compact('cart_pro_count' , 'cart_pro'));
    }



    public function profile()
    {
        $customer_uncensor = Orders::where('orders_users_id', Auth::user()->id)
            ->where('orders_censor', 'Đang kiểm duyệt')
            ->count();

        $customer_censor = Orders::where('orders_users_id', Auth::user()->id)
            ->where('orders_censor', 'Đã kiểm duyệt')
            ->count();
        $shipper_info = Shipper::where('ship_users', Auth::user()->name)->count();
        return view('customer.profile', compact('customer_uncensor', 'customer_censor', 'shipper_info'));
    }

    public function list_order($id)
    {
        $customer_order_info = Orders::where('orders_users_id', $id)->get();
        return view('customer.order_info', compact('customer_order_info'));
    }

    public function delete_order_item($id){
        $delete_order_item = Orders::findOrFail($id);

        try{
          $delete_order_item->delete();
          return redirect()->back()->with(['success' => "Hủy đơn hàng $id thành công!"]);
        }catch(Exception $e){
            echo $e->getMessage();
            return redirect()->back()->with('error', 'Lỗi , không xóa được đơn hàng!');
        }

    }


    public function list_ship($name)
    {
        $customer_ship_info = Shipper::where('ship_users', $name)->get();
        return view('customer.ship_info', compact('customer_ship_info'));
    }


    // edit ảnh
    public function edit_profile(Request $request, $id)
    {
        $seller_img = User::findOrFail($id);
        $request->validate([
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        try {
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

            return redirect()->route('customer.profile')->with('success', "Bạn đã được cập nhật hình ảnh thành công.");
        } catch (Exception $e) {
            // Redirect back with error message including exception message for debugging
            return redirect()->back()
                ->with('error', 'Lỗi cập nhật hình ảnh: ' . $e->getMessage());
        }
    }
}
