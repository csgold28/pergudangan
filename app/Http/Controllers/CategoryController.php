<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::with(['parent'])->orderBy('created_at', 'DESC')->get();
        $parent = Category::getParent()->orderBy('name', 'ASC')->get();
        return view('category.index', compact('category','parent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:categories'
        ],[
            'name.required' => 'Isi Nama Kategori',
            'name.max'      => 'Maksimal 50 Karakter',
            'name.unique'   => 'Nama Kategori '.$request->name.' sudah ada'
        ]);

        Category::create([
            'name'  => strtoupper($request->name),
            'slug'  => $request->name,
            'parent_id' => $request->parent_id
        ]);

        return redirect(route('categories.index'))->with(['success' => 'Kategori Baru Ditambahkan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $parent = Category::getParent()->orderBy('name', 'ASC')->get(); 
        return view('category.edit', compact('category','parent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:categories,name,'.$id
        ],[
            'name.required' => 'Isi Nama Kategori',
            'name.max'      => 'Maksimal 50 Karakter',
            'name.unique'   => 'Nama Kategori '.$request->name.' sudah ada'
        ]);

        $category = Category::find($id); 
        $category->update([
            'name'  => strtoupper($request->name),
            'parent_id' => $request->parent_id
        ]);

        return redirect(route('categories.index'))->with(['success' => 'Kategori Diperbaharui!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::withCount(['child'])->find($id);
        if ($category->child_count == 0) {
            $category->delete();
            return redirect(route('categories.index'))->with(['success' => 'Kategori Dihapus!']);
        }
        return redirect(route('categories.index'))->with(['error' => 'Kategori Ini Memiliki Sub Kategori!']);
    }
}
