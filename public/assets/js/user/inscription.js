document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#inscriptionForm");
  if (!form) return;

  const statusBox = document.querySelector("#formStatus");

  const map = {
    nom: { input: "#nom", err: "#nomError" },
    email: { input: "#email", err: "#emailError" },
    password: { input: "#password", err: "#passwordError" },
    confirm_password: { input: "#confirm_password", err: "#confirmPasswordError" },
    telephone: { input: "#telephone", err: "#telephoneError" },
  };

  function setStatus(type, msg) {
    if (!statusBox) return;
    if (!msg) {
      statusBox.className = "alert d-none";
      statusBox.textContent = "";
      return;
    }
    statusBox.className = `alert alert-${type}`;
    statusBox.textContent = msg;
  }

  function clearFeedback() {
    Object.keys(map).forEach((k) => {
      const input = document.querySelector(map[k].input);
      const err = document.querySelector(map[k].err);
      if (input) input.classList.remove("is-invalid", "is-valid");
      if (err) err.textContent = "";
    });
    setStatus(null, "");
  }

  function applyServerResult(data) {
    if (data.values && data.values.telephone) {
      document.querySelector("#telephone").value = data.values.telephone;
    }

    Object.keys(map).forEach((k) => {
      const input = document.querySelector(map[k].input);
      const err = document.querySelector(map[k].err);
      const msg = (data.errors && data.errors[k]) ? data.errors[k] : "";

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
      setStatus("warning", data.errors._global);
    }
  }

  async function callValidate() {
    const data = {};
    const fd = new FormData(form);
    fd.forEach((value, key) => {
      data[key] = value;
    });
    
    const res = await fetch("/inscription/validate", {
      method: "POST",
      body: JSON.stringify(data),
      headers: { 
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest" 
      },
    });
    if (!res.ok) throw new Error("Server error during validation.");
    return res.json();
  }

  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    clearFeedback();

    try {
      const data = await callValidate();
      applyServerResult(data);

      if (data.ok) {
        setStatus("success", "Validation OK ✅ Submitting...");
        
        // Submit the form data via fetch
        const formData = {};
        const fd = new FormData(form);
        fd.forEach((value, key) => {
          formData[key] = value;
        });
        
        const res = await fetch("/inscription/register", {
          method: "POST",
          body: JSON.stringify(formData),
          headers: { 
            "Content-Type": "application/json"
          },
        });
        
        const result = await res.json();
        
        if (result.ok) {
          setStatus("success", "Account created successfully! Redirecting...");
          setTimeout(() => {
            window.location.href = "/login";
          }, 1500);
        } else {
          setStatus("danger", "Registration failed: " + (result.errors?._global || "Unknown error"));
          applyServerResult(result);
        }
      } else {
        setStatus("danger", "Please correct the errors.");
      }
    } catch (err) {
      setStatus("warning", err.message || "An error occurred.");
    }
  });

  Object.keys(map).forEach((k) => {
    const input = document.querySelector(map[k].input);
    if (input) {
      input.addEventListener("blur", async () => {
        try {
          const data = await callValidate();
          applyServerResult(data);
        } catch (_) {}
      });
    }
  });
});
