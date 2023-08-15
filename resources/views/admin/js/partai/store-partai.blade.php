<script type="text/javascript">
    $("#modal-partai").on("click", "button", function(e) {
        e.preventDefault();
        let nama = $("#nama").val();
        let singkatan = $("#singkatan").val();
        let no_urut = $("#no_urut").val();
        let token = $("meta[name='csrf-token']").attr("content");
        if ($.trim(nama).length && $.trim(singkatan).length && $.trim(no_urut).length) {
            // alert(nama + ' ' + singkatan + ' ' + no_urut);
            $.ajax({
                url: `/partai`,
                type: "POST",
                dataType: "json",
                cache: false,
                data: {
                    "nama": nama,
                    "singkatan": singkatan,
                    "no_urut": no_urut,
                    "_token": token
                },
                success: function(response) {
                    if (response.success === true) {
                        let table = "";
                        $.each(response.data, function(key, value) {
                            table += `  <tr id="` + value.id + `">
                                            <td class="text-center">
                                                <input name="no_urut" type="number" value="` + value.no_urut + `"
                                                class="form-control form-control-under border-0 ml-0 text-center d-inline urut" autocomplete="off" 
                                                oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null">
                                            </td>
                                            <td class="td">
                                                <input name="nama" type="text" value="` + value.nama + `"
                                                class="form-control form-control-under border-0 ml-0 nama" autocomplete="off">
                                            </td>
                                            <td>
                                                <input name="singkatan"  type="text" value="` + value.singkatan + `"
                                                class="form-control form-control-under border-0 ml-0 singkat" autocomplete="off">
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
                        $("#nama").val('');
                        $("#singkatan").val('');
                        $("#no_urut").val('');
                        $('#modal-partai').modal('hide');
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
