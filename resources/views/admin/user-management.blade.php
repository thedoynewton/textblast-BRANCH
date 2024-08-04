@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="container mx-auto">
    <div class="bg-white p-6 rounded-lg shadow-md">

        <h2 class="text-2xl font-bold mb-4">Add New User</h2>
        {{-- @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
    </div>
    @endif --}}
    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Add New User Design : Zai -->
    <form action="{{ route('admin.add-user') }}" method="POST" class="mb-10">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Full Name Field -->
            <div class="relative">
                <label for="name" class="absolute top-0 left-0 text-sm font-normal text-black">Full Name</label>
                <input type="text" name="name" id="name" class="mt-6 w-full h-10 rounded-[5px] border border-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <p class="absolute top-[87px] left-0 text-sm font-normal text-[#23282e] opacity-30">
                    Please make sure when you enter your full name, it is the same name displayed in your USeP Email.<br /> <br />
                    Example: Juan DELA CRUZ.
                </p>
            </div>

            <!-- Email Field -->
            <div class="relative">
                <label for="email" class="absolute top-0 left-0 text-sm font-normal text-black">Email</label>
                <input type="email" name="email" id="email" class="mt-6 w-full h-10 rounded-[5px] border border-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" pattern="[a-zA-Z0-9._%+-]+@usep\.edu\.ph$" title="Must be a @usep.edu.ph email">
                <p class="absolute top-[87px] left-0 text-sm font-normal text-[#23282e] opacity-30">
                    USeP emails are the only emails accepted in the system.
                </p>
            </div>
        </div>

        <!-- Buttons for Form Actions -->
        <div class="flex justify-end mt-[6.5rem] space-x-4">
            <button type="reset" class="w-[114px] h-10 bg-[#db3131] text-white text-sm font-semibold rounded-[5px] shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                Clear Fields
            </button>
            <button type="submit" class="w-[114px] h-10 bg-[#3c82f6] text-white text-sm font-semibold rounded-[5px] shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                Add User
            </button>
        </div>
    </form>

    <h1 class="text-2xl font-bold mb-6">List of Users</h1>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Name</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Role</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                <td class="py-2 px-4 border-b">{{ $user->role }}</td>
                <td class="py-2 px-4 border-b">
                    <form action="{{ route('admin.change-role', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <select name="role" class="border rounded p-1">
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="subadmin" {{ $user->role == 'subadmin' ? 'selected' : '' }}>Subadmin</option>
                        </select>
                        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">Change Role</button>
                    </form>
                    <form action="{{ route('admin.remove-access', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Remove Access</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection