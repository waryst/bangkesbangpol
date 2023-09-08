<script type="text/javascript">
    $("#modal-new").on("click", "#simpan", function(e) {
        e.preventDefault();
        let name = $("#modal-new #name").val();
        let email = $(" #modal-new #email").val();
        let password = $(" #modal-new #password").val();
        let token = $("meta[name='csrf-token']").attr("content");
        if ($.trim(name).length && $.trim(email).length && $.trim(password).length) {
            $.ajax({
                url: `/user-admin`,
                type: "POST",
                dataType: "json",
                cache: false,
                data: {
                    "name": name,
                    "email": email,
                    "password": password,
                    "_token": token
                },
                success: function(response) {
                    if (response.status === true) {
                        let table = "";
                        let x = 1;
                        $.each(response.data, function(key, value) {
                            table += `       <tr id="` + value.id + `">
                                                <td class="text-center">
                                                    <input type="number" value="` + x++ + `"
                                                        class="form-control form-control-under border-0 ml-0 text-center d-inline urut bg-white" name="no_urut" readonly
                                                        disabled>
                                                </td>
                                                <td class="td">
                                                    <input type="text" value="` + value.name + `"
                                                        class="form-control form-control-under border-0 ml-0 name" name="name" autocomplete="off">
                                                </td>
                                                <td class="td">
                                                    <input type="text" value="` + value.email + `"
                                                        class="form-control form-control-under border-0 ml-0 email" name="email" autocomplete="off">
                                                </td>

                                                <td class="text-center px-2">
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs btn-secondary pass" data-id="` + value.id + `" data-toggle="modal"
                                                            data-target="#modal-pass">
                                                            <i class="ri-key-2-line  px-1"></i>
                                                        </button>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs btn-secondary delete-button ml-2">
                                                            <i class="ri-delete-bin-line px-1"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>`;

                        });
                        $("#table-body").html(table);
                        $("#modal-new #name").val('');
                        $("#modal-new #email").val('');
                        $("#modal-new #password").val('');
                        $('#modal-new').modal('hide');
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
        }
    });

</script>
