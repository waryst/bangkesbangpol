<script type="text/javascript">
    $("#table-body").on("click", ".add", function(e) {
        e.preventDefault();
        let dapil_id = $(this).data('quantity');
        $.ajax({
            url: `/kecamatan/` + dapil_id,
            type: "GET",
            dataType: "json",
            cache: false,
            success: function(response) {
                let x = `${response.success}`;
                if (x == 'true') {
                    let table = "";
                    let dapil = `${response.dapil}`;
                    $.each(response.data, function(key, value) {
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

                    $("#dapil_name").html("DAPIL " + dapil.toUpperCase() + "");
                    $("#table-body-kecamatan").html(table);


                    $("#default").addClass('d-none');
                    $("#table-body tr").removeClass('bg-light2');
                    $("#table-body tr td input").removeClass('bg-light2');
                    $("#tr-" + dapil_id).addClass('bg-light2');
                    $("#tr-" + dapil_id + " > td > input").addClass('bg-light2');
                    $("#kecamatan").data("quantity", dapil_id);

                    $("#d-input").removeClass('d-none');
                    $("#d-list").removeClass('d-none');
                    $("#d-cari").removeClass('d-none');

                    $('html, body').animate({
                        scrollTop: $("head").offset().top
                    }, 500);
                }
            }
        });
    });

</script>
