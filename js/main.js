document.addEventListener('DOMContentLoaded', function () {
    const navToggle = document.querySelector('.nav-toggle');
    const navList = document.querySelector('.nav-list');

    navToggle.addEventListener('click', function () {
        navList.classList.toggle('show');
    });
});
// Function to validate password length
function validatePassword(password) {
    return password.length >= 8;
}

// Function to validate phone number format
function validatePhoneNumber(phoneNumber) {
    return /^\d{10}$/.test(phoneNumber);
}

// Function to validate email format
function validateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

// Function to validate username format
function validateUsername(username) {
    return /^[a-zA-Z0-9]{4,}$/.test(username);
}

// Function to toggle password visibility
function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}

function fetchSuggestions(inputId) {
    const input = document.getElementById(inputId);
    const inputValue = input.value.trim().toLowerCase();

    // Example: Suggestions for countries
    const countrySuggestions = ['India', 'United States', 'Canada', 'United Kingdom', 'Australia'];

    // Example: Suggestions for states in India
    const indiaStates = ['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal'];

    // Example: Suggestions for states in United States
    const usStates = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'];

    // Example: Suggestions for pin codes in India (assuming 6-digit pin codes)
    const indiaPinCodes = ['110001', '201301', '400001', '600001', '700001'];

    // Check the input value and provide suggestions accordingly
    let suggestions = [];
    if (inputValue.length >= 1) {
        if (inputId === 'reg-country') {
            suggestions = countrySuggestions.filter(country => country.toLowerCase().startsWith(inputValue));
        } else if (inputId === 'reg-state') {
            // Assuming only India and United States are selected countries
            const selectedCountry = document.getElementById('reg-country').value.trim().toLowerCase();
            if (selectedCountry === 'india') {
                suggestions = indiaStates.filter(state => state.toLowerCase().startsWith(inputValue));
            } else if (selectedCountry === 'united states') {
                suggestions = usStates.filter(state => state.toLowerCase().startsWith(inputValue));
            }
        } else if (inputId === 'reg-pincode') {
            // Assuming only India is selected country
            suggestions = indiaPinCodes.filter(pinCode => pinCode.startsWith(inputValue));
        }
    }

    // Display suggestions to the user (you can implement this part based on your UI requirements)
    console.log(suggestions);
}

// Event listener for password visibility toggle
document.getElementById('toggle-password-view').addEventListener('click', function() {
    togglePasswordVisibility('reg-password');
    togglePasswordVisibility('reg-confirm-password');
});

// Event listener for fetching suggestions on input change
document.getElementById('reg-country').addEventListener('input', function() {
    fetchSuggestions('reg-country');
});

// Event listener for form submission
document.getElementById('registration-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission for now

    // Fetch form inputs
    const username = document.getElementById('reg-username').value.trim();
    const password = document.getElementById('reg-password').value.trim();
    const confirmPassword = document.getElementById('reg-confirm-password').value.trim();
    const email = document.getElementById('reg-email').value.trim();
    const phoneNumber = document.getElementById('reg-phone').value.trim();
    const country = document.getElementById('reg-country').value.trim();
    const state = document.getElementById('reg-state').value.trim();
    const pincode = document.getElementById('reg-pincode').value.trim();

    // Validate inputs
    if (!validateUsername(username)) {
        alert('Invalid username. Username must contain at least 4 characters and only alphanumeric characters are allowed.');
        return;
    }

    if (!validatePassword(password)) {
        alert('Password must be at least 8 characters long.');
        return;
    }

    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return;
    }

    if (!validateEmail(email)) {
        alert('Invalid email format.');
        return;
    }

    if (!validatePhoneNumber(phoneNumber)) {
        alert('Invalid phone number format. Please enter a 10-digit phone number.');
        return;
    }

    // Perform further validations as needed

    // If all validations pass, you can proceed with form submission
    // For now, just log the form data
    console.log('Username:', username);
    console.log('Password:', password);
    console.log('Email:', email);
    console.log('Phone Number:', phoneNumber);
    console.log('Country:', country);
    console.log('State:', state);
    console.log('Pincode:', pincode);

    // Submit the form
    // document.getElementById('registration-form').submit();
});
// Function to toggle between login and registration forms
function toggleForms() {
    const loginContainer = document.getElementById('login-container');
    const registrationContainer = document.getElementById('registration-container');

    if (loginContainer.style.display === 'block') {
        loginContainer.style.display = 'none';
        registrationContainer.style.display = 'block';
    } else {
        loginContainer.style.display = 'block';
        registrationContainer.style.display = 'none';
    }
}

// Event listener for "Register Now" link
document.getElementById('register-link').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default link behavior
    toggleForms(); // Toggle between login and registration forms
});

// Event listener for "Login Now" link
document.getElementById('login-link').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default link behavior
    toggleForms(); // Toggle between login and registration forms
});