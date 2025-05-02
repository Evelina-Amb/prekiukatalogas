<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
	<br>
    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-fixed divide-y divide-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Produktas</th>
                        <th class="px-4 py-2 text-sm font-semibold">Kaina</th>
                        <th class="px-2 py-2 text-sm font-semibold">Kiekis</th>
                        <th class="px-3 py-2 text-left text-sm font-semibold">Aprašymas</th>
                        <th class="px-3 py-2 text-left text-sm font-semibold">Kategorija</th>
                        <th class="px-3 py-2 text-left text-sm font-semibold">Įmonė</th>
                        <th class="px-4 py-2 text-sm font-semibold">Miestas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-3 py-2 text-gray-800 truncate">{{ $product->name }}</td>
                            <td class="px-5 py-2 text-gray-800">{{ number_format($product->price, 2) }} €</td>
                            <td class="px-2 py-2 text-gray-800">{{ $product->quantity }}</td>
                            <td class="px-3 py-2 text-gray-600 truncate">{{ Str::limit($product->description, 50) }}</td>
                            <td class="px-1 py-2 text-gray-700 truncate">{{ $product->category->name }}</td>
                            <td class="px-3 py-2 text-gray-700 truncate">{{ $product->company->name }}</td>
                            <td class="px-4 py-2 text-gray-700 truncate">{{ $product->company->city->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">Nėra produktų.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
