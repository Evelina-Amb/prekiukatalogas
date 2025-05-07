<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 fixed top-0 left-0 right-0 z-50">
   <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Profilis') }}
                    </x-nav-link>
					<x-nav-link :href="route('katalogas')" :active="request()->routeIs('katalogas')">
                        {{ __('katalogas') }}
                    </x-nav-link>
                </div>
@if (request()->routeIs('katalogas'))	
<div class="space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
    <button 
        type="button" 
        onclick="toggleFilters()" 
        style="background-color: #1e40af; color: white; padding: 10px 20px; border-radius: 6px; font-weight: bold; cursor: pointer;">
        Filtrai
    </button>
</div>
<div id="filters-overlay" class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
    <form method="GET" action="{{ route('katalogas.pdf') }}">
        {{-- Retain all filters when submitting --}}
        @foreach(request()->all() as $key => $value)
            @if(is_array($value))
                @foreach($value as $item)
                    <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                @endforeach
            @else
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach

        <button type="submit"
            style="background-color: #1e40af; color: white; padding: 10px 20px; border-radius: 6px; font-weight: bold; cursor: pointer;">
            PDF
        </button>
    </form>
</div> 
<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
    <button 
        id="filter-toggle-button"
        type="button" 
        onclick="toggleAdd()" 
        style="background-color: #1e40af; color: white; padding: 10px 20px; border-radius: 6px; font-weight: bold; cursor: pointer;">
        Pridėti
    </button>
</div>@endif
</div>
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            @auth
							<div>{{ Auth::user()->name }}</div>
							@endauth
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @auth
    @if (Route::has('profile.edit'))
        <x-dropdown-link :href="route('profile.edit')">
            {{ __('Profile') }}
        </x-dropdown-link>
    @endif
@endauth
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
