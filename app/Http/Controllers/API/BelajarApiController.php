<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BelajarApiController extends Controller
{
    public function getAllData()
    {
        $data = MahasiswaModel::all();
        return response()->json([
            'code' => 200,
            'message' => 'success get all data',
            'data' => $data
        ]);
    }

    public function createData(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'nama_mahasiswa' => 'required',
                'nim' => 'required|numeric|unique:tb_mahasiswa'
            ],
            [
                'nama_mahasiswa.required' => 'Form nama mahasiswa tidak boleh kosong',
                'nim.required' => 'Form nim tidak boleh kosong',
                'nim.numeric' => 'Nim wajib angka',
                'nim.unique' => "NIm sudah ada sebelumnya"
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Check your validation',
                'errors' => $validation->errors()
            ]);
        }

        try {
            $data = new MahasiswaModel;
            $data->nama_mahasiswa = $request->input('nama_mahasiswa');
            $data->nim = $request->input('nim');
            // dd($data);
            $data->save();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed',
                'errors' => $th->getMessage()
            ]);
        }

        return response()->json([
            'message' => 'success create data',
            'data' => $data
        ]);
      
    }
}
