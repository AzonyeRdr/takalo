<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Metis Admin</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/assets/favicon-CvUZKS4z.svg">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS from Metis -->
    <link rel="stylesheet" href="/assets/main-QD_VOj1Y.css">
</head>
<body class="bg-dark min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card bg-body-tertiary border-0 shadow-lg">
                    <div class="card-body p-4 p-md-5">
                        <!-- Logo/Brand -->
                        <div class="text-center mb-4">
                            <div class="mb-3">
                                <img src="data:image/svg+xml,%3csvg%20width='64'%20height='64'%20viewBox='0%200%2032%2032'%20fill='none'%20xmlns='http://www.w3.org/2000/svg'%3e%3ccircle%20cx='16'%20cy='16'%20r='16'%20fill='url(%23logoGradient)'/%3e%3cpath%20d='M10%2024V8h2.5l2.5%206.5L17.5%208H20v16h-2V12.5L16.5%2020h-1L14%2012.5V24H10z'%20fill='white'%20font-weight='700'/%3e%3cdefs%3e%3clinearGradient%20id='logoGradient'%20x1='0%25'%20y1='0%25'%20x2='100%25'%20y2='100%25'%3e%3cstop%20offset='0%25'%20style='stop-color:%236366f1;stop-opacity:1'%20/%3e%3cstop%20offset='100%25'%20style='stop-color:%238b5cf6;stop-opacity:1'%20/%3e%3c/linearGradient%3e%3c/defs%3e%3c/svg%3e" alt="Metis Logo" width="64" height="64">
                            </div>
                            <h2 class="h3 fw-bold text-primary mb-1">Metis Admin</h2>
                            <p class="text-body-secondary">Create your account</p>
                        </div>

                        <form id="inscriptionForm" novalidate>
                            <div id="formStatus" class="alert d-none"></div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nom" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="nom" name="nom" required>
                                    <div id="nomError" class="invalid-feedback d-block"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="prenom" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                                    <div id="prenomError" class="invalid-feedback d-block"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div id="emailError" class="invalid-feedback d-block"></div>
                            </div>

                            <div class="mb-3">
                                <label for="telephone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="telephone" name="telephone" required>
                                <div id="telephoneError" class="invalid-feedback d-block"></div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <div id="passwordError" class="invalid-feedback d-block"></div>
                            </div>

                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <div id="confirmPasswordError" class="invalid-feedback d-block"></div>
                            </div>

                            <button class="btn btn-primary w-100 py-2 mb-3" type="submit">
                                <span class="btn-text">Sign Up</span>
                            </button>
                            
                            <div class="text-center">
                                <p class="text-body-secondary mb-0">
                                    Already have an account? 
                                    <a href="/login" class="text-primary text-decoration-none fw-semibold">Sign in</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/vendor-bootstrap-C9iorZI5.js"></script>
    <script src="/assets/users/js/inscription-validation.js"></script>
</body>
</html>
