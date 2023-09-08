<script type="text/javascript">
    $("#modal-caleg").on("click", "button", function(e) {
        e.preventDefault();
        let partai_id = $("#partai_id").val();
        let nama = $("#nama").val();
        let no_urut = $("#no_urut").val();
        let token = $("meta[name='csrf-token']").attr("content");
        if ($.trim(nama).length && $.trim(no_urut).length) {
            $.ajax({
                url: `/caleg-dpr`,
                type: "POST",
                dataType: "json",
                cache: false,
                data: {
                    "partai_id": partai_id,
                    "nama": nama,
                    "no_urut": no_urut,
                    "_token": token
                },
                success: function(response) {
                    if (response.success === true) {
                        let table = "";
                        $.each(response.data, function(key, value) {
                            table += `<tr id="` + value.id + `">
                                                <td class="text-center">
                                                    <input name="no_urut" type="number" value="` + value.no_urut + `"
                                                        class="form-control form-control-under border-0 ml-0 text-center d-inline urut" name="no_urut" autocomplete="off"
                                                        oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null">
                                                </td>
                                                <td class="td">
                                                    <input name="nama" value="` + value.nama + `" 
                                                    class="form-control form-control-under border-0 ml-0 nama">
                                                </td>
                                                <td class="text-center px-1">
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs btn-secondary delete-button"><i class="ri-delete-bin-line px-1"></i></button>
                                                    </div>
                                                </td>
                                            </tr>`;
                        });

                        $("#table-body-caleg").html(table);
                        $("#nama").val('');
                        $("#no_urut").val('');
                        $('#modal-caleg').modal('hide');
                        // 
                        let n = $('#' + partai_id + ' .count').val();
                        let nn = parseInt(n) + 1;
                        $('#' + partai_id + ' .count').val(nn);
                        // 
                        addToolTip('#table-body-caleg input', 'bottom', 'focus', 'press enter to save');
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
