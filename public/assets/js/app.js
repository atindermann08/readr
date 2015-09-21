$('div.alert').hide();
$('div.alert').delay(300).fadeIn(400);
$('div.alert').not('.alert-important').delay(3000).slideUp(500);

// $('#confirmationModal').modal();
document.getElementById('image').onchange = function () {
    document.getElementById('uploadImageLbl').innerHTML = this.value;
};



$(".single-select").select2();
$(".book-title-select").select2({
  allowClear: true,
  placeholder: 'Add Book title(s) to your library(separated by comma)',
  tokenSeparators: [','],
  tags: true
});

$(".book-title-select-book-club").select2({
  allowClear: true,
  placeholder: 'Add Book title(s) to Book Club(separated by comma)',
  tokenSeparators: [',']
});

$(".multi-select-book-club").select2({
  allowClear: true,
  tokenSeparators: [','],
});

$(".multi-select-authors").select2({
  allowClear: true,
  placeholder: 'Add Single or Multiple Authors(separated by comma)',
  tokenSeparators: [','],
  tags: true
});
