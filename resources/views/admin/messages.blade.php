@extends('layouts.admin')

@section('title', 'Broadcast Messages')

@section('content')
<!-- Display Success or Error Messages -->
@if (session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
    {{ session('error') }}
</div>
@endif

<div class="bg-white p-6 rounded-lg shadow-md">
    <!-- Broadcasting Form -->
    <form action="{{ route('admin.reviewMessage') }}" method="POST">
        @csrf

        <!-- Broadcast Type Selection as Tabs -->
        <div class="mb-4">
            <div class="flex border-b border-gray-300">
                <button type="button" class="tab-button px-4 py-2 text-sm font-medium focus:outline-none"
                    data-value="all">ALL</button>
                <button type="button" class="tab-button px-4 py-2 text-sm font-medium focus:outline-none"
                    data-value="students">STUDENTS</button>
                <button type="button" class="tab-button px-4 py-2 text-sm font-medium focus:outline-none"
                    data-value="employees">EMPLOYEES</button>
            </div>
            <input type="hidden" name="broadcast_type" id="broadcast_type"
                value="{{ request('broadcast_type', 'all') }}">
        </div>

        <!-- Filters Container -->
        <div class="mb-4">
            <div class="flex space-x-4 mb-4">
                <!-- Campus Selection (Always Visible) -->
                <div class="flex-grow" id="campus_filter">
                    <label for="campus" class="block text-sm font-medium text-gray-700">Campus</label>
                    <select name="campus" id="campus" class="block mt-1 border border-gray-300 rounded-md shadow-sm p-2" style="width: 13rem;">
                        <option value="" disabled selected>Select Campus</option>
                        <option value="all">All Campuses</option>
                        @foreach ($campuses as $campus)
                        <option value="{{ $campus->campus_id }}">{{ $campus->campus_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Student-specific Filters -->
                <div id="student_filters" class="flex space-x-4 w-full" style="display: none;">
                    <div class="flex-grow">
                        <label for="college" class="block text-sm font-medium text-gray-700">College</label>
                        <select name="college" id="college" style="width: 21rem;"
                            class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2"
                            onchange="updateProgramDropdown()">
                            <option value="" disabled selected>Select College</option>
                            <option value="all">All Colleges</option>
                        </select>
                    </div>

                    <div class="flex-grow">
                        <label for="program" class="block text-sm font-medium text-gray-700">Academic Program</label>
                        <select name="program" id="program" style="width: 20rem;"
                            class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2">
                            <option value="" disabled selected>Select Program</option>
                            <option value="all">All Programs</option>
                        </select>
                    </div>

                    <div class="flex-grow">
                        <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                        <select name="year" id="year" style="width: 7.9rem;"
                            class="block mt-1 border border-gray-300 rounded-md shadow-sm p-2">
                            <option value="" disabled selected>Select Year</option>
                            <option value="all">All Year Levels</option>
                            @foreach ($years as $year)
                            <option value="{{ $year->year_id }}">{{ $year->year_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Employee-specific Filters -->
                <div id="employee_filters" class="flex space-x-4 w-full" style="display: none;">
                    <div class="flex-grow">
                        <label for="office" class="block text-sm font-medium text-gray-700">Office</label>
                        <select name="office" id="office" style="width: 21rem;"
                            class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2"
                            onchange="updateTypeDropdown()">
                            <option value="" disabled selected>Select Office</option>
                            <option value="all">All Offices</option>
                        </select>
                    </div>

                    <div class="flex-grow">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" style="width: 14rem;"
                            class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2"
                            onchange="updateTypeDropdown()">
                            <option value="" disabled selected>Select Status</option>
                            <option value="all">All Statuses</option>
                        </select>
                    </div>

                    <div class="flex-grow">
                        <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                        <select name="type" id="type" style="width: 14rem;"
                            class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2">
                            <option value="" disabled selected>Select Type</option>
                            <option value="all">All Types</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Message Template Selection -->
            <div class="flex-grow" style="width: 13rem;">
                <label for="template" class="block text-sm font-medium text-gray-700">Select Template</label>
                <select id="template" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="" disabled selected>Select a Template</option>
                    @foreach ($messageTemplates as $template)
                    <option value="{{ $template->content }}">{{ $template->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Message Input -->
        <div class="mb-4">
            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
            <textarea name="message" id="message" placeholder="Enter your message here ..." rows="4"
                class="block w-full mt-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 focus:ring-indigo-300 p-2 text-sm overflow-y-auto resize-none"
                style="height: 14rem">{{ request('message') }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Review Message</button>
        </div>
    </form>

    <!-- This loads the script in resources/js -->
    @vite('resources/js/app.js')
</div>
@endsection