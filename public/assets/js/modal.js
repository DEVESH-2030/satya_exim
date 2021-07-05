$(document).on('submit', 'form#ajax-submit', function(e) { 
      e.preventDefault();
      var data = new FormData(this);

      $.ajax({
          cache:false,
          contentType: false,
          processData: false,
          url: $(this).attr("action"),
          method: $(this).attr("method"),
          dataType: "json",
          data: data,
          success: function(response) { 
            if (response.success == 200) {
                $('div#ajax-success-alert').modal('show');
                location.reload();
            } else {
                $('div#ajax-error-alert').modal('show');
            }
          }
      }); 
});