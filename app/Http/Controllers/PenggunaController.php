<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Http\Requests\StorePenggunaRequest;
use App\Http\Requests\UpdatePenggunaRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengguna = Pengguna::all();
        return view('pengguna.pengguna', compact('pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenggunaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenggunaRequest $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns|min:7',
            'nama' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'required|numeric',
            'address' => 'required|min:5',
            'password' => 'required',
        ]);
    
        // Default avatar file name
        $defaultAvatar = 'avatardefault.png';
    
        $pengguna = Pengguna::create([
            'email' => $request->email,
            'nama' => $request->nama,
            'role' => $request->role,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password)
        ]);
    
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/avatar'), $filename);
        } else {
            // If no avatar is provided, use the default avatar
            $filename = $defaultAvatar;
        }
    
        $pengguna->avatar = $filename;
        $pengguna->save();
    
        return redirect('/pengguna');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function show(Pengguna $pengguna)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        return view('pengguna.edit', compact('pengguna'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenggunaRequest  $request
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenggunaRequest $request, $id)
    {
    $request->validate([
        'email' => 'required|email:rfc,dns|min:7',
        'nama' => 'required',
        'role' => 'required',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'phone' => 'required|numeric',
        'address' => 'required|min:5',
        'password' => Hash::make($request->password)
    ]);

    $pengguna = Pengguna::findOrFail($id);
    $pengguna->update($request->except(['_token', 'submit']));

    if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
        // Hapus avatar sebelumnya jika ada
        if ($pengguna->avatar) {
            $avatarPath = public_path('storage/avatar/') . $pengguna->avatar;
            if (file_exists($avatarPath)) {
                unlink($avatarPath);
            }
        }

        $file = $request->file('avatar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('storage/avatar'), $filename);

        $pengguna->avatar = $filename;
        $pengguna->save();
    }

    return redirect('/pengguna');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengguna = Pengguna::findOrFail($id);
    
        // Hapus foto dari folder storage
        if ($pengguna->avatar) {
            $filePath = public_path('storage/avatar/' . $pengguna->avatar);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
    
        $pengguna->delete();
    
        return redirect('/pengguna');
    }
    
    
    
    
}
