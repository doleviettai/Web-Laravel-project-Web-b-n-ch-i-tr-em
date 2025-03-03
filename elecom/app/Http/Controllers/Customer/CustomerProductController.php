<?php

namespace App\Http\Controllers\Customer;

use Exception;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CartCus;

class CustomerProductController extends Controller
{
    public function product()
    {
        // $products_info = Product::where('product_status','Vẫn còn')->get();
        $products_info = Product::where('product_status','Vẫn còn')->paginate(6);
        return view('customer.product.product', compact('products_info'));
    }

    public function productsearch_0_100()
    {
        $products = Product::whereBetween('product_price', [0, 100.000])->where('product_status','Vẫn còn')->get();
        // $products = Product::whereBetween('product_price', [0, 100.000])->where('product_status','Vẫn còn')->paginate(6);

        if ($products->isEmpty()) {
            return response('<h2><center>Không tìm thấy sản phẩm</center></h2>');
        } else {
            $output = '';
            foreach ($products as $product) {
                $imgPath = $product->product_img == null
                    ? asset('admin_asset/img/photos/blocks.png')
                    : asset("admin_asset/img/photos/{$product->product_img}");

                $output .= '
                    <div class="bg-white border border-gray-200 shadow-lg rounded-lg p-4 transition duration-300 hover:-translate-y-2 shadow-black">
                        <center>
                            <img src="' . $imgPath . '"
                                 class="w-56 h-40 object-cover rounded-md mb-4" alt="Product Image">
                        </center>

                        <div class="text-center">
                            <h5 class="font-semibold text-lg mb-2">' . $product->product_name . '</h5>
                            <input type="hidden" name="pro_item_id" value="' . $product->id . '">
                            <input type="hidden" name="pro_item_price" value="' . $product->product_price . '">

                            <table class="w-full text-left border-t border-gray-200 mt-2">
                                <tbody id="hien_table">
                                    <tr class="border-b border-gray-200">
                                        <td class="py-2 font-semibold">Giá:</td>
                                        <td class="py-2">' . $product->product_price . '</td>
                                    </tr>
                                    <tr class="border-b border-gray-200">
                                        <td class="py-2 font-semibold">Loại sản phẩm:</td>
                                        <td class="py-2">' . $product->category->category_name . ' / ' . $product->default_attribute->attribute_value. '</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 font-semibold">Kích cỡ:</td>
                                        <td class="py-2">' . $product->subcategory->subcategory_name . '</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="flex flex-col sm:flex-row items-center justify-center mt-4 space-y-2 sm:space-y-0 sm:space-x-2">
                                <a href="'.route('customer.product.see' , $product->id).'" class="w-full sm:w-auto bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-200 transform hover:scale-105 hover:bg-blue-600 hover:shadow-lg hover:no-underline">Xem sản phẩm</a>
                            </div>
                        </div>
                    </div>
                ';
            }
            return response($output);
        }
    }



