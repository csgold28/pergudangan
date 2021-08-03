<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::where('user_id', Auth::user()->id)->orderBy('created_at','DESC')->get();
        return view('client.index',compact('client'));
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
            'name'  => 'required',
            'phone' => 'required|unique:clients',
            'alamat'=> 'required'
        ],[
            'name.required'     => 'Isi Nama Client',
            'phone.required'   => 'Isi Kontak Client',
            'phone.unique'     => 'Kontak '.$request->phone.' sudah terdaftar',
            'alamat.required'   => 'Isi Alamat Client'
        ]);
        Client::create([
            'name'  => strtoupper($request->name),
            'phone' => $request->phone,
            'alamat'=> $request->alamat,
            'user_id'=> Auth::user()->id
        ]);
        return redirect(route('client.index'))->with(['success' => 'Client Baru Ditambahkan!']);
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
        $client = Client::find($id);
        return view('client.edit',compact('client'));
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
            'name'  => 'required',
            'phone' => 'required|unique:clients,phone,'.$id,
            'alamat'=> 'required'
        ],[
            'name.required'     => 'Isi Nama Client',
            'phone.required'   => 'Isi Kontak Client',
            'phone.unique'     => 'Kontak '.$request->phone.' sudah terdaftar',
            'alamat.required'   => 'Isi Alamat Client'
        ]);

        $client = Client::find($id);
        $client->update([
            'name'  => strtoupper($request->name),
            'phone' => $request->phone,
            'alamat'=> $request->alamat,
            'user_id'=> Auth::user()->id
        ]);

        return redirect(route('client.index'))->with(['success' => 'Data Client Diperbaharui!']);
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
