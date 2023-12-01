<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->where("id", '<>', Auth::user()->id)->get();
        return view('admin.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required',
            'status' => 'required',
            'image' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'), 'user');
        } else {
            $image = "";
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'status' => $request->status,
            'image' => $image,
        ];

        User::create($data);

        return redirect()->back()->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user = User::where('id', $user->id)->first();
        return view('admin.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id . ',id,deleted_at,NULL',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'), 'user');
        } else {
            $image = $request->input('old_image');
        }


        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'image' => $image,
        ];

        User::where('id', $request->id)->update($data);

        return redirect()->back()->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
