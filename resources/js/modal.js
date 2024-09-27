document.addEventListener('DOMContentLoaded', function () {
    // Handle "Read More" link click for both message templates and message logs
    document.querySelectorAll('[data-modal-target]').forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            // Get modal target and content data
            const modalId = this.getAttribute('data-modal-target');
            const title = this.getAttribute('data-template-name');
            const content = this.getAttribute('data-content');
            // Get the modal elements dynamically based on modalId
            const modal = document.querySelector(modalId);
            const modalTitle = modal.querySelector('#modal-title');
            const modalContent = modal.querySelector('#modal-message-content');
            // Populate modal content
            modalTitle.textContent = title;
            modalContent.textContent = content;
            // Show the correct modal
            modal.classList.remove('hidden');
        });
    });

    // Handle "Close" button click for both modals
    document.querySelectorAll('#close-modal').forEach(button => {
        button.addEventListener('click', function () {
            const modal = this.closest('.fixed');  // Find the closest modal element
            modal.classList.add('hidden');  // Hide the modal
        });
    });
});