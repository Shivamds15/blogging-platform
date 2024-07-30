$(document).ready(function() {
    $('#password-toggle').click(function() {
        var $passwordField = $('#password');
        var $passwordIcon = $('#password-icon');
        var isPassword = $passwordField.attr('type') === 'password';
        $passwordField.attr('type', isPassword ? 'text' : 'password');
        $passwordIcon.toggleClass('fa-eye fa-eye-slash');
    });

    $('#profile_picture').change(function(e) {
        var file = e.target.files[0];
        if (file) {
            var url = URL.createObjectURL(file);
            $('#profile-picture-preview').attr('src', url);
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.delete-comment-btn', function() {
        var commentId = $(this).data('id');
        $.ajax({
            url: `/comments/${commentId}`,
            type: 'DELETE',
            success: function() {
                $(`#comment-${commentId}`).remove();
            },
            error: function() {
                alert('Error deleting comment');
            }
        });
    });

    var commentModal = new bootstrap.Modal($('#commentModal')[0]);
    $('#openCommentModal').click(function() {
        commentModal.show();
    });

    $('.cmmClose').click(function() {
        commentModal.hide();
    });

    $('#commentModal').click(function(event) {
        if (event.target === this) {
            commentModal.hide();
        }
    });
});
