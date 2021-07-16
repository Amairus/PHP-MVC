$(".form")
  .find("input, textarea")
  .on("keyup blur focus", function (e) {
    var $this = $(this),
      label = $this.prev("label");

    if (e.type === "keyup") {
      if ($this.val() === "") {
        label.removeClass("active highlight");
      } else {
        label.addClass("active highlight");
      }
    } else if (e.type === "blur") {
      if ($this.val() === "") {
        label.removeClass("active highlight");
      } else {
        label.removeClass("highlight");
      }
    } else if (e.type === "focus") {
      if ($this.val() === "") {
        label.removeClass("highlight");
      } else if ($this.val() !== "") {
        label.addClass("highlight");
      }
    }
  });

$(".tab a").on("click", function (e) {
  e.preventDefault();

  $(this).parent().addClass("active");
  $(this).parent().siblings().removeClass("active");

  target = $(this).attr("href");

  $(".tab-content > div").not(target).hide();

  $(target).fadeIn(600);
});

// var request;

// $('#signup').submit(function(event){

//   event.preventDefault();

//   if(request) {
//     request.abort();
//   }

//   var $form = $(this);
//   var $inputs = $form.find("input, select, button, textarea");
//   var $serializedData = $form.serialize();
//   $inputs.prop("disabled", true);

//   request = $.ajax({
//     url: "Signup",
//     type: "post",
//     data: $serializedData
//   });

//     // Callback handler that will be called on success
//     request.done(function (response, textStatus, jqXHR){
//       // Log a message to the console
//       console.log("Hooray, it worked!");
//   });

//   // Callback handler that will be called on failure
//   request.fail(function (jqXHR, textStatus, errorThrown){
//       // Log the error to the console
//       console.error(
//           "The following error occurred: "+
//           textStatus, errorThrown
//       );
//   });

//   // Callback handler that will be called regardless
//   // if the request failed or succeeded
//   request.always(function () {
//       // Reenable the inputs
//       $inputs.prop("disabled", false);
//   });
// });