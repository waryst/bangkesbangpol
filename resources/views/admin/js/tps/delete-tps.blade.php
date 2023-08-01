<script type="text/javascript">
    $('#table-body-tps').on('click', ".delete-button", function(e) {
        e.preventDefault();
        let id = $(this).data('quantity');
        let token = $("meta[name='csrf-token']").attr("content");

        Swal.fire({
            title: 'Anda yakin?',
            text: "Data TPS ini akan dihapus semua.",
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
                    url: `/tps/` + id,
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
                            let tps_count = `${response.tps_count}`;
                            let desa_id = $('#tps').data("quantity");
                            let table = "";
                            let kec = `${response.kecamatan}`;
                            $.each(response.data, function(key, value) {
                                table += `
                                <tr>
                                    <td class="td-i">
                                        <input value="TPS ` + value.title + `" class="form-control border-0 ml-0 bg-white" readonly>
                                    </td>
                                    <td class="text-center">`;
                                if (key === 0) {
                                    table += `<div class="btn-group">
                                            <button class="btn btn-xs btn-secondary delete-button" 
                                            data-quantity="` + value.id + `" >
                                            <i class="ri-delete-bin-line px-1"></i>
                                            </button>
                                        </div>`;
                                }
                                table += `   </td>
                                 </tr>`;
                            });
                            $("#table-body-tps").html(table);
                            $("#tr-" + desa_id + " > #tps_count").html(tps_count);

                            $("#delete-semua").removeClass('d-none');
                            if (tps_count < 1) {
                                $("#delete-semua").addClass('d-none');
                            }
                        }
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
                        // let aktif = $("#desa").data("quantity");
                        // if (aktif == id) {
                        //     $("#d-input").addClass('d-none');
                        //     $("#d-list").addClass('d-none');
                        //     $("#d-cari").addClass('d-none');
                        //     $("#default").removeClass('d-none');
                        //     $("#kec_name").html('');
                        //     $("#kec_name").data("quantity", "");
                        // }
                    }
                });
            }
        });
    });

</script>
