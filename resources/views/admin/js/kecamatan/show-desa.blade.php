<script type="text/javascript">
    $("#table-body").on("click", ".add", function(e) {
        e.preventDefault();
        let kecamatan_id = $(this).data('quantity');
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
                        table += `
                            <tr>
                                <td class="td-i">
                                    <input id="` + value.id + `" type="text" value="` + value.title + `" class="form-control form-control-under border-0 ml-0">
                                </td>
                                <td class="text-center">` + value.tps_count + `</td>
                            <td class="text-center px-1">
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-secondary delete-button" data-quantity="` + value.id + `" >
                                        <i class="ri-delete-bin-line px-1"></i>
                                    </button>
                                    </div>
                                </td>
                            </tr>`;
                    });

                    $("#kec_name").html("KECAMATAN <b>" + kec.toUpperCase() + "</b>");
                    $("#table-body-desa").html(table);


                    $("#default").addClass('d-none');
                    $("#table-body tr").removeClass('bg-light2');
                    $("#table-body tr td input").removeClass('bg-light2');
                    $("#tr-" + kecamatan_id).addClass('bg-light2');
                    $("#tr-" + kecamatan_id + " > td > input").addClass('bg-light2');
                    $("#desa").data("quantity", kecamatan_id);

                    $("#d-input").removeClass('d-none');
                    $("#d-list").removeClass('d-none');
                    $("#d-cari").removeClass('d-none');

                    $('html, body').animate({
                        scrollTop: $("head").offset().top
                    }, 500);
                }
                addToolTip('#table-body-desa input', 'right', 'focus', 'press enter to save');
            }
        });
    });

</script>
