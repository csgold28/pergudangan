<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Productdetail;
use Illuminate\Http\Request;
use PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parent = Category::all();
        $product = Product::with(['category','productdetail'])->orderBy('created_at','DESC')->get();
        return view('product.index', compact('parent','product'));
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
            'name' => 'required|string|max:50|unique:products',
            'parent_id' => 'required'
        ],[
            'name.required' => 'Isi Nama Barang',
            'name.max'      => 'Maksimal 50 Karakter',
            'name.unique'   => 'Nama Barang '.$request->name.' sudah ada',
            'parent_id.required'     => 'Pilih Kategori'
        ]);

        Product::create([
            'name'          => strtoupper($request->name),
            'category_id'   => $request->parent_id
        ]);

        return redirect(route('product.index'))->with(['success' => 'Barang Baru Ditambahkan!']);
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
        $product = Product::find($id);
        $parent = Category::where('parent_id',true)->get();
        return view('product.edit', compact('product','parent'));
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
            'name' => 'required|string|max:50|unique:products,name,'.$id,
            'parent_id' => 'required'
        ],[
            'name.required' => 'Isi Nama Barang',
            'name.max'      => 'Maksimal 50 Karakter',
            'name.unique'   => 'Nama Barang '.$request->name.' sudah ada',
            'parent_id.required'     => 'Pilih Kategori'
        ]);

        $product = Product::find($id);
        $product->update([
            'name'          => strtoupper($request->name),
            'category_id'   => $request->parent_id
        ]);

        return redirect(route('product.index'))->with(['success' => 'Data Barang Diperbaharui!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detailproduct = Productdetail::where('product_id', $id)->first();
        if (!$detailproduct) {
            $product =  Product::find($id);
            $product->delete();
            return redirect(route('product.index'))->with(['success' => 'Data Barang Dihapus!']);
        }

        return redirect(route('product.index'))->with(['error' => 'Data Barang ini masih ada unit!']);
    }

    public function cetak_pdf()
    {
        $product = Product::with(['category','productdetail'])->orderBy('created_at','DESC')->get();
        $pdf = PDF::loadview('product.cetak_pdf',compact('product'));
	    return $pdf->download('laporan-pdf-'.date('d-m-Y').'.pdf');
    }
}
