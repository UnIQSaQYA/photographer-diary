CKEDITOR.bootstrapModalFix = function (modal, $) {
  modal.on('shown', function () {
    var that = $(this).data('modal');
    $(document)
      .off('focusin.modal')
      .on('focusin.modal', function (e) {
        // Add this line
        if( e.target.className && e.target.className.indexOf('cke_') == 0 ) return;

        // Original
        if (that.$element[0] !== e.target && !that.$element.has(e.target).length) {
          that.$element.focus()
        }
      });
  });
};