<x-layouts.admin>
    <x-slot name="title">Kelola Galeri</x-slot>

    <style>
        .gallery-preview {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e5e7eb; 
        }
    </style>

    <div class="flex-1">
        @if (session('success'))
            <div class="bg-green-500 text-white text-center p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                <strong class="font-bold">Oops! Ada yang salah:</strong>
                <ul class="list-disc pl-5 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-amber-100 p-6 rounded-lg mb-8">
            <h1 class="text-4xl font-bold">BATATUA 1928 - KELOLA GALERI</h1>
            <p class="mt-2 text-lg text-gray-700">Ganti 5 gambar yang akan tampil di halaman depan Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($images as $image)
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-2xl font-bold mb-4">{{ $image->slot_name }}</h3>

                    <img src="{{ asset('Assets/' . $image->image_path) }}" alt="{{ $image->slot_name }}" class="gallery-preview mb-4">

                    <form action="{{ route('admin.gallery.update', $image->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Ganti Gambar:</label>
                            <input type="file" name="gambar" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                        </div>

                        <button type="submit" class="w-full mt-4 bg-amber-600 hover:bg-amber-700 text-white py-2 rounded-lg font-bold transition-colors">
                            Simpan {{ $image->slot_name }}
                        </button>
                    </form>
                </div>
            @endforeach

        </div> 
    </div> 

</x-layouts.admin>