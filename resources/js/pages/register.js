export function initRegister() {
    const form = document.getElementById('register-form');

    if (!form) return;

    // ==============================
    // Password Toggle
    // ==============================

    const passwordInput = document.getElementById('password');
    const passwordConfirmationInput =
        document.getElementById('password_confirmation');

    const passwordToggle =
        document.getElementById('password-toggle');

    const passwordConfirmationToggle =
        document.getElementById('password-confirmation-toggle');

    function togglePassword(input, button) {
        if (!input || !button) return;

        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';

            if (icon) {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        } else {
            input.type = 'password';

            if (icon) {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    }

    passwordToggle?.addEventListener('click', () => {
        togglePassword(passwordInput, passwordToggle);
    });

    passwordConfirmationToggle?.addEventListener('click', () => {
        togglePassword(
            passwordConfirmationInput,
            passwordConfirmationToggle
        );
    });


    // ==============================
    // Password Strength
    // ==============================

    const strengthBar =
        document.getElementById('password-strength-bar');

    const strengthText =
        document.getElementById('password-strength-text');

    function checkPasswordStrength(password) {
        if (!strengthBar || !strengthText) return;

        let strength = 0;

        if (password.length >= 8) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;

        strengthBar.style.width = `${strength * 20}%`;

        if (!password) {
            strengthBar.style.width = '0%';
            strengthText.textContent = '';
            return;
        }

        if (strength <= 2) {
            strengthText.textContent = 'Weak';
        } else if (strength === 3) {
            strengthText.textContent = 'Medium';
        } else {
            strengthText.textContent = 'Strong';
        }
    }

    passwordInput?.addEventListener('input', () => {
        checkPasswordStrength(passwordInput.value);
    });


    // ==============================
    // Password Confirmation UI
    // ==============================

    const passwordMatchText =
        document.getElementById('password-match-text');

    function checkPasswordMatch() {
        if (!passwordConfirmationInput || !passwordMatchText) return;

        const password = passwordInput?.value || '';
        const confirmation = passwordConfirmationInput.value;

        if (!confirmation) {
            passwordMatchText.textContent = '';
            passwordConfirmationInput.classList.remove(
                'is-valid',
                'is-invalid'
            );

            return;
        }

        if (password === confirmation) {
            passwordMatchText.textContent = 'Passwords match.';
            passwordMatchText.className =
                'form-text text-success';

            passwordConfirmationInput.classList.remove('is-invalid');
            passwordConfirmationInput.classList.add('is-valid');
        } else {
            passwordMatchText.textContent =
                'Passwords do not match.';
            passwordMatchText.className =
                'form-text text-danger';

            passwordConfirmationInput.classList.remove('is-valid');
            passwordConfirmationInput.classList.add('is-invalid');
        }
    }

    passwordInput?.addEventListener('input', checkPasswordMatch);

    passwordConfirmationInput?.addEventListener(
        'input',
        checkPasswordMatch
    );


    // ==============================
    // Submit Button UI
    // ==============================

    form.addEventListener('submit', () => {
        const submitBtn =
            document.getElementById('register-submit-btn');

        if (!submitBtn) return;

        submitBtn.disabled = true;

        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2"></span>
            Creating Account...
        `;
    });


    // ==============================
    // Input Focus Effects
    // ==============================

    const inputs = form.querySelectorAll(
        'input:not([type="hidden"])'
    );

    inputs.forEach(input => {

        input.addEventListener('focus', () => {
            input.parentElement?.classList.add('input-focused');
        });

        input.addEventListener('blur', () => {
            input.parentElement?.classList.remove('input-focused');
        });

    });
}
