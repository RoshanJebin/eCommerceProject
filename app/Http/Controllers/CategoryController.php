<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;

class CategoryController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
            'image' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'), 'category');
        } else {
            $image = "";
        }

        $data = [
            'name' => $request->name,
            'status' => $request->status,
            'image' => $image,
        ];

        Category::create($data);

        return redirect()->back()->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $category = Category::where('id', $category->id)->first();
        return view('admin.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'), 'category');
        } else {
            $image = $request->input('old_image');
        }


        $data = [
            'name' => $request->name,
            'status' => $request->status,
            'image' => $image,
        ];

        Category::where('id', $request->id)->update($data);

        return redirect()->back()->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
