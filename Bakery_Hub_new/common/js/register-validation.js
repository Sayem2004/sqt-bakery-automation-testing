
var form = document.getElementById('registerForm');

form.addEventListener('submit', function(event) {
    
    event.preventDefault();
    
    var name = document.getElementById('name').value;
    var phone = document.getElementById('phone').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var role = document.getElementById('role').value;
    
    var errorMessage = document.getElementById('error-message');
    
    errorMessage.textContent = '';
    errorMessage.style.color = 'red';
    
    if (name == '') {
        errorMessage.textContent = 'Please enter your name.';
        return;
    }
    
    if (name.length < 2) {
        errorMessage.textContent = 'Name must be at least 2 characters.';
        return;
    }
    
    if (phone == '') {
        errorMessage.textContent = 'Please enter your phone number.';
        return;
    }
    
    if (phone.length < 10) {
        errorMessage.textContent = 'Phone number must be at least 10 digits.';
        return;
    }
    
    if (email == '') {
        errorMessage.textContent = 'Please enter your email.';
        return;
    }
    
    if (!email.includes('@') || !email.includes('.')) {
        errorMessage.textContent = 'Please enter a valid email address.';
        return;
    }
    
    if (password == '') {
        errorMessage.textContent = 'Please enter a password.';
        return;
    }
    
    if (password.length < 6) {
        errorMessage.textContent = 'Password must be at least 6 characters.';
        return;
    }
    
    if (role == '') {
        errorMessage.textContent = 'Please select a role.';
        return;
    }
    
    errorMessage.textContent = 'Registering...';
    errorMessage.style.color = 'blue';
    
    var xhr = new XMLHttpRequest();
    
    xhr.open('POST', '../controller/register-validation.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    
    xhr.onload = function() {
        if (xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            
            if (response.success) {
                errorMessage.textContent = response.message;
                errorMessage.style.color = 'green';
                
                form.reset();
                
                setTimeout(function() {
                    window.location.href = 'login.php';
                }, 2000);
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
    
    var data = 'name=' + encodeURIComponent(name) +
               '&phone=' + encodeURIComponent(phone) +
               '&email=' + encodeURIComponent(email) +
               '&password=' + encodeURIComponent(password) +
               '&role=' + encodeURIComponent(role);
    xhr.send(data);
});
