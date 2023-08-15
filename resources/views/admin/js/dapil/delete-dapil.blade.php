<script type="text/javascript">
    $('#table-body').on('click', ".delete-button", function(e) {
        e.preventDefault();
        let id = $(this).data('quantity');
        let title = $("#" + id).val();
        let token = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: 'Anda yakin?',
            text: "Data " + title + " akan dihapus.",
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
                    url: `/dapil/` + id,
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
                        let aktif = $("#kecamatan").data("quantity");
                        if (aktif == id) {
                            $("#d-input").addClass('d-none');
                            $("#d-list").addClass('d-none');
                            $("#d-cari").addClass('d-none');
                            $("#default").removeClass('d-none');
                            $("#dapil_name").html('');
                        }
                    }
                });
            }
        });
    });

</script>
