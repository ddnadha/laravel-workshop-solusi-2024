<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-semibold text-lg">
                    Barang
                    <p class="font-medium text-sm mt-2">Edit Barang</p>
                </div>
                <form action="{{ route('item.update', $item) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="m-6 mt-1 p-4">
                        <div class="grid grid-cols-2">
                            <div>
                                <div class="mt-4">
                                    <x-input-label for="name" :value="__('Nama')" />

                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                        required autocomplete="name" value="{{ $item->name ?? '' }}" />

                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="price" :value="__('Harga')" />

                                    <x-text-input id="price" class="block mt-1 w-full" type="text" name="price"
                                        required autocomplete="price" value="{{ $item->price ?? '' }}" />

                                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="stock" :value="__('Stock')" />

                                    <x-text-input id="stock" class="block mt-1 w-full" type="text" name="stock"
                                        required autocomplete="stock" value="{{ $item->stock ?? '' }}" />

                                    <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                                </div>
                                <div class="flex justify-end">
                                    <div class="mt-4">
                                        <x-primary-button class="">
                                            {{ __('Simpan') }}
                                        </x-primary-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
