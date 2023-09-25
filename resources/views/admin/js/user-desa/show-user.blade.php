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


                        table += `  <tr id="` + value.user.id + `">
                                        <td class="kecamatan">` + value.kecamatan.title + `</td>
                                        <td class="desa">` + value.title + `</td>
                                        <td class="name">` + value.user.name + `</td>
                                        <td class="username">` + value.user.email + `</td>
                                        <td class="text-center px-2">
                                            <div class="btn-group">
                                                <span class="d-none">
                                                            ` + value.kecamatan.title.replace(" ", "").toLowerCase() + `.` + value.title.replace(" ", "").toLowerCase() + `
                                                </span>
                                                <button class="btn btn-xs btn-secondary pass" data-id="` + value.user.id + `" data-toggle="modal" data-target="#modal-pass">
                                                    <i class="ri-key-2-line  px-1"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>`;
                    });
                    $("#table-body").html(table);
                    $("#nama_kecamatan").html("DATA USER OPERATOR DESA - KECAMATAN " + kecamatan.toUpperCase());
                    addToolTip('#table-body input', 'bottom', 'focus', 'press enter to save');
                }
            }
        });
    });

</script>
