//  menu dropdown
const menuDropdown = document.querySelector(".dropBtn");

if (menuDropdown) {
  menuDropdown.addEventListener("click", () => {
    document.querySelector(".dropdownContent").classList.toggle("show");
  });
}

// sidebar
const menuBtn = document.querySelector(".menuIcon");
const sidebar = document.querySelector(".sidebar");

menuBtn.addEventListener("click", () => {
  sidebar.classList.toggle("open");
});
