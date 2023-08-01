<script type="text/javascript">
    $('#tps').keyup(function(e) {
        if (e.which == '13') {
            e.preventDefault();
            if ($.trim(this.value).length) {
                let jml = $('#tps').val();
                let desa_id = $('#tps').data("quantity");
                let token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    url: `/tps`,
                    type: "POST",
                    dataType: "json",
                    cache: false,
                    data: {
                        "jml": jml,
                        "desa_id": desa_id,
                        "_token": token
                    },
                    success: function(response) {
                        let x = `${response.success}`;
                        if (x == 'true') {
                            let tps_count = `${response.tps_count}`;
                            let table = "";
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
                            $("#tps").val('');
                            $('#modal-tps').modal('hide');
                            $("#tr-" + desa_id + " > #tps_count").html(tps_count);
                            $("#delete-semua").removeClass('d-none');
                            if (tps_count < 1) {
                                $("#delete-semua").addClass('d-none');
                            }
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
