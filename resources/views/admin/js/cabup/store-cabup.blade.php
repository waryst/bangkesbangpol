<script type="text/javascript">
    $("#modal-capres").on("click", "button", function(e) {
        e.preventDefault();
        var form = $('#new')[0];
        var formData = new FormData(form);
        let token = $("meta[name='csrf-token']").attr("content");

        // val
        let nama_capres = $("#modal-capres #nama_cabub").val();
        let nama_cawapres = $("#modal-capres #nama_cawabub").val();
        let no_urut = $("#modal-capres #no_urut").val();
        let foto = $("#modal-capres #foto").val();


        if ($.trim(nama_capres).length && $.trim(nama_cawapres).length && $.trim(foto).length && $.trim(no_urut).length) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });
            $.ajax({
                url: `/calon-bupati`,
                type: "POST",
                dataType: "json",
                cache: false,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === true) {
                        let table = "";
                        $.each(response.data, function(key, value) {
                            table += `      <tr id="` + value.id + `">
                                                <td class="text-center">
                                                    <input type="number" value="` + value.no_urut + `"
                                                        class="form-control form-control-under border-0 ml-0 text-center d-inline urut"
                                                        name="no_urut" autocomplete="off"
                                                        oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null">
                                                </td>
                                                <td class="td">
                                                    <input type="text" value="` + value.nama_cabub + `"
                                                        class="form-control form-control-under border-0 ml-0 nama_cabub"
                                                        name="nama_cabub" autocomplete="off">
                                                </td>
                                                <td class="td">
                                                    <input type="text" value="` + value.nama_cawabub + `"
                                                        class="form-control form-control-under border-0 ml-0 nama_cawabub"
                                                        name="nama_cawabub" autocomplete="off">
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
                        $("#nama_cabub").val('');
                        $("#nama_cawabub").val('');
                        $("#foto").val('');
                        $("#no_urut").val('');
                        $('#modal-capres').modal('hide');
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
                    addToolTip('#table-body input', 'bottom', 'focus', 'press enter to save');
                }
            });
        }
    });

</script>
