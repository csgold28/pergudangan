<?php

namespace App\Http\Controllers;

use App\Client;
use App\Product;
use App\Project;
use App\Projectbarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::with(['user','client'])->where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();
        $client = Client::where('user_id',Auth::user()->id)->orderBy('name','ASC')->get();
        return view('project.index',compact('project','client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = Client::where('user_id',Auth::user()->id)->orderBy('name','ASC')->get();
        return view('project.create',compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'client_id' => 'required',
        //     'nominal' => 'required|integer|min:0',
        //     'dp'       => 'required|integer|min:0',
        //     // 'sisa'  => 'required|integer|min:0',
        //     'waktu_sewa' => 'required',
        //     'tipe_transaksi' => 'required',
        //     'status_pembayaran' => 'required',
        //     'keterangan_pembayaran' => 'required',
        //     'status_barang' => 'required',
        // ],[
        //     'client_id.required'   => 'Pilih Client',
        //     'nominal.required'  => 'Isi Nominal',
        //     'nominal.min'       => 'Minimal 0',
        //     'dp.required'       => 'Isi Nominal DP',
        //     'dp.min'            => 'Dp minimal 0',
        //     // 'sisa.riquired'     => 'Masukkan sisa tagihan',
        //     // 'sisa.min'          => 'Minimal 0',
        //     'waktu_sewa.required'=> 'Isi Waktu Sewa',
        //     'tipe_transaksi.required'=> 'Isi tipe transaksi',
        //     'status_pembayaran.required'=> 'Pilih Status Pemabayaran',
        //     'keterangan_pembayaran.required'=> 'Isi Keterangan Pembayaran',
        //     'status_barang.required'    => 'Pilih Status Barang',
        // ]);
        
        Project::create([
            'client_id'         => $request->client_id,
            'nominal'           => $request->nominal,
            'dp'                => $request->dp,
            // 'sisa'              => $request->sisa,
            'waktu_sewa'        => $request->waktu_sewa,
            'tipe_transaksi'    => $request->tipe_transaksi,
            'status_pembayaran' => $request->status_pembayaran,
            'keterangan_pembayaran'=>$request->keterangan_pembayaran,
            'status_barang'     => 1,
            'teknisiloading_id' => $request->teknisiloading_id,
            'no_kontrak'        => $request->no_kontrak,
            'teknisibongkar_id' => $request->teknisibongkar_id,
            'user_id'           => Auth::user()->id,
            'note'              => $request->note
        ]);
        
        return redirect(route('project.index'))->with(['success' => 'Project Baru Ditambahkan!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        $product = Product::orderBy('name','ASC')->get();
        $projectbarang = Projectbarang::with(['project','product'])->where('project_id',$id)->get();
        return view('project.barang',compact('projectbarang','product','project'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::where('user_id',Auth::user()->id)->orderBy('name','ASC')->get();
        $project = Project::find($id);
        return view('project.edit',compact('client','project'));

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
        // dd($request->all());
        // $this->validate($request,[
        //     'client_id' => 'required',
        //     'nominal' => 'required|integer|min:0',
        //     'dp'       => 'required|integer|min:0',
        //     'sisa'  => 'required|integer|min:0',
        //     'waktu_sewa' => 'required',
        //     'tipe_transaksi' => 'required',
        //     'status_pembayaran' => 'required',
        //     'keterangan_pembayaran' => 'required',
        //     'status_barang' => 'required',
        // ],[
        //     'client_id.required'   => 'Pilih Client',
        //     'nominal.required'  => 'Isi Nominal',
        //     'nominal.min'       => 'Minimal 0',
        //     'dp.required'       => 'Isi Nominal DP',
        //     'dp.min'            => 'Dp minimal 0',
        //     'sisa.riquired'     => 'Masukkan sisa tagihan',
        //     'sisa.min'          => 'Minimal 0',
        //     'waktu_sewa.required'=> 'Isi Waktu Sewa',
        //     'tipe_transaksi.required'=> 'Isi tipe transaksi',
        //     'status_pembayaran.required'=> 'Pilih Status Pemabayaran',
        //     'keterangan_pembayaran.required'=> 'Isi Keterangan Pembayaran',
        //     'status_barang.required'    => 'Pilih Status Barang',
        // ]);

        

        $project = Project::find($id);
        $project->update([
            'client_id'         => $request->client_id,
            'nominal'           => $request->nominal,
            'dp'                => $request->dp,
            'sisa'              => $request->sisa,
            'waktu_sewa'        => $request->waktu_sewa,
            'tipe_transaksi'    => $request->tipe_transaksi,
            'status_pembayaran' => $request->status_pembayaran,
            'keterangan_pembayaran'=>$request->keterangan_pembayaran,
            'status_barang'     => 1,
            'teknisiloading_id' => $request->teknisiloading_id,
            'no_kontrak'        => $request->no_kontrak,
            'teknisibongkar_id' => $request->teknisibongkar_id,
            'user_id'           => Auth::user()->id,
        ]);

        return redirect(route('project.index'))->with(['success' => 'Project Diperbaharui!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
