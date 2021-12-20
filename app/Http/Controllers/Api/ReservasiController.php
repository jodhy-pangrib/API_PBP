<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Validator;

class ReservasiController extends Controller
{
    public function index() {
        $reservasi = Reservasi::all(); // mengambil semua data reservasi

        if (count($reservasi) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'reservasi' => $reservasi
            ], 200);
        } // return data semua reservasi dalam bentuk json

        return response([
            'message' => 'Empty',
            'reservasi' => null
        ], 400); // return message data reservasi kosong
    }

    // method untuk menampilkan 1 data reservasi (search)
    public function show($id) {
        $reservasi = Reservasi::find($id); // mencari data reservasi berdasarkan id

        if(!is_null($reservasi)) {
            return response([
                'message' => 'Retrieve Reservasi Success',
                'reservasi' => $reservasi
            ], 200);
        } // return data reservasi yang ditemukan dalam bentuk json

        return response([
            'message' => 'Reservasi Not Found',
            'reservasi' => null
        ], 404); // return message saat data reservasi tidak ditemukan
    }

    // method untuk menambah 1 data reservasi baru (create)
    public function store(Request $request) {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama' => 'required|max:60',
            'room_type' => 'required|max:60',
            'checkIn' => 'required|date',
            'checkOut' => 'required|date',
            'total_harga' => 'required|numeric'
        ]); // membuat rule validasi input

        if ($validate->fails()) 
            return response(['message' => $validate->errors()], 400); // return error invalid input

        $reservasi = Reservasi::create($storeData);
        return response([
            'message' => 'Pembayaran Berhasil',
            'reservasi' => $reservasi
        ], 200); // return data reservasi baru dalam bentuk json
    }

    // method untuk menghapus 1 data product (delete)
    public function destroy($id) {
        $reservasi = Reservasi::find($id); // mencari data product berdasarkan id

        if (is_null($reservasi)) {
            return response([
                'message' => 'Reservasi Not Found',
                'reservasi' => null
            ], 404);
        } // return message saat data reservasi tidak ditemukan

        if ($reservasi->delete()) {
            return response([
                'message' => 'Delete Reservasi Success',
                'reservasi' => $reservasi
            ], 200);
        } // return message saat berhasil menghapus data reservasi
        
        return response([
            'message' => 'Delete Reservasi Failed',
            'reservasi' => null,
        ], 400); // return message saat gagal menghapus data reservasi
    }

    //method untuk mengubah 1 data reservasi (update)
    public function update(Request $request, $id) {
        $reservasi = Reservasi::find($id); // mencari data reservasi berdasarkan id
        if (is_null($reservasi)) {
            return response([
                'message' => 'Reservasi Not Found',
                'reservasi' => null
            ], 404);
        } // return message saat data reservasi tidak ditemukan

        $updateData = $request->all(); // mengambil semua input dari api client
        $validate = Validator::make($updateData, [
            'nama' => 'required|max:60',
            'room_type' => 'required|max:60',
            'checkIn' => 'required|date',
            'checkOut' => 'required|date',
            'total_harga' => 'required|numeric'
        ]); // membuat rule validasi input

        if($validate->fails())
            return response(['message' => $validate->errors()], 400); // return error invalid input

        $reservasi->nama = $updateData['nama'];
        $reservasi->room_type = $updateData['room_type'];
        $reservasi->checkIn = $updateData['checkIn'];
        $reservasi->checkOut = $updateData['checkOut'];
        $reservasi->total_harga = $updateData['total_harga'];

        if ($reservasi->save()) {
            return response([
                'message' => 'Update Reservasi Success',
                'reservasi' => $reservasi
            ], 200);
        } // return data reservasi baru dalam bentuk json

        return response([
            'message' => 'Update Reservasi Failed',
            'reservasi' => null
        ], 400); // return message saat reservasi gagal diedit
    }
}
