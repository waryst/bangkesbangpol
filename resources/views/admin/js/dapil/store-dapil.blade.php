<script type="text/javascript">
    $('#dapil').keyup(function(e) {
        if (e.which == '13') {
            e.preventDefault();
            if ($.trim(this.value).length) {
                let title = $('#dapil').val();
                let token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    url: `/dapil`,
                    type: "POST",
                    dataType: "json",
                    cache: false,
                    data: {
                        "title": title,
                        "_token": token
                    },

                    success: function(response) {
                        let x = `${response.success}`;
                        if (x == 'true') {
                            let table = "";
                            $.each(response.data, function(key, value) {
                                table += `
                                <tr id="tr-` + value.id + `">
                                    <td class="td-i">
                                        <input id="` + value.id + `" type="text" value="Dapil ` + value.title + `"
                                            class="form-control bg-white border-0 ml-0" readonly>
                                    </td>
                                    <td class="text-center" id="kecamatan_count">` + value.kecamatan_count + `</td>
                                    <td class="text-center px-1">
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-secondary delete-button"
                                                data-quantity="` + value.id + `">
                                                <i class="ri-delete-bin-line px-1"></i>
                                            </button>
                                            <button class="btn btn-xs btn-secondary add"
                                                data-quantity="` + value.id + `">
                                                <i class="ri-add-fill px-1"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>`;
                            });

                            $("#table-body").html(table);
                            $("#dapil").val('');
                            $('#modal-dapil').modal('hide');

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

                    }
                });
            }
        }
    });

</script>
