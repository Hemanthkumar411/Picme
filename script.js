function scrollToSection(sectionId) {
  const section = document.getElementById(sectionId);
  if (section) {
    section.scrollIntoView({ behavior: 'smooth' });
  }
}

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

window.onscroll = function () {
  const scrollBtn = document.querySelector(".scroll-top");
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    scrollBtn.style.display = "block";
  } else {
    scrollBtn.style.display = "none";
  }
};

function toggleLoginPopup() {
  const popup = document.getElementById("login-popup");
  popup.style.display = popup.style.display === "flex" ? "none" : "flex";
  document.getElementById("user-login").style.display = "none";
  document.getElementById("admin-login").style.display = "none";
}

function showLoginForm(type) {
  document.getElementById("user-login").style.display = type === "user" ? "block" : "none";
  document.getElementById("admin-login").style.display = type === "admin" ? "block" : "none";
}