    public function productsearch(Request $request)
    {
        $searchTerm = $request->input('search_product');

        $products = Product::where('product_name', 'like', "%$searchTerm%")
            ->orWhere('product_price', 'like', "%$searchTerm%")
            ->orWhereHas('category', function ($query) use ($searchTerm) {
                $query->where('category_name', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhereHas('subcategory', function ($query) use ($searchTerm) {
                $query->where('subcategory_name', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhereHas('default_attribute', function ($query) use ($searchTerm) {
                $query->where('attribute_value', 'like', "%$searchTerm%");
            })
            ->paginate(6);

        if ($products->isEmpty()) {
            return response('<h2><center>Không tìm thấy sản phẩm</center></h2>');
        } else {
            $output = '';
            foreach ($products as $product) {
                $imgPath = $product->product_img == null
                    ? asset('admin_asset/img/photos/blocks.png')
                    : asset("admin_asset/img/photos/{$product->product_img}");

                $output .= '
                                <div class="bg-white border border-gray-200 shadow-lg rounded-lg p-4 transition duration-300 hover:-translate-y-2 shadow-black">
                                    <center>
                                        <img src="' . $imgPath . '"
                                            class="w-56 h-40 object-cover rounded-md mb-4" alt="Product Image">
                                    </center>

                                    <div class="text-center">
                                        <h5 class="font-semibold text-lg mb-2">' . $product->product_name . '</h5>
                                        <input type="hidden" name="pro_item_id" value="' . $product->id . '">
                                        <input type="hidden" name="pro_item_price" value="' . $product->product_price . '">

                                        <table class="w-full text-left border-t border-gray-200 mt-2">
                                            <tbody id="hien_table">
                                                <tr class="border-b border-gray-200">
                                                    <td class="py-2 font-semibold">Giá:</td>
                                                    <td class="py-2">' . $product->product_price . '</td>
                                                </tr>
                                                <tr class="border-b border-gray-200">
                                                    <td class="py-2 font-semibold">Loại sản phẩm:</td>
                                                    <td class="py-2">' . $product->category->category_name . ' /
                                                        ' . $product->subcategory->subcategory_name . '</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 font-semibold">Kích cỡ:</td>
                                                    <td class="py-2">
                                                        ' . $product->default_attribute->attribute_value . '</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="flex flex-col sm:flex-row items-center justify-center mt-4 space-y-2 sm:space-y-0 sm:space-x-2">
                                            <a href="'.route('customer.product.see' , $product->id).'" class="w-full sm:w-auto bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-200 transform hover:scale-105 hover:bg-blue-600 hover:shadow-lg hover:no-underline">Xem sản phẩm</a>
                                        </div>
                                    </div>
                                </div>
                    ';
            }
            return response($output);
        }
    }

    public function productsearch_100_500()
    {
        $products = Product::whereBetween('product_price', [100.000, 500.000])->where('product_status','Vẫn còn')->get();
        // $products = Product::whereBetween('product_price', [100.000, 500.000])->where('product_status','Vẫn còn')->paginate(6);

        if ($products->isEmpty()) {
            return response('<h2><center>Không tìm thấy sản phẩm</center></h2>');
        } else {
            $output = '';
            foreach ($products as $product) {
                $imgPath = $product->product_img == null
                    ? asset('admin_asset/img/photos/blocks.png')
                    : asset("admin_asset/img/photos/{$product->product_img}");

                $output .= '
                    <div class="bg-white border border-gray-200 shadow-lg rounded-lg p-4 transition duration-300 hover:-translate-y-2 shadow-black">
                        <center>
                            <img src="' . $imgPath . '"
                                 class="w-56 h-40 object-cover rounded-md mb-4" alt="Product Image">
                        </center>

                        <div class="text-center">
                            <h5 class="font-semibold text-lg mb-2">' . $product->product_name . '</h5>
                            <input type="hidden" name="pro_item_id" value="' . $product->id . '">
                            <input type="hidden" name="pro_item_price" value="' . $product->product_price . '">

                            <table class="w-full text-left border-t border-gray-200 mt-2">
                                <tbody id="hien_table">
                                    <tr class="border-b border-gray-200">
                                        <td class="py-2 font-semibold">Giá:</td>
                                        <td class="py-2">' . $product->product_price . '</td>
                                    </tr>
                                    <tr class="border-b border-gray-200">
                                        <td class="py-2 font-semibold">Loại sản phẩm:</td>
                                        <td class="py-2">' . $product->category->category_name . ' / ' . $product->default_attribute->attribute_value. '</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 font-semibold">Kích cỡ:</td>
                                        <td class="py-2">' . $product->subcategory->subcategory_name . '</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="flex flex-col sm:flex-row items-center justify-center mt-4 space-y-2 sm:space-y-0 sm:space-x-2">
                                <a href="'.route('customer.product.see' , $product->id).'" class="w-full sm:w-auto bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-200 transform hover:scale-105 hover:bg-blue-600 hover:shadow-lg hover:no-underline">Xem sản phẩm</a>
                            </div>
                        </div>
                    </div>
                ';
            }
            return response($output);
        }
    }

    public function productsearch_500_1000()
    {
        $products = Product::whereBetween('product_price', [500.000, 1000.000])->where('product_status','Vẫn còn')->get();
        // $products = Product::whereBetween('product_price', [500.000, 1000.000])->where('product_status','Vẫn còn')->paginate(6);

        if ($products->isEmpty()) {
            return response('<h2><center>Không tìm thấy sản phẩm</center></h2>');
        } else {
            $output = '';
            foreach ($products as $product) {
                $imgPath = $product->product_img == null
                    ? asset('admin_asset/img/photos/blocks.png')
                    : asset("admin_asset/img/photos/{$product->product_img}");

                $output .= '
                    <div class="bg-white border border-gray-200 shadow-lg rounded-lg p-4 transition duration-300 hover:-translate-y-2 shadow-black">
                        <center>
                            <img src="' . $imgPath . '"
                                 class="w-56 h-40 object-cover rounded-md mb-4" alt="Product Image">
                        </center>

                        <div class="text-center">
                            <h5 class="font-semibold text-lg mb-2">' . $product->product_name . '</h5>
                            <input type="hidden" name="pro_item_id" value="' . $product->id . '">
                            <input type="hidden" name="pro_item_price" value="' . $product->product_price . '">

                            <table class="w-full text-left border-t border-gray-200 mt-2">
                                <tbody id="hien_table">
                                    <tr class="border-b border-gray-200">
                                        <td class="py-2 font-semibold">Giá:</td>
                                        <td class="py-2">' . $product->product_price . '</td>
                                    </tr>
                                    <tr class="border-b border-gray-200">
                                        <td class="py-2 font-semibold">Loại sản phẩm:</td>
                                        <td class="py-2">' . $product->category->category_name . ' / ' . $product->default_attribute->attribute_value. '</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 font-semibold">Kích cỡ:</td>
                                        <td class="py-2">' . $product->subcategory->subcategory_name . '</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="flex flex-col sm:flex-row items-center justify-center mt-4 space-y-2 sm:space-y-0 sm:space-x-2">
                                <a href="'.route('customer.product.see' , $product->id).'" class="w-full sm:w-auto bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-200 transform hover:scale-105 hover:bg-blue-600 hover:shadow-lg hover:no-underline">Xem sản phẩm</a>
                            </div>
                        </div>
                    </div>
                ';
            }
            return response($output);
        }
    }

    public function productsearch_1000_2000()
    {
        $products = Product::whereBetween('product_price', [1000.000, 2000.000])->where('product_status','Vẫn còn')->get();
        // $products = Product::whereBetween('product_price', [1000.000, 2000.000])->where('product_status','Vẫn còn')->paginate(6);

        if ($products->isEmpty()) {
            return response('<h2><center>Không tìm thấy sản phẩm</center></h2>');
        } else {
            $output = '';
            foreach ($products as $product) {
                $imgPath = $product->product_img == null
                    ? asset('admin_asset/img/photos/blocks.png')
                    : asset("admin_asset/img/photos/{$product->product_img}");

                $output .= '
                    <div class="bg-white border border-gray-200 shadow-lg rounded-lg p-4 transition duration-300 hover:-translate-y-2 shadow-black">
                        <center>
                            <img src="' . $imgPath . '"
                                 class="w-56 h-40 object-cover rounded-md mb-4" alt="Product Image">
                        </center>

                        <div class="text-center">
                            <h5 class="font-semibold text-lg mb-2">' . $product->product_name . '</h5>
                            <input type="hidden" name="pro_item_id" value="' . $product->id . '">
                            <input type="hidden" name="pro_item_price" value="' . $product->product_price . '">

                            <table class="w-full text-left border-t border-gray-200 mt-2">
                                <tbody id="hien_table">
                                    <tr class="border-b border-gray-200">
                                        <td class="py-2 font-semibold">Giá:</td>
                                        <td class="py-2">' . $product->product_price . '</td>
                                    </tr>
                                    <tr class="border-b border-gray-200">
                                        <td class="py-2 font-semibold">Loại sản phẩm:</td>
                                        <td class="py-2">' . $product->category->category_name . ' / ' . $product->default_attribute->attribute_value. '</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 font-semibold">Kích cỡ:</td>
                                        <td class="py-2">' . $product->subcategory->subcategory_name . '</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="flex flex-col sm:flex-row items-center justify-center mt-4 space-y-2 sm:space-y-0 sm:space-x-2">
                                <a href="'.route('customer.product.see' , $product->id).'" class="w-full sm:w-auto bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-200 transform hover:scale-105 hover:bg-blue-600 hover:shadow-lg hover:no-underline">Xem sản phẩm</a>
                            </div>
                        </div>
                    </div>
                ';
            }
            return response($output);
        }
    }

    public function productsearch_2000_5000()
    {
        $products = Product::whereBetween('product_price', [2000.000, 5000.000])->where('product_status','Vẫn còn')->get();
        // $products = Product::whereBetween('product_price', [2000.000, 5000.000])->where('product_status','Vẫn còn')->paginate(6);

        if ($products->isEmpty()) {
            return response('<h2><center>Không tìm thấy sản phẩm</center></h2>');
        } else {
            $output = '';
            foreach ($products as $product) {
                $imgPath = $product->product_img == null
                    ? asset('admin_asset/img/photos/blocks.png')
                    : asset("admin_asset/img/photos/{$product->product_img}");

                $output .= '
                    <div class="bg-white border border-gray-200 shadow-lg rounded-lg p-4 transition duration-300 hover:-translate-y-2 shadow-black">
                        <center>
                            <img src="' . $imgPath . '"
                                 class="w-56 h-40 object-cover rounded-md mb-4" alt="Product Image">
                        </center>

                        <div class="text-center">
                            <h5 class="font-semibold text-lg mb-2">' . $product->product_name . '</h5>
                            <input type="hidden" name="pro_item_id" value="' . $product->id . '">
                            <input type="hidden" name="pro_item_price" value="' . $product->product_price . '">

                            <table class="w-full text-left border-t border-gray-200 mt-2">
                                <tbody id="hien_table">
                                    <tr class="border-b border-gray-200">
                                        <td class="py-2 font-semibold">Giá:</td>
                                        <td class="py-2">' . $product->product_price . '</td>
                                    </tr>
                                    <tr class="border-b border-gray-200">
                                        <td class="py-2 font-semibold">Loại sản phẩm:</td>
                                        <td class="py-2">' . $product->category->category_name . ' / ' . $product->default_attribute->attribute_value. '</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 font-semibold">Kích cỡ:</td>
                                        <td class="py-2">' . $product->subcategory->subcategory_name . '</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="flex flex-col sm:flex-row items-center justify-center mt-4 space-y-2 sm:space-y-0 sm:space-x-2">
                                <a href="'.route('customer.product.see' , $product->id).'" class="w-full sm:w-auto bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-200 transform hover:scale-105 hover:bg-blue-600 hover:shadow-lg hover:no-underline">Xem sản phẩm</a>
                            </div>
                        </div>
                    </div>
                ';
            }
            return response($output);
        }
    }

    public function productsearch_5000_10tr()
    {
        $products = Product::whereBetween('product_price', [5000.000, 10000.000])->where('product_status','Vẫn còn')->get();
        // $products = Product::whereBetween('product_price', [5000.000, 10000.000])->where('product_status','Vẫn còn')->paginate(6);

        if ($products->isEmpty()) {
            return response('<h2><center>Không tìm thấy sản phẩm</center></h2>');
        } else {
            $output = '';
            foreach ($products as $product) {
                $imgPath = $product->product_img == null
                    ? asset('admin_asset/img/photos/blocks.png')
                    : asset("admin_asset/img/photos/{$product->product_img}");

                $output .= '
                    <div class="bg-white border border-gray-200 shadow-lg rounded-lg p-4 transition duration-300 hover:-translate-y-2 shadow-black">
                        <center>
                            <img src="' . $imgPath . '"
                                 class="w-56 h-40 object-cover rounded-md mb-4" alt="Product Image">
                        </center>

                        <div class="text-center">
                            <h5 class="font-semibold text-lg mb-2">' . $product->product_name . '</h5>
                            <input type="hidden" name="pro_item_id" value="' . $product->id . '">
                            <input type="hidden" name="pro_item_price" value="' . $product->product_price . '">

                            <table class="w-full text-left border-t border-gray-200 mt-2">
                                <tbody id="hien_table">
                                    <tr class="border-b border-gray-200">
                                        <td class="py-2 font-semibold">Giá:</td>
                                        <td class="py-2">' . $product->product_price . '</td>
                                    </tr>
                                    <tr class="border-b border-gray-200">
                                        <td class="py-2 font-semibold">Loại sản phẩm:</td>
                                        <td class="py-2">' . $product->category->category_name . ' / ' . $product->default_attribute->attribute_value. '</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 font-semibold">Kích cỡ:</td>
                                        <td class="py-2">' . $product->subcategory->subcategory_name . '</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="flex flex-col sm:flex-row items-center justify-center mt-4 space-y-2 sm:space-y-0 sm:space-x-2">
                                <a href="'.route('customer.product.see' , $product->id).'" class="w-full sm:w-auto bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-200 transform hover:scale-105 hover:bg-blue-600 hover:shadow-lg hover:no-underline">Xem sản phẩm</a>
                            </div>
                        </div>
                    </div>
                ';
            }
            return response($output);
        }
    }


//=================================================================
    public function product_see($id)
    {
        $product_info = Product::findOrFail($id);
        return view('customer.product.product_show', compact('product_info'));
    }

    public function product_create_order(Request $request)
    {
        // Lấy dữ liệu từ form
        $customerNameID = $request->input('cus_product_user_id'); // Tên khách hàng
        $productName = $request->input('cus_product_name'); // Tên sản phẩm
        $productID = $request->input('cus_product_id');
        $productPrice = $request->input('cus_product_price'); // Giá sản phẩm
        $productQuantity = $request->input('cus_product_quantity'); // Số lượng sản phẩm

        // Kiểm tra nếu giá trị không hợp lệ (tùy thuộc vào yêu cầu, ví dụ giá trị không được null)
        if (!$productQuantity || !$productPrice) {
            // Xử lý khi có lỗi nếu cần, có thể quay lại form với thông báo lỗi.
            return back()->with('error', 'Thông tin sản phẩm không hợp lệ.');
        }
        $productName = $productName . " (" . $productQuantity . ")";
        $totalPrice = $productPrice * $productQuantity;
        return view('customer.product.product_create_order', compact('customerNameID', 'productName','productID', 'productPrice', 'productQuantity', 'totalPrice'));
    }

    public function product_insert_order(Request $request){
        $request->validate([
            'order_user_id' => 'required|integer',
            'order_product' => 'required|string',
            'order_pro_id' => 'required|integer',
            'order_quantity' => 'required|integer',
            'order_totalprice' => 'required|numeric|min:0.001',
            'order_phonenumber' => 'nullable|string|max:15' ,
            'order_address'=>'nullable|string|max:255'
        ]);

        $product = Product::find($request->order_pro_id);

        try{
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

            $product->product_quantity = $product->product_quantity - $request->order_quantity;
            $product->save();

            return redirect()->route('customer.product')->with('success', 'Sản phẩm đã được thanh toán và đang được kiểm duyệt.');
        }catch(Exception $e){
            return redirect()->route('customer.product')->with('error', 'Sản phẩm chưa được thanh toán: ' . $e->getMessage());
        }
    }

    public function product_add_to_cart(Request $request){
            $request->validate([
                 'cus_product_user_id' => 'required|exists:users,id',
                 'cus_product_name' => 'required|exists:products,id',
                 'cus_product_price' => 'required|numeric|min:0.001',
                 'cart_product_quantity' => 'required|integer'
            ]);

            $product = Product::find($request->cus_product_name);

            if(!$request->cart_product_quantity){
                return back()->with('error', 'Thông tin sản phẩm thêm vào giỏ hàng không hợp lệ.');
            }

            try{
                CartCus::create([
                     'product_id' => $request->cus_product_name,
                     'user_id' => $request->cus_product_user_id,
                     'cart_quantity' => $request->cart_product_quantity,
                     'cart_price' => $request->cart_product_quantity * $request->cus_product_price,
                ]);

                $product->product_quantity = $product->product_quantity - $request->cart_product_quantity;
                $product->save();

                return redirect()->route('customer.product')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng của bạn');
            }catch(Exception $e){
                return redirect()->back()->with('error', 'Sản phẩm chưa được thêm vào giỏ hàng: ' . $e->getMessage());
            }
    }
}
