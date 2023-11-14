<script type="text/javascript">
    $("#table-body").on("click", ".pass", function(e) {
        e.preventDefault();
        let id = $(this).data("id");
        let email = $(this).data("user");
        $("#modal-pass #xmail").val(email);
        $("#modal-pass button").data('id', id);
    });


    // -------------------------------------------------------------------------------


    $("#modal-pass").on("click", "#simpan-password", function(e) {
        e.preventDefault();
        let id = $(this).data("id");
        let password = $("#modal-pass #new_password").val();
        let password_confirmation = $("#modal-pass #confirm_password").val();
        let token = $("meta[name='csrf-token']").attr("content");
        if ($.trim(password).length && password === password_confirmation) {
            $.ajax({
                url: `/user-desa/` + id,
                type: "PATCH",
                dataType: "json",
                cache: false,
                data: {
                    "password": password,
                    "password_confirmation": password_confirmation,
                    "_token": token
                },
                success: function(response) {
                    if (response.status === true) {
                        $("#modal-pass button").data('id', '');
                        $("#new_password").val('');
                        $("#new_password").attr("type", "password");
                        $("#confirm_password").val('');
                        $("#confirm_password").attr("type", "password");
                        $('#modal-pass').modal('hide');

                        $(".eye").html('<i class="mdi mdi-eye-outline"></i>');
                    }
                    setTimeout(
                        function() {
                            Swal.fire({
                                icon: `${response.type}`,
                                title: `${response.message}`,
                                showConfirmButton: false,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }, 700);
                    addToolTip('#table-body input', 'bottom', 'focus', 'press enter to save');
                }
            });
        } else {
            setTimeout(
                function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal, password tidak sama.',
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }, 700);
        }

    });
</script>
