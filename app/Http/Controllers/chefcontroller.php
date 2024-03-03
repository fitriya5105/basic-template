<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Add this line

class ChefController extends Controller
{
    public function index()
    {
        $chef = Chef::orderBy('id', 'desc')->get();
        return view('chef.index', compact('chef'));
    }

    public function create()
    {
        return view('chef.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'image' => 'required',
        ], [
            'nama.required' => 'Judul Harus Di Isi',
            'image.required' => 'Gambar Harus Di Isi',
        ]);

        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->hashName();
            $validated['image'] = $imageName;

            $chefDirectory = public_path() . '/chef-images';
            $request->file('image')->move($chefDirectory, $imageName);
        }

        Chef::create($validated);

        return redirect()->route('chef.index')->with('success', 'Data chef berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $chef = Chef::find($id);

        return view('chef.edit', compact('chef'));
    }

    public function show($id)
    {
        $chef = Chef::find($id);

        if (!$chef) {
            return redirect()->route('chef.index')->with('error', 'Data not found.');
        }

        return view('chef.show', compact('chef'));
    }

    public function more($id)
    {
        $chef = Chef::find($id);

        if (!$chef) {
            return redirect()->route('myhome')->with('error', 'Data not found.');
        }

        return view('chef.more', compact('chef'));
    }

    public function update(Request $request, string $id)
    {
        $chef = Chef::find($id);

        if (!$chef) {
            return redirect()->route('chef.index')->with('error', 'Data not found.');
        }

        $validated = $request->validate([
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('image')) {
            File::delete(public_path() . "/chef-images/$chef->image");

            $imageName = $request->file('image')->hashName();
            $validated['image'] = $imageName;

            $chefDirectory = public_path() . '/chef-images';
            $request->file('image')->move($chefDirectory, $imageName);
        }

        $chef->update($validated);

        return redirect()->route('chef.index')->with('success', 'Chef berhasil di edit!');
    }

    public function destroy(string $id)
    {
        $chef = Chef::find($id);

        File::delete(public_path() . "/chef-images/$chef->image");

        $chef->delete();

        return redirect()->route('chef.index')->with('success', 'Chef berhasil dihapus!');
    }
}
