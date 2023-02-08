if (localStorage.getItem("user") == null) {
  location.href = "login.html";
} else {
  $("#email").val(localStorage.getItem("user"));
  $("#user").html(localStorage.getItem("user"));
}

$.ajax({
  url: "./php/profile.php",
  type: "POST",

  data: {
    email: window.localStorage.getItem("user"),
  },
  success: function (data) {
    $.getJSON("./php/data.json", function (data) {
      var id = data._id
      $("#dbid").val(id.$oid);
      $("#fullname").val(data.name);
      $("#dateofbirth").val(data.dateofbirth);
      $("#mobilenumber").val(data.mobile);
      $("#address").val(data.address);
      $("#pincode").val(data.pincode);


    }).fail(function () {
      console.log("check error");
    });

   
    
  },
});

function logout() {
  localStorage.removeItem("user");
  location.href = "login.html";
}

$("#submit").on("click", function (e) {
  
  console.log($("#input_form").serialize());

  e.preventDefault();
  $.ajax({
    url: "./php/profile.php",
    type: "POST",
    data: $("#input_form").serialize(),
    success: function (response) {
      $("#alerts").html(response);
       console.log(response);
    },
  });

  location.reload(true);
});