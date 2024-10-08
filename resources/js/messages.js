// Directly embedded JavaScript
document.addEventListener('DOMContentLoaded', function () {
    // Initialize filters on page load
    toggleFilters();

        // Retrieve the primary color from CSS variables
        const primaryColor = getComputedStyle(document.documentElement).getPropertyValue('--primary-color').trim();

    // Highlight the "ALL" tab by default
    const allTabButton = document.querySelector('.tab-button[data-value="all"]');
    allTabButton.classList.add('border-b-2');
    allTabButton.style.borderColor = primaryColor;  // Apply the primary color
    allTabButton.style.color = primaryColor;        // Set text color to primary color

    // Add event listeners to the tab buttons
    document.querySelectorAll('.tab-button').forEach(function (button) {
        button.addEventListener('click', function () {
            // Update the hidden broadcast_type input based on the clicked tab
            document.getElementById('broadcast_type').value = this.getAttribute('data-value');

            // Highlight the active tab and remove highlight from others
            document.querySelectorAll('.tab-button').forEach(function (btn) {
                btn.classList.remove('border-b-2');
                btn.style.borderColor = '';  // Remove the inline border color style
                btn.style.color = '';        // Remove the inline text color style
            });
            this.classList.add('border-b-2');
            this.style.borderColor = primaryColor;  // Apply the primary color
            this.style.color = primaryColor;        // Set text color to primary color

            // Reset the Campus dropdown to its default placeholder
            resetCampusDropdown();

            // Toggle the filters based on the selected tab
            toggleFilters();

            // Update the recipient count
            updateRecipientCount();
        });
    });

    // Add event listeners for dropdown changes
    document.getElementById('campus').addEventListener('change', updateDependentFilters);
    document.getElementById('office').addEventListener('change', updateTypeDropdown);
    document.getElementById('status').addEventListener('change', updateTypeDropdown);
    document.getElementById('college').addEventListener('change', updateProgramDropdown);
    document.getElementById('program').addEventListener('change', updateMajorDropdown);

    // Event listeners for all dropdowns
    document.getElementById('campus').addEventListener('change', updateRecipientCount);
    document.getElementById('college').addEventListener('change', updateRecipientCount);
    document.getElementById('program').addEventListener('change', updateRecipientCount);
    document.getElementById('major').addEventListener('change', updateRecipientCount);
    document.getElementById('year').addEventListener('change', updateRecipientCount);
    document.getElementById('office').addEventListener('change', updateRecipientCount);
    document.getElementById('status').addEventListener('change', updateRecipientCount);
    document.getElementById('type').addEventListener('change', updateRecipientCount);

    // Add event listener for template selection
    document.getElementById('template').addEventListener('change', function () {
        const templateContent = this.value;
        document.getElementById('message').value = templateContent;
    });

    // Add event listener for schedule options
    const scheduleRadios = document.querySelectorAll('input[name="schedule"]');
    const scheduleOptions = document.getElementById('schedule-options');

    scheduleRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.value === 'scheduled') {
                scheduleOptions.style.display = 'block';
            } else {
                scheduleOptions.style.display = 'none';
            }
        });
    });

    // Initialize the recipient count on page load
    updateRecipientCount();

    // Polling for progress updates if a logId is present
    const logIdElement = document.getElementById('progress-container');
    if (logIdElement && logIdElement.dataset.logId) {
        const logId = logIdElement.dataset.logId;
        const pollInterval = 5000; // Poll every 5 seconds

        // Update the progress based on the current logId
        function updateProgress() {
            fetch(`/api/progress/${logId}`)
                .then(response => response.json())
                .then(data => {
                    const percentageSent = data.percentageSent;
                    document.getElementById('progress-label').textContent = `${percentageSent}% Sent`;
                    document.getElementById('progress-percent').textContent = `${percentageSent}%`;
                    document.getElementById('progress-bar').style.width = `${percentageSent}%`;

                    if (percentageSent < 100) {
                        setTimeout(updateProgress, pollInterval);
                    }
                })
                .catch(error => console.error('Error fetching progress:', error));
        }

        // Start polling
        updateProgress();
    }
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
    clearDropdownOptions('major');
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
        clearDropdownOptions('major');
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
    select.innerHTML = ''; // Clear current options

    if (selectId === 'college') {
        select.innerHTML = '<option value="" disabled selected>Select Academic Unit</option>';
        select.innerHTML += '<option value="all">All Academic Unit</option>';
    } else if (selectId === 'major') {
        select.innerHTML = '<option value="" disabled selected>Select Major</option>';
        select.innerHTML += '<option value="all">All Majors</option>';
    } else {
        select.innerHTML = '<option value="" disabled selected>Select ' + selectId.charAt(0).toUpperCase() + selectId.slice(1) + '</option>';
        select.innerHTML += '<option value="all">All ' + selectId.charAt(0).toUpperCase() + selectId.slice(1) + '</option>';
    }
}

function updateProgramDropdown() {
    var collegeId = document.getElementById('college').value;

    clearDropdownOptions('program');
    clearDropdownOptions('major'); // Clear majors when college or program changes

    if (collegeId === 'all') {
        return;
    }

    if (collegeId) {
        // Make an AJAX request to get the dependent programs based on the selected college
        fetch(`/api/filters/college/${collegeId}/programs`)
            .then(response => response.json())
            .then(data => {
                updateSelectOptions('program', data.programs);
            });
    }
}

// Update major dropdown based on selected program
function updateMajorDropdown() {
    var programId = document.getElementById('program').value;

    // Reset the major dropdown
    clearDropdownOptions('major');

    if (programId === 'all') {
        return;
    }

    if (programId) {
        // Make an AJAX request to get the dependent majors based on the selected program
        fetch(`/api/filters/program/${programId}/majors`)
            .then(response => response.json())
            .then(data => {
                updateSelectOptions('major', data.majors);
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

function updateRecipientCount() {
    const broadcastType = document.getElementById('broadcast_type').value;
    const campusId = document.getElementById('campus').value;
    const collegeId = document.getElementById('college') ? document.getElementById('college').value : null;
    const programId = document.getElementById('program') ? document.getElementById('program').value : null;
    const majorId = document.getElementById('major') ? document.getElementById('major').value : null;
    const yearId = document.getElementById('year') ? document.getElementById('year').value : null;
    const officeId = document.getElementById('office') ? document.getElementById('office').value : null;
    const statusId = document.getElementById('status') ? document.getElementById('status').value : null;
    const typeId = document.getElementById('type') ? document.getElementById('type').value : null;

    // Set default total recipients to 0
    document.getElementById('total_recipients').value = '0';

    fetch(
        `/api/recipients/count?broadcast_type=${broadcastType}&campus_id=${campusId}&college_id=${collegeId}&program_id=${programId}&major_id=${majorId}&year_id=${yearId}&office_id=${officeId}&status_id=${statusId}&type_id=${typeId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('total_recipients').value = data.total;
        })
        .catch(error => {
            console.error('Error fetching recipient count:', error);
            document.getElementById('total_recipients').value = 'Error';
        });
}   