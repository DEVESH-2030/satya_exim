    // Destroy on anchor
$(document).on('click', 'button#deactivate', function(e) {
  e.preventDefault();

    swal({
        title         : "Are You Sure",
        text          : "Do You Want To Inctive ?",
        icon          : "warning",
        buttons       : true,
        dangerMode    : true,
    })
    .then((willDelete) => {
        if (willDelete) {
          $.ajax({
              url         : $(this).attr("href"),
              method      : 'POST',
              dataType    : "json",
              success     : function(response) {
                  if (response.success == 200) {

                    swal("Good job!", ""+response.message+"", "success");

                    setInterval(function(){
                      location.reload(true);
                    }, 2000);

                  } // end success if
              } // end success function.
          }); // end ajax .
        } else {
          // Write something here.
        }
    }); // End then.
}); // end Document.

// Destroy on anchor
$(document).on('click', 'button#activate', function(e) {
  e.preventDefault();

    swal({
        title         : "Are You Sure",
        text          : "Do You Want To Active ?",
        icon          : "warning",
        buttons       : true,
        dangerMode    : true,
    })
    .then((willDelete) => {
        if (willDelete) {
          $.ajax({
              url         : $(this).attr("href"),
              method      : 'POST',
              dataType    : "json",
              success     : function(response) {
                  if (response.success == 200) {

                    swal("Good job!", ""+response.message+"", "success");

                    setInterval(function(){
                      location.reload(true);
                    }, 2000);

                  } // end success if
              } // end success function.
          }); // end ajax .
        } else {
          // Write something here.
        }
    }); // End then.
}); // end Document.



    // Destroy on anchor
$(document).on('click', 'button#approve', function(e) {
  e.preventDefault();

    swal({
        title         : "Are You Sure",
        text          : "Do You Want To Approved ?",
        icon          : "warning",
        buttons       : true,
        dangerMode    : true,
    })
    .then((willDelete) => {
        if (willDelete) {
          $.ajax({
              url         : $(this).attr("href"),
              method      : 'POST',
              dataType    : "json",
              success     : function(response) {
                  if (response.success == 200) {

                    swal("Good job!", ""+response.message+"", "success");

                    setInterval(function(){
                      location.reload(true);
                    }, 2000);

                  } // end success if
              } // end success function.
          }); // end ajax .
        } else {
          // Write something here.
        }
    }); // End then.
}); // end Document.

// Destroy on anchor
$(document).on('click', 'button#reject', function(e) {
  e.preventDefault();

    swal({
        title         : "Are You Sure",
        text          : "Do You Want To Reject ?",
        icon          : "warning",
        buttons       : true,
        dangerMode    : true,
    })
    .then((willDelete) => {
        if (willDelete) {
          $.ajax({
              url         : $(this).attr("href"),
              method      : 'POST',
              dataType    : "json",
              success     : function(response) {
                  if (response.success == 200) {

                    swal("Good job!", ""+response.message+"", "success");

                    setInterval(function(){
                      location.reload(true);
                    }, 2000);

                  } // end success if
              } // end success function.
          }); // end ajax .
        } else {
          // Write something here.
        }
    }); // End then.
}); // end Document.



// Featured Product change status

    // Destroy on anchor
$(document).on('click', 'button#unfeatured', function(e) {
  e.preventDefault();

    swal({
        title         : "Are You Sure",
        text          : "Do You Want To Unfeatured ?",
        icon          : "warning",
        buttons       : true,
        dangerMode    : true,
    })
    .then((willDelete) => {
        if (willDelete) {
          $.ajax({
              url         : $(this).attr("href"),
              method      : 'POST',
              dataType    : "json",
              success     : function(response) {
                  if (response.success == 200) {

                    swal("Good job!", ""+response.message+"", "success");

                    setInterval(function(){
                      location.reload(true);
                    }, 2000);

                  } // end success if
              } // end success function.
          }); // end ajax .
        } else {
          // Write something here.
        }
    }); // End then.
}); // end Document.

// Destroy on anchor
$(document).on('click', 'button#featured', function(e) {
  e.preventDefault();

    swal({
        title         : "Are You Sure",
        text          : "Do You Want To Featured ?",
        icon          : "warning",
        buttons       : true,
        dangerMode    : true,
    })
    .then((willDelete) => {
        if (willDelete) {
          $.ajax({
              url         : $(this).attr("href"),
              method      : 'POST',
              dataType    : "json",
              success     : function(response) {
                  if (response.success == 200) {

                    swal("Good job!", ""+response.message+"", "success");

                    setInterval(function(){
                      location.reload(true);
                    }, 2000);

                  } // end success if
              } // end success function.
          }); // end ajax .
        } else {
          // Write something here.
        }
    }); // End then.
}); // end Document.

