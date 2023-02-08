$("#input_form").validate({
    rules: {
      name: {
        minlength: 2,
      },
      email: {
          email:true,
      },
      password: {
          required: true,
          minlength: 8
      },
      password_confirmation: {
          required: true,
          minlength: 8,
          equalTo: "#password"
      }
    },
    messages: {
      name: {
        required: "Please enter a name",
        minlengh: "Name atleast 2 characters",
      },
      email:"Please enter a valid email address",
      password:"Please enter atleast 8 characters",
      password_confirmation: "Password dosent match"
    },
  
    submitHandler: function (form) {
      form.submit();
    },
  });
  
  $("#submit").on("click", function (e) {
    console.log($("#input_form").serialize());   
    e.preventDefault();
    $.ajax({
      url: "./php/register.php",
      type: "POST",
      data: $("#input_form").serialize(),
  
      success: function (response) {
        if (response == "success") {
          location.href="login.html"
        } else {
          $("#alerts").html(response);
          console.log(response);
        }
      },
    });
  });