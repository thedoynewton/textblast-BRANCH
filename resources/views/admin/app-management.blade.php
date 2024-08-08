@extends('layouts.admin')

@section('title', 'App Management')

@section('content')
    <div class="container mx-auto p-4">
        <!-- Main Menu -->
        <div class="bg-white p-4 rounded-lg shadow-md mb-10">
            <ul class="flex justify-center space-x-8">
                <li>
                    <a href="#students-section"
                        class="text-gray-600 hover:text-white bg-gray-100 hover:bg-blue-600 font-semibold transition duration-300 ease-in-out px-4 py-2 rounded-md"
                        onclick="openSection('students-section')">Student Information</a>
                </li>
                <li>
                    <a href="#campus-section"
                        class="text-gray-600 hover:text-white bg-gray-100 hover:bg-blue-600 font-semibold transition duration-300 ease-in-out px-4 py-2 rounded-md"
                        onclick="openSection('campus-section')">Campus Information</a>
                </li>
                <li>
                    <a href="#employees-section"
                        class="text-gray-600 hover:text-white bg-gray-100 hover:bg-blue-600 font-semibold transition duration-300 ease-in-out px-4 py-2 rounded-md"
                        onclick="openSection('employees-section')">Employee Information</a>
                </li>
            </ul>
        </div>

        <!-- Students Information Section -->
        <div id="students-section" class="section-content">
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold mb-6">Students Information</h2>

                <!-- Campus Filter Dropdown -->
                <div class="mb-6">
                    <label for="studentsCampusFilter" class="block text-gray-700 font-medium mb-2">Select Campus</label>
                    <select id="studentsCampusFilter" class="border p-2 rounded w-full" onchange="filterByCampus('studentsTable', 'studentsCampusFilter')">
                        <option value="">All Campuses</option>
                        @foreach ($campuses as $campus)
                            <option value="{{ $campus->campus_name }}">{{ $campus->campus_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tabs for Students -->
                <div class="mb-6">
                    <ul class="flex border-b border-gray-200">
                        <li class="mr-2">
                            <a href="#students"
                                class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out"
                                onclick="openTab(event, 'students')">Students</a>
                        </li>
                        <li class="mr-2">
                            <a href="#college"
                                class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out"
                                onclick="openTab(event, 'college')">College</a>
                        </li>
                        <li class="mr-2">
                            <a href="#program"
                                class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out"
                                onclick="openTab(event, 'program')">Program</a>
                        </li>
                        <li class="mr-2">
                            <a href="#major"
                                class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out"
                                onclick="openTab(event, 'major')">Major</a>
                        </li>
                        <li class="mr-2">
                            <a href="#year"
                                class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out"
                                onclick="openTab(event, 'year')">Year</a>
                        </li>
                    </ul>
                </div>

                <!-- Students Table -->
                <div id="students" class="tab-content">
                    <div class="mb-4">
                        <input type="text" id="studentsSearch" onkeyup="searchTable('studentsSearch', 'studentsTable')" placeholder="Search for students.." class="border p-2 rounded w-full">
                    </div>
                    <button type="button"
                        class="mb-4 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">Import
                        Students Database</button>
                    <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                        <table id="studentsTable" class="min-w-full bg-white border border-gray-300 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">First Name</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">Last Name</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">Middle Name</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">Contact</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">Email</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">Enrollment Status</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700 hidden">Campus</th> <!-- Hidden column for filtering -->
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
                                        <td class="py-3 px-4 border-b text-gray-600 hidden">{{ $student->campus->campus_name }}</td> <!-- Hidden campus column -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- College Table -->
                <div id="college" class="tab-content hidden">
                    <div class="mb-4">
                        <input type="text" id="collegeSearch" onkeyup="searchTable('collegeSearch', 'collegeTable')" placeholder="Search for colleges.." class="border p-2 rounded w-full">
                    </div>
                    <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                        <table id="collegeTable" class="min-w-full bg-white border border-gray-300 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">College</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700 hidden">Campus</th> <!-- Hidden column for filtering -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                        <td class="py-3 px-4 border-b text-gray-600">{{ $student->college->college_name }}</td>
                                        <td class="py-3 px-4 border-b text-gray-600 hidden">{{ $student->campus->campus_name }}</td> <!-- Hidden campus column -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Program Table -->
                <div id="program" class="tab-content hidden">
                    <div class="mb-4">
                        <input type="text" id="programSearch" onkeyup="searchTable('programSearch', 'programTable')" placeholder="Search for programs.." class="border p-2 rounded w-full">
                    </div>
                    <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                        <table id="programTable" class="min-w-full bg-white border border-gray-300 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">Program</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700 hidden">Campus</th> <!-- Hidden column for filtering -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                        <td class="py-3 px-4 border-b text-gray-600">{{ $student->program->program_name }}</td>
                                        <td class="py-3 px-4 border-b text-gray-600 hidden">{{ $student->campus->campus_name }}</td> <!-- Hidden campus column -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Major Table -->
                <div id="major" class="tab-content hidden">
                    <div class="mb-4">
                        <input type="text" id="majorSearch" onkeyup="searchTable('majorSearch', 'majorTable')" placeholder="Search for majors.." class="border p-2 rounded w-full">
                    </div>
                    <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                        <table id="majorTable" class="min-w-full bg-white border border-gray-300 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">Major</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700 hidden">Campus</th> <!-- Hidden column for filtering -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                        <td class="py-3 px-4 border-b text-gray-600">{{ $student->major->major_name ?? 'N/A' }}</td>
                                        <td class="py-3 px-4 border-b text-gray-600 hidden">{{ $student->campus->campus_name }}</td> <!-- Hidden campus column -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Year Table -->
                <div id="year" class="tab-content hidden">
                    <div class="mb-4">
                        <input type="text" id="yearSearch" onkeyup="searchTable('yearSearch', 'yearTable')" placeholder="Search for years.." class="border p-2 rounded w-full">
                    </div>
                    <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                        <table id="yearTable" class="min-w-full bg-white border border-gray-300 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">Year</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700 hidden">Campus</th> <!-- Hidden column for filtering -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                        <td class="py-3 px-4 border-b text-gray-600">{{ $student->year->year_name }}</td>
                                        <td class="py-3 px-4 border-b text-gray-600 hidden">{{ $student->campus->campus_name }}</td> <!-- Hidden campus column -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Campus Information Section -->
        <div id="campus-section" class="section-content hidden">
            <div class="bg-white p-8 rounded-lg shadow-lg mt-10">
                <h2 class="text-xl font-bold mb-6">Campus Information</h2>

                <!-- Tabs -->
                <div class="mb-6">
                    <ul class="flex border-b border-gray-200">
                        <li class="mr-2">
                            <a href="#campus-students"
                                class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out"
                                onclick="openTab(event, 'campus-students')">Campus for Students</a>
                        </li>
                        <li class="mr-2">
                            <a href="#campus-employees"
                                class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out"
                                onclick="openTab(event, 'campus-employees')">Campus for Employees</a>
                        </li>
                    </ul>
                </div>

                <!-- Campus Table for Students -->
                <div id="campus-students" class="tab-content">
                    <div class="mb-4">
                        <input type="text" id="campusStudentsSearch" onkeyup="searchTable('campusStudentsSearch', 'campusStudentsTable')" placeholder="Search for campuses.." class="border p-2 rounded w-full">
                    </div>
                    <button type="button"
                        class="mb-4 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">Import
                        Campus Database</button>
                    <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                        <table id="campusStudentsTable" class="min-w-full bg-white border border-gray-300 rounded-lg">
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

                <!-- Campus Table for Employees -->
                <div id="campus-employees" class="tab-content hidden">
                    <div class="mb-4">
                        <input type="text" id="campusEmployeesSearch" onkeyup="searchTable('campusEmployeesSearch', 'campusEmployeesTable')" placeholder="Search for campuses.." class="border p-2 rounded w-full">
                    </div>
                    <button type="button"
                        class="mb-4 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Import
                        Campus Database</button>
                    <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                        <table id="campusEmployeesTable" class="min-w-full bg-white border border-gray-300 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">Campus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                        <td class="py-3 px-4 border-b text-gray-600">{{ $employee->campus->campus_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Employees Information Section -->
        <div id="employees-section" class="section-content hidden">
            <div class="bg-white p-8 rounded-lg shadow-lg mt-10">
                <h2 class="text-xl font-bold mb-6">Employees Information</h2>

                <!-- Campus Filter Dropdown -->
                <div class="mb-6">
                    <label for="employeesCampusFilter" class="block text-gray-700 font-medium mb-2">Select Campus</label>
                    <select id="employeesCampusFilter" class="border p-2 rounded w-full" onchange="filterByCampus('employeesTable', 'employeesCampusFilter')">
                        <option value="">All Campuses</option>
                        @foreach ($campuses as $campus)
                            <option value="{{ $campus->campus_name }}">{{ $campus->campus_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tabs for Employees -->
                <div class="mb-6">
                    <ul class="flex border-b border-gray-200">
                        <li class="mr-2">
                            <a href="#employees"
                                class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out"
                                onclick="openTab(event, 'employees')">Employees</a>
                        </li>
                        <li class="mr-2">
                            <a href="#office"
                                class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out"
                                onclick="openTab(event, 'office')">Office</a>
                        </li>
                        <li class="mr-2">
                            <a href="#status"
                                class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out"
                                onclick="openTab(event, 'status')">Status</a>
                        </li>
                        <li class="mr-2">
                            <a href="#type"
                                class="bg-white inline-block py-2 px-6 text-gray-500 hover:bg-gray-100 font-semibold transition duration-200 ease-in-out"
                                onclick="openTab(event, 'type')">Type</a>
                        </li>
                    </ul>
                </div>

                <!-- Employees Table -->
                <div id="employees" class="tab-content">
                    <div class="mb-4">
                        <input type="text" id="employeesSearch" onkeyup="searchTable('employeesSearch', 'employeesTable')" placeholder="Search for employees.." class="border p-2 rounded w-full">
                    </div>
                    <button type="button"
                        class="mb-4 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Import
                        Employees Database</button>
                    <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                        <table id="employeesTable" class="min-w-full bg-white border border-gray-300 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">First Name</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">Last Name</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">Middle Name</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">Contact</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">Email</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700 hidden">Campus</th> <!-- Hidden column for filtering -->
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
                                        <td class="py-3 px-4 border-b text-gray-600 hidden">{{ $employee->campus->campus_name }}</td> <!-- Hidden campus column -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Office Table -->
                <div id="office" class="tab-content hidden">
                    <div class="mb-4">
                        <input type="text" id="officeSearch" onkeyup="searchTable('officeSearch', 'officeTable')" placeholder="Search for offices.." class="border p-2 rounded w-full">
                    </div>
                    <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                        <table id="officeTable" class="min-w-full bg-white border border-gray-300 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">Office</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700 hidden">Campus</th> <!-- Hidden column for filtering -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                        <td class="py-3 px-4 border-b text-gray-600">{{ $employee->office->office_name }}</td>
                                        <td class="py-3 px-4 border-b text-gray-600 hidden">{{ $employee->campus->campus_name }}</td> <!-- Hidden campus column -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Status Table -->
                <div id="status" class="tab-content hidden">
                    <div class="mb-4">
                        <input type="text" id="statusSearch" onkeyup="searchTable('statusSearch', 'statusTable')" placeholder="Search for statuses.." class="border p-2 rounded w-full">
                    </div>
                    <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                        <table id="statusTable" class="min-w-full bg-white border border-gray-300 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">Status</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700 hidden">Campus</th> <!-- Hidden column for filtering -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                        <td class="py-3 px-4 border-b text-gray-600">{{ $employee->status->status_name }}</td>
                                        <td class="py-3 px-4 border-b text-gray-600 hidden">{{ $employee->campus->campus_name }}</td> <!-- Hidden campus column -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Type Table -->
                <div id="type" class="tab-content hidden">
                    <div class="mb-4">
                        <input type="text" id="typeSearch" onkeyup="searchTable('typeSearch', 'typeTable')" placeholder="Search for types.." class="border p-2 rounded w-full">
                    </div>
                    <div class="overflow-x-auto overflow-y-auto max-h-96 mb-8">
                        <table id="typeTable" class="min-w-full bg-white border border-gray-300 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700">Type</th>
                                    <th class="py-3 px-4 border-b font-medium text-gray-700 hidden">Campus</th> <!-- Hidden column for filtering -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                        <td class="py-3 px-4 border-b text-gray-600">{{ $employee->type->type_name }}</td>
                                        <td class="py-3 px-4 border-b text-gray-600 hidden">{{ $employee->campus->campus_name }}</td> <!-- Hidden campus column -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script -->
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

            function openSection(sectionId) {
                var sections = document.getElementsByClassName("section-content");
                for (var i = 0; i < sections.length; i++) {
                    sections[i].classList.add("hidden");
                }
                document.getElementById(sectionId).classList.remove("hidden");
            }

            function searchTable(inputId, tableId) {
                var input, filter, table, tr, td, i, j, txtValue;
                input = document.getElementById(inputId);
                filter = input.value.toUpperCase();
                table = document.getElementById(tableId);
                tr = table.getElementsByTagName("tr");

                for (i = 1; i < tr.length; i++) {
                    tr[i].style.display = "none"; // Hide all rows initially
                    td = tr[i].getElementsByTagName("td");
                    for (j = 0; j < td.length; j++) {
                        if (td[j]) {
                            txtValue = td[j].textContent || td[j].innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = ""; // Show the row if match is found
                                break;
                            }
                        }
                    }
                }
            }

            function filterByCampus(tableId, filterId) {
                var table, tr, td, i, txtValue, campusFilter;
                table = document.getElementById(tableId);
                tr = table.getElementsByTagName("tr");
                campusFilter = document.getElementById(filterId).value.toUpperCase();

                for (i = 1; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[6]; // 6 is the index for the hidden campus column
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (campusFilter === "" || txtValue.toUpperCase() === campusFilter) {
                            tr[i].style.display = ""; // Show the row if match is found or no filter is applied
                        } else {
                            tr[i].style.display = "none"; // Hide the row if it doesn't match the filter
                        }
                    }
                }
            }

            // Automatically open the first section on page load
            document.addEventListener("DOMContentLoaded", function () {
                openSection('students-section');
            });
        </script>
@endsection
