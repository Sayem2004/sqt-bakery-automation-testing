
var form = document.getElementById('loginForm');

form.addEventListener('submit', function(event) {
    
    event.preventDefault();
    
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    
    var errorMessage = document.getElementById('error-message');
    
    errorMessage.textContent = '';
    errorMessage.style.color = 'red';
    
    if (email == '') {
        errorMessage.textContent = 'Please enter your email.';
        return;
    }
    
    if (!email.includes('@') || !email.includes('.')) {
        errorMessage.textContent = 'Please enter a valid email address.';
        return;
    }
    
    if (password == '') {
        errorMessage.textContent = 'Please enter your password.';
        return;
    }
    
    if (password.length < 6) {
        errorMessage.textContent = 'Password must be at least 6 characters.';
        return;
    }
    
    errorMessage.textContent = 'Logging in...';
    errorMessage.style.color = 'blue';
    
    var xhr = new XMLHttpRequest();
    
    xhr.open('POST', '../controller/login-validation.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    
    xhr.onload = function() {
        if (xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            
            if (response.success) {
                errorMessage.textContent = 'Login successful! Redirecting...';
                errorMessage.style.color = 'green';
                
                window.location.href = response.redirect;
            } else {
                errorMessage.textContent = response.message;
                errorMessage.style.color = 'red';
            }
        } else {
            errorMessage.textContent = 'Server error. Please try again.';
            errorMessage.style.color = 'red';
        }
    };
    
    xhr.onerror = function() {
        errorMessage.textContent = 'Connection error. Please try again.';
        errorMessage.style.color = 'red';
    };
    
    var data = 'email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password);
    xhr.send(data);
});
