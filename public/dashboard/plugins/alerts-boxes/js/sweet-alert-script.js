function alert_success(msg) {
    swal("Berhasil", msg, "success");
}

function alert_error(msg) {
    swal("Error", msg, "error");
}

function alert_info(msg) {
    swal("Information", msg, "info");
}

function alert_warning(msg) {
    swal("Warning", msg, "warning");
}
// $(document).ready(function () {

//     $("#alert-basic").click(function () {
//         swal("Hello world!");
//     });

//     $("#alert-title").click(function () {
//         swal("Here's the title!", "...and here's the text!");
//     });

//     $("#alert-success").click(function () {
//         swal("Good job!", "You clicked the button!,", "success");
//     });

//     $("#alert-error").click(function () {
//         swal("Somthing Wrong!", "You clicked the button!,", "error");
//     });

//     $("#alert-info").click(function () {
//         swal("Information!", "You clicked the button!,", "info");
//     });

//     $("#alert-warning").click(function () {
//         swal("Warning!", "You clicked the button!,", "warning");
//     });


//     $("#confirm-btn-alert").click(function () {

//         swal({
//                 title: "Are you sure?",
//                 text: "Once deleted, you will not be able to recover this imaginary file!",
//                 icon: "warning",
//                 buttons: true,
//                 dangerMode: true,
//             })
//             .then((willDelete) => {
//                 if (willDelete) {
//                     swal("Poof! Your imaginary file has been deleted!", {
//                         icon: "success",
//                     });
//                 } else {
//                     swal("Your imaginary file is safe!");
//                 }
//             });

//     });

// });
