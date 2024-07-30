$(function() {
    $('#password-toggle').on('click', function() {
        var $passwordField = $('#password');
        var $passwordIcon = $('#password-icon');
        var isPassword = $passwordField.attr('type') === 'password';
        $passwordField.attr('type', isPassword ? 'text' : 'password');
        $passwordIcon.toggleClass('fa-eye fa-eye-slash');
    });
});

$(function() {
    $('#profile_picture').on('change', function(e) {
        const file = e.target.files[0];
        let url = window.URL.createObjectURL(file);
        $('#profile-picture-preview').attr('src', url);
    });
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.delete-comment-btn', function() {
    const commentId = $(this).data('id');
    $.ajax({
        url: `/comments/${commentId}`,
        type: 'DELETE',
        success: function(response) {
            $(`#comment-${commentId}`).remove(); 
        },
        error: function(response) {
            alert('Error deleting comment');
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var openModalButton = document.getElementById('openCommentModal');
    var commentModal = new bootstrap.Modal(document.getElementById('commentModal'));
    
    var modalElement = document.getElementById('commentModal');

    openModalButton.addEventListener('click', function () {
        commentModal.show();
    });

    document.querySelector('.cmmClose').addEventListener('click', function() {
        commentModal.hide();
    });
    
    modalElement.addEventListener('click', function (event) {
        if (event.target === modalElement) {
            commentModal.hide();
        }
    });
});