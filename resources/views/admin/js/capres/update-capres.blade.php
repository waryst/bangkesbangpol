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
                        url: `/calon-presiden/` + id,
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
                                        table += `<tr id="` + value.id + `">
                                                    <td class="text-center">
                                                        <input type="number" value="` + value.no_urut + `"
                                                            class="form-control form-control-under border-0 ml-0 text-center d-inline urut"
                                                            name="no_urut" autocomplete="off"
                                                            oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null">
                                                    </td>
                                                    <td class="td">
                                                        <input type="text" value="` + value.nama_capres + `"
                                                            class="form-control form-control-under border-0 ml-0 nama_capres"
                                                            name="nama_capres" autocomplete="off">
                                                    </td>
                                                    <td class="td">
                                                        <input type="text" value="` + value.nama_cawapres + `"
                                                            class="form-control form-control-under border-0 ml-0 nama_cawapres"
                                                            name="nama_cawapres" autocomplete="off">
                                                    </td>
                                                    <td class="text-center px-2">
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs btn-secondary img-eye"
                                                                data-foto="` + value.foto + `" data-nomor="` + value.no_urut + `">
                                                                <i class="ri-eye-line px-1"></i>
                                                            </button>
                                                            <button class="btn btn-xs btn-secondary img-edit" 
                                                                data-toggle="modal" data-target="#modal-foto" data-id="` + value.id + `">
                                                                <i class="ri-image-add-line px-1"></i>
                                                            </button>
                                                        </div>
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
                                $('#' + id + ' input[name=' + field + ']').data("previous-value", value);
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
