/**
 * ImagePreviewer
 *
 * Este objeto es capaz de mostrar el archivo de imagen seleccionado en un input de tipo "file".
 * Es muy útil para mostrar imágenes antes de subirlas al servidor, por ejemplo.
 */
function ImagePreviewer(fileInput) {
  this.fileInput = fileInput;
}

ImagePreviewer.prototype.render = function(whereToRenderSelector) {
  this.readUrl(whereToRenderSelector);
};

ImagePreviewer.prototype.readUrl = function(whereToRenderSelector) {
  if ( ! this.fileInput.files || ! this.fileInput.files[0]) return false;

  var reader = new FileReader();

  reader.onload = function(e) {
    $(whereToRenderSelector).attr('src', e.target.result);
  };

  reader.readAsDataURL(this.fileInput.files[0]);
};

ImagePreviewer.showPicture = function(url) {
  var dialog = new BootstrapDialog({
    message: '<img class="preview" src="' + url +'">'
  });
  dialog.realize();
  dialog.getModalHeader().hide();
  dialog.getModalFooter().hide();
  dialog.open();
};
