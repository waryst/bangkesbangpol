<script>
    $("#table-body").on("keyup", "input", function(e) {
        if (e.which == '13') {
            e.preventDefault();
            if ($.trim(this.value).length) {
                let id = $(this).closest('tr').attr('id');
                let field = $(this).attr('name');
                let value = $(this).val();
                let token = $("meta[name='csrf-token']").attr("content");
                let original_value = $('#' + id + ' input[name=' + field + ']').data("previous-value");
                if ($.trim(value) != $.trim(original_value)) {
                    $.ajax({
                        url: `/user-admin/` + id,
                        type: "PATCH",
                        dataType: "json",
                        cache: false,
                        data: {
                            "field": field,
                            "value": value,
                            "_token": token
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                if (response.data !== null) {
                                    $('#' + id + ' input[name=' + field + ']').blur();
                                    let table = "";
                                    let x = 1;
                                    $.each(response.data, function(key, value) {
                                        table += `      <tr id="` + value.id + `">
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
                                }
                                $('#' + id + ' input[name=' + field + ']').data("previous-value", value);
                                $('#' + id + ' input[name=' + field + ']').blur();
                            }
                            // if (response.status == 'duplicate') {}
                            // if (response.status != 'fail') {
                            Swal.fire({
                                icon: `${response.type}`,
                                title: `${response.message}`,
                                showConfirmButton: false,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            // }
                            addToolTip('#table-body input', 'bottom', 'focus', 'press enter to save');
                        }
                    });
                }
            }
        }
    });

</script>
