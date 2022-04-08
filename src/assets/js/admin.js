(function($){
  if (typeof acf != 'undefined') {
    acf.add_action('ready append', function($el) {
      // array to hold list of existing ID values
      var layout_ids = [];
      // selector targets id field but not hidden clones of layouts
      var fields = $('[data-key="field_61e57af3d97d3"] .acf-input input').not('.clones [data-key="field_61e57af3d97d3"] .acf-input input');
      if (fields.length) {
        for (i=0; i<fields.length; i++) {
          var field = $(fields[i]);
          var value = field.val();
          if (value == '' || layout_ids.indexOf(value) != -1) {
            value = acf.uniqid();
            field.val(value);
            field.trigger('change');
          }
          layout_ids.push(value);
        }
      }
      
    });
  }
})(jQuery);