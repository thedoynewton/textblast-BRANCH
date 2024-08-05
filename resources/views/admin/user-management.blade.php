@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white p-8 rounded-lg shadow-lg transition-all duration-300 hover:shadow-xl">

        <h2 class="text-2xl font-bold mb-6 text-center sm:text-left">Add New User</h2>

        {{-- @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif --}}
        <!-- Error Handling with Pop-up Message -->
        @if ($errors->any())
        <div x-data="{ open: true }" class="relative z-50">
            <!-- Background Overlay -->
            <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm transition-opacity ease-out duration-300" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

            <!-- Modal -->
            <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" class="fixed inset-0 flex items-center justify-center">
                <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-auto transition-transform duration-300 hover:scale-105">
                    <div class="flex justify-center items-center border-b pb-2 mb-4">
                        <h2 class="text-lg font-semibold text-red-600">Input Error</h2>
                    </div>
                    <ul class="text-red-700 text-center">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <div class="mt-6 text-center">
                        <button @click="open = false" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-transform duration-300 hover:scale-105">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Add New User Form -->
        <form action="{{ route('admin.add-user') }}" method="POST" class="mb-10">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Full Name Field -->
                <div class="relative">
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" id="name" class="mt-2 w-full h-10 pl-3 rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-colors duration-300 hover:border-indigo-500">
                    <p class="mt-2 text-xs text-gray-500">
                        Please make sure the name matches in USeP Email.<br />
                        Example: Juan DELA CRUZ.
                    </p>
                </div>

                <!-- Email Field -->
                <div class="relative">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="mt-2 w-full h-10 pl-3 rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-colors duration-300 hover:border-indigo-500" pattern="[a-zA-Z0-9._%+-]+@usep\.edu\.ph$" title="Must be a @usep.edu.ph email">
                    <p class="mt-2 text-xs text-gray-500">
                        Only USeP emails are accepted.
                    </p>
                </div>

            </div>

            <!-- Buttons for Form Actions -->
            <div class="flex flex-col sm:flex-row justify-end mt-8 space-y-4 sm:space-y-0 sm:space-x-4">
                <button type="reset" class="w-full p-2 sm:w-auto bg-red-500 text-white text-sm font-semibold rounded-md shadow-md py-2 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75 transition-transform duration-300 hover:scale-105">
                    Clear Fields
                </button>
                <button type="submit" class="w-full p-2 sm:w-auto bg-blue-500 text-white text-sm font-semibold rounded-md shadow-md py-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition-transform duration-300 hover:scale-105">
                    Add User
                </button>
            </div>
        </form>

        <!-- Search Form -->
        <form action="{{ route('admin.user-management') }}" method="GET" class="mb-6">
            <div class="flex items-center">
                <input type="text" name="search" id="search" placeholder="Search by name" class="w-full h-10 pl-3 pr-3 rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-colors duration-300 hover:border-indigo-500">
                <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition-transform duration-300 hover:scale-105">
                    Search
                </button>
            </div>
        </form>

        <!-- List of Users -->
        <h1 class="text-2xl font-bold mb-6 text-center sm:text-left">List of Users</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded-md overflow-hidden shadow-sm transition-shadow duration-300 hover:shadow-md">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-2 px-4 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="py-2 px-4 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="py-2 px-4 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="py-2 px-4 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-100 transition-colors duration-300">
                        <td class="py-2 px-4 text-xs text-gray-700">{{ $user->name }}</td>
                        <td class="py-2 px-4 text-xs text-gray-700">{{ $user->email }}</td>
                        <td class="py-2 px-4 text-xs text-gray-700">{{ $user->role }}</td>
                        <td class="py-2 px-4 text-xs text-gray-700">
                            <form action="{{ route('admin.change-role', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <select name="role" class="border rounded p-1 text-xs transition-colors duration-300 hover:border-indigo-500">
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="subadmin" {{ $user->role == 'subadmin' ? 'selected' : '' }}>Subadmin</option>
                                </select>
                                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded text-xs hover:bg-blue-600 focus:outline-none transition-transform duration-300 hover:scale-105">Change Role</button>
                            </form>
                            <form action="{{ route('admin.remove-access', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600 focus:outline-none transition-transform duration-300 hover:scale-105">Remove Access</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- For Pop-up Message -->
<script src="//unpkg.com/alpinejs" defer></script>

@endsection