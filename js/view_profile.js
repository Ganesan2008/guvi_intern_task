// view_profile.js
$(document).ready(function() {
    var sessionId = localStorage.getItem('sessionId');
    if (!sessionId) {
        window.location.href = 'login.html';
        return;
    }

    // Load profile data when the page is loaded
    $.ajax({
        url: 'http://localhost/Guvi_intership/php/profile.php',
        type: 'GET',
        data: { sessionId: sessionId },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                var profile = response.profile;
                $('#profile-details').html(`
                    <p>First Name: ${profile.first_name}</p>
                    <p>Last Name: ${profile.last_name}</p>
                    <p>Date of Birth: ${profile.dob}</p>
                    <p>Age: ${profile.age}</p>
                    <p>Personal Email: ${profile.personal_email}</p>
                `);
            } else {
                alert('Failed to load profile: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('An error occurred while loading the profile. Please try again.');
        }
    });

    // Handle edit profile button click
    $('#edit-profile').on('click', function() {
        window.location.href = 'profile.html';
    });

    $('#home-button').on('click', function() {
        window.location.href = 'index.html';
    });
});
