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
                        url: `/partai/` + id,
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
                                //status success, repopulate table
                                if (response.data !== null) {
                                    $('#' + id + ' input[name=' + field + ']').blur();
                                    let table = "";
                                    $.each(response.data, function(key, value) {
                                        table += `  <tr id="` + value.id + `">
                                                        <td class="text-center">
                                                            <input name="no_urut"  type="number" value="` + value.no_urut + `"
                                                            class="form-control form-control-under border-0 ml-0 text-center d-inline urut" autocomplete="off"
                                                            oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null">
                                                        </td>
                                                        <td class="td">
                                                            <input  name="nama" type="text" value="` + value.nama + `"
                                                            class="form-control form-control-under border-0 ml-0 nama" autocomplete="off">
                                                        </td>
                                                        <td>
                                                            <input name="singkatan" type="text" value="` + value.singkatan + `"
                                                            class="form-control form-control-under border-0 ml-0 singkat" autocomplete="off">
                                                        </td>
                                                        <td class="text-center px-2">
                                                            <div class="btn-group">
                                                                <button class="btn btn-xs btn-secondary delete-button">
                                                                    <i class="ri-delete-bin-line px-1"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>`;
                                    });
                                    $("#table-body").html(table);
                                }
                                $('#' + id + ' input[name=' + field + ']').data("previous-value", value.toUpperCase());
                                $('#' + id + ' input[name=' + field + ']').blur();
                            }
                            if (response.status == 'duplicate') {
                                //status duplicate, reset input val to previous value
                                // $('#' + id + ' input[name=' + field + ']').val(original_value);
                            }

                            if (response.status != 'fail') {
                                Swal.fire({
                                    icon: `${response.type}`,
                                    title: `${response.message}`,
                                    showConfirmButton: false,
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            }
                            //status fail, reset to previous value, blur. nothing happen

                            addToolTip('#table-body input', 'bottom', 'focus', 'press enter to save');
                        }
                    });
                }
            }
        }
    });

</script>
