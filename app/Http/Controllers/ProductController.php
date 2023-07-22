<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('back_end.product.index');
    }
    public function create(Request $request)
    {
        Product::createProduct($request);
        return redirect('/manage-product')->with('message', 'Product Create Successfully, Thank You.');
    }
    public function edit($id)
    {
        return view('back_end.product.edit', ['product' => Product::find($id)]);
    }
    public function update(Request $request, $id)
    {
        Product::updateProduct($request, $id);
        return redirect('/manage-product')->with('message', 'Product Update Successfully, Thank You.');
    }
    public function delete($id)
    {
        Product::deleteProduct($id);
        return redirect('/manage-product')->with('message', 'Product Update Successfully, Thank You.');
    }
    public function manage()
    {
        return view('back_end.product.manage', ['products' => Product::orderBy('id', 'desc')->get()]);
    }
}
