<script type="text/javascript">
    $('#table-body-kecamatan').on('click', ".delete-button", function(e) {
        e.preventDefault();
        let id = $(this).data('quantity');
        let title = $("#dapil_name").html();
        let token = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: 'Anda yakin?',
            text: "Kecamatan ini akan dihapus dari " + title + ".",
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
                    url: `/kecamatan/` + id + `/edit`,
                    type: "GET",
                    dataType: "json",
                    cache: false,
                    data: {
                        "id": id,
                        "_token": token
                    },
                    success: function(response) {
                        let x = `${response.success}`;
                        if (x == 'true') {

                            let kecamatan_count = `${response.kecamatan_count}`;
                            let kecamatan_id = $('#kecamatan').data("quantity");
                            let table = "";
                            let kec = `${response.kecamatan}`;
                            $.each(response.data, function(key, value) {
                                table += `
                                            <tr>
                                                <td class="td-i">
                                                    <input id="` + value.id + `" type="text" value="` + value.title + `" class="form-control bg-white border-0 ml-0" readonly>
                                                </td>
                                                
                                                <td class="text-center px-1">
                                                    <div class="btn-group">
                                                    <button class="btn btn-xs btn-secondary delete-button" 
                                                    data-quantity="` + value.id + `" >
                                                    <i class="ri-delete-bin-line px-1"></i>
                                                    </button>
                                                    </div>
                                                </td>
                                            </tr>`;
                            });
                            $("#table-body-kecamatan").html(table);
                            $("#tr-" + kecamatan_id + " > #kecamatan_count").html(
                                kecamatan_count);
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
                    }
                });
            }
        });
    });

</script>
