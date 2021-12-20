<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class KaryawanController extends Controller
{
    //
    public function index() {
        $karyawan = Karyawan::all(); // mengambil semua data user

        if (count($karyawan) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'karyawan' => $karyawan
            ], 200);
        } // return data semua user dalam bentuk json

        return response([
            'message' => 'Empty',
            'karyawan' => null
        ], 400); // return message data user kosong
    }

    public function show($id) {
        $karyawan = karyawan::find($id); // mencari data user berdasarkan id

        if(!is_null($karyawan)) {
            return response([
                'message' => 'Retrieve Karyawan Success',
                'karyawan' => $karyawan
            ], 200);
        } // return data karyawan yang ditemukan dalam bentuk json

        return response([
            'message' => 'User Not Found',
            'karyawan' => null
        ], 404); // return message saat data user tidak ditemukan
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_karyawan' => 'required',
            'nomor_karyawan' => 'required|unique:Karyawan|digits:4|numeric',
            'umur' => 'required|numeric|min:20|max:40',
            'jenis_kelamin' => 'required',
            'role' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $karyawan = Karyawan::create($storeData);
        return response([
            'message' => 'Add Karyawan Success',
            'karyawan' => $karyawan
        ], 200);   
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);

        if(is_null($karyawan)){
            return response([
                'message' => 'Karyawan Not Found',
                'karyawan' => null
            ], 404);
        }

        if($karyawan->delete()){
            return response([
                'message' => 'Delete Karyawan Success',
                'karyawan' => $karyawan
            ], 200);
        }

        return response([
            'message' => 'Delete Karyawan Failed',
            'karyawan' => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::find($id);
        if(is_null($karyawan)){
            return response([
                'message' => 'Karyawan Not Found',
                'karyawan' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_karyawan' => 'required',
            'nomor_karyawan' => ['required', "numeric", "digits:4", Rule::unique('Karyawan')->ignore($karyawan)],
            'umur' => 'required|numeric|min:20|max:40',
            'jenis_kelamin' => 'required',
            'role' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $karyawan->nama_karyawan = $updateData['nama_karyawan'];
        $karyawan->nomor_karyawan = $updateData['nomor_karyawan'];
        $karyawan->umur = $updateData['umur'];
        $karyawan->jenis_kelamin = $updateData['jenis_kelamin'];
        $karyawan->role = $updateData['role'];

        if ($karyawan->save()) {
            return response([
                'message' => 'Update Karyawan Success',
                'karyawan' => $karyawan
            ], 200);
        } // return data karyawan baru dalam bentuk json

        return response([
            'message' => 'Update Karyawan Failed',
            'karyawan' => null,
        ], 400);
    }
}
