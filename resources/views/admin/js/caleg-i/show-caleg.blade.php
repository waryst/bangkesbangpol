<script type="text/javascript">
    $("#table-body").on("click", ".add", function(e) {
        e.preventDefault();
        let partai_id = $(this).closest('tr').attr('id');
        let nama_partai = $("#" + partai_id + " .nama").val();
        $.ajax({
            url: `/caleg-dprd1/` + partai_id,
            type: "GET",
            dataType: "json",
            cache: false,
            success: function(response) {
                if (response.status === true) {
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


                    $("#title2").html("<b>- " + nama_partai.toUpperCase() + "</b>");
                    $("#table-body-caleg").html(table);
                    $("#partai_id").val(partai_id);
                    $("#party_name").val(nama_partai.toUpperCase());

                    $("#tools").removeClass("d-none");
                    $("#table").removeClass("d-none");
                    $("#default").addClass('d-none');

                    $("#table-body tr").removeClass('bg-light2');
                    $("#table-body tr td input").removeClass('bg-light2');

                    $("#" + partai_id).addClass('bg-light2');
                    $("#" + partai_id + " > td > input").addClass('bg-light2');
                    addToolTip('#table-body-caleg input', 'bottom', 'focus', 'press enter to save');

                    $('html, body').animate({
                        scrollTop: $("head").offset().top
                    }, 500);
                }
            }
        });
    });

</script>
