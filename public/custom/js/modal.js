// create modal on button tag
$(document).on('click', 'button.add_address_modal', function() { 
      $( "div.add_model" ).load( $(this).data('href'), function() { 
          $('div.add_model').modal('show');
      });
});

// create modal on anchor tag 
$(document).on('click', 'a.add_model', function() {
      $( "div.add_model" ).load( $(this).data('href'), function() {
          $('div.add_model').modal('show');
      });
});

// add modal
$(document).on('submit', 'form#add_model', function(e) { 

      e.preventDefault();
      var data = new FormData(this);
 $('#loderIcon').show();
 $('#loderButton').prop("disabled", true);

      $.ajax({
          cache:false,
          contentType: false,
          processData: false,
          url: $(this).attr("action"),
          method: $(this).attr("method"),
          dataType: "json",
          data: data,
          success: function(response) { 
             $('#loderIcon').hide();
             $('#loderButton').prop("disabled", false);
            if (response.success == 200) {
                toastr.success(response.message); 
                $('div.add_model').modal('hide');
                location.reload();
            } else {
                toastr.error(response.message);
            }
          }
      }); 
});

// edit modal on button tag
$(document).on('click', 'button.edit_model', function() {
      $( "div.edit_model" ).load( $(this).data('href'), function() {
          $('div.edit_model').modal('show');
      });
});

// edit modal on button tag
$(document).on('click', 'button.view_subscription_model', function() {
      $( "div.view_subscription_model" ).load( $(this).data('href'), function() {
          $('div.view_subscription_model').modal('show');
      });
});

// edit modal on anchor tag 
$(document).on('click', 'a.edit_model', function() {
      $( "div.edit_model" ).load( $(this).data('href'), function() {
          $('div.edit_model').modal('show');
      });
});

// edit modal
$(document).on('submit', 'form#edit_model', function(e) {
      e.preventDefault();
      var data = new FormData(this);
 $('#loderIcon').show();
 $('#loderButton').prop("disabled", true);

      $.ajax({
          cache:false,
          contentType: false,
          processData: false,
          url: $(this).attr("action"),
          method: $(this).attr("method"),
          dataType: "json",
          data: data,
          success: function(response) {
            $('#loderIcon').hide();
            $('#loderButton').prop("disabled", false);
            if (response.success == 200) {
                toastr.success(response.message);
                $('div.edit_model').modal('hide');
                location.reload();
            } else {
                toastr.error(response.message);
            }
          }
      }); 
  });

// view modal on button tag
$(document).on('click', 'button.view_model', function() {
      $( "div.view_model" ).load( $(this).data('href'), function() {
          $('div.view_model').modal('show');
      });
});

// view modal on anchor tag
$(document).on('click', 'a.view_model', function() {
      $( "div.view_model" ).load( $(this).data('href'), function() {
          $('div.view_model').modal('show');
      });
});


// add_form
$(document).on('submit', 'form#add_form', function(e) {  
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
                toastr.success(response.message); 
                //$('div.add_form').modal('hide');
                location.reload();
            } else {
                toastr.error(response.message);
            }
          }
      }); 
});


// edit_form
$(document).on('submit', 'form#edit_form', function(e) {
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
                toastr.success(response.message);
                //$('div.edit_form').modal('hide');
                location.reload();
            } else {
                toastr.error(response.message);
            }
          }
      }); 
  });




