<?php

namespace App\Http\Controllers\Seller;

use Exception;
use App\Models\Orders;
use App\Models\Shipper;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;


class SellerStoreController extends Controller
{
    public function ship(){
        $shipers = Shipper::all()->sortDesc();
        return view('seller.store.listship' , compact('shipers'));
    }

    public function cart_photos_pdf($id){
        $shiper_order = Shipper::find($id);

        $pdfOptions = [
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ];

        $pdf = Pdf::loadView('seller.store.inova', compact('shiper_order'))->setOptions($pdfOptions);

        return $pdf->download(($shiper_order->ship_users ?? "Ko có").time().".pdf");
        // return view('seller.store.inova');
    }

    public function cart_search(Request $request)
    {
        $searchTerm = $request->input('search_ship');

        $shipers = Shipper::where('ship_users', 'like', "%$searchTerm%")
            ->orWhere('ship_product', 'like', "%$searchTerm%")
            ->orWhere('ship_quantity', 'like', "%$searchTerm%")
            ->orWhere('ship_price', 'like', "%$searchTerm%")
            ->orWhere('ship_phonenumber', 'like', "%$searchTerm%")
            ->orWhere('ship_address', 'like', "%$searchTerm%")
            ->orWhere('ship_thank', 'like', "%$searchTerm%")
            ->orWhereHas('order', function ($query) use ($searchTerm) {
                $query->where('orders_id', 'like', "%$searchTerm%");
            })
            ->get();

        if ($shipers->isEmpty()) {
            return response('<tr><td colspan="8">Không tìm thấy đơn hàng này</td></tr>');
        }

        $output = '';
        foreach ($shipers as $shiper) {
            $output .= '
        <tr>
            <td>' . $shiper->order->orders_id. '</td>
            <td>' . ($shiper->ship_users ?? "Không có") . '</td>
            <td>' . $shiper->ship_product . '</td>
            <td>' . $shiper->ship_quantity . '</td>
            <td>' . $shiper->ship_price . '</td>
            <td>' . $shiper->ship_phonenumber . '</td>
            <td>' . $shiper->ship_address . '</td>
            <td>' . $shiper->ship_thank . '</td>
            <td>
                <a href="' . route('vendor.cart.print_pdf' , $shiper->id) . '" class="btn btn-secondary"><i class="fa-regular fa-file-pdf"></i></a>
            </td>
        </tr>
        ';
        }

        return response($output);
    }

//=============================Order==================================
    public function manage(){
        $orders = Orders::all()->sortDesc();
        return view('seller.store.history' , compact('orders'));
    }

    public function order_edit($id)
    {
        $orders_info = Orders::find($id);
        return view('seller.store.edit_order', compact('orders_info'));
    }

    public function order_update(Request $request, $id)
    {
        $order_edit = Orders::findOrFail($id);

        $request->validate([
            'orders_status' => 'required|string|max:255',
            'orders_phonenumber' => 'nullable|string|max:15', // Đổi thành kiểu string nếu số điện thoại phức tạp
            'orders_address' => 'nullable|string|max:255',
        ]);

        try {
            $order_edit->update([
                'orders_censor' => $request->orders_status,
                'orders_phonenumber' => ($request->orders_phonenumber == 0) ? "0" : $request->orders_phonenumber,
                'orders_address' => ($request->orders_address === "Trống") ? "Trống" : $request->orders_address,
            ]);

            return redirect()->route('vendor.store.manage')->with('success', "Cập nhật đơn hàng $order_edit->id thành công!");
        } catch (Exception $e) {
            return redirect()->back()->with('error', "Lỗi cập nhật đơn hàng: " . $e->getMessage());
        }
    }




    public function order_insertship($id)
    {
        $orders_info = Orders::find($id); // Sử dụng findOrFail để đảm bảo nếu không tìm thấy sẽ trả về lỗi 404
        return view('seller.store.ship_order', compact('orders_info'));
    }

    public function order_createship(Request $request)
    {
        $request->validate([
            'ship_order_id' => 'required|exists:orders,id', // Kiểm tra sự tồn tại của ID đơn hàng
            'ship_users' => 'required|string|max:255',
            'ship_product' => 'required|string',
            'ship_quantity' => 'required|integer',
            'ship_price' => 'required|numeric|min:0',
            'ship_phonenumber' => 'required|integer',
            'ship_address' => 'required|string',
            'ship_thank' => 'required|string'
        ]);

        try {
            Shipper::create([
                'ship_users' => $request->ship_users,
                'ship_orders_id' => $request->ship_order_id,
                'ship_product' => $request->ship_product,
                'ship_quantity' => $request->ship_quantity,
                'ship_price' => $request->ship_price,
                'ship_phonenumber' => $request->ship_phonenumber,
                'ship_address' => $request->ship_address,
                'ship_thank' => $request->ship_thank
            ]);

            return redirect()->route('vendor.store.ship')->with('success', 'Đơn hàng đã được gửi đi thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi thêm sản phẩm: ' . $e->getMessage());
        }
    }

    public function order_search(Request $request)
    {
        $searchTerm = $request->input('search_orders');

        $orders = Orders::where('orders_id', 'like', "%$searchTerm%")
            ->orWhere('orders_product', 'like', "%$searchTerm%")
            ->orWhere('orders_quantity', 'like', "%$searchTerm%")
            ->orWhere('orders_price', 'like', "%$searchTerm%")
            ->orWhere('orders_censor', 'like', "%$searchTerm%")
            ->orWhere('created_at', 'like', "%$searchTerm%")
            ->orWhereHas('user', function ($query) use ($searchTerm) {
                $query->where('name', 'like', "%$searchTerm%");
            })
            ->get();

        if ($orders->isEmpty()) {
            return response('<tr class="alert alert-danger"><td colspan="10">Không tìm thấy đơn hàng này</td></tr>');
        } else {
            $output = '';
            foreach ($orders as $order) {
                $censorClass = '';
                if ($order->orders_censor == "Đang kiểm duyệt") {
                    $censorClass = '<div class="bg-warning bg-gradient bg-opacity-75 text-center rounded-pill p-1">' . $order->orders_censor . '</div>';
                } elseif ($order->orders_censor == "Đã kiểm duyệt") {
                    $censorClass = '<div class="bg-success bg-gradient bg-opacity-75 text-center rounded-pill p-1">' . $order->orders_censor . '</div>';
                } else {
                    $censorClass = $order->orders_censor;
                }

                $output .= '
                <tr>
                    <td>' . $order->id . '</td>
                    <td>' . $order->orders_id . '</td>
                    <td>' . ($order->user->name ?? "Không có") . '</td>
                    <td>' . $order->orders_product . '</td>
                    <td>' . $order->orders_quantity . '</td>
                    <td>' . $order->orders_price . '</td>
                    <td>' . $censorClass . '</td>
                    <td>' . $order->created_at . '</td>
                    <td>
                        <a href="' . '#' . '" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                    <td>
                        <a href="' . '#' . '" class="btn btn-primary"><i class="fa-solid fa-truck-fast"></i></a>
                    </td>
                </tr>
            ';
            }
            return response($output);
        }
    }
}
