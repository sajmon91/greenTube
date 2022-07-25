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

if (menuBtn) {
  menuBtn.addEventListener("click", () => {
    sidebar.classList.toggle("open");
  });
}

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

//dashboard search
const searchInput = document.querySelector("#dashboardSearch");
const rows = document.querySelectorAll("tbody tr");

if (searchInput) {
  searchInput.addEventListener("keyup", (ev) => {
    const q = ev.target.value.toLowerCase();
    rows.forEach((row) => {
      row.querySelector("td .title").textContent.toLowerCase().startsWith(q)
        ? (row.style.display = "table-row")
        : (row.style.display = "none");
    });
  });
}

// dashboard sort table
function sortTableByColumn(table, column, sortBy, asc = true) {
  const dirModifier = asc ? 1 : -1;
  const tBody = table.tBodies[0];
  const rows = Array.from(tBody.querySelectorAll("tr"));

  const sortedRows = rows.sort((a, b) => {
    const aColText = a
      .querySelector(`td:nth-child(${column + 1})`)
      .textContent.trim();
    const bColText = b
      .querySelector(`td:nth-child(${column + 1})`)
      .textContent.trim();

    if (sortBy === "byDate") {
      const pattern = /(\d{2})\.(\d{2})\.(\d{4})/;
      const dt1 = new Date(aColText.replace(pattern, "$3-$2-$1"));
      const dt2 = new Date(bColText.replace(pattern, "$3-$2-$1"));

      if (dt1.getUTCMonth() > dt2.getUTCMonth()) {
        return 1 * dirModifier;
      } else if (dt1.getUTCMonth() < dt2.getUTCMonth()) {
        return -1 * dirModifier;
      } else {
        //same month
        if (dt1.getUTCDate() > dt2.getUTCDate()) {
          return 1 * dirModifier;
        } else if (dt1.getUTCDate() < dt2.getUTCDate()) {
          return -1 * dirModifier;
        }
      }
    }

    if (sortBy === "byViews") {
      const n1 = parseInt(aColText);
      const n2 = parseInt(bColText);

      return n1 - n2 * dirModifier;
    }
  });

  // Remove all existing TRs from the table
  while (tBody.firstChild) {
    tBody.removeChild(tBody.firstChild);
  }

  // Re-add the newly sorted rows
  tBody.append(...sortedRows);

  // Remember how the column is currently sorted
  table
    .querySelectorAll("th")
    .forEach((th) => th.classList.remove("th-sort-asc", "th-sort-desc"));
  table
    .querySelector(`th:nth-child(${column + 1})`)
    .classList.toggle("th-sort-asc", asc);
  table
    .querySelector(`th:nth-child(${column + 1})`)
    .classList.toggle("th-sort-desc", !asc);
}

///////////////////////////////////////////////////

document.querySelectorAll(".table-sortable th.sort").forEach((headerCell) => {
  headerCell.addEventListener("click", () => {
    const tableElement = headerCell.parentElement.parentElement.parentElement;
    const headerIndex = Array.prototype.indexOf.call(
      headerCell.parentElement.children,
      headerCell
    );

    const sortBy = headerCell.dataset.column;
    const currentIsAscending = headerCell.classList.contains("th-sort-asc");

    sortTableByColumn(tableElement, headerIndex, sortBy, !currentIsAscending);
  });
});
