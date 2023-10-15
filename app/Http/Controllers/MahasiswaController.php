<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MahasiswaController extends Controller
{
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
            $errors = $validation->errors()->first();
            Alert::error('Validasi gagal', $errors);
            return redirect()->back();
        }

        $data = new MahasiswaModel;
        $data->nama_mahasiswa = $request->input('nama_mahasiswa');
        $data->nim = $request->input('nim');
        // dd($data);
        $data->save();

        Alert::success('Success tambah data');
        return redirect()->back();
    }

    public function getAllData()
    {
        $data = MahasiswaModel::all();
        return view('welcome')->with('data', $data);
    }

    public function getDataById($id)
    {
        $data = MahasiswaModel::where('id', $id)->first();
        return view('edit')->with('data', $data);
    }

    public function updateData(Request $request, $id)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'nama_mahasiswa' => 'required',
                'nim' => 'required|numeric'
            ],
            [
                'nama_mahasiswa.required' => 'Form nama mahasiswa tidak boleh kosong',
                'nim.required' => 'Form nim tidak boleh kosong',
                'nim.numeric' => 'Nim wajib angka',
            ]
        );

        if ($validation->fails()) {
            $errors = $validation->errors()->first();
            Alert::error('Validasi gagal', $errors);
            return redirect()->back();
        }

        $data = MahasiswaModel::where('id', $id)->first();
        $data->nama_mahasiswa = $request->input('nama_mahasiswa');
        $data->nim = $request->input('nim');
        $data->save();

        Alert::success('Success Update data');
        return redirect('/');
    }

    public function deleteData($id)
    {
        $data = MahasiswaModel::where('id', $id)->first();
        $data->delete();
        Alert::success('Success delete data');
        return redirect()->back();
    }
}
