<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');

        $data = Pegawai::with('pekerjaan')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', "%{$keyword}%")
                      ->orWhere('email', 'like', "%{$keyword}%");
            })
            ->paginate(10);

        return view('pegawai.index', compact('data', 'keyword'));
    }

    public function add()
    {
        $pekerjaan = Pekerjaan::all();
        return view('pegawai.add', compact('pekerjaan'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'required|email|unique:dzakiya_542103_pegawai,email',
            'gender' => 'required|in:male,female',
            'pekerjaan_id' => 'required|exists:dzakiya_542103_pekerjaan,id',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with($validator->errors()->all());
        }

        $data = new Pegawai();
        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->gender = $request->gender;
        $data->pekerjaan_id = $request->pekerjaan_id;
        $data->is_active = $request->is_active;

        if ($data->save()) {
            return redirect()->route('pegawai.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('pegawai.index')->with('error', 'Data tidak tersimpan');
        }
    }

    public function edit(Request $request)
    {
        $data = Pegawai::findOrFail($request->id);
        $pekerjaan = Pekerjaan::all();

        return view('pegawai.edit', compact('data', 'pekerjaan'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('dzakiya_542103_pegawai', 'email')->ignore($request->id),
            ],
            'gender' => 'required|in:male,female',
            'pekerjaan_id' => 'required|exists:dzakiya_542103_pekerjaan,id',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with($validator->errors()->all());
        }

        $data = Pegawai::findOrFail($request->id);

        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->gender = $request->gender;
        $data->pekerjaan_id = $request->pekerjaan_id;
        $data->is_active = $request->is_active;

        if ($data->save()) {
            return redirect()->route('pegawai.index')->with('success', 'Data tersimpan');
        } else {
            return redirect()->route('pegawai.index')->with('error', 'Data tidak tersimpan');
        }
    }

    public function destroy(Request $request)
    {
        Pegawai::findOrFail($request->id)->delete();

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data terhapus');
    }
}
