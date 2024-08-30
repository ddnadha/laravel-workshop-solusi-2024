<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center">
                    <div class="p-6 text-gray-900 font-semibold text-lg">
                        Barang
                        <p class="font-medium text-sm mt-2">Daftar Barang yang ada di sistem</p>
                    </div>
                    <a href="{{ route('item.create') }}"
                        class="rounded text-white bg-indigo-700 px-4 mx-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">Tambah
                        Barang</a>
                </div>
                <div class="m-6 mt-1 p-4 border border-gray-200 rounded">
                    <table class="w-full divide-y divide-gray-200 bg-white text-sm">
                        <thead class="text-left">
                            <tr>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900 text-center">No</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Nama Barang</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Harga</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Gambar</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Stok</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @foreach ($items as $item)
                                <tr>
                                    <td class="whitespace-nowrap p-4 text-gray-900 text-center">{{ $loop->iteration }}
                                    </td>
                                    <td class="whitespace-nowrap p-4 text-gray-900">{{ $item->name }}</td>
                                    <td class="whitespace-nowrap p-4 text-gray-900">{{ $item->price }}</td>
                                    <td class="whitespace-nowrap p-4 text-gray-900">
                                        <img src="{{ asset('storage/' . $item->img) }}" alt="" class="h-16">
                                    </td>
                                    <td class="whitespace-nowrap p-4 text-gray-900">{{ $item->stock }}</td>
                                    <td class="whitespace-nowrap p-4">
                                        <form action="{{ route('item.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('item.edit', $item) }}"
                                                class="inline-block rounded text-white bg-yellow-500 px-4 py-2 text-xs font-medium text-white hover:bg-yellow-600">Edit</a>
                                            <button type="submit"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus barang ini?')"
                                                class="inline-block rounded text-white bg-red-500 px-4 py-2 text-xs font-medium text-white hover:bg-red-600">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
