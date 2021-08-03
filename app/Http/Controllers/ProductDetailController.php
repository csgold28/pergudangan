<?php

namespace App\Http\Controllers;

use App\Product;
use App\Productdetail;
use App\Suplayer;
use Illuminate\Http\Request;
use PDF;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $produkdetail = Productdetail::with(['product','suplayer'])->orderBy('updated_at','DESC')->get();
        $product = Product::orderBy('name','ASC')->get();
        $suplayer = Suplayer::orderBy('name','ASC')->get();
        return view('productdetail.index',compact('produkdetail','product','suplayer'));

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
        $this->validate($request,[
            'product'       => 'required',
            // 'barcode'       => 'required|unique:productdetails',
            'status'        => 'required',
            'suplayer'      => 'required',
            'serial_number' => 'required|unique:productdetails',
            'status_barang' => 'required',
        ],[
            'product.required'  => 'Pilih Nama Barang',
            'barcode.required'  => 'Isi Barcode',
            // 'barcode.unique'    => 'Barcode '.$request->barcode.' sudah terpakai',
            'status.required'   => 'Pilih Status',
            'suplayer.required' => 'Pilih Suplayer',
            'serial_number.required'    => 'Isi Serial Number',
            'serial_number.unique'      => 'Serial Number sudah Ada',
            'status_barang.required'    => 'Pilih Status barang'
        ]);

        if ($request->get('status') == 2) {
            $this->validate($request,[
                // 'project'      => 'required',
                'keterangan'   => 'required',
            ],[
                'project.required'     => 'Pilih Projek',
                'keterangan.required'  => 'Isi Keterangan',
            ]);
        }

        Productdetail::create([
            'product_id'    => $request->product,
            'barcode'       => $request->barcode,
            'status'        => $request->status,
            'status_barang' => $request->status_barang,
            'serial_number' => $request->serial_number,
            'suplayer_id'   => $request->suplayer,
            // 'project_id'    => $request->project,
            'keterangan'    => $request->keterangan
        ]);

        return redirect(route('productdetail.index'))->with(['success' => 'Unit Baru Ditambahkan!']);
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
        $produkdetail = Productdetail::find($id);
        $product = Product::orderBy('name','ASC')->get();
        $suplayer = Suplayer::orderBy('name','ASC')->get();
        return view('productdetail.edit',compact('produkdetail','product','suplayer'));
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
        $this->validate($request,[
            'product'   => 'required',
            'barcode'   => 'required|unique:productdetails,barcode,'.$id,
            'status'    => 'required',
            'suplayer'  => 'required',
            'status_barang' => 'required',
        ],[
            'product.required'  => 'Pilih Nama Barang',
            'barcode.required'  => 'Isi Barcode',
            'barcode.unique'    => 'Barcode '.$request->barcode.' sudah terpakai',
            'status.required'   => 'Pilih Status',
            'suplayer.required' => 'Pilih Suplayer',
            'status_barang.required'    => 'Pilih Status barang'
        ]);

        if ($request->get('status') == 2) {
            $this->validate($request,[
                // 'project'      => 'required',
                'keterangan'   => 'required',
            ],[
                // 'project.required'     => 'Pilih Projek',
                'keterangan.required'  => 'Isi Keterangan',
            ]);
        }

        $produkdetail = Productdetail::find($id);
        $produkdetail->update([
            'product_id'    => $request->product,
            'barcode'       => $request->barcode,
            'status'        => $request->status,
            'status_barang' => $request->status_barang,
            'serial_number' => $request->serial_number,
            'suplayer_id'   => $request->suplayer,
            'project_id'    => $request->project,
            'keterangan'    => $request->keterangan
        ]);

        return redirect(route('productdetail.index'))->with(['success' => 'Data Unit Diperbaharui!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produkdetail = Productdetail::find($id);
        if (!$produkdetail->status == 2) {
            return redirect(route('productdetail.index'))->with(['error' => 'Unit barcode '.$produkdetail->barcode.' sedang dipakai!']);
        }
        $produkdetail->delete();
        return redirect(route('productdetail.index'))->with(['success' => 'Unit barcode '.$produkdetail->barcode.' Dihapus!']);
    }

    public function cetak_pdf()
    {
        $produkdetail = Productdetail::with(['product','suplayer'])->orderBy('updated_at','DESC')->get();
        $pdf = PDF::loadview('productdetail.cetak_pdf',compact('produkdetail'));
	    return $pdf->download('laporan-barang-pdf-'.date('d-m-Y').'.pdf');
    }
}
