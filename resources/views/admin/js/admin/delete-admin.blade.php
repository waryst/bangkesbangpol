<script type="text/javascript">
    $("#table-body").on("click", ".delete-button", function(e) {
        e.preventDefault();
        let id = $(this).closest('tr').attr('id');
        let token = $("meta[name='csrf-token']").attr("content");
        let current_user_id = {{ auth()->user()->id }};
        Swal.fire({
            title: 'Anda yakin?',
            text: "User ini akan dihapus",
            icon: 'warning',
            iconColor: '#fa5c7c',
            showCancelButton: true,
            confirmButtonColor: '#39afd1',
            cancelButtonColor: '#dadee2',
            confirmButtonText: 'Ya, hapus!!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: `/user-admin/` + id,
                    type: "DELETE",
                    dataType: "json",
                    cache: false,
                    data: {
                        "id": id,
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
                                                    </div>`;
                                if (value.id != current_user_id) {
                                    table += `<div class="btn-group">
                                                        <button class="btn btn-xs btn-secondary delete-button ml-2">
                                                            <i class="ri-delete-bin-line px-1"></i>
                                                        </button>
                                                    </div>`;
                                }
                                table += `</td> </tr>`;
                            });
                            $("#table-body").html(table);
                        }

                        Swal.fire({
                            icon: `${response.type}`,
                            title: `${response.message}`,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        addToolTip('#table-body input', 'bottom', 'focus', 'press enter to save');
                    }
                });
            }
        });
    });

</script>
