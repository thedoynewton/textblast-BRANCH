@extends('layouts.admin')

@section('title', 'App Management')

@section('content')
    <div class="container mx-auto p-4">
        <div class="bg-white p-8 rounded-lg shadow-lg">

            <!-- Tabs -->
            <div class="mb-6">
                <ul class="flex border-b border-gray-200">
                    <li class="mr-2">
                        <a href="#students" class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out" onclick="openTab(event, 'students')">Students</a>
                    </li>
                    <li class="mr-2">
                        <a href="#campus" class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out" onclick="openTab(event, 'campus')">Campus</a>
                    </li>
                    <li class="mr-2">
                        <a href="#college" class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out" onclick="openTab(event, 'college')">College</a>
                    </li>
                    <li class="mr-2">
                        <a href="#program" class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out" onclick="openTab(event, 'program')">Program</a>
                    </li>
                    <li class="mr-2">
                        <a href="#major" class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out" onclick="openTab(event, 'major')">Major</a>
                    </li>
                    <li class="mr-2">
                        <a href="#year" class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out" onclick="openTab(event, 'year')">Year</a>
                    </li>
                </ul>
            </div>

            <!-- Students Table -->
            <div id="students" class="tab-content">
                <button type="button" class="mb-4 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">Import Students Database</button>
                <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">First Name</th>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">Last Name</th>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">Middle Name</th>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">Contact</th>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">Email</th>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">Enrollment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $student->stud_fname }}</td>
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $student->stud_lname }}</td>
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $student->stud_mname }}</td>
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $student->stud_contact }}</td>
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $student->stud_email }}</td>
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $student->enrollment_stat }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Campus Table -->
            <div id="campus" class="tab-content hidden">
                <button type="button" class="mb-4 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">Import Campus Database</button>
                <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">Campus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $student->campus->campus_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- College Table -->
            <div id="college" class="tab-content hidden">
                <button type="button" class="mb-4 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">Import College Database</button>
                <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">College</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $student->college->college_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Program Table -->
            <div id="program" class="tab-content hidden">
                <button type="button" class="mb-4 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">Import Program Database</button>
                <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">Program</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $student->program->program_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Major Table -->
            <div id="major" class="tab-content hidden">
                <button type="button" class="mb-4 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">Import Major Database</button>
                <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">Major</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $student->major->major_name ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Year Table -->
            <div id="year" class="tab-content hidden">
                <button type="button" class="mb-4 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">Import Year Database</button>
                <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">Year</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $student->year->year_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- New Tab Area for Employees -->
        <div class="bg-white p-8 rounded-lg shadow-lg mt-10">
            <!-- Tabs -->
            <div class="mb-6">
                <ul class="flex border-b border-gray-200">
                    <li class="mr-2">
                        <a href="#employees" class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out" onclick="openTab(event, 'employees')">Employees</a>
                    </li>
                    <li class="mr-2">
                        <a href="#office" class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out" onclick="openTab(event, 'office')">Office</a>
                    </li>
                    <li class="mr-2">
                        <a href="#status" class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out" onclick="openTab(event, 'status')">Status</a>
                    </li>
                    <li class="mr-2">
                        <a href="#type" class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out" onclick="openTab(event, 'type')">Type</a>
                    </li>
                </ul>
            </div>

            <!-- Employees Table -->
            <div id="employees" class="tab-content">
                <button type="button" class="mb-4 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Import Employees Database</button>
                <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">First Name</th>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">Last Name</th>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">Middle Name</th>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">Contact</th>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">Email</th>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">Campus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $employee->emp_fname }}</td>
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $employee->emp_lname }}</td>
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $employee->emp_mname }}</td>
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $employee->emp_contact }}</td>
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $employee->emp_email }}</td>
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $employee->campus->campus_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Office Table -->
            <div id="office" class="tab-content hidden">
                <button type="button" class="mb-4 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Import Office Database</button>
                <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">Office</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $employee->office->office_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Status Table -->
            <div id="status" class="tab-content hidden">
                <button type="button" class="mb-4 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Import Status Database</button>
                <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $employee->status->status_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Type Table -->
            <div id="type" class="tab-content hidden">
                <button type="button" class="mb-4 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Import Type Database</button>
                <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 border-b font-medium text-gray-700">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <td class="py-3 px-4 border-b text-gray-600">{{ $employee->type->type_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.add("hidden");
            }
            evt.currentTarget.classList.remove("text-gray-500");
            evt.currentTarget.classList.add("border-blue-500");
            document.getElementById(tabName).classList.remove("hidden");
            evt.currentTarget.className += " border-blue-500";
        }
    </script>
@endsection
