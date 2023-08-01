<script type="text/javascript">
    $("#kecamatan").on("change", function(e) {
        e.preventDefault();
        let kecamatan_id = $(this).val();

        $.ajax({
            url: `/desa/` + kecamatan_id,
            type: "GET",
            dataType: "json",
            cache: false,
            success: function(response) {
                let x = `${response.success}`;
                if (x == 'true') {
                    let table = "";
                    let kec = `${response.kecamatan}`;
                    $.each(response.data, function(key, value) {
                        table +=
                            `<tr id="tr-` + value.id + `">
                                    <td class="td-i"><input class="form-control border-0 ml-0 bg-white" 
                                        value="` + value.title + `" readonly></td>
                                    <td class="text-center" id="tps_count">` + value.tps_count +
                            `</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-secondary add" 
                                            data-quantity="` + value.id + `" >
                                                <i class="mdi mdi-eye-outline px-1"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>`;
                    });
                    $("#kec_name").html("KECAMATAN <b>" + kec.toUpperCase() + "</b>");
                    $("#table-body-desa").html(table);

                    $("#d-input").addClass('d-none');
                    $("#d-list").addClass('d-none');
                    $("#d-cari").addClass('d-none');
                    $("#default").removeClass('d-none');
                }
            }
        });
    });

</script>
