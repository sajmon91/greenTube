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

// tabs
const tabs = document.querySelectorAll("[data-tab-target]");
const tabContents = document.querySelectorAll("[data-tab-content]");

tabs.forEach((tab) => {
  tab.addEventListener("click", () => {
    const target = document.querySelector(tab.dataset.tabTarget);
    tabContents.forEach((tabContent) => {
      tabContent.classList.remove("active");
    });
    tabs.forEach((tab) => {
      tab.classList.remove("active");
    });
    tab.classList.add("active");
    target.classList.add("active");
  });
});
