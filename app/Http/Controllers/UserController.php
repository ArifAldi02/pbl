<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function myProfile()
    {
        $user = Auth::user();
        return view('user.profile', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|min:3',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->save();

        if ($user) {
            return redirect('/myProfile')->with('success', 'Berhasil');
        }

        return redirect('/myProfile')->with('error', 'Gagal');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|numeric',
        ]);

        $detail_siswa = Siswa::create([
            'nisn' => $request->nisn,
            'id_user' => Auth::user()->id
        ]);
        $detail_siswa->save();

        if ($detail_siswa) {
            return redirect('/myProfile')->with('success', 'Berhasil');
        }
        return redirect('/myProfile')->with('error', 'Gagal');
    }
}
