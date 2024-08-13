$(document).ready(function () {
  let table = new DataTable("#myTable");

  $("#password-toggle").click(function () {
    let $passwordField = $("#password");
    let $passwordIcon = $("#password-icon");
    let isPassword = $passwordField.attr("type") === "password";
    $passwordField.attr("type", isPassword ? "text" : "password");
    $passwordIcon.toggleClass("fa-eye fa-eye-slash");
  });

  $("#profile_picture").change(function (e) {
    let file = e.target.files[0];
    if (file)
      $("#profile-picture-preview").attr("src", URL.createObjectURL(file));
  });

  $.ajaxSetup({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
  });

  $(document).on("click", ".delete-comment-btn", function () {
    let commentId = $(this).data("id");
    $.ajax({
      url: `/comments/${commentId}`,
      type: "DELETE",
      success: () => $(`#comment-${commentId}`).remove(),
      error: () => alert("Error deleting comment"),
    });
  });

  let commentModal = new bootstrap.Modal($("#commentModal")[0]);
  $("#openCommentModal").click(() => commentModal.show());
  $(".cmmClose, #commentModal").click((event) => {
    if (event.target === this || event.target.classList.contains("cmmClose"))
      commentModal.hide();
  });
});

const searchInput = document.getElementById('sidebar-search');
const sidebarItems = document.querySelectorAll('.sideSearch');
const sidebar = document.querySelector('.sidebar');

let isSidebarClosed = false;

searchInput.addEventListener('input', () => {
    const searchTerm = searchInput.value.toLowerCase();
    sidebarItems.forEach(item => {
        item.style.display = item.querySelector('.content').textContent.toLowerCase().includes(searchTerm) ? '' : 'none';
    });
});

sidebar.addEventListener('mouseover', () => {
    isSidebarClosed = false;
    setTimeout(() => {
        if (sidebar.offsetWidth > 80) searchInput.focus();
    }, 100);
});

sidebar.addEventListener('mouseout', () => {
    isSidebarClosed = true;
    setTimeout(() => {
        if (isSidebarClosed) {
            searchInput.blur();
            searchInput.value = '';
            sidebarItems.forEach(item => item.style.display = '');
        }
    }, 100);
});

document.addEventListener('mouseover', (event) => {
    if (!sidebar.contains(event.target)) isSidebarClosed = true;
});

