$('div.alert').not('.alert-important').delay(3000).slideUp(300);

$(".multi-select").select2({
  allowClear: true,
  tokenSeparators: [','],
  tags: true
});

//
// function formatBook (book) {
//   return book.title;
// }
//
// function formatBookSelection (book) {
//   return book.title;
// }
//
// $(".book-title-remote").select2({
//   placeholder: "Add Book",
//   allowClear: true,
//   tags: true,
//   tokenSeparators: [','],
//   ajax: {
//     url: "/api/books/q",
//     dataType: 'json',
//     delay: 250,
//     data: function (params) {
//       return {
//         //q: params.term, // search term
//       };
//     },
//     processResults: function (data) {
//       // parse the results into the format expected by Select2.
//       // since we are using custom formatting functions we do not need to
//       // alter the remote JSON data
//       return {
//         results: data
//       };
//     },
//     cache: true
//   },
//   escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
//   minimumInputLength: 0,
//   templateResult: formatBook, // omitted for brevity, see the source of this page
//   templateSelection: formatBookSelection // omitted for brevity, see the source of this page
// });
