<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
 <!-- Success Message -->
                    @if (session('status'))
                        <div class="bg-green-100 text-green-800 p-4 rounded-md mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

<!-- Error Message (if there are validation errors) -->
                    @if ($errors->any())
                        <div class="bg-red-100 text-red-800 p-4 rounded-md mb-4">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">Atnaujinkite profilio informacija</h3>

                    <!-- User Info Update Form -->
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mt-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Vardas</label>
                            <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="mt-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="mt-6">
                         <button type="submit" style="background-color: #2563eb; color: white;" class="px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">Update Info</button>
						</div>
						<br>
                    </form>

                    <hr class="my-8">

                    <h3 class="text-lg font-semibold">Slaptažodžio keitimas</h3>

                    <!-- Password Change Form -->
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mt-4">
                            <label for="current_password" class="block text-sm font-medium text-gray-700">Dabartinis slaptažodis</label>
                            <input type="password" id="current_password" name="current_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mt-4">
                            <label for="new_password" class="block text-sm font-medium text-gray-700">Naujas slaptažodis</label>
                            <input type="password" id="new_password" name="new_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mt-4">
                            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Pakartokite nauja slaptažodi</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mt-6">
                            <button type="submit" style="background-color: #2563eb; color: white;" class="px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">Update Info</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
