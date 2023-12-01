<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::orderBy('id', 'desc')->get();
        return view('admin.stock.index', ['stocks' => $stocks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderBy('product_name')->get();
        return view('admin.stock.create', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'supplier_name' => 'required',
            'product_id' => 'required',
            'last_added_date' => 'required',
            'quantity_added' => 'required'
        ]);

        $data = [
            'supplier_name' => $request->supplier_name,
            'product_id' => $request->product_id,
            'last_added_date' => $request->last_added_date,
            'quantity_added' => $request->quantity_added,
        ];

        Stock::create($data);

        return redirect()->back()->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        $stock = Stock::where('id', $stock->id)->first();
        $products = Product::orderBy('product_name')->get();
        return view('admin.stock.edit', [
            'stock' => $stock,
            'products' => $products
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|unique:stocks,email,' . $id . ',id,deleted_at,NULL',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'), 'stock');
        } else {
            $image = $request->input('old_image');
        }


        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'image' => $image,
        ];

        Stock::where('id', $request->id)->update($data);

        return redirect()->back()->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
