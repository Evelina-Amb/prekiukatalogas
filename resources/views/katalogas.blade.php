<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
<style>
    .form-button,
    .form-button-link {
        background-color: #1e40af;
        color: white;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: bold;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .form-button:hover,
    .form-button-link:hover {
        background-color: #1a3694;
    }
}
</style>
<div id="filters-section" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        <form method="GET" action="{{ route('katalogas') }}" class="space-y-6">

 {{-- Cities --}}
<div>
    <label class="font-semibold block mb-2">Miestai:</label>
    <div class="flex flex-wrap gap-4">
        @foreach($cities as $city)
            <label class="inline-flex items-center gap-2 mb-2">
                <input type="checkbox" name="cities[]" value="{{ $city->id }}"
				class="mr-2"
                       {{ in_array($city->id, request('cities', [])) ? 'checked' : '' }}>
                <span class="ml-1">{{ $city->name }}</span>
            </label>
        @endforeach
    </div>
</div>

    {{-- Quantity --}}
<div class="grid grid-cols-2 gap-6">
    <div>
        <label for="quantity_min" class="block text-sm font-medium">Kiekis nuo:</label>
        <input
            type="number"
            name="quantity_min"
            id="quantity_min"
            min="0"
            value="{{ request('quantity_min') }}"
            class="border rounded px-3 py-2 w-32">
    </div>
    <div>
        <label for="quantity_max" class="block text-sm font-medium">Kiekis iki:</label>
        <input
            type="number"
            name="quantity_max"
            id="quantity_max"
            min="0"
            value="{{ request('quantity_max') }}"
            class="border rounded px-3 py-2 w-32">
    </div>
</div>

    {{-- Price --}}
    <div class="grid grid-cols-2 gap-6">
        <div>
            <label for="price_min" class="block text-sm font-medium mb-1">Kaina nuo:</label>
            <input type="number" name="price_min" step="0.01" id="price_min" 
                   value="{{ request('price_min') }}" 
                   class="border rounded px-3 py-2 w-32">
        </div>
        <div>
            <label for="price_max" class="block text-sm font-medium mb-1">Kaina iki:</label>
            <input type="number" name="price_max" step="0.01" id="price_max" 
                   value="{{ request('price_max') }}" 
                   class="border rounded px-3 py-2 w-32">
        </div>
    </div>

    {{-- Categories --}}
    <div id="category-selects">
        <label class="block font-semibold mb-2">Kategorijos:</label>
        @php $selectedCategories = request('categories', [null]) @endphp
        @foreach($selectedCategories as $i => $cat)
    <div class="mb-2 flex items-center gap-2">
        <select name="categories[]" class="border rounded px-3 py-2 w-60">
            <option value="">- Pasirinkti -</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $cat == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @if ($i === count($selectedCategories) - 1)
            <button type="button" onclick="addCategorySelect()" class="px-3 py-1 rounded">+</button>
        @endif
    </div>
@endforeach
    </div>

<div class="flex gap-4">
    <button type="submit" class="form-button">Taikyti</button>
    <a href="{{ route('katalogas') }}" class="form-button-link">Atstatyti</a>
</div>
</form>
</div>
</div>

{{-- Script for dynamic category addition --}}
<script>
    function addCategorySelect() {
        const container = document.getElementById('category-selects');
        const categories = @json($categories->map(fn($c) => ['id' => $c->id, 'name' => $c->name]));
        
        const div = document.createElement('div');
        div.className = 'mb-2 flex items-center gap-2';

        const select = document.createElement('select');
        select.name = 'categories[]';
        select.classList.add('border', 'rounded', 'px-3', 'py-2', 'w-60');

        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.text = '- Pasirinkti -';
        select.appendChild(defaultOption);

        categories.forEach(cat => {
            const opt = document.createElement('option');
            opt.value = cat.id;
            opt.text = cat.name;
            select.appendChild(opt);
        });

        div.appendChild(select);
        container.appendChild(div);
    }
</script>
<script>
    function toggleFilters() {
        const section = document.getElementById('filters-section');
        const body = document.body;
        const filterBtn = document.getElementById('filter-toggle-button');

        section.classList.toggle('hidden');

        if (!section.classList.contains('hidden')) {
            body.style.overflow = 'hidden';
            filterBtn.style.display = 'none';
        } else {
            body.style.overflow = '';
            filterBtn.style.display = 'block';
        }
    }
</script>

<br><br><br><br><br>
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
    </div><br>
</x-app-layout>