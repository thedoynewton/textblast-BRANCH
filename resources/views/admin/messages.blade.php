@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-6">Broadcast Messages</h1>

    <form action="{{ route('admin.send-messages') }}" method="POST">
        @csrf

        <!-- Flexbox container for dropdowns -->
        <div class="flex space-x-4 mb-4">
            <div class="w-1/4">
                <label for="campus" class="block text-sm font-medium text-gray-700">Campus</label>
                <select name="campus" id="campus" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 focus:ring-indigo-300 p-2">
                    <option value="">All</option>
                    @foreach($campuses as $campus)
                    <option value="{{ $campus->campus_id }}">{{ $campus->campus_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-1/4">
                <label for="college" class="block text-sm font-medium text-gray-700">College</label>
                <select name="college" id="college" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 focus:ring-indigo-300 p-2">
                    <option value="">All</option>
                    @foreach($colleges as $college)
                    <option value="{{ $college->college_id }}">{{ $college->college_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-1/4">
                <label for="program" class="block text-sm font-medium text-gray-700">Program</label>
                <select name="program" id="program" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 focus:ring-indigo-300 p-2">
                    <option value="">All</option>
                    @foreach($programs as $program)
                    <option value="{{ $program->program_id }}">{{ $program->program_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-1/4">
                <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                <select name="year" id="year" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 focus:ring-indigo-300 p-2">
                    <option value="">All</option>
                    @foreach($years as $year)
                    <option value="{{ $year->year_id }}">{{ $year->year_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <!-- Input Message -->
        <div class="mb-4">
            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
            <textarea name="message" id="message" rows="4" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 focus:ring-indigo-300 p-2"></textarea>
        </div>


        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">Send</button>
    </form>
</div>
@endsection