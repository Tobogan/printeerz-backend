function ConfirmDelete() {
  var x = confirm("Êtes-vous sûr?");
  if (x)
    return true;
  else
    return false;
}