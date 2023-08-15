<script type="text/javascript">
    $("#table-body-desa").on("click", ".add", function(e) {
        e.preventDefault();
        let desa_id = $(this).data('quantity');
        $.ajax({
            url: `/tps/` + desa_id,
            type: "GET",
            dataType: "json",
            cache: false,
            success: function(response) {
                let x = `${response.success}`;
                if (x == 'true') {
                    let table = "";
                    let kec = `${response.kecamatan}`;
                    let count = `${response.tps_count}`;

                    $.each(response.data, function(key, value) {
                        table += `
                                <tr>
                                    <td class="td-i">
                                        <input value="TPS ` + value.title + `" class="form-control border-0 ml-0 bg-white" readonly>
                                    </td>
                                    <td class="text-center px-2">`;
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

                    $("#desa_name").html("DESA <b>" + kec.toUpperCase() + "</b>");
                    $("#table-body-tps").html(table);


                    $("#default").addClass('d-none');
                    $("#table-body-desa tr").removeClass('bg-light2');
                    $("#table-body-desa tr td input").removeClass('bg-light2');
                    $("#tr-" + desa_id).addClass('bg-light2');
                    $("#tr-" + desa_id + " > td > input").addClass('bg-light2');

                    $("#tps").data("quantity", desa_id);

                    $("#d-input").removeClass('d-none');
                    $("#d-list").removeClass('d-none');
                    $("#d-cari").removeClass('d-none');
                    $("#delete-semua").removeClass('d-none');
                    if (count < 1) {
                        $("#delete-semua").addClass('d-none');
                    }

                    $('html, body').animate({
                        scrollTop: $("body").offset().top
                    }, 500);

                }
            }
        });
    });

</script>
