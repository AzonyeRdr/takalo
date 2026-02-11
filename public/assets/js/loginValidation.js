document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  if (!form) return;

  const emailInput = document.getElementById("email");
  const errorBox = document.getElementById("Wemail");

  function setError(msg) {
    if (!errorBox) return;
    if (!msg) {
      errorBox.textContent = "";
      errorBox.className = "errors";
      return;
    }
    errorBox.textContent = msg;
    errorBox.className = "errors error";
  }

  function setSuccess(msg) {
    if (!errorBox) return;
    errorBox.textContent = msg;
    errorBox.className = "errors success";
  }

  function verifierEmailFormat(email) {
    if (email.length === 0) {
      return "Email cannot be empty...";
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(email)) {
      return "Email format is invalid...";
    }

    return null;
  }

  emailInput.addEventListener("input", function () {
    const error = verifierEmailFormat(emailInput.value.trim());
    if (error) {
      setError(error);
    } else {
      setError(null);
    }
  });

  emailInput.addEventListener("blur", function () {
    const error = verifierEmailFormat(emailInput.value.trim());
    if (error) {
      setError(error);
    }
  });

  form.addEventListener("submit", async function (e) {
    e.preventDefault();

    const error = verifierEmailFormat(emailInput.value.trim());

    if (error) {
      setError(error);
      return;
    }

    const submitButton = form.querySelector('input[type="submit"]');
    submitButton.disabled = true;
    const originalValue = submitButton.value;
    submitButton.value = "Logging in...";

    const formData = new FormData(form);

    try {
      const response = await fetch(form.action, {
        method: "POST",
        body: formData,
        headers: { "X-Requested-With": "XMLHttpRequest" },
      });

      if (!response.ok) {
        throw new Error("Erreur serveur lors de la connexion.");
      }

      const data = await response.json();

      if (data.success) {
        setSuccess(data.message || "Login successful!");
        setTimeout(() => {
          window.location.href = "/index";
        }, 500);
      } else {
        if (data.errors && data.errors.email) {
          setError(data.errors.email);
        } else if (data.errors && data.errors.general) {
          setError(data.errors.general);
        } else {
          setError("Login failed. Please try again.");
        }

        submitButton.disabled = false;
        submitButton.value = originalValue;
      }
    } catch (error) {
      console.error("Login error:", error);
      setError(error.message || "An error occurred during login.");

      submitButton.disabled = false;
      submitButton.value = originalValue;
    }
  });
});
