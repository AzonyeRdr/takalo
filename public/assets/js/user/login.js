document.addEventListener("DOMContentLoaded", function () {
  var loginForm = document.getElementById("loginForm");
  var loginBtn = document.getElementById("loginBtn");
  var alertContainer = document.getElementById("alertContainer");

  loginForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    // Clear previous errors
    alertContainer.classList.add("d-none");
    alertContainer.innerHTML = "";

    // Get form data
    var formData = new FormData(loginForm);
    var email = formData.get("email");
    var password = formData.get("password");

    // Show loading state
    loginBtn.disabled = true;
    loginBtn.innerHTML =
      '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <span class="btn-text">Connexion en cours...</span>';

    try {
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
        // Show success message
        showAlert("Connexion réussie! Redirection...", "success");

        // Redirect
        setTimeout(function () {
          window.location.href = data.redirect || "/index";
        }, 500);
      } else {
        // Show error message
        showAlert(data.message || "Échec de la connexion", "danger");
        resetButton();
      }
    } catch (error) {
      console.error("Erreur de connexion:", error);
      showAlert("Une erreur s'est produite. Veuillez réessayer.", "danger");
      resetButton();
    }
  });

  function showAlert(message, type) {
    // Clear previous alerts
    alertContainer.innerHTML = "";

    // Create alert div
    var alert = document.createElement("div");
    alert.className = "alert alert-" + type;
    alert.setAttribute("role", "alert");

    // Add message text
    var messageText = document.createTextNode(message);
    alert.appendChild(messageText);

    alertContainer.appendChild(alert);
    alertContainer.classList.remove("d-none");
  }

  function resetButton() {
    loginBtn.disabled = false;
    loginBtn.innerHTML =
      '<span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span><span class="btn-text">Se connecter</span>';
  }
});
