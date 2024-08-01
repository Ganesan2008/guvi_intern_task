// login.js
$(document).ready(function() {
    $('#loginForm').on('submit', function(event) {
        event.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            url: 'http://localhost/Guvi_intership/php/login.php',
            type: 'POST',
            data: {email: email, password: password},
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    localStorage.setItem('sessionId', response.sessionId);
                    localStorage.setItem('user', JSON.stringify(response.user));
                    window.location.href = 'profile.html';
                } else {
                    alert('Login failed: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred during the login process. Please try again.');
            }
        });
    });
});
