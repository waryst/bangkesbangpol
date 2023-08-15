<script type="text/javascript">
    $('#delete-semua').on('click', function(e) {
        e.preventDefault();
        let id = $('#tps').data('quantity');
        let token = $("meta[name='csrf-token']").attr("content");
        let desa = $("#tr-" + id + " > td > input").val();
        Swal.fire({
            title: 'Anda yakin?',
            text: "Data TPS desa " + desa + " akan dihapus semua.",
            icon: 'warning',
            iconColor: '#fa5c7c',
            showCancelButton: true,
            confirmButtonColor: '#39afd1',
            cancelButtonColor: '#dadee2',
            confirmButtonText: 'Ya, hapus!!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: `/tps/` + id + `/edit`,
                    type: "GET",
                    dataType: "json",
                    cache: false,
                    data: {
                        "id": id,
                        "_token": token
                    },
                    success: function(response) {
                        let x = `${response.success}`;
                        if (x == 'true') {
                            let tps_count = `${response.tps_count}`;
                            let desa_id = $('#tps').data("quantity");
                            let table = "";
                            $("#table-body-tps").html(table);
                            $("#tr-" + desa_id + " > #tps_count").html(tps_count);

                            $("#delete-semua").addClass('d-none');

                        }
                        Swal.fire({
                            icon: `${response.type}`,
                            title: `${response.message}`,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        // let aktif = $("#desa").data("quantity");
                        // if (aktif == id) {
                        //     $("#d-input").addClass('d-none');
                        //     $("#d-list").addClass('d-none');
                        //     $("#d-cari").addClass('d-none');
                        //     $("#default").removeClass('d-none');
                        //     $("#kec_name").html('');
                        //     $("#kec_name").data("quantity", "");
                        // }
                    }
                });
            }
        });
    });

</script>
