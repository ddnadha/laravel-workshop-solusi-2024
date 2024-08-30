<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-gray-900 font-semibold text-lg mb-4">
                    Produk Tersedia
                    <p class="font-medium text-sm mt-2">Silahkan pilih barang yang ingin dibeli</p>
                </div>
                <div class="grid grid-cols-12 lg:gap-5 sm:gap-2">
                    <div class="lg:col-span-8 md:col-span-7 col-span-12 mb-4">
                        <div class="grid lg:grid-cols-3 sm:grid-cols-2 xs:grid-cols-1 gap-4">
                            @foreach ($items as $item)
                                <div class="rounded bg-white border p-4">
                                    <h6 class="font-medium text-md">{{ $item->name }}</h6>
                                    <span class="block font-bold text-xs mb-2">Rp. @rupiah($item->price)</span>
                                    <form action="{{ route('cart.add', $item) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full px-4 py-1 bg-green-600 text-white border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">Buy</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="lg:col-span-4 md:col-span-5 col-span-12">
                        @if ($carts->isNotEmpty())
                            <div class="text-gray-900 font-semibold text-lg pb-4 border-b-2">
                                Keranjang Belanja
                                <p class="font-medium text-sm mt-2">Silahkan pilih kategori untuk memfilter produk
                                </p>
                            </div>
                            @foreach ($carts as $cart)
                                <div class="px-2 py-2 w-full grid grid-cols-5 gap-4 border-top">
                                    <h6 class="font-medium text-sm col-span-2">{{ $cart->name }}</h6>
                                    <p class="font-bold text-xs leading-loose col-span-2">{{ $cart->qty }} x Rp.
                                        @rupiah($cart->price)</p>
                                    <div class="w-full flex justify-end gap-2">
                                        <form action="{{ route('cart.reduce', $cart) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="w-6 text-center py-1 bg-red-600 text-white border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                -
                                            </button>
                                        </form>
                                        <form action="{{ route('cart.add', $cart) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="w-6 text-center py-1 bg-indigo-600 text-white border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                +
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            @endforeach
                            <div class="px-2 py-2 w-full border-t-2 mb-4">
                                <div class="flex justify-between mb-4">
                                    <h6 class="font-medium text-sm">Total</h6>
                                    <p class="font-bold text-xs leading-loose">
                                        Rp. @rupiah($carts->sum(fn($c) => $c->qty * $c->price))
                                    </p>
                                </div>
                                <form action="{{ route('transaction.store') }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="block text-center w-full px-4 py-2 bg-green-600 text-white border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Check out
                                    </button>
                                </form>
                            </div>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
