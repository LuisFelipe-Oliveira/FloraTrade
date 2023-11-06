document.addEventListener("DOMContentLoaded", function () {
  const menuIcon = document.getElementById("menuIcon");
  const menuContent = document.querySelector(".menu-content");
  const closeIcon = document.getElementById("closeIcon");

  menuIcon.addEventListener("click", function () {
    menuContent.style.display = "block";
  });

  closeIcon.addEventListener("click", function () {
    menuContent.style.display = "none";
  });
});
