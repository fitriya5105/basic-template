<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\support\Facades\File;

class MenuController extends Controller
{
    public function index()
    {
        
        $menu = Menu::orderBy('id','desc')
        ->get();                
        return view('menu.index', compact('menu'));
    }

    
    public function create()
    {
    
        return view('menu.create');
    }

    
    public function store(Request $request)
{
    $validated = $request->validate([
        'no_menu' => 'required|numeric',
        'title' => 'required',
        'image' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
    ],[
        'no_menu.required' => 'Menu Harus Di Isi',
        'no_menu.numeric' => 'Menu Harus Dalam Angka',
        'no_menu.unique' => 'No Menu Sudah Ada',
        'title.required' => 'Judul Harus Di Isi',
        'description.required' => 'Deskripsi Harus Di Isi',
        'price.numeric' => 'Price Harus Dalam Angka',
        'price.required' => 'Harga Harus Di Isi',        
        'image.required' => 'Gambar Harus Di Isi',        
    ]);

    if ($request->hasFile('image')) {
        $imageName = $request->file('image')->hashName();
        $validated['image'] = $imageName;

        $menuDirectory = public_path() . '/menu-images';
        $request->file('image')->move($menuDirectory, $imageName);
    }

    Menu::create($validated);

    return redirect()->route('menu.index')->with('success', 'Data Menu berhasil di tambah!');
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $menu = Menu::find($id);

         
        return view('menu.edit', compact('menu'));
    }

    /**
 * Display the specified resource.
 */
public function show($id)
{
    $menu = Menu::find($id);

    if (!$menu) {
        return redirect()->route('menu.index')->with('error', 'Data not found.');
    }

    return view('menu.show', compact('menu'));
}
public function more($id)
{
    $menu = Menu::find($id);

    if (!$menu) {
        return redirect()->route('myhome')->with('error', 'Data not found.');
    }

    return view('menu.more', compact('menu'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu = Menu::find($id);
    
        if (!$menu) {
            return redirect()->route('menu.index')->with('error', 'Data not found.');
        }
    
        $validated = $request->validate([
            'no_menu' => 'required|numeric|unique:menu,no_menu,' . $menu->id,
            'title' => 'required',
            'description' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif',
            'price' => 'required|numeric',
        ]);
    
        if ($request->hasFile('image')) {
            File::delete(public_path() . "/menu-images/$menu->image");
    
            $imageName = $request->file('image')->hashName();
            $validated['image'] = $imageName;
    
            $menuDirectory = public_path() . '/menu-images';
            $request->file('image')->move($menuDirectory, $imageName);
        }
    
        $menu->update($validated);
    
        return redirect()->route('menu.index')->with('success', 'Menu berhasil di edit!');
    }
    

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    
        $menu = Menu::find($id);

    
        File::delete(public_path() . "/menu-images/$menu->image");

    
        $menu->delete();

    
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus!');        
    }
}