<script type="text/javascript">
    $("#table-body-caleg").on("click", ".delete-button", function(e) {
        e.preventDefault();
        let id = $(this).closest('tr').attr('id');
        let token = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: 'Anda yakin?',
            text: "Data caleg ini akan dihapus",
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
                    url: `/caleg-dprd2/` + id,
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
                            $.each(response.data, function(key, value) {
                                table += `          <tr id="` + value.id + `">
                                                        <td class="text-center">
                                                            <input type="number" value="` + value.no_urut + `"
                                                                class="form-control form-control-under border-0 ml-0 text-center d-inline urut"
                                                                name="no_urut" autocomplete="off"
                                                                oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null">
                                                        </td>
                                                        <td class="td">
                                                            <input value="` + value.nama + `" name="nama" class="form-control form-control-under border-0 ml-0 nama">
                                                        </td>
                                                        <td class="text-center px-1">
                                                            <div class="btn-group">
                                                                <button class="btn btn-xs btn-secondary delete-button"><i class="ri-delete-bin-line px-1"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>`;
                            });
                            $("#table-body-caleg").html(table);
                            // 
                            let partai_id = $("#partai_id").val();
                            let n = $('#' + partai_id + ' .count').val();
                            let nn = parseInt(n) - 1;
                            $('#' + partai_id + ' .count').val(nn);
                            // 
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
                        addToolTip('#table-body-caleg input', 'bottom', 'focus', 'press enter to save');
                    }
                });
            }
        });
    });

</script>
