@extends('base')
@section('title','Edit Pegawai')
@section('menupegawai', 'underline decoration-4 underline-offset-7')

@section('content')
<section class="p-4 bg-white rounded-lg min-h-[50vh]">
    <h1 class="text-3xl font-bold text-[#C0392B] mb-6 text-center">Edit Pegawai</h1>

    <div class="mx-auto max-w-xl">
        <form action="{{ route('pegawai.update', ['id' => $data->id]) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input type="text" name="nama" value="{{ $data->nama }}"
                       class="w-full rounded-md border px-3 py-2 text-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ $data->email }}"
                       class="w-full rounded-md border px-3 py-2 text-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Gender</label>
                <select name="gender" class="w-full rounded-md border px-3 py-2 text-sm" required>
                    <option value="male" {{ $data->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $data->gender == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Pekerjaan</label>
                <select name="pekerjaan_id" class="w-full rounded-md border px-3 py-2 text-sm" required>
                    @foreach($pekerjaan as $p)
                        <option value="{{ $p->id }}"
                            {{ $data->pekerjaan_id == $p->id ? 'selected' : '' }}>
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Status</label>
                <select name="is_active" class="w-full rounded-md border px-3 py-2 text-sm" required>
                    <option value="1" {{ $data->is_active ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ !$data->is_active ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="flex gap-2 pt-4">
                <button type="submit"
                        class="rounded-md bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">
                    Update
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
