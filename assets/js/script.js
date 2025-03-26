function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const toggleBtnIcon = document.querySelector("#toggle-btn box-icon");
  const sidebarTextElements = document.querySelectorAll(".sidebar-text");

  // Use an explicit toggle flag to track the state
  if (sidebar.classList.contains("w-64")) {
    // Collapsing sidebar
    sidebar.classList.remove("w-64", "p-6"); // Remove width and padding for expanded state
    sidebar.classList.add("w-16"); // Add collapsed width
    toggleBtnIcon.setAttribute("name", "right-arrow"); // Change icon direction

    sidebarTextElements.forEach((el) => {
      el.classList.add("opacity-0"); // Hide text
      setTimeout(() => el.classList.add("hidden"), 300); // Completely hide after animation
    });
  } else if (sidebar.classList.contains("w-16")) {
    // Expanding sidebar
    sidebar.classList.remove("w-16"); // Remove collapsed width
    sidebar.classList.add("w-64", "p-6"); // Restore expanded width and padding
    toggleBtnIcon.setAttribute("name", "left-arrow"); // Change icon direction

    sidebarTextElements.forEach((el) => {
      el.classList.remove("hidden"); // Ensure text is visible
      setTimeout(() => el.classList.remove("opacity-0"), 50); // Smooth fade-in
    });
  }
}
document.addEventListener("DOMContentLoaded", () => {
  const dashboardItem = document.querySelector(".dashboard-item");
  const absensiItem = document.querySelector(".absensi-item");
  const currentUrl = window.location.pathname;

  if (currentUrl === "/tugas6pemweb/dashboard.php") {
    dashboardItem.classList.add("bg-violet-600", "text-white");
  } else if (currentUrl === "/tugas6pemweb/absensi.php") {
    absensiItem.classList.add("bg-violet-600", "text-white");
  }
});
