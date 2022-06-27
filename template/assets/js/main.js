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

// videos hover
const allVideos = document.querySelectorAll(".videoPlay");

allVideos.forEach((video) => {
  video.addEventListener("mouseover", () => {
    video.play();
  });
  video.addEventListener("mouseleave", () => {
    video.pause();
  });
});
