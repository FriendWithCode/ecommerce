<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Toko Sparepart Mobil</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Orbitron:wght@400;500;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-color: #f04e30;
      --primary-dark: #d84325;
      --dark-bg: #0a0a0a;
      --dark-card: #1a1a1a;
      --text-light: #e0e0e0;
      --text-muted: #a0a0a0;
      --border-color: #333333;
      --accent-color: #00c2ff;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
      color: var(--text-light);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .register-wrapper {
      width: 100%;
      max-width: 480px;
      margin: 0 auto;
    }

    .register-card {
      background: var(--dark-card);
      border-radius: 16px;
      border: 1px solid var(--border-color);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
      overflow: hidden;
      transition: transform 0.3s ease;
    }

    .register-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.6);
    }

    /* Header */
    .register-header {
      background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
      padding: 35px 30px;
      text-align: center;
      position: relative;
    }

    .register-header::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: rgba(255, 255, 255, 0.2);
    }

    .brand-logo {
      font-family: 'Orbitron', sans-serif;
      font-size: 2.5rem;
      font-weight: 700;
      color: white;
      text-decoration: none;
      margin-bottom: 15px;
      display: inline-block;
    }

    .brand-logo span {
      color: #ffdd00;
    }

    .register-title {
      font-size: 1.4rem;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.95);
      margin: 0;
    }

    /* Body */
    .register-body {
      padding: 40px;
    }

    @media (max-width: 576px) {
      .register-body {
        padding: 30px 25px;
      }
      .register-header {
        padding: 30px 25px;
      }
    }

    /* Form Elements */
    .form-group {
      margin-bottom: 25px;
    }

    .form-label {
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 600;
      color: var(--text-light);
      margin-bottom: 10px;
      font-size: 0.95rem;
    }

    .form-label i {
      color: var(--primary-color);
      width: 20px;
      text-align: center;
      font-size: 1.1rem;
    }

    .form-control {
      background: rgba(255, 255, 255, 0.05);
      border: 2px solid var(--border-color);
      border-radius: 10px;
      color: var(--text-light);
      padding: 14px 18px;
      font-size: 1rem;
      transition: all 0.3s ease;
      width: 100%;
    }

    .form-control:focus {
      background: rgba(255, 255, 255, 0.08);
      border-color: var(--primary-color);
      box-shadow: 0 0 0 4px rgba(240, 78, 48, 0.15);
      color: var(--text-light);
      outline: none;
    }

    .form-control::placeholder {
      color: var(--text-muted);
      opacity: 0.7;
    }

    .form-control[readonly] {
      background: rgba(255, 255, 255, 0.03);
      color: var(--text-muted);
      cursor: not-allowed;
    }

    /* Password Input Group */
    .password-wrapper {
      position: relative;
    }

    .password-toggle {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: var(--text-muted);
      cursor: pointer;
      padding: 8px;
      font-size: 1.1rem;
      transition: color 0.3s;
      z-index: 10;
    }

    .password-toggle:hover {
      color: var(--primary-color);
    }

    /* Password Strength */
    .password-strength-container {
      margin-top: 12px;
    }

    .strength-label {
      display: flex;
      justify-content: space-between;
      font-size: 0.85rem;
      color: var(--text-muted);
      margin-bottom: 6px;
    }

    .strength-bar {
      height: 6px;
      background: var(--border-color);
      border-radius: 3px;
      overflow: hidden;
      position: relative;
    }

    .strength-fill {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 0%;
      border-radius: 3px;
      transition: all 0.3s ease;
    }

    .strength-text {
      font-size: 0.85rem;
      margin-top: 6px;
      font-weight: 500;
    }

    /* Strength Colors */
    .strength-weak { background: #dc3545; }
    .strength-fair { background: #ffc107; }
    .strength-good { background: #28a745; }
    .strength-strong { background: #17a2b8; }

    /* Form Hints */
    .form-hint {
      display: block;
      font-size: 0.85rem;
      color: var(--text-muted);
      margin-top: 8px;
    }

    /* Submit Button */
    .btn-submit {
      background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
      color: white;
      border: none;
      border-radius: 10px;
      padding: 16px;
      font-size: 1.1rem;
      font-weight: 600;
      width: 100%;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      cursor: pointer;
      margin-top: 10px;
    }

    .btn-submit:hover:not(:disabled) {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(240, 78, 48, 0.4);
    }

    .btn-submit:active:not(:disabled) {
      transform: translateY(-1px);
    }

    .btn-submit:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }

    /* Login Link */
    .login-link {
      text-align: center;
      margin-top: 30px;
      padding-top: 25px;
      border-top: 1px solid var(--border-color);
      color: var(--text-muted);
      font-size: 0.95rem;
    }

    .login-link a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s;
    }

    .login-link a:hover {
      color: var(--accent-color);
      text-decoration: underline;
    }

    /* Alerts */
    .alert-container {
      margin-bottom: 25px;
    }

    .alert {
      border-radius: 10px;
      border: none;
      padding: 16px 20px;
      display: flex;
      align-items: flex-start;
      gap: 12px;
      animation: slideDown 0.4s ease-out;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .alert-success {
      background: rgba(40, 167, 69, 0.15);
      color: #28a745;
      border-left: 4px solid #28a745;
    }

    .alert-danger {
      background: rgba(220, 53, 69, 0.15);
      color: #dc3545;
      border-left: 4px solid #dc3545;
    }

    .alert i {
      font-size: 1.2rem;
      margin-top: 2px;
    }

    /* Validation */
    .is-invalid {
      border-color: #dc3545 !important;
    }

    .is-invalid:focus {
      box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.15) !important;
    }

    .invalid-feedback {
      color: #dc3545;
      font-size: 0.85rem;
      margin-top: 6px;
      display: block;
    }

    /* Animations */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(15px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .form-group {
      animation: fadeIn 0.5s ease-out forwards;
      opacity: 0;
    }

    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-group:nth-child(3) { animation-delay: 0.3s; }
    .form-group:nth-child(4) { animation-delay: 0.4s; }
    .form-group:nth-child(5) { animation-delay: 0.5s; }

    /* Loading State */
    .btn-submit.loading {
      position: relative;
      color: transparent;
    }

    .btn-submit.loading::after {
      content: '';
      position: absolute;
      width: 24px;
      height: 24px;
      border: 3px solid rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      border-top-color: white;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    /* Utility Classes */
    .text-center { text-align: center; }
    .mb-0 { margin-bottom: 0; }
    .mt-3 { margin-top: 1rem; }
    .w-100 { width: 100%; }
  </style>
</head>

<body>
  <div class="register-wrapper">
    <div class="register-card">
      
      <!-- Header -->
      <div class="register-header">
        <a href="/" class="brand-logo">
          <span>SPARE</span>PARTS
        </a>
        <h1 class="register-title">Buat Akun Baru</h1>
      </div>

      <!-- Body -->
      <div class="register-body">
        
        <!-- Alert Container -->
        <div class="alert-container">
          @if(session('message'))
          <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <div>{{ session('message') }}</div>
          </div>
          @endif

          @if($errors->any())
          <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
              @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
              @endforeach
            </div>
          </div>
          @endif
        </div>

        <!-- Registration Form -->
        <form action="{{ route('actionregister') }}" method="post" id="registerForm">
          @csrf

          <!-- Email -->
          <div class="form-group">
            <label class="form-label">
              <i class="fas fa-envelope"></i> Email
            </label>
            <input 
              type="email" 
              name="email" 
              class="form-control" 
              placeholder="Masukkan email aktif" 
              value="{{ old('email') }}"
              required
              autocomplete="email"
            >
            @error('email')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <!-- Username -->
          <div class="form-group">
            <label class="form-label">
              <i class="fas fa-user"></i> Username
            </label>
            <input 
              type="text" 
              name="username" 
              class="form-control" 
              placeholder="Buat username unik" 
              value="{{ old('username') }}"
              required
              autocomplete="username"
            >
            @error('username')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <!-- Password -->
          <div class="form-group">
            <label class="form-label">
              <i class="fas fa-key"></i> Password
            </label>
            <div class="password-wrapper">
              <input 
                type="password" 
                name="password" 
                id="passwordInput" 
                class="form-control" 
                placeholder="Minimal 3 karakter"
                required
                autocomplete="new-password"
                oninput="updatePasswordStrength(this.value)"
              >
              <button type="button" class="password-toggle" onclick="togglePassword()">
                <i class="fas fa-eye"></i>
              </button>
            </div>
            
            <!-- Password Strength Indicator -->
            <div class="password-strength-container">
              <div class="strength-label">
                <span>Kekuatan Password:</span>
                <span id="strengthText">Belum diisi</span>
              </div>
              <div class="strength-bar">
                <div class="strength-fill" id="strengthFill"></div>
              </div>
            </div>
            
            <small class="form-hint">
              Password harus minimal 3 karakter. Semakin panjang dan kompleks, semakin aman.
            </small>
            
            @error('password')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <!-- Role -->
          <div class="form-group">
            <label class="form-label">
              <i class="fas fa-user-tag"></i> Role
            </label>
            <input 
              type="text" 
              name="role" 
              class="form-control" 
              value="Guest" 
              readonly
            >
            <small class="form-hint">
              Semua pengguna baru akan memiliki role Guest secara default
            </small>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn-submit" id="submitBtn">
            <i class="fas fa-user-plus"></i>
            <span>Daftar Sekarang</span>
          </button>

          <!-- Login Link -->
          <div class="login-link">
            Sudah punya akun? 
            <a href="/admin" class="ms-1">
              <i class="fas fa-sign-in-alt me-1"></i>Login Disini
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Password Toggle Visibility
    function togglePassword() {
      const passwordInput = document.getElementById('passwordInput');
      const toggleIcon = document.querySelector('.password-toggle i');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
      }
    }

    // Password Strength Calculator
    function updatePasswordStrength(password) {
      const strengthFill = document.getElementById('strengthFill');
      const strengthText = document.getElementById('strengthText');
      
      let strength = 0;
      let width = 0;
      let text = 'Belum diisi';
      let colorClass = '';
      
      if (password.length > 0) {
        // Calculate strength based on length
        if (password.length < 3) {
          strength = 1;
          width = 25;
          text = 'Sangat Lemah';
          colorClass = 'strength-weak';
        } else if (password.length < 6) {
          strength = 2;
          width = 50;
          text = 'Lemah';
          colorClass = 'strength-fair';
        } else if (password.length < 9) {
          strength = 3;
          width = 75;
          text = 'Cukup';
          colorClass = 'strength-good';
        } else {
          strength = 4;
          width = 100;
          text = 'Kuat';
          colorClass = 'strength-strong';
        }
        
        // Bonus points for complexity
        if (/[A-Z]/.test(password)) strength += 0.5;
        if (/[0-9]/.test(password)) strength += 0.5;
        if (/[^A-Za-z0-9]/.test(password)) strength += 0.5;
        
        // Adjust width based on final strength
        width = Math.min(100, 25 + (strength * 25));
        
        // Update text based on final strength
        if (strength >= 4) {
          text = 'Sangat Kuat';
        } else if (strength >= 3) {
          text = 'Kuat';
        }
      } else {
        width = 0;
        text = 'Belum diisi';
        colorClass = '';
      }
      
      // Update UI
      strengthFill.style.width = width + '%';
      strengthFill.className = 'strength-fill ' + colorClass;
      strengthText.textContent = text;
      strengthText.style.color = getStrengthColor(colorClass);
    }

    // Get color for strength text
    function getStrengthColor(colorClass) {
      switch(colorClass) {
        case 'strength-weak': return '#dc3545';
        case 'strength-fair': return '#ffc107';
        case 'strength-good': return '#28a745';
        case 'strength-strong': return '#17a2b8';
        default: return 'var(--text-muted)';
      }
    }

    // Form Validation and Submission
    document.getElementById('registerForm').addEventListener('submit', function(e) {
      const password = document.getElementById('passwordInput').value;
      const submitBtn = document.getElementById('submitBtn');
      
      // Remove any minlength restriction
      document.getElementById('passwordInput').removeAttribute('minlength');
      
      // Basic validation - minimum 3 characters
      if (password.length < 3) {
        e.preventDefault();
        alert('Password harus minimal 3 karakter');
        document.getElementById('passwordInput').focus();
        return false;
      }
      
      // Add loading state
      submitBtn.classList.add('loading');
      submitBtn.disabled = true;
      submitBtn.querySelector('span').textContent = 'Mendaftarkan...';
      
      // Allow form to submit
      return true;
    });

    // Auto-focus first input
    document.addEventListener('DOMContentLoaded', function() {
      // Focus first input
      const firstInput = document.querySelector('input[name="email"]');
      if (firstInput) {
        firstInput.focus();
      }
      
      // Initialize password strength with current value
      updatePasswordStrength(document.getElementById('passwordInput').value);
      
      // Remove minlength attribute
      const passwordInput = document.getElementById('passwordInput');
      passwordInput.removeAttribute('minlength');
      
      // Real-time validation styling
      const inputs = document.querySelectorAll('.form-control');
      inputs.forEach(input => {
        input.addEventListener('input', function() {
          if (this.value.trim() !== '') {
            this.classList.remove('is-invalid');
          }
        });
        
        input.addEventListener('blur', function() {
          if (this.value.trim() === '' && this.hasAttribute('required')) {
            this.classList.add('is-invalid');
          }
        });
      });
    });

    // Prevent Bootstrap from adding minlength
    document.addEventListener('DOMContentLoaded', function() {
      // Check and remove minlength periodically
      setInterval(() => {
        const passwordInput = document.getElementById('passwordInput');
        if (passwordInput.hasAttribute('minlength')) {
          passwordInput.removeAttribute('minlength');
        }
      }, 500);
    });
  </script>
</body>
</html>