$(document).ready(function () {
    // check current password
    
    $("#setting-confirm-password").keyup(function () {
        var currentPassword = $("#setting-confirm-password").val();
        var url = "/admin/check/current/password";

        $.ajax({
            type: "POST",
            url: url,
            data: {
                currentPassword: currentPassword
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if(response == "true") {
                    $("#confirm-password-message").html('<font color=green> Current password is correct</font>');
                } else if(response === "false") {
                    $("#confirm-password-message").html('<font color=red> Current password is incorrect</font>');
                }
            },
            error: function(error) {
                console.log(error)
            }
        });
    });
});

