<?php

namespace App\Http\Controllers\Admin;

use App\Models\Foods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class FoodsController extends Controller
{
    public function index()
    {
        $foods = Foods::all();

        return view('admin.foods.index', compact('foods'));
    }

    public function create()
    {
        return view('admin.foods.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|file|mimes:png,jpg,jpeg|max:1024',
            'name' => 'required|max:100',
            'stock' => 'required|integer',
            'price' => 'required|integer'
        ]);

        $extension = $request->file('image')->getClientOriginalExtension();
        $imageName = rand() . '.' . $extension;
        $path = $request->file('image')->storeAs('foods', $imageName, 'public');

        $foods = Foods::create([
            'image' => $imageName,
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price
        ]);

        return redirect()->route('foods.index')->with('success', 'Foods created successfully');
    }

    public function edit($id)
    {
        $foods = Foods::find($id);

        return view('admin.foods.edit', compact('foods'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|file|mimes:png,jpg,jpeg|max:1024',
            'name' => 'required|max:100',
            'stock' => 'required|integer',
            'price' => 'required|integer'
        ]);

        $foods = Foods::find($id);

        if($request->file('image')) {
            $imageNameOld = 'storage/foods/'. $foods->image;
            if(File::exists($imageNameOld)) {
                File::delete($imageNameOld);

                $extension = $request->file('image')->getClientOriginalExtension();
                $imageName = rand() . '.' . $extension;
                $path = $request->file('image')->storeAs('foods', $imageName, 'public');
            }
        } else {
            $imageName = $foods->image;
        }

        $foods = Foods::find($id)->update([
            'image' => $imageName,
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price
        ]);

        return redirect()->route('foods.index')->with('success', 'Foods updated successfully');
    }

    public function destroy($id)
    {
        $foods = Foods::find($id);
        $imageNameOld = File::delete('storage/foods/'. $foods->image);
        $foods->delete();

        return redirect()->route('foods.index')->with('success', 'Foods deleted successfully');
    }
}
