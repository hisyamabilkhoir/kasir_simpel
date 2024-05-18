<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function cashier()
    {
        $data = [
            "products" => ProductModel::where('show', 1)->get(),
        ];

        return view('cashier', $data);
    }

    public function cashier_add_to_cart(Request $request)
    {
        $id = $request->id;

        $product = ProductModel::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "picture" => $product->picture,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Menu : ' . $product->name . ' berhasil dimasukan keranjang !');
    }

    public function cashier_cart_remove()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Keranjang berhasil di hapus !');
    }

    public function cashier_bill_print()
    {
        $data = ([
            "rows"  => session()->get('cart'),
        ]);

        return view("bill_print", $data);
    }
}
