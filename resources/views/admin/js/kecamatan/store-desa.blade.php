<script type="text/javascript">
    $('#desa').keyup(function(e) {
        if (e.which == '13') {
            e.preventDefault();
            if ($.trim(this.value).length) {
                let title = $('#desa').val();
                let kecamatan_id = $('#desa').data("quantity");
                let token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    url: `/desa`,
                    type: "POST",
                    dataType: "json",
                    cache: false,
                    data: {
                        "title": title,
                        "kecamatan_id": kecamatan_id,
                        "_token": token
                    },
                    success: function(response) {
                        let x = `${response.success}`;
                        if (x == 'true') {

                            let desa_count = `${response.desa_count}`;

                            let table = "";
                            $.each(response.data, function(key, value) {
                                table += `
                                    <tr>
                                        <td class="td-i">
                                            <input id="` + value.id + `" type="text" value="` + value.title + `" class="form-control form-control-under border-0 ml-0">
                                        </td>
                                        <td class="text-center">` + value.tps_count +
                                    `</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button class="btn btn-xs btn-secondary delete-button" 
                                                data-quantity="` + value.id + `" >
                                                    <i class="ri-delete-bin-line px-1"></i>
                                                </button>
                                            </div>
                                         </td>
                                    </tr>`;
                            });

                            $("#table-body-desa").html(table);
                            $("#desa").val('');
                            $("#cari_desa").val('');
                            $('#modal-desa').modal('hide');
                            $("#tr-" + kecamatan_id + " > #desa_count").html(desa_count);
                        }
                        setTimeout(
                            function() {
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
                            }, 700);
                    }
                });
            }
        }
    });

</script>
