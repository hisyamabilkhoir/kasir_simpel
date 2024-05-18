<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function product()
    {
        $data = [
            "products" => ProductModel::orderBy('name', 'asc')->get(),
        ];

        return view('products', $data);
    }

    public function product_add(Request $request)
    {
        $validatedData = $request->validate(
            [
                'image' => 'image',
            ],
            [
                'image.image' => 'Format gambar tidak di dukung !',
            ]
        );

        $image = $request->file('image');
        $nameImage = Str::random(40) . '.' . $image->getClientOriginalExtension();
        $image->move('./products/', $nameImage);

        ProductModel::create([
            'name' =>  $request->name,
            'price' =>  $request->price,
            'picture' =>  $nameImage,
            'show' =>  1,
        ]);

        session()->flash('msg_status', 'success');
        session()->flash('msg', "<h5 class='mb--5'>Berhasil</h5><p class='b3'>Menu : $request->name berhasil tambahkan !</p>");
        return redirect()->to('product');
    }

    public function product_update(Request $request)
    {
        $validatedData = $request->validate(
            [
                'image' => 'image',
            ],
            [
                'image.image' => 'Format gambar tidak di dukung !',
            ]
        );

        if ($request->file('image')) {
            unlink(('./products/') . $request->pictureOld);

            $image = $request->file('image');
            $nameImage = Str::random(40) . '.' . $image->getClientOriginalExtension();
            $image->move('./products/', $nameImage);
        } else {
            $nameImage = $request->pictureOld;
        }


        if ($request->show == null) {
            $show = 0;
        } else {
            $show = 1;
        }


        ProductModel::where('id', $request->id)
            ->update([
                'name' =>  $request->name,
                'price' =>  $request->price,
                'picture' =>  $nameImage,
                'show' =>  $show,
            ]);


        session()->flash('msg_status', 'success');
        session()->flash('msg', "<h5 class='mb--5'>Berhasil</h5><p class='b3'>Menu : $request->name berhasil diubah !</p>");
        return redirect()->to('product');
    }

    public function product_delete(Request $request)
    {

        $product = ProductModel::where('id', $request->id)->first();

        unlink(('./products/') . $product->picture);

        ProductModel::where('id', $request->id)
            ->delete();


        session()->flash('msg_status', 'success');
        session()->flash('msg', "<h5 class='mb--5'>Berhasil</h5><p class='b3'>Menu : $product->name berhasil dihapus !</p>");
        return redirect()->to('product');
    }
}
