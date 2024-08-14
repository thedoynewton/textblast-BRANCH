import './bootstrap';

// Directly embedded JavaScript
document.addEventListener('DOMContentLoaded', function () {
    // Initialize filters on page load
    toggleFilters();

    // Highlight the "ALL" tab by default
    const allTabButton = document.querySelector('.tab-button[data-value="all"]');
    allTabButton.classList.add('border-b-2', 'border-indigo-500', 'text-indigo-500');

    // Add event listeners to the tab buttons
    document.querySelectorAll('.tab-button').forEach(function (button) {
        button.addEventListener('click', function () {
            // Update the hidden broadcast_type input based on the clicked tab
            document.getElementById('broadcast_type').value = this.getAttribute(
                'data-value');

            // Highlight the active tab and remove highlight from others
            document.querySelectorAll('.tab-button').forEach(function (btn) {
                btn.classList.remove('border-b-2', 'border-indigo-500',
                    'text-indigo-500');
            });
            this.classList.add('border-b-2', 'border-indigo-500', 'text-indigo-500');

            // Reset the Campus dropdown to its default placeholder
            resetCampusDropdown();

            // Toggle the filters based on the selected tab
            toggleFilters();
        });
    });

    // Add event listeners for dropdown changes
    document.getElementById('campus').addEventListener('change', updateDependentFilters);
    document.getElementById('office').addEventListener('change', updateTypeDropdown);
    document.getElementById('status').addEventListener('change', updateTypeDropdown);
    document.getElementById('college').addEventListener('change', updateProgramDropdown);


    // Add event listener for template selection
    document.getElementById('template').addEventListener('change', function () {
        const templateContent = this.value;
        document.getElementById('message').value = templateContent;
    });
});

function toggleFilters() {
    var broadcastType = document.getElementById('broadcast_type').value;
    var studentFilters = document.getElementById('student_filters');
    var employeeFilters = document.getElementById('employee_filters');

    // Hide all filters initially
    studentFilters.style.display = 'none';
    employeeFilters.style.display = 'none';

    // Display the appropriate filters based on the broadcast type
    if (broadcastType === 'students') {
        studentFilters.style.display = 'flex';
    } else if (broadcastType === 'employees') {
        employeeFilters.style.display = 'flex';
    }

    // Clear dropdown values when switching tabs
    clearDropdownOptions('college');
    clearDropdownOptions('program');
    clearDropdownOptions('year');
    clearDropdownOptions('office');
    clearDropdownOptions('status');
    clearDropdownOptions('type');
}

function resetCampusDropdown() {
    var campusSelect = document.getElementById('campus');
    campusSelect.value = ''; // Reset to default "Select Campus"
}

function updateDependentFilters() {
    var campusId = document.getElementById('campus').value;
    var broadcastType = document.getElementById('broadcast_type').value;

    if (campusId === 'all') {
        // If "All Campuses" is chosen, clear all other dropdowns
        clearDropdownOptions('college');
        clearDropdownOptions('program');
        clearDropdownOptions('year');
        clearDropdownOptions('office');
        clearDropdownOptions('status');
        clearDropdownOptions('type');
        return;
    }

    if (!campusId) return;

    // Make an AJAX request to get the dependent filters based on the selected campus
    fetch(`/api/filters/${broadcastType}/${campusId}`)
        .then(response => response.json())
        .then(data => {
            if (broadcastType === 'students') {
                updateSelectOptions('college', data.colleges);
                updateSelectOptions('year', data.years); // Ensure years are always populated
            } else if (broadcastType === 'employees') {
                updateSelectOptions('office', data.offices);
                updateSelectOptions('status', data.statuses); // Populate statuses for employees
                updateSelectOptions('type', data.types); // Populate types for employees
            }
        });
}

function updateSelectOptions(selectId, options) {
    var select = document.getElementById(selectId);
    clearDropdownOptions(selectId);
    options.forEach(option => {
        var opt = document.createElement('option');
        opt.value = option.id;
        opt.textContent = option.name;
        select.appendChild(opt);
    });
}

function clearDropdownOptions(selectId) {
    var select = document.getElementById(selectId);
    select.innerHTML = '<option value="" disabled selected>Select ' + selectId.charAt(0).toUpperCase() + selectId
        .slice(1) + '</option>';
    select.innerHTML += '<option value="all">All ' + selectId.charAt(0).toUpperCase() + selectId.slice(1) +
        '</option>';
}

function updateProgramDropdown() {
    var collegeId = document.getElementById('college').value;
    console.log(`Selected collegeId: ${collegeId}`);

    // Reset the program dropdown
    clearDropdownOptions('program');

    if (collegeId === 'all') return;

    if (collegeId) {
        console.log(`Making fetch request to /api/filters/college/${collegeId}/programs`);
        fetch(`/api/filters/college/${collegeId}/programs`)
            .then(response => response.json())
            .then(data => {
                console.log("Received program data:", data);
                updateSelectOptions('program', data.programs);
            });
    }
}

function updateTypeDropdown() {
    var campusId = document.getElementById('campus').value;
    var officeId = document.getElementById('office').value;
    var statusId = document.getElementById('status').value;

    // Reset the type dropdown
    clearDropdownOptions('type');

    if (campusId && officeId) {
        // Make an AJAX request to get the dependent types based on the selected campus, office, and status
        fetch(`/api/filters/types/${campusId}/${officeId}/${statusId}`)
            .then(response => response.json())
            .then(data => {
                updateSelectOptions('type', data.types);
            });
    }
}