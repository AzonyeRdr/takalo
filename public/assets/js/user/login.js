        document.addEventListener('DOMContentLoaded', function() {
            var loginForm = document.getElementById('loginForm');
            var loginBtn = document.getElementById('loginBtn');
            var alertContainer = document.getElementById('alertContainer');
            
            loginForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                // Clear previous errors
                alertContainer.innerHTML = '';
                
                // Get form data
                var formData = new FormData(loginForm);
                var email = formData.get('email');
                var password = formData.get('password');
                
                // Show loading state
                loginBtn.disabled = true;
                loginBtn.querySelector('.btn-text').textContent = 'Signing in...';
                loginBtn.querySelector('.spinner-border').classList.remove('d-none');
                
                try {
                    var response = await fetch('/login/verifyUser', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ email: email, password: password })
                    });
                    
                    var data = await response.json();
                    
                    if (data.success) {
                        // Show success message
                        showAlert('Login successful! Redirecting...', 'success');
                        
                        // Redirect
                        setTimeout(function() {
                            window.location.href = data.redirect || '/messages';
                        }, 500);
                    } else {
                        // Show error message
                        showAlert(data.message || 'Login failed', 'danger');
                        resetButton();
                    }
                } catch (error) {
                    console.error('Login error:', error);
                    showAlert('An error occurred. Please try again.', 'danger');
                    resetButton();
                }
            });
            
            function showAlert(message, type) {
                // Clear previous alerts
                alertContainer.innerHTML = '';
                
                // Create alert div
                var alert = document.createElement('div');
                alert.className = 'alert alert-' + type + ' alert-dismissible fade show';
                alert.setAttribute('role', 'alert');
                
                // Add message text
                var messageText = document.createTextNode(message);
                alert.appendChild(messageText);
                
                // Create close button
                var closeBtn = document.createElement('button');
                closeBtn.className = 'btn-close';
                closeBtn.setAttribute('type', 'button');
                closeBtn.setAttribute('data-bs-dismiss', 'alert');
                closeBtn.setAttribute('aria-label', 'Close');
                
                alert.appendChild(closeBtn);
                alertContainer.appendChild(alert);
            }
            
            function resetButton() {
                loginBtn.disabled = false;
                loginBtn.querySelector('.btn-text').textContent = 'Sign In';
                loginBtn.querySelector('.spinner-border').classList.add('d-none');
            }
        });
