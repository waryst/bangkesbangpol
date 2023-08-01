<script type="text/javascript">
    $("#table-body").on("keypress", "input", function(e) {
        if (e.which == '13') {
            e.preventDefault();
            if ($.trim(this.value).length) {
                let id = $(this).attr('id');
                let title = $(this).val();
                let token = $("meta[name='csrf-token']").attr("content");
                $(this).blur();
                // alert(source);
                $.ajax({
                    url: `/kecamatan/` + id,
                    type: "PATCH",
                    dataType: "json",
                    cache: false,
                    data: {
                        "title": title,
                        "_token": token
                    },
                    success: function(response) {
                        let x = `${response.success}`;
                        if (x != 'duplicate') {
                            var post = `${response.data}`;
                            $("#" + id).val(post);
                            Swal.fire({
                                type: `${response.type}`,
                                icon: `${response.type}`,
                                title: `${response.message}`,
                                showConfirmButton: false,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });

                            let aktif = $("#desa").data("quantity");
                            if (aktif == id) {
                                $("#kec_name").html(post);
                            }
                        }

                    }
                });
            }
        }
    });

</script>
