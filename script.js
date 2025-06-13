function toggleLoginPopup() {
  const popup = document.getElementById("login-popup");
  popup.style.display = popup.style.display === "block" ? "none" : "block";
}

function showLoginForm(role) {
  document.getElementById("user-login").style.display = "none";
  document.getElementById("admin-login").style.display = "none";
  document.getElementById(`${role}-login`).style.display = "block";
}

function scrollToSection(sectionId) {
  const section = document.getElementById(sectionId);
  section.scrollIntoView({ behavior: "smooth" });
}

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: "smooth" });
}

function login(role) {
  const username = document.getElementById(`${role}-username`).value;
  const password = document.getElementById(`${role}-password`).value;

  fetch("login.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}&role=${role}`
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        // Update UI
        toggleLoginPopup();

        if (data.role === "user") {
          showUserLoggedIn(data.name);
        } else if (data.role === "admin") {
          showAdminDashboard(data.name); // placeholder for future
        }
      } else {
        alert("Login failed: " + data.message);
      }
    })
    .catch((error) => {
      console.error("Login error:", error);
      alert("Login failed due to server error");
    });
}

function showUserLoggedIn(name) {
  const navButtons = document.querySelector(".nav-buttons");

  navButtons.innerHTML = `
    <span class="welcome-text">Welcome @${name}</span>
    <button onclick="logout()">Logout</button>
  `;
}

function logout() {
  location.reload(); // simple page reload to reset to original state
}

// Optional: Display signup success message if redirected from signup
window.onload = function () {
  const params = new URLSearchParams(window.location.search);
  if (params.get('signup') === 'success') {
    alert("Signup successful! Please login.");
    toggleLoginPopup();
  }
};
