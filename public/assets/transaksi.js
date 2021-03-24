var date_start = "";
var date_end = "";
var status = "all";
var table_transaksi = "";
$(document).ready(function () {
    $('#filter_date .input-daterange').datepicker({
        'format': 'yyyy-mm-dd'
    });

    $("#filter_status").change(function () {
        status = this.value;
        table_transaksi.ajax.reload();
    });

    $("#btn_filter_date").click(function () {
        date_start = $("#date_start").val();
        date_end = $("#date_end").val();
        table_transaksi.ajax.reload();
    });

    $("#btnGagal").click(function (event) {
        swal({
            title: "Pembayaran Gagal?",
            text: "Proses Ini Akan Merubah Status Pembayaran Menjadi Gagal",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            content: "input"
        }).then((value) => {
            if (value !== null) {
                konfirmasi("Gagal", 0, value);
            }
        });
    });

    $("#btnKonfirmasi").click(function (event) {
        swal({
            title: "Pembayaran Berhasil",
            text: "Kembalian",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            content: "input"
        }).then((value) => {
            if (value !== null) {
                konfirmasi("Berhasil", (value) ? value : 0);
            }
        });
    });

    $("#btnComment").click(function (event) {
        swal({
            title: "Tambah Comment",
            text: "Comment",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            content: "input"
        }).then((value) => {
            if (value !== null) {
                konfirmasi("Comment", 0, value);
            }
        });
    });

    $("#table_transaksi").on('click', '.btnDetail', function (event) {
        get_detail_by_id(this.id);
    });
    get_transaksi();
});

function get_transaksi() {
    table_transaksi = $("#table_transaksi").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{Route('transaksi')}}",
            data: function (d) {
                d.date_start = date_start;
                d.date_end = date_end;
                d.filter_status = status;
            }
        },
        "lengthChange": false,
        "order": [
            [4, 'desc']
        ],
        "columnDefs": [{
            "width": "15%",
            "targets": 1
        }, {
            "width": "10%",
            "targets": 0
        }],
        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            if (aData.status === "Pending") {
                $("td", nRow).css('background-color', '#fff0a6');
            } else if (aData.status === "Gagal" || aData.status === "Expired") {
                $("td", nRow).css('background-color', '#ffcfcf');
            } else if (aData.status === "Berhasil") {
                $("td", nRow).css('background-color', '#d7ffd7');
            }
        },
        columns: [{
            data: 'action',
            name: 'action'
        }, {
            data: 'idtrx',
            name: 'idtrx'
        }, {
            data: 'pelanggan',
            name: 'pelanggan'
        }, {
            data: 'paket',
            name: 'paket'
        }, {
            data: 'status',
            name: 'status'
        }, {
            data: 'tanggal',
            name: 'tanggal'
        }, {
            data: 'comment',
            name: 'comment'
        }]
    });
}

function get_detail_by_id(idtrx) {
    $.ajax({
        url: "{{Route('transaksi.getById')}}",
        type: "POST",
        data: {
            "idtrx": idtrx
        },
        success: (data) => {
            //do Success
            let response = $.parseJSON(data);
            if (response.status === 1) {
                let status_pembayaran = response.data.status;
                let deskripsi = $.parseJSON(response.data.deskripsi);
                $("#modalDetail").modal('show');
                $("#detail_idtrx").val(response.data.idtrx);
                $("#detail_jenis_paket").val(response.data.paket);
                $("#detail_deskripsi").html((deskripsi.from === null ? "" : deskripsi.from.deskripsi) +
                    " " + deskripsi.jenis + (deskripsi.from === null ? " " : " Ke ") +
                    deskripsi.to.deskripsi);
                $("#detail_total").html(response.data.total);
                $("#detail_status_pembayaran").html(status_pembayaran);
                $("#detail_image").attr('src', response.data.image);
                $("#detail_image_h").attr('href', response.data.image);
                $("#detail_iduser").val(response.data.iduser);
                if (status_pembayaran === "Pending") {
                    $("#btnGagal").attr('hidden', false);
                    $("#btnKonfirmasi").attr('hidden', false);
                    $("#btnComment").attr('hidden', false);
                } else {
                    $("#btnGagal").attr('hidden', true);
                    $("#btnKonfirmasi").attr('hidden', true);
                    $("#btnComment").attr('hidden', true);
                }
            } else if (response.status === 100) {
                get_detail_by_id(response.idtrx);
                table_transaksi.ajax.reload();
            } else {
                alert_info(response.message);
            }
        },
        error: (err) => {
            //do Error
            alert_error("Kesalahan Pada Server");
        }
    });
}

function konfirmasi(cmd, saldo = 0, comment = "") {
    let formData = new FormData($("#form_detail")[0]);
    formData.append('cmd', cmd);
    formData.append('saldo', saldo);
    formData.append('comment', comment);

    $.ajax({
        url: "{{Route('transaksi.konfirmasi')}}",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: (data) => {
            //do success
            let response = $.parseJSON(data);
            if (response.status === 1) {
                table_transaksi.ajax.reload();
                $("#modalDetail").modal('hide');
                alert_success(response.message);
            } else {
                alert_info(response.message);
            }
        },
        error: (err) => {
            alert_error("Kesalahan Pada Server");
        }
    });
}
