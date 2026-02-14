document.addEventListener("DOMContentLoaded", function () {
  var loginForm = document.getElementById("loginForm");
  if (!loginForm) return;

  var loginBtn = document.getElementById("loginBtn");
  var alertContainer = document.getElementById("alertContainer");

  var map = {
    email: { input: "#email", err: "#emailError" },
    password: { input: "#password", err: "#passwordError" },
  };

  function setStatus(type, msg) {
    if (!alertContainer) return;
    if (!msg) {
      alertContainer.className = "d-none";
      alertContainer.innerHTML = "";
      return;
    }
    alertContainer.className = `alert alert-${type}`;
    alertContainer.textContent = msg;
  }

  function clearFeedback() {
    Object.keys(map).forEach((k) => {
      var input = document.querySelector(map[k].input);
      var err = document.querySelector(map[k].err);
      if (input) input.classList.remove("is-invalid", "is-valid");
      if (err) err.textContent = "";
    });
    setStatus(null, "");
  }

  function applyFeedback(data) {
    Object.keys(map).forEach((k) => {
      var input = document.querySelector(map[k].input);
      var err = document.querySelector(map[k].err);
      var msg = data.errors && data.errors[k] ? data.errors[k] : "";

      if (msg) {
        if (input) input.classList.add("is-invalid");
        if (input) input.classList.remove("is-valid");
        if (err) err.textContent = msg;
      } else {
        if (input) input.classList.remove("is-invalid");
        if (input) input.classList.add("is-valid");
        if (err) err.textContent = "";
      }
    });

    if (data.errors && data.errors._global) {
      setStatus("danger", data.errors._global);
    }
  }

  function validateFields() {
    var email = document.querySelector("#email").value.trim();
    var password = document.querySelector("#password").value.trim();
    var errors = {};
    var isValid = true;

    // Email validation
    if (!email) {
      errors.email = "L'email est requis";
      isValid = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      errors.email = "Format d'email invalide";
      isValid = false;
    }

    // Password validation
    if (!password) {
      errors.password = "Le mot de passe est requis";
      isValid = false;
    }

    applyFeedback({ errors: errors });
    return isValid;
  }

  loginForm.addEventListener("submit", async function (e) {
    e.preventDefault();
    clearFeedback();

    if (!validateFields()) {
      setStatus("danger", "Veuillez corriger les erreurs.");
      return;
    }

    // Show loading state
    if (loginBtn) {
      loginBtn.disabled = true;
      loginBtn.innerHTML =
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <span class="btn-text">Connexion en cours...</span>';
    }

    try {
      var formData = new FormData(loginForm);
      var email = formData.get("email");
      var password = formData.get("password");

      var response = await fetch("/login/verifyUser", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          email: email,
          password: password,
        }),
      });

      var data = await response.json();

      if (data.success) {
        setStatus("success", "Connexion réussie! Redirection...");
        setTimeout(function () {
          window.location.href = data.redirect || "/index";
        }, 500);
      } else {
        setStatus("danger", data.message || "Échec de la connexion");
        resetButton();
      }
    } catch (error) {
      console.error("Erreur de connexion:", error);
      setStatus("danger", "Une erreur s'est produite. Veuillez réessayer.");
      resetButton();
    }
  });

  // Validation en temps réel sur blur
  Object.keys(map).forEach((k) => {
    var input = document.querySelector(map[k].input);
    if (input) {
      input.addEventListener("blur", function () {
        validateFields();
      });
    }
  });

  function resetButton() {
    if (loginBtn) {
      loginBtn.disabled = false;
      loginBtn.innerHTML =
        '<span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span><span class="btn-text">Se connecter</span>';
    }
  }
});
