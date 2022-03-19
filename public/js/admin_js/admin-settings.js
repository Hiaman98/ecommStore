$(document).ready(function () {
    // check current password
    
    $("#setting-current-password").keyup(function () {
        var currentPassword = $("#setting-current-password").val();
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
                    $("#current-password-message").html('<font color=green> Current password is correct</font>');
                } else if(response === "false") {
                    $("#current-password-message").html('<font color=red> Current password is incorrect</font>');
                }
            },
            error: function(error) {
                console.log(error)
            }
        });
    });
});

