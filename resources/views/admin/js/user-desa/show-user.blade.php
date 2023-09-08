<script type="text/javascript">
    $('#kecamatan').on('select2:close', function(e) {
        e.preventDefault();
        let kecamatan_id = $(this).val();

        $.ajax({
            url: `/user-desa/` + kecamatan_id,
            type: "GET",
            dataType: "json",
            cache: false,
            success: function(response) {
                console.log(response);
                if (response.status === true) {

                    let table = "";
                    let kecamatan = `${response.kecamatan}`;
                    $.each(response.data, function(key, value) {
                        if (value.user === null) {
                            var nama = "-";
                            var email = "-";
                            var userid = "";
                        } else {
                            var nama = value.user.name;
                            var email = value.user.email;
                            var userid = value.user.id;
                        }
                        table += `<tr id="` + userid + `">
                                    <td class="td-i">
                                        <input type="text" value="` + value.title + `"
                                            class="form-control form-control-under border-0 ml-0 desa" disabled readonly>
                                    </td>
                                    <td class="td">
                                        <input type="text" value="` + nama + `"
                                            class="form-control form-control-under border-0 ml-0 name" disabled readonly>
                                    </td>
                                    <td class="td">
                                        <input type="text" value="` + email + `"
                                            class="form-control form-control-under border-0 ml-0 email" disabled readonly>
                                    </td>
                                    <td class="text-center px-2">
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-secondary pass" data-id="` + userid + `" data-toggle="modal" data-target="#modal-pass">
                                                <i class="ri-key-2-line  px-1"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>`;
                    });
                    $("#table-body").html(table);
                    $("#nama_kecamatan").html(" - KECAMATAN <b>" + kecamatan.toUpperCase() + "</b>");
                    addToolTip('#table-body input', 'bottom', 'focus', 'press enter to save');
                }
            }
        });
    });

</script>
