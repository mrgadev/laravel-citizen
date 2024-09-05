<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Paguyuban;
use Illuminate\Http\Request;
use App\Models\PengurusPaguyuban;

class PengurusPaguyubanController extends Controller
{


    public function addMember(Paguyuban $paguyuban) {
        $wargas = Warga::all();
        return view('pages.dashboard.pengurus_paguyuban.add-member', compact('paguyuban', 'wargas'));
    }

    public function saveMember(Request $request, Paguyuban $paguyuban) {
        // dd($paguyuban);
        $data = $request->validate([
            'paguyuban_id' => 'required|exists:paguyubans,id',
            'warga_id' => 'required|exists:wargas,id',
            'posisi' => 'string|required|max:255',
        ]);
        PengurusPaguyuban::create($data);
        return redirect()->route('paguyuban.show', $paguyuban->id)->with('success', 'Berhasil menambah anggota!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editMember(string $id)
    {
        $pengurusPaguyuban = PengurusPaguyuban::find($id);
        $wargas = Warga::all();
        return view('pages.dashboard.pengurus_paguyuban.edit', compact('pengurusPaguyuban', 'wargas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateMember(Request $request, string $id)
    {
        $data = $request->validate([
            'paguyuban_id' => 'required|exists:paguyubans,id',
            'warga_id' => 'required|exists:wargas,id',
            'posisi' => 'string|required|max:255',
        ]);
        $pengurusPaguyuban = PengurusPaguyuban::find($id);
        $pengurusPaguyuban->update($data);
        return redirect()->route('paguyuban.show', $data['paguyuban_id'])->with('success', 'Berhasil mengubah data anggota!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteMember(string $id)
    {
        $pengurusPaguyuban = PengurusPaguyuban::find($id);
        $pengurusPaguyuban->delete();
        return redirect()->route('paguyuban.show', $pengurusPaguyuban->paguyuban_id)->with('success', 'Berhasil menghapus anggota');

    }
}
