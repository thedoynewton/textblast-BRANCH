@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
    <div class="bg-white p-6 rounded-lg shadow-md">

        <!-- Warning Message -->
        @if($lowBalance)
        <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
            <h2 class="text-xl font-bold">Warning: Low SMS Balance</h2>
            <p>Your SMS balance is running low. Please recharge to avoid service interruption.</p>
        </div>
        @endif

        <!-- Filters for Start Date, End Date, and Campus -->
        <div class="flex space-x-4 mb-4">
            <div>
                <label for="start-date" class="block text-sm font-medium">Start Date</label>
                <input type="date" id="start-date" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div>
                <label for="end-date" class="block text-sm font-medium">End Date</label>
                <input type="date" id="end-date" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div>
                <label for="campus-filter" class="block text-sm font-medium">Campus</label>
                <select id="campus-filter" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="" selected>All Campuses</option>
                    @foreach ($campuses as $campus)
                    <option value="{{ $campus->campus_id }}">{{ $campus->campus_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="recipient-type" class="block text-sm font-medium">Recipient Type</label>
                <select id="recipient-type" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="all" selected>All Recipients</option>
                    <option value="students">Students</option>
                    <option value="employees">Employees</option>
                </select>
            </div>

            <!-- Add the Apply Filters button -->
            <div class="flex items-end">
                <button id="apply-filters" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md">
                    Apply Filters
                </button>
            </div>
        </div>

        <!-- Student Filters: College, Academic Program, Major, Year -->
        <div id="student-filters" class="flex space-x-4 mb-4 hidden">
            <div>
                <label for="college-filter" class="block text-sm font-medium">College</label>
                <select id="college-filter" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="all" selected>All Colleges</option>
                    @foreach ($colleges as $college)
                    <option value="{{ $college->college_id }}">{{ $college->college_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="program-filter" class="block text-sm font-medium">Academic Program</label>
                <select id="program-filter" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="all" selected>All Programs</option>
                    @foreach ($programs as $program)
                    <option value="{{ $program->program_id }}">{{ $program->program_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="major-filter" class="block text-sm font-medium">Major</label>
                <select id="major-filter" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="all" selected>All Majors</option>
                    @foreach ($majors as $major)
                    <option value="{{ $major->major_id }}">{{ $major->major_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="year-filter" class="block text-sm font-medium">Year</label>
                <select id="year-filter" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="all" selected>All Years</option>
                    @foreach ($years as $year)
                    <option value="{{ $year->year_id }}">{{ $year->year_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Employee Filters: Office, Status, Type -->
        <div id="employee-filters" class="flex space-x-4 mb-4 hidden">
            <div>
                <label for="office-filter" class="block text-sm font-medium">Office</label>
                <select id="office-filter" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="all" selected>All Offices</option>
                    @foreach ($offices as $office)
                    <option value="{{ $office->office_id }}">{{ $office->office_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="status-filter" class="block text-sm font-medium">Status</label>
                <select id="status-filter" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="all" selected>All Statuses</option>
                    @foreach ($statuses as $status)
                    <option value="{{ $status->status_id }}">{{ $status->status_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="type-filter" class="block text-sm font-medium">Type</label>
                <select id="type-filter" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="all" selected>All Types</option>
                    @foreach ($types as $type)
                    <option value="{{ $type->type_id }}">{{ $type->type_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Chart Container -->
        <div class="mb-8">
            <canvas id="messagesChart" width="400" height="200"></canvas>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@vite(['resources/js/analytics.js'])
@endsection