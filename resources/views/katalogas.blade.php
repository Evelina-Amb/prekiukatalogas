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
        <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            type="number"
            name="quantity_min"
            id="quantity_min"
            min="0"
            value="{{ request('quantity_min') }}"
            class="border rounded px-3 py-2 w-32">
    </div>
    <div>
        <label for="quantity_max" class="block text-sm font-medium">Kiekis iki:</label>
        <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
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
            <input type="number" name="price_min" step="0.01" id="price_min" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                   value="{{ request('price_min') }}">
        </div>
        <div>
            <label for="price_max" class="block text-sm font-medium mb-1">Kaina iki:</label>
            <input type="number" name="price_max" step="0.01" id="price_max" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                   value="{{ request('price_max') }}">
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
        if (!section) return;

        if (section.classList.contains('hidden')) {
            section.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        } else {
            section.classList.add('hidden');
            document.body.style.overflow = '';
        }
    }
</script>
<script>
    document.addEventListener('click', function (event) {
        const modal = document.getElementById('filters-section');
        const isVisible = modal && !modal.classList.contains('hidden');

        if (!isVisible) return;

        if (!modal.querySelector('form')?.contains(event.target) && !event.target.closest('button[onclick="toggleFilters()"]')) {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }
    });
</script>
<script>
    function toggleAdd() {
        const modal = document.getElementById('add-product-modal');
        modal.classList.toggle('hidden');
        document.getElementById('step1').classList.remove('hidden');
        document.getElementById('step2').classList.add('hidden');
        document.getElementById('company_code').value = '';
        document.getElementById('code-error').classList.add('hidden');
    }

    function verifyCompanyCode() {
        const code = document.getElementById('company_code').value;

        fetch("{{ route('company.verify') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ code: code })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('company_id').value = data.company.id;
                document.getElementById('city_id').value = data.company.city_id;
                document.getElementById('step1').classList.add('hidden');
                document.getElementById('step2').classList.remove('hidden');
            } else {
                document.getElementById('code-error').classList.remove('hidden');
            }
        })
        .catch(() => {
            document.getElementById('code-error').classList.remove('hidden');
        });
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
	
<div id="add-product-modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
		<div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-xl relative">
        <button onclick="toggleAdd()" class="absolute top-0 right-0 m-2 text-xl rounded-full w-8 h-8 flex items-center">&times;</button>
		<div id="step1">
            <label for="company_code" class="block mb-2 font-semibold">Įmonės kodas:</label>
            <input type="text" id="company_code" class="border rounded px-3 py-2 w-full mb-4">
            <p id="code-error" class="text-red-600 text-sm hidden mb-4">Neteisingas kodas</p>
            <button onclick="verifyCompanyCode()" class="form-button">Tęsti</button>
        </div>

        <div id="step2" class="hidden">
            <form id="add-product-form" method="POST" action="{{ route('products.store') }}">
                @csrf
                <input type="hidden" name="company_id" id="company_id">
                <input type="hidden" name="city_id" id="city_id">

                <label class="block mt-4 font-semibold">Produkto pavadinimas:</label>
                <input type="text" name="name" class="border rounded px-3 py-2 w-full" required>

                <label class="block mt-4 font-semibold">Kaina (€):</label>
                <input type="number" name="price" step="0.01" class="border rounded px-3 py-2 w-full" required>

                <label class="block mt-4 font-semibold">Kiekis:</label>
                <input type="number" name="quantity" class="border rounded px-3 py-2 w-full" required>

                <label class="block mt-4 font-semibold">Aprašymas:</label>
                <textarea name="description" class="border rounded px-3 py-2 w-full" rows="3" required></textarea>

                <label class="block mt-4 font-semibold">Kategorija:</label>
                <select name="category_id" class="border rounded px-3 py-2 w-full" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>

                <div class="mt-6 flex justify-between">
                    <button type="submit" class="form-button">Pridėti</button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>