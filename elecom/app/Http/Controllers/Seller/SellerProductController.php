<?php

namespace App\Http\Controllers\Seller;

use Exception;
use App\Models\User;
use App\Models\Orders;
use App\Models\Product;
use App\Models\AC_order;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\DefaultAttribute;
use App\Http\Controllers\Controller;

class SellerProductController extends Controller
{
    public function index(){
        // $products = Product::all();
        $products = Product::paginate(4);
        return view('seller.product.manage', compact('products'));
    }

    public function productsearch(Request $request)
    {
        $searchTerm = $request->input('search_product_vendor');

        $products = Product::where('product_name', 'like', "%$searchTerm%")
            ->orWhere('id', 'like', "%$searchTerm%")
            ->orWhere('product_price', 'like', "%$searchTerm%")
            ->orWhere('product_status', 'like', "%$searchTerm%")
            ->orWhere('product_quantity', 'like', "%$searchTerm%")
            ->orWhereHas('category', function ($query) use ($searchTerm) {
                $query->where('category_name', 'like', "%$searchTerm%");
            })
            ->orWhereHas('subcategory', function ($query) use ($searchTerm) {
                $query->where('subcategory_name', 'like', "%$searchTerm%");
            })
            ->orWhereHas('default_attribute', function ($query) use ($searchTerm) {
                $query->where('attribute_value', 'like', "%$searchTerm%");
            })
            ->get();

        if ($products->isEmpty()) {
            return response('<tr class="alert alert-danger text-center fs-3"><td colspan="9">Không tìm thấy sản phẩm</td></tr>');
        } else {
            $output = '';
            foreach ($products as $product) {
                $imgPath = $product->product_img == null
                    ? asset('admin_asset/img/photos/blocks.png')
                    : asset("admin_asset/img/photos/{$product->product_img}");

                $output .= '
            <tr>
                <td>' . $product->id . '</td>
                <td>' . $product->product_name . '</td>
                <td>' . $product->product_price . '</td>
                <td>' . $product->category->category_name . '</td>
                <td>' . $product->subcategory->subcategory_name . '</td>
                <td>' . $product->default_attribute->attribute_value . '</td>
                <td>' . $product->product_status . '</td>
                <td>' . $product->product_quantity . '</td>
                <td>
                    <img src="' . $imgPath . '" alt="" class="img_user">
                </td>
            </tr>';
            }
            return response($output);
        }
    }

    //===========================================Bán sản phẩm=======================================================
    public function manage(){
        $products = Product::where('product_status', '=', "Vẫn còn")->get();
        $customers = User::where('role', '=', '2')->get();
        $orders = AC_order::all();

        $productList = $orders->map(function ($order) {
            return $order->product->product_name . " (" . $order->order_quantity . ")";
        })->implode("|");
        // Tính tổng số lượng và tổng tiền từ đơn hàng
        $quantity = $orders->sum('order_quantity');
        $total = $orders->sum('order_price');
        return view('seller.product.manage_review' , compact('products', 'customers', 'orders', 'quantity', 'total', 'productList'));
    }

    public function review_manage_order()
    {
        $customers = User::where('role', '=', '2')->get();
        $orders = AC_order::all();

        // Tạo chuỗi tên sản phẩm và số lượng
        $productList = $orders->map(function ($order) {
            return $order->product->product_name . " (" . $order->order_quantity . ")";
        })->implode("|");
        // Tính tổng số lượng và tổng tiền từ đơn hàng
        $quantity = $orders->sum('order_quantity');
        $total = $orders->sum('order_price');

        return view('seller/product/admincart', compact('customers', 'orders', 'quantity', 'total', 'productList'));
    }

    public function review_insert_item_order(Request $request)
    {
        $request->validate([
            'pro_item_id' => 'required|exists:products,id',
            'pro_item_quantity' => 'required|integer|min:1',
        ]);

        // Tìm sản phẩm với ID được cung cấp
        $product = Product::find($request->pro_item_id);

        // Kiểm tra xem số lượng yêu cầu có lớn hơn số lượng hiện có trong kho không
        if ($product->product_quantity < $request->pro_item_quantity) {
            return redirect()->route('vendor.product.manage_review')->with('error', 'Số lượng sản phẩm trong kho không đủ để thêm vào giỏ hàng.');
        }

        try {
            // Tạo đơn hàng mới trong bảng AC_order
            AC_order::create([
                'product_id' => $request->pro_item_id,
                'order_quantity' => $request->pro_item_quantity,
                'order_price' => $request->pro_item_quantity * $request->pro_item_price,
            ]);

            // Trừ số lượng sản phẩm trong kho
            $product->product_quantity = $product->product_quantity - $request->pro_item_quantity;
            $product->save();

            return redirect()->route('vendor.product.manage_review')->with('success', 'Sản phẩm đã được thêm thành công và cập nhật số lượng trong kho.');
        } catch (Exception $e) {
            return response()->json(['error' => false, 'message' => 'Lỗi khi thêm sản phẩm vào giỏ hàng.']);
        }
    }

