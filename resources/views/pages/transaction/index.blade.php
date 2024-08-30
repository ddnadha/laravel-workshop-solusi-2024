<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-semibold text-lg">
                    Transaksi
                    <p class="font-medium text-sm mt-2">Lihat semua transaksimu</p>
                </div>
                <div class="m-6 mt-1 p-4 border border-gray-200 rounded">
                    <table class="w-full divide-y divide-gray-200 bg-white text-sm">
                        <thead class="text-left">
                            <tr>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">No</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Pembeli</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Tanggal Pembelian</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Total</th>

                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td class="whitespace-nowrap p-4 text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="whitespace-nowrap p-4 text-gray-700">
                                        {{ $transaction->user->name }}</td>
                                    <td class="whitespace-nowrap p-4 text-gray-700">
                                        {{ $transaction->created_at->format('d M Y') }}</td>
                                    <td class="whitespace-nowrap p-4 text-gray-700">Rp. @rupiah($transaction->total)</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 mb-6">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
