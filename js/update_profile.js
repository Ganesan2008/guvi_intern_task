// update_profile.js
$(document).ready(function() {
    var sessionId = localStorage.getItem('sessionId');
    if (!sessionId) {
        window.location.href = 'login.html';
        return;
    }

    // Load existing profile data into the form
    $.ajax({
        url: 'http://localhost/Guvi_intership/php/profile.php',
        type: 'GET',
        data: { sessionId: sessionId },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                var profile = response.profile;
                $('#first-name').val(profile.first_name);
                $('#last-name').val(profile.last_name);
                $('#dob').val(profile.dob);
                $('#age').val(profile.age);
                $('#personal-email').val(profile.personal_email);
            } else {
                alert('Failed to load profile: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('An error occurred while loading the profile. Please try again.');
        }
    });

    // Handle profile update form submission
    $('#profile-form').on('submit', function(event) {
        event.preventDefault();

        var formData = {
            sessionId: sessionId,
            'first-name': $('#first-name').val(),
            'last-name': $('#last-name').val(),
            dob: $('#dob').val(),
            age: $('#age').val(),
            'personal-email': $('#personal-email').val()
        };

        $.ajax({
            url: 'http://localhost/Guvi_intership/php/update_profile.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Profile updated successfully');
                    window.location.href = 'view_profile.html';
                } else {
                    alert('Failed to update profile: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while updating the profile. Please try again.');
            }
        });
    });
});