    public function review_delete_item_order($id)
    {
        // Tìm đơn hàng dựa trên ID và lấy số lượng sản phẩm trong đơn hàng
        $AC_order = AC_order::findOrFail($id);
        $AC_order_quantity = $AC_order->order_quantity;

        // Tìm sản phẩm liên quan đến đơn hàng
        $product = Product::find($AC_order->product_id);

        // Kiểm tra nếu sản phẩm tồn tại
        if ($product) {
            // Thêm lại số lượng của đơn hàng vào kho
            $product->product_quantity += $AC_order_quantity;
            $product->save();
        }

        // Xóa đơn hàng
        $AC_order->delete();

        return redirect()->route('vendor.product.manage_review')->with('success', 'Xóa 1 sản phẩm ra danh sách thành công và số lượng đã được cập nhật lại trong kho.');
    }


    public function review_truncate_order()
    {
        // Thực hiện truncate trực tiếp trên model
        AC_order::truncate();
        return redirect()->route('vendor.product.manage_review')->with('success', 'Xóa bảng order thành công!');
    }

    public function review_create_order(){
        $products = Product::where('product_status', '=', "Vẫn còn")->get();
        $customers = User::where('role', '=', '2')->get();
        $orders = AC_order::all();

        $productList = $orders->map(function ($order) {
            return $order->product->product_name . " (" . $order->order_quantity . ")";
        })->implode("|");

        $quantity = $orders->sum('order_quantity');
        $total = $orders->sum('order_price');

        return view('seller/product/manage_review', compact('products','customers', 'orders', 'quantity', 'total', 'productList'));
    }


    public function review_insert_order(Request $request) {
        $request->validate([
            'ac_order_namepro' => 'required|string|max:255',
            'ac_order_totalquantitypro' => 'required|integer|min:1',
            'ac_order_totalpricepro' => 'required|numeric|min:0.001',
        ]);

        try {
            // Lưu bản ghi mới vào bảng Orders
            Orders::create([
                'orders_id' => time(),
                'orders_users_id' => $request->ac_order_user_id ?? null, // Để null nếu không chọn khách hàng
                'orders_product' => $request->ac_order_namepro,
                'orders_quantity' => $request->ac_order_totalquantitypro,
                'orders_price' => $request->ac_order_totalpricepro,
                'orders_censor' => "Đang kiểm duyệt"
                // 'orders_address' => $request->input('orders_address', ''),
            ]);

            // Xóa tất cả bản ghi trong bảng AC_order
            AC_order::truncate();

            return redirect()->route('vendor.review.create_order')->with('success', 'Sản phẩm đã được thanh toán và đang được kiểm duyệt.');
        } catch (Exception $e) {
            return redirect()->route('vendor.review.create_order')->with('error', 'Sản phẩm chưa được thanh toán: ' . $e->getMessage());
        }
    }

    public function review_search(Request $request)
    {
        $searchTerm = $request->input('search_product');

        if (!empty($searchTerm)) {
            $products = Product::where('product_name', 'like', "%$searchTerm%")
                ->orWhere('product_price', 'like', "%$searchTerm%")
                ->orWhereHas('category', function ($query) use ($searchTerm) {
                    $query->where('category_name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orWhereHas('default_attribute', function ($query) use ($searchTerm) {
                    $query->where('attribute_value', 'like', "%$searchTerm%");
                })
                ->get();
        } else {
            $products = Product::where('product_status', '=', "Vẫn còn")->get();
        }

        if ($products->isEmpty()) {
            return response('<h2><center>Không tìm thấy sản phẩm</center></h2>');
        } else {
            $output = '';
            foreach ($products as $product) {
                $imgPath = $product->product_img == null
                    ? asset('admin_asset/img/photos/blocks.png')
                    : asset("admin_asset/img/photos/{$product->product_img}");

                $output .= '
                            <div class="card m-4">
                                <center>
                                    <img src="' . $imgPath . '"
                                        class="card-img-top mt-1 img_item" alt="...">
                                </center>
                                <div class="card-body">
                                    <form id="add-to-cart-form">
                                        ' . csrf_field() . '
                                        <h5 class="card-title">' . $product->product_name . '</h5>
                                        <input type="hidden" name="pro_item_id" value="' . $product->id . '">
                                        <input type="hidden" name="pro_item_price" value="' . $product->product_price . '">
                                        <table class="table table-responsive">
                                          <thead>
                                            <tr>
                                                <td>Giá : </td>
                                                <td>' . $product->product_price . '</td>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                                <td>Loại sản phẩm : </td>
                                                <td>' . $product->category->category_name . '</td>
                                            </tr>
                                            <tr>
                                                <td>Kích cỡ : </td>
                                                <td>' . $product->default_attribute->attribute_value . '</td>
                                            </tr>
                                          </tbody>
                                        </table>

                                        <div class="d-flex align-items-center mt-2">
                                            <div class="form-outline m-1">
                                                <input type="number" name="pro_item_quantity" min="0" value="0"
                                                    class="form-control me-2">
                                            </div>
                                            <button type="button" class="btn btn-primary m-1" id="btn-add-to-cart">Thêm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                ';
            }
            return response($output);
        }
    }
}
