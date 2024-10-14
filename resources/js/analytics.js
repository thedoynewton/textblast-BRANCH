document.addEventListener('DOMContentLoaded', function () {
    const applyFiltersButton = document.getElementById('apply-filters');
    const recipientTypeSelect = document.getElementById('recipient-type');
    const studentFilters = document.getElementById('student-filters');
    const employeeFilters = document.getElementById('employee-filters');

    // Function to toggle filters based on recipient type
    function toggleFilters() {
        const recipientType = recipientTypeSelect.value;
        if (recipientType === 'students') {
            studentFilters.classList.remove('hidden');
            employeeFilters.classList.add('hidden');
        } else if (recipientType === 'employees') {
            employeeFilters.classList.remove('hidden');
            studentFilters.classList.add('hidden');
        } else {
            studentFilters.classList.add('hidden');
            employeeFilters.classList.add('hidden');
        }
    }
    // Listen for changes on the recipient type filter
    recipientTypeSelect.addEventListener('change', toggleFilters);

    // Function to fetch and update the chart data
    function fetchChartData() {
        const startDate = document.getElementById('start-date').value;
        const endDate = document.getElementById('end-date').value;
        const campus = document.getElementById('campus-filter').value;
        const recipientType = recipientTypeSelect.value;
        // Get filters for students and employees
        const college = document.getElementById('college-filter').value;
        const program = document.getElementById('program-filter').value;
        const major = document.getElementById('major-filter').value;
        const year = document.getElementById('year-filter').value;
        const office = document.getElementById('office-filter').value;
        const status = document.getElementById('status-filter').value;
        const type = document.getElementById('type-filter').value;
        // Build the query string for filters
        let queryString = `start_date=${startDate}&end_date=${endDate}&campus=${campus}&recipient_type=${recipientType}`;
        if (recipientType === 'students') {
            queryString += `&college=${college}&program=${program}&major=${major}&year=${year}`;
        } else if (recipientType === 'employees') {
            queryString += `&office=${office}&status=${status}&type=${type}`;
        }

        // Make an AJAX request to get chart data
        fetch(`/api/analytics/messages?${queryString}`)
            .then(response => response.json())
            .then(data => {
                // Update chart data
                const messagesChart = new Chart(document.getElementById('messagesChart').getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [
                            {
                                label: 'Successful Messages',
                                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1,
                                data: data.success
                            },
                            {
                                label: 'Failed Messages',
                                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1,
                                data: data.failed
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                beginAtZero: true
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    // Apply filter on button click
    applyFiltersButton.addEventListener('click', fetchChartData);
    // Initial fetch when page loads
    fetchChartData();
});
