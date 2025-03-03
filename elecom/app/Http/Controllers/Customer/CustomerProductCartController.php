<?php

namespace App\Http\Controllers\Customer;

use Exception;
use App\Models\Orders;
use App\Models\CartCus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerProductCartController extends Controller
{
    public function cart() {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Lấy giỏ hàng của người dùng hiện tại
        $mycarts = CartCus::where('user_id', Auth::user()->id)->get();

        // Lấy danh sách sản phẩm trong giỏ hàng của người dùng
        $cartsList = $mycarts->map(function ($cart) {
            return $cart->product->product_name . " (" . $cart->cart_quantity . ")";
        })->implode(" | ");
        $cartquantity_pro =CartCus::where('user_id', Auth::user()->id)->count();

        // Tính tổng số lượng và tổng giá của sản phẩm trong giỏ hàng
        $cartquantity = CartCus::where('user_id', Auth::user()->id)->sum('cart_quantity');
        $carttotal_price = CartCus::where('user_id', Auth::user()->id)->sum('cart_price');

        return view('customer.cart.cart', compact('mycarts', 'cartsList','cartquantity_pro', 'cartquantity', 'carttotal_price'));
    }

    public function delete_cart_item($id){
        $cart = CartCus::findOrFail($id);

        try {
            $cart->delete();
            return redirect()->route('customer.cart')->with(['success' => "Xóa sản phẩm của {$cart->product->product_name} thành công!"]);
        } catch (Exception $e) {
            echo $e->getMessage();
            return redirect()->back()->with('error', 'Lỗi , không xóa được sản phẩm!');
        }
    }

    public function cart_create_order(Request $request)
    {
        $customerNameID = $request->input('cus_product_user_id'); // ID khách hàng
        $productName = $request->input('cus_product_name'); // Tên sản phẩm
        $productPrice = $request->input('cus_product_price'); // Giá sản phẩm
        $productQuantity = $request->input('cus_product_quantity'); // Số lượng sản phẩm

        if (!$productQuantity || !$productPrice) {
            return back()->with('error', 'Thông tin sản phẩm không hợp lệ.');
        }

        return view('customer.cart.cart_create_order' , compact('customerNameID' , 'productName' , 'productPrice' , 'productQuantity'));
    }

    public function cart_insert_order(Request $request){
        $request->validate([
            'order_user_id' => 'required|integer',
            'order_product' => 'required|string',
            'order_quantity' => 'required|integer',
            'order_totalprice' => 'required|numeric|min:0.001',
            'order_phonenumber' => 'nullable|string|max:15' ,
            'order_address'=>'nullable|string|max:255'
        ]);

        Orders::create([
                'orders_id'=>time(),
                'orders_users_id'=> $request->order_user_id,
                'orders_product'=> $request->order_product,
                'orders_quantity'=> $request->order_quantity,
                'orders_price'=> $request->order_totalprice,
                'orders_censor'=> "Đang kiểm duyệt",
                'orders_phonenumber'=> $request->order_phonenumber,
                'orders_address'=> $request->order_address,
        ]);

        $cart_delete = CartCus::where('user_id','=',$request->order_user_id);
        $cart_delete->delete();
        return redirect()->route('customer.product')->with('success', 'Đơn hàng đã được thanh toán và đang được kiểm duyệt.');
    }
}
