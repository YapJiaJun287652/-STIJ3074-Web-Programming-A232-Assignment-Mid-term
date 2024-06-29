// Function to validate the login form
function validateLoginForm() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if (username === '' || password === '') {
        document.getElementById('loginMessage').textContent = 'All fields are required.';
        return false;
    }

    return true;
}

// Function to validate the registration form
function validateRegistrationForm() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const phone = document.getElementById('phone').value;
    const address = document.getElementById('address').value;

    if (name === '' || email === '' || password === '' || phone === '' || address === '') {
        document.getElementById('registrationMessage').textContent = 'All fields are required.';
        return false;
    }

    return true;
}

// Function to fetch and display service details in a modal
function showServiceDetails(serviceId) {
    fetch(`get_service.php?service_id=${serviceId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalServiceName').textContent = data.service_name;
            document.getElementById('modalServiceDescription').textContent = data.service_description;
            document.getElementById('modalServicePrice').textContent = `Price: RM${data.service_price}`;
            $('#serviceModal').modal('show'); // Using jQuery to show Bootstrap modal
        })
        .catch(error => console.error('Error:', error));
}

// Function to hide the parent card when close button is clicked
function hideCard(button) {
    const card = button.closest('.card');
    card.style.display = 'none';
}
