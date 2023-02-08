$("#input_form").validate({
    rules: {
      email: {
        email: true,
      },
    },
    messages: {
      email: "Please enter a valid email address",
    },

    submitHandler: function (form) {
      form.submit();
    },
  });

  $("#submit").on("click", function (e) {
    e.preventDefault();
    var email = $("#email").val();
    $.ajax({
      url: "./php/login.php",
      type: "POST",
      data: $("#input_form").serialize(),

      success: function (response) {
        if (response == "success") {
          console.log(email);
          localStorage.setItem("user", email);
          location.href="profile.html"
        } else {
          $("#alerts").html(response);
          console.log(response);
        }
      },
    });
  });