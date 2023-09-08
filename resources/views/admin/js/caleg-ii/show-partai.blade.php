<script type="text/javascript">
    $('#dapil').on('select2:close', function(e) {
        e.preventDefault();
        let dapil_id = $(this).val();
        let nama_dapil = $("#dapil option:selected").text();
        // alert(nama_dapil);
        $.ajax({
            url: `/caleg-dprd2/` + dapil_id,
            type: "GET",
            dataType: "json",
            cache: false,
            success: function(response) {
                if (response.success) {
                    let table = "";
                    $.each(response.data, function(key, value) {
                        table += `<tr id="` + value.id + `">
                                    <td class="text-center px-1">
                                        <input value="` + value.no_urut + `" class="form-control border-0 bg-white text-center urut" readonly>
                                    </td>
                                    <td class="td">
                                        <input value="` + value.nama + `" class="form-control border-0 ml-0 bg-white nama" readonly>
                                    </td>
                                    <td class="text-center px-1">
                                        <input value="` + value.jumlah_caleg + `" class="form-control border-0 bg-white text-center count" readonly>
                                    </td>
                                    <td class="text-center px-1">
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-secondary add">
                                                <i class="ri-add-fill px-1"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>`;
                    });
                    $("#table-body").html(table);


                    $("#tools").addClass("d-none");
                    $("#table").addClass("d-none");
                    $("#default").removeClass('d-none');
                    $("#default2").addClass('d-none');

                    $("#table-body tr").removeClass('bg-light2');
                    $("#table-body tr td input").removeClass('bg-light2');
                    $("#title2").html('');
                    $("#title2").html("<b>- " + nama_dapil.toUpperCase() + "</b>");

                    // $("#kec_name").html("KECAMATAN <b>" + kec.toUpperCase() + "</b>");
                    // $("#d-input").addClass('d-none');
                    // $("#d-list").addClass('d-none');
                    // $("#d-cari").addClass('d-none');
                    // $("#default").removeClass('d-none');
                }
            }
        });
    });

</script>
