<script type="text/javascript">
    $('#table-body-desa').on('click', ".delete-button", function(e) {
        e.preventDefault();
        let id = $(this).data('quantity');
        let token = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: 'Anda yakin?',
            text: "Data desa dan TPS di bawah desa ini akan dihapus semua.",
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
                    url: `/desa/` + id,
                    type: "DELETE",
                    dataType: "json",
                    cache: false,
                    data: {
                        "id": id,
                        "_token": token
                    },
                    success: function(response) {
                        let x = `${response.success}`;
                        if (x == 'true') {

                            let desa_count = `${response.desa_count}`;
                            let kecamatan_id = $('#desa').data("quantity");
                            let table = "";
                            let kec = `${response.kecamatan}`;
                            $.each(response.data, function(key, value) {
                                table += `
                                    <tr>
                                        <td class="td-i">
                                            <input id="` + value.id + `" type="text" value="` + value.title + `" class="form-control form-control-under border-0 ml-0">
                                        </td>
                                        <td class="text-center">` + value.tps_count +
                                    `</td>
                                        <td class="text-center px-1">
                                            <div class="btn-group">
                                                <button class="btn btn-xs btn-secondary delete-button" 
                                                data-quantity="` + value.id + `">
                                                    <i class="ri-delete-bin-line px-1"></i>
                                                </button>
                                            </div>
                                         </td>
                                    </tr>`;
                            });
                            $("#table-body-desa").html(table);
                            $("#tr-" + kecamatan_id + " > #desa_count").html(desa_count);
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
                        // let aktif = $("#desa").data("quantity");
                        // if (aktif == id) {
                        //     $("#d-input").addClass('d-none');
                        //     $("#d-list").addClass('d-none');
                        //     $("#d-cari").addClass('d-none');
                        //     $("#default").removeClass('d-none');
                        //     $("#kec_name").html('');
                        //     $("#kec_name").data("quantity", "");
                        // }
                        addToolTip('#table-body-desa input', 'right', 'focus', 'press enter to save');
                    }
                });
            }
        });
    });

</script>
