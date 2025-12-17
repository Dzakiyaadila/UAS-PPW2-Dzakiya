@extends('base')
@section('title','Tambah Pegawai')
@section('menupegawai', 'underline decoration-4 underline-offset-7')

@section('content')
<section class="p-4 bg-white rounded-lg min-h-[50vh]">
    <h1 class="text-3xl font-bold text-[#C0392B] mb-6 text-center">Tambah Pegawai</h1>

    <div class="mx-auto max-w-xl">
        <form action="{{ route('pegawai.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                       class="w-full rounded-md border px-3 py-2 text-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full rounded-md border px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Gender</label>
                <select name="gender" class="w-full rounded-md border px-3 py-2 text-sm" required>
                    <option value="">-- Pilih --</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Pekerjaan</label>
                <select name="pekerjaan_id" class="w-full rounded-md border px-3 py-2 text-sm" required>
                    <option value="">-- Pilih Pekerjaan --</option>
                    @foreach($pekerjaan as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Status</label>
                <select name="is_active" class="w-full rounded-md border px-3 py-2 text-sm" required>
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-2">Captcha</label>

                <div class="mb-2">
                    {!! captcha_img() !!}
                </div>

                <input
                    type="text"
                    name="captcha"
                    class="border rounded w-full p-2"
                    placeholder="Masukkan captcha"
                    required
                >

                @error('captcha')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="flex gap-2 pt-4">
                <button type="submit"
                        class="rounded-md bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">
                    Simpan
                </button>
                <a href="{{ route('pegawai.index') }}"
                   class="rounded-md bg-gray-500 px-4 py-2 text-sm text-white hover:bg-gray-600">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</section>
@endsection
