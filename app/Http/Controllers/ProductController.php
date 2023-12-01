<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;


class ProductController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('stocks')->orderBy('id', 'desc')->get();
        return view('admin.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', [
            'categories' => $categories
        ]);
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required|unique:products,product_code,NULL,id,deleted_at,NULL',
            'cost' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'), 'product');
        } else {
            $image = "";
        }

        $data = [
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'cost' => $request->cost,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $image,
        ];

        Product::create($data);

        return redirect()->back()->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product = Product::where('id', $product->id)->first();
        $categories = Category::all();
        return view('admin.product.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required|unique:products,product_code,' . $id . ',id,deleted_at,NULL',
            'cost' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'), 'product');
        } else {
            $image = $request->input('old_image');
        }


        $data = [
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'cost' => $request->cost,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $image,
        ];

        Product::where('id', $request->id)->update($data);

        return redirect()->back()->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
