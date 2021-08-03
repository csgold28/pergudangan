<?php

namespace App\Http\Controllers;

use App\Productdetail;
use App\Suplayer;
use Illuminate\Http\Request;

class SuplayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suplayer = Suplayer::orderBy('created_at', 'DESC')->get();
        return view('suplayer.index',compact('suplayer'));
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
            'name' => 'required|string|max:50|unique:suplayers'
        ],[
            'name.required' => 'Isi Nama Suplayer',
            'name.max'      => 'Maksimal 50 Karakter',
            'name.unique'   => 'Nama Suplayer '.$request->name.' sudah ada'
        ]);

        Suplayer::create([
            'name'  => strtoupper($request->name)
        ]);

        return redirect(route('suplayer.index'))->with(['success' => 'Suplayer Baru Ditambahkan!']);
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
        $suplayer = Suplayer::find($id);
        return view('suplayer.edit',compact('suplayer'));
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
            'name' => 'required|string|max:50|unique:suplayers,name,'.$id
        ],[
            'name.required' => 'Isi Nama Suplayer',
            'name.max'      => 'Maksimal 50 Karakter',
            'name.unique'   => 'Nama Suplayer '.$request->name.' sudah ada'
        ]);

        $suplayer = Suplayer::find($id);
        $suplayer->update([
            'name'  => strtoupper($request->name)
        ]);

        return redirect(route('suplayer.index'))->with(['success' => 'Suplayer Diperbaharui!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Productdetail::where('suplayer_id', $id)->first();
        if (!$data) {
            $suplayer = Suplayer::find($id);
            $suplayer->delete();
            return redirect(route('suplayer.index'))->with(['success' => 'Suplayer '.$suplayer->name.' Dihapus!']);
        }
        return redirect(route('suplayer.index'))->with(['error' => 'Suplayer '.$suplayer->name.' Masih terpakai pada data barang!']);

    }
}
