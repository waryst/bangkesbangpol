<script type="text/javascript">
    $("#modal-kecamatan").on('click', 'button', function(e) {
        e.preventDefault();

        let kecamatan_id = $('#kecamatan').val();
        let dapil_id = $('#kecamatan').data("quantity");
        let token = $("meta[name='csrf-token']").attr("content");
        // alert(dapil_id);
        if ($.trim(kecamatan_id).length) {
            $.ajax({
                url: `/dapil/` + dapil_id,
                type: "PATCH",
                dataType: "json",
                cache: false,
                data: {
                    "kecamatan_id": kecamatan_id,
                    "_token": token
                },
                success: function(response) {
                    let x = `${response.success}`;
                    if (x == 'true') {

                        // let kecamatan_count = `${response.kecamatan_count}`;

                        let table = "";
                        $.each(response.kecamatan, function(key, value) {
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

                        let table2 = "";
                        $.each(response.dapil, function(key, value) {
                            table2 += `
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


                        $("#table-body-kecamatan").html(table);
                        $("#table-body").html(table2);
                        $("#kecamatan").val('');


                        $('.select2-selection__rendered li:not(:last-child)').remove();

                        $('#modal-kecamatan').modal('hide');
                        // $("#tr-" + dapil_id + " > #kecamatan_count").html(kecamatan_count);
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
    });

</script>
