function changeview() {
  var signin = document.getElementById("signin");
  var signup = document.getElementById("signup");

  signin.classList.toggle("d-none");
  signup.classList.toggle("d-none");
}

function signup() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("email");
  var password = document.getElementById("pass");
  var mobile = document.getElementById("mobile");
  var gender = document.getElementById("gender");

  var f = new FormData();
  f.append("fname", fname.value);
  f.append("lname", lname.value);
  f.append("email", email.value);
  f.append("password", password.value);
  f.append("mobile", mobile.value);
  f.append("gender", gender.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == "Success") {
        fname.value = "";
        lname.value = "";
        email.value = "";
        password.value = "";
        mobile.value = "";
        document.getElementById("msg").innerHTML = "";
        changeview();
      } else {
        document.getElementById("msg").innerHTML = text;
      }
    }
  };

  r.open("POST", "signupprocess.php", true);
  r.send(f);
}

function signin() {
  var remember = document.getElementById("remember");
  var email = document.getElementById("em2");
  var password = document.getElementById("pass2");

  var formdata = new FormData();
  formdata.append("email", email.value);
  formdata.append("password", password.value);
  formdata.append("remember", remember.checked);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == "Success") {
        window.location = "home.php";
      } else {
        document.getElementById("msg2").innerHTML = text;
      }
    }
  };

  r.open("POST", "signinprocess.php", true);
  r.send(formdata);
}

var bm;

function forgotpassword() {
  var email = document.getElementById("em2");
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;
      if (text == "success") {
        var l = document.getElementById("loader");
        l.className = "d-none";

        alert("Verification sent! Check your inbox");
        var m = document.getElementById("forgetpassmodal");
        bm = new bootstrap.Modal(m);
        bm.show();
      } else {
        var l = document.getElementById("loader");
        l.className = "d-none";
        alert(text);
      }
    } else {
      var l = document.getElementById("loader");
      l.className = "spinner-border text-primary";
    }
  };

  r.open("GET", "forgotpassword.php?e=" + email.value, true);
  r.send();
}

function showpass1() {
  var np = document.getElementById("np");
  var npb = document.getElementById("npb");
  if (npb.innerHTML == "Show") {
    np.type = "text";
    npb.innerHTML = "Hide";
  } else {
    np.type = "password";
    npb.innerHTML = "Show";
  }
}

function showpass2() {
  var rnp = document.getElementById("rnp");
  var npb2 = document.getElementById("npb2");
  if (npb2.innerHTML == "Show") {
    rnp.type = "text";
    npb2.innerHTML = "Hide";
  } else {
    rnp.type = "password";
    npb2.innerHTML = "Show";
  }
}

function resetpassword() {
  var email = document.getElementById("em2");
  var newp = document.getElementById("np");
  var rnewp = document.getElementById("rnp");

  var verifycode = document.getElementById("vc");

  var f = new FormData();
  f.append("em", email.value);
  f.append("np", newp.value);
  f.append("rnp", rnewp.value);
  f.append("vc", verifycode.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == "success") {
        alert("Password Updated Successful");

        bm.hide();
      } else {
        alert(text);
      }
    }
  };

  r.open("POST", "resetpassword.php", true);
  r.send(f);
}

function changeimg() {
  var image1 = document.getElementById("imguploader1");
  var view1 = document.getElementById("prev1");

  var image2 = document.getElementById("imguploader2");
  var view2 = document.getElementById("prev2");

  var image3 = document.getElementById("imguploader3");
  var view3 = document.getElementById("prev3");

  image1.onchange = function () {
    var file = this.files[0];
    var url = window.URL.createObjectURL(file);

    view1.src = url;
    view1.className = "imgheight";
  };
  image2.onchange = function () {
    var file = this.files[0];
    var url = window.URL.createObjectURL(file);

    view2.src = url;
    view2.className = "imgheight";
  };
  image3.onchange = function () {
    var file = this.files[0];
    var url = window.URL.createObjectURL(file);

    view3.src = url;
    view3.className = "imgheight";
  };
}

function addproduct() {
  var category = document.getElementById("cat");
  var brand = document.getElementById("br");
  var model = document.getElementById("mod");
  var title = document.getElementById("ti");
  var condition;
  if (document.getElementById("bn").checked) {
    condition = "1";
  } else if (document.getElementById("us").checked) {
    condition = "2";
  }

  var color;
  if (document.getElementById("cl1").checked) {
    color = 1;
  } else if (document.getElementById("cl2").checked) {
    color = 2;
  } else if (document.getElementById("cl3").checked) {
    color = 3;
  } else if (document.getElementById("cl4").checked) {
    color = 4;
  } else if (document.getElementById("cl5").checked) {
    color = 5;
  } else if (document.getElementById("cl6").checked) {
    color = 6;
  }

  var quantity = document.getElementById("qty");
  var price = document.getElementById("cost");
  var delivery_within_colombo = document.getElementById("dwc");
  var delivery_outof_colombo = document.getElementById("doc");
  var description = document.getElementById("desc");
  var image1 = document.getElementById("imguploader1");
  var image2 = document.getElementById("imguploader2");
  var image3 = document.getElementById("imguploader3");

  // alert(category.value);
  // alert(brand.value);
  // alert(model.value);
  // alert(title.value);
  // alert(condition);
  // alert(color);
  // alert(quantity.value);
  // alert(price.value);
  // alert(delivery_within_colombo.value);
  // alert(delivery_outof_colombo.value);
  // alert(description.value);
  // alert(image.value);

  var form = new FormData();
  form.append("c", category.value);
  form.append("b", brand.value);
  form.append("m", model.value);
  form.append("t", title.value);
  form.append("co", condition);
  form.append("col", color);
  form.append("qty", quantity.value);
  form.append("p", price.value);
  form.append("dwc", delivery_within_colombo.value);
  form.append("doc", delivery_outof_colombo.value);
  form.append("desc", description.value);
  form.append("img1", image1.files[0]);
  form.append("img2", image2.files[0]);
  form.append("img3", image3.files[0]);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;
      if (text == "success") {
        alert("Product uploaded successfully");
      } else {
        alert(text);
      }
    }
  };

  r.open("POST", "addproductprocess.php", true);
  r.send(form);
}

// function addproduct() {
//   window.location = "addproduct.php";
// }

function signout() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;
      if (text == "success") {
        window.location = "home.php";
      }
    }
  };
  r.open("GET", "signout.php", true);
  r.send();
}

function changeproductview() {
  var add = document.getElementById("addproductbox");
  var update = document.getElementById("updateproductbox");

  add.classList.toggle("d-none");
  update.classList.toggle("d-none");
}

function updateprofile() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");
  var line1 = document.getElementById("line1");
  var line2 = document.getElementById("line2");
  var city = document.getElementById("city");
  var district = document.getElementById("district");
  var province = document.getElementById("province");
  var pc = document.getElementById("pc");
  var img = document.getElementById("profileimg");

  var form = new FormData();
  form.append("fn", fname.value);
  form.append("ln", lname.value);
  form.append("mb", mobile.value);
  form.append("l1", line1.value);
  form.append("l2", line2.value);
  form.append("img", img.files[0]);
  form.append("c", city.value);
  form.append("d", district.value);
  form.append("p", province.value);
  form.append("pc", pc.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;
      alert(text);
    }
  };

  r.open("POST", "updateprocess.php", true);
  r.send(form);
}

// toggle status change

function changestatus(id) {
  var productid = id;
  var statuslabel = document.getElementById("checklabel" + id);
  // var statuscheck = document.getElementById("check");

  // var status;
  // if (statuscheck.checked) {
  //   status = 1;
  // } else {
  //   status = 0;
  // }
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "inactive") {
        statuslabel.innerHTML = "Activate Product";
      } else if (t == "active") {
        statuslabel.innerHTML = "Deactivate Product";
      }
    }
  };

  r.open("GET", "statuschange_process.php?p=" + productid, true);
  r.send();
}

// delete popup modal
var k;
function deletemodal(id) {
  var dm = document.getElementById("deletemodal" + id);
  k = new bootstrap.Modal(dm);
  k.show();
}

// delete product

function deleteproduct(id) {
  var productid = id;
  var modal = document.getElementById("deletemodal" + id);

  k = new bootstrap.Modal(modal);
  k.show();

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        alert("Product Deleted");
        k.hide();
      }
    }
  };

  r.open("GET", "deleteproduct.php?id=" + productid, true);
  r.send();
}

//Search filters part

function load_data(page, query = "") {
  var age;
  if (document.getElementById("n").checked) age = 1;
  else if (document.getElementById("o").checked) age = 2;
  else age = 0;

  var qty;
  if (document.getElementById("l").checked) qty = 1;
  else if (document.getElementById("h").checked) qty = 2;
  else qty = 0;

  var condition;
  if (document.getElementById("b").checked) condition = 1;
  else if (document.getElementById("u").checked) condition = 2;
  else condition = 0;

  $.ajax({
    url: "search.php",
    method: "POST",
    data: {
      page: page,
      query: query,
      age: age,
      qty: qty,
      condition: condition,
    },
    success: function (data) {
      $("#products").html(data);
    },
  });
}
$(document).ready(function () {
  load_data(1);

  $(document).on("click", ".page-link", function () {
    var page = $(this).data("page_number");
    var query = $("#s").val();
    load_data(page, query);
  });

  $("#s").keyup(function () {
    var query = $("#s").val();
    load_data(1, query);
  });
});

function load_user_data(page, query = "") {
  $.ajax({
    url: "searchuser.php",
    method: "POST",
    data: {
      page: page,
      query: query,
    },
    success: function (data) {
      $("#user_data").html(data);
    },
  });
}
$(document).ready(function () {
  load_user_data(1);
  $(document).on("click", ".page-link", function () {
    var page = $(this).data("page_number");

    var query = $("#searchtext").val();
    load_user_data(page, query);
  });
  $("#searchbutton").click(function () {
    var query = $("#searchtext").val();
    load_user_data(1, query);
  });
});

// filters part

function addfilters() {
  var search = document.getElementById("s");
  var divr = document.getElementById("div1");
  var pagination = document.getElementById("pagination");

  var age;
  if (document.getElementById("n").checked) {
    age = 1;
  } else if (document.getElementById("o").checked) {
    age = 2;
  } else {
    age = 0;
  }

  var qty;
  if (document.getElementById("l").checked) {
    qty = 1;
  } else if (document.getElementById("h").checked) {
    qty = 2;
  } else {
    qty = 0;
  }

  var condition;
  if (document.getElementById("b").checked) {
    condition = 1;
  } else if (document.getElementById("u").checked) {
    condition = 2;
  } else {
    condition = 0;
  }

  var f = new FormData();
  f.append("se", search.value);
  f.append("a", age);
  f.append("q", qty);
  f.append("c", condition);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      divr.innerHTML = t;
      pagination.className = "d-none";
      // var arr = JSON.parse(t);
      // for (var i = 0; i < arr.length; i++) {
      //   var row = arr[i];
      //   alert(row["title"]);
      // }
      // var obj = JSON.parse(t);

      // alert(Object.keys(obj).length);
    }
  };

  r.open("POST", "addfilterprocess.php", true);
  r.send(f);
}

// update product

function searchtoupdate() {
  var id = document.getElementById("search").value;
  var title = document.getElementById("ti");
  var qty = document.getElementById("qty");
  var cost = document.getElementById("cost");
  var dwc = document.getElementById("dwc");
  var doc = document.getElementById("doc");
  var desc = document.getElementById("desc");
  var image_div = document.getElementById("prev");
  var image = document.getElementById("imguploader");
  // var category = document.getElementById("cat");

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;
      var object = JSON.parse(text);
      title.value = object["ti"];
      qty.value = object["qty"];
      cost.value = object["price"];
      dwc.value = object["dwc"];
      doc.value = object["doc"];
      desc.value = object["desc"];
      image_div.src = object["img"];
      image_div.className = "product-img";
      image.files[0] = object["img"];
      // category.innerHTML = object["category"];
      // alert(object["ti"]);
    }
  };
  r.open("GET", "searchtoupdate.php?id=" + id, true);
  r.send();
}

// update product

function updateproduct() {
  var id = document.getElementById("search");
  var category = document.getElementById("ca");
  var title = document.getElementById("ti");
  var qty = document.getElementById("qty");
  var cost = document.getElementById("cost");
  var dwc = document.getElementById("dwc");
  var doc = document.getElementById("doc");
  var desc = document.getElementById("desc");
  var image = document.getElementById("imguploader");

  var form = new FormData();
  form.append("id", id.value);
  form.append("c", category.value);
  form.append("t", title.value);
  form.append("qty", qty.value);
  form.append("cost", cost.value);
  form.append("dwc", dwc.value);
  form.append("doc", doc.value);
  form.append("desc", desc.value);
  form.append("img", image.files[0]);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      alert(t);
    }
  };
  r.open("POST", "updateproductprocess.php", true);
  r.send(form);
}

// send id to update product

function send_id(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "updateproduct.php";
      }
    }
  };
  r.open("GET", "sendproductprocess.php?id=" + id, true);
  r.send();
}

//load main image

function loadmainimg(id) {
  var pid = id;
  var mainimg = document.getElementById("mainimg");
  var img = document.getElementById("pimg" + pid).src;

  mainimg.style.backgroundImage = "url(" + img + ")";
}

// qty up down
function qtyinc(qty) {
  var pqty = qty;
  var input = document.getElementById("qtyinput");

  if (input.value < pqty) {
    var newval = parseInt(input.value) + 1;
    input.value = newval.toString();
  } else {
    alert("Maximum Quantity has been achieved");
  }
}

function qtydec() {
  var input = document.getElementById("qtyinput");

  if (input.value > 1) {
    var newval = parseInt(input.value) - 1;

    input.value = newval.toString();
  } else {
    alert("Minimum Quantity has been achieved");
  }
}

// home product search
// function basicsearch() {
//   var search = document.getElementById("basicsearch").value;
//   var category = document.getElementById("basiccategory").value;
//   var cardrow = document.getElementById("pdetails");
//   var cardcat = document.getElementById("pcat");

//   var r = new XMLHttpRequest();
//   r.onreadystatechange = function () {
//     if (r.readyState == 4) {
//       var t = r.responseText;
//       // alert(t);
//       cardrow.className = "d-none";
//       cardcat.className = "d-none";
//       var ar = JSON.parse(t);
//       for (var i = 0; i < ar.length; i++) {
//         var divrow = document.createElement("div");
//         divrow.className = "row";
//         var div = document.createElement("div");
//         div.className = "card col-6 col-lg-2  mt-1 mb-1 ms-1";
//         var img = document.createElement("img");
//         img.src = ar[i]["img"];
//         img.className = "card-img-top";
//         var div1 = document.createElement("div");
//         div1.className = "card-body";
//         var h5 = document.createElement("h5");
//         h5.className = "card-title";
//         h5.innerHTML = ar[i]["title"];
//         var span1 = document.createElement("span");
//         span1.innerHTML = "New";
//         var span2 = document.createElement("span");
//         span2.className = "card-text text-primary";
//         span2.innerHTML = ar[i]["price"];
//         var br = document.createElement("br");
//         var span3 = document.createElement("span");
//         span3.className = "card-text text-warning";
//         span3.innerHTML = "In Stock";
//         var input = document.createElement("input");
//         input.type = "number";
//         input.value = ar[i]["qty"];
//         input.className = "form-control mb-1";
//         var a1 = document.createElement("a");
//         a1.className = "btn btn-success";
//         a1.innerHTML = "Buy Now";
//         var a2 = document.createElement("a");
//         a2.className = "btn btn-danger";
//         a2.innerHTML = "Add To Cart";
//         divrow.appendChild(div);
//         div.appendChild(div1);
//         div.appendChild(img);
//         div1.appendChild(h5);
//         h5.appendChild(span1);
//         div1.appendChild(span2);
//         div1.appendChild(br);
//         div1.appendChild(span3);
//         div1.appendChild(input);
//         div1.appendChild(a1);
//         div1.appendChild(a2);

//         document.getElementById("pdiv").appendChild(divrow);
//       }
//     }
//   };
//   r.open("GET", "basicsearch.php?s=" + search + "&c=" + category, true);
//   r.send();
// }

function basicsearch() {
  var search = document.getElementById("basicsearch").value;
  var category = document.getElementById("basiccategory").value;
  var cardrow = document.getElementById("pdetails");
  var cardcat = document.getElementById("pcat");
  var carousel = document.getElementById("carouselmain");

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t);
      if (t == 0) {
        alert("No such product");
      } else {
        cardrow.className = "d-none";
        cardcat.className = "d-none";
        carousel.className = "d-none";
        var ar = JSON.parse(t);
        document.getElementById("pdiv").innerHTML = "";
        for (var i = 0; i < ar.length; i++) {
          document.getElementById(
            "pdiv"
          ).innerHTML += `<div class="card col-6 col-lg-2 mt-1 mb-1 ms-3" style="width: 18rem;">
                              <img src="${ar[i]["img"]}" class="card-img-top cardimg" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">${ar[i]["title"]}<span
                                                class="badge bg-primary">New</span>
                                        </h5>
                                        <span class="card-text text-primary">Rs. ${ar[i]["price"]}</span>
                                        <br>
                                        <span class="card-text text-warning">In Stock</span>
                                        <input type="number" class="form-control mb-2" value="{ar[i]["qty"]}" min="0" disabled>
                                        <a href="singleproductview.php?id=${ar[i]["id"]}"
                                            class="btn btn-success">Buy Now</a>
                                        <a href="#" class="btn btn-danger">Add To Cart</a>
                                    </div>
                                </div>`;
        }
      }
    }
  };
  r.open("GET", "basicsearch.php?s=" + search + "&c=" + category, true);
  r.send();
}

// add to watchlist

function addtowishlist(id) {
  var pid = id;
  // var heart = document.getElementById("heart");
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "wishlist.php";
        // alert(t);
        // heart.className = "text-danger";
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "addtowishlist.php?id=" + pid, true);
  r.send();
}

// remove from watch list

function removefromwatchlist(id) {
  var wid = id;

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        // window.location = "wishlist.php";
        window.location.reload();
      }
    }
  };
  r.open("GET", "removefromwishlist.php?id=" + wid, true);
  r.send();
}

// go to cart

function gotocart() {
  window.location = "cart.php";
}

// add to cart

function addtocart(id) {
  var pid = id;
  var qty = document.getElementById("qtytext" + id).value;

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "cart.php";
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "addtocartprocess.php?id=" + pid + "&qty=" + qty, true);
  r.send();
}

// remove from cart

function removefromcart(id) {
  var cid = id;
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "succcess") {
        window.location = "cart.php";
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "removefromcart.php?id=" + cid, true);
  r.send();
}

// payment gateway

function paynow(id) {
  var qty = document.getElementById("qtyinput").value;

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      var obj = JSON.parse(t);

      var email = obj["email"];
      var amount = obj["amount"];

      if (t == "1") {
        alert("Please Signin First");
        window.location = "index.php";
      } else if (t == "2") {
        alert("Please Update your Profile first");
        window.location = "userprofile.php";
      } else {
        //payhere
        // Called when user completed the payment. It can be a successful payment or failure
        payhere.onCompleted = function onCompleted(orderId) {
          console.log("Payment completed. OrderID:" + orderId);

          saveInvoice(orderId, id, email, amount, qty);

          //Note: validate the payment and show success or failure page to the customer
        };

        // Called when user closes the payment without completing
        payhere.onDismissed = function onDismissed() {
          //Note: Prompt user to pay again or show an error page
          console.log("Payment dismissed");
        };

        // Called when error happens when initializing payment such as invalid parameters
        payhere.onError = function onError(error) {
          // Note: show an error page
          console.log("Error:" + error);
        };

        // Put the payment variables here
        var payment = {
          sandbox: true,
          merchant_id: "1217900", // Replace your Merchant ID
          return_url:
            "http://localhost/mainproject/singleproductview.php?id=" + id, // Important
          cancel_url:
            "http://localhost/mainproject/singleproductview.php?id=" + id, // Important
          notify_url: "http://sample.com/notify",
          order_id: obj["id"],
          items: obj["item"],
          amount: amount + ".00",
          currency: "LKR",
          first_name: obj["fname"],
          last_name: obj["lname"],
          email: obj["email"],
          phone: obj["mobile"],
          address: obj["address"],
          city: obj["city"],
          country: "Sri Lanka",
          delivery_address: obj["address"],
          delivery_city: obj["city"],
          delivery_country: "Sri Lanka",
          custom_1: "",
          custom_2: "",
        };

        // Show the payhere.js popup, when "PayHere Pay" is clicked
        document.getElementById("payhere-payment").onclick = function (e) {
          payhere.startPayment(payment);
        };
        //payhere
      }
    }
  };
  r.open("GET", "buynowprocess.php?id=" + id + "&qty=" + qty, true);
  r.send();
}

// saveInvoice(orderId,email,amount);

function saveInvoice(orderId, id, email, amount, qty) {
  var orderid = orderId;
  var mail = email;
  var total = amount;
  var id = id;
  var pqty = qty;

  var f = new FormData();
  f.append("oid", orderid);
  f.append("pid", id);
  f.append("email", mail);
  f.append("total", total);
  f.append("pqty", pqty);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        window.location = "invoice.php?id=" + orderid;
      }
    }
  };
  r.open("POST", "saveinvoice.php", true);
  r.send(f);
}

// cart details modal

function detailsmodal(id) {
  alert(id);
}

// print invoice

function printDiv() {
  var restorepage = document.body.innerHTML;
  var page = document.getElementById("GFG").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = restorepage;
}

// feedback modal

function addfeedback(id) {
  var feedbackmodal = document.getElementById("feedbackmodal" + id);
  f = new bootstrap.Modal(feedbackmodal);
  f.show();
}

// save feedback
var f;
function savefeedback(id) {
  var pid = id;
  var feedtext = document.getElementById("feedtext" + id).value;

  var form = new FormData();
  form.append("i", pid);
  form.append("t", feedtext);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        f.hide();
      } else {
        alert("Please enter some feedback");
      }
    }
  };
  r.open("POST", "savefeedback.php", true);
  r.send(form);
}

// admin verifivation
function adminVerification() {
  var e = document.getElementById("e").value;

  var form = new FormData();
  form.append("e", e);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == "Success") {
        var verificationModal = document.getElementById("verificationModal");
        k = new bootstrap.Modal(verificationModal);

        k.show();
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "adminVerificationProcess.php", true);
  r.send(form);
}

// very with email
function verify() {
  var v = document.getElementById("vc").value;
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == "success") {
        k.hide();
        window.location = "adminPanel.php";
      } else {
        alert(text);
      }
    }
  };
  r.open("GET", "verifyProcess.php?v=" + v, true);
  r.send();
}

// block user

function blockuser(email) {
  var mail = email;

  var blockbtn = document.getElementById("blb" + mail);

  var f = new FormData();
  f.append("e", mail);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "2") {
        blockbtn.className = "btn btn-danger";
        blockbtn.innerHTML = "Block";
      } else {
        blockbtn.className = "btn btn-success";
        blockbtn.innerHTML = "Unblock";
      }
    }
  };
  r.open("POST", "userblockprocess.php", true);
  r.send(f);
}

// block product

function blockproduct(id) {
  var id = id;

  var blockbtn = document.getElementById("blb" + id);

  var f = new FormData();
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "2") {
        blockbtn.className = "btn btn-danger";
        blockbtn.innerHTML = "Block";
      } else {
        blockbtn.className = "btn btn-success";
        blockbtn.innerHTML = "Unblock";
      }
    }
  };
  r.open("POST", "productblockprocess.php", true);
  r.send(f);
}

// search user in manage users

function searchuser() {
  var text = document.getElementById("searchtext").value;

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "manageusers.php";
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "searchuser.php?s=" + text, true);
  r.send();
}

// advanced search

function advancedsearch() {
  var keyword = document.getElementById("k").value;
  var category = document.getElementById("c").value;
  var brand = document.getElementById("b").value;
  var model = document.getElementById("m").value;
  var condition = document.getElementById("con").value;
  var color = document.getElementById("clr").value;
  var pricefrom = document.getElementById("pf").value;
  var priceto = document.getElementById("pt").value;

  var result = document.getElementById("result");

  var f = new FormData();
  f.append("k", keyword);
  f.append("c", category);
  f.append("b", brand);
  f.append("m", model);
  f.append("con", condition);
  f.append("clr", color);
  f.append("pf", pricefrom);
  f.append("pt", priceto);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      result.innerHTML = t;
    }
  };
  r.open("POST", "advancedsearchprocess.php", true);
  r.send(f);
}

// daily sellings

function dailysellings() {
  var from = document.getElementById("sf").value;
  var to = document.getElementById("st").value;
  var link = document.getElementById("historylink");

  link.href = "sellinghistory.php?f=" + from + "&t=" + to;
}

// advanced jquey search
function advanced_jsearch(page, query = "") {
  category = $("#c").val();
  brand = $("#b").val();
  model = $("#m").val();
  condition = $("#con").val();
  color = $("#clr").val();
  pfrom = $("#pf").val();
  pto = $("#pt").val();

  $.ajax({
    url: "advancedsearchjq.php",
    method: "POST",
    data: {
      page: page,
      query: query,
      category: category,
      brand: brand,
      condition: condition,
      color: color,
      pfrom: pfrom,
      pto: pto,
      model: model,
    },
    success: function (data) {
      $("#result").html(data);
    },
  });
}

$(document).on("click", ".page-link", function () {
  var page = $(this).data("page_number");
  var query = $("#k").val();
  advanced_jsearch(page, query);
});

$("#advancedsearchbutton").click(function () {
  var query = $("#k").val();
  advanced_jsearch(1, query);
});

// send messages

function sendmessage(mail, msgid) {
  var email = mail;
  var msgtxt = document.getElementById(msgid).value;

  var f = new FormData();
  f.append("e", email);
  f.append("t", msgtxt);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById(msgid).value = "";
    }
  };

  r.open("POST", "sendmessageprocess.php", true);
  r.send(f);
}

// refres msg view area

function refreshmsgare(mail, msgdiv) {
  var chatrow = document.getElementById(msgdiv);

  var f = new FormData();
  f.append("e", mail);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      chatrow.innerHTML = t;
    }
  };

  r.open("POST", "refreshmsgareaprocess.php", true);
  r.send(f);
}
// refresher
function refresher(email, msgdiv) {
  setInterval(function () {
    refreshmsgare(email, msgdiv);
  }, 1000);
  setInterval(refreshrecentarea, 1000);
}
// refreshrecentarea
function loadmessages(email, msgdiv) {
  setInterval(function () {
    refreshmsgare(email, msgdiv);
  }, 1000);
}
function refreshrecentarea() {
  var rcv = document.getElementById("rcv");

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      rcv.innerHTML = t;
    }
  };

  r.open("POST", "refreshrecentareaprocess.php", true);
  r.send();
}

// view mesaage modal in manage users

function viewmsgmodal(email) {
  var pop = document.getElementById("msgmodal" + email);
  k = new bootstrap.Modal(pop);
  k.show();
}

// goo too messages.php

function gotomessages(email) {
  alert(email);
}

// add new category modal

function addnewmodal() {
  var catmodal = document.getElementById("catmodal");
  k = new bootstrap.Modal(catmodal);
  k.show();
}

// save category

function savecategory() {
  var category = document.getElementById("categorytext").value;

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        k.hide();
        alert("Category added successfully");
        window.location = "manageProduct.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "addnewcategory.php?t=" + category, true);
  r.send();
}

// single view modal in manage product php

function singleviewmodal(id) {
  var modal = document.getElementById("singleproductview" + id);

  k = new bootstrap.Modal(modal);
  k.show();
}

//basic search
function basicsearch(page) {
  category = $("#basiccategory").val();
  query = $("#basicsearch").val();

  $.ajax({
    url: "basicsearchjquery.php",
    method: "POST",
    data: {
      page: page,
      query: query,
      category: category,
    },
    success: function (data) {
      $("#carouselmain").hide();
      $("#load").html(data);
    },
  });
}

$(document).on("click", ".page-link", function () {
  var page = $(this).data("page_number");
  basicsearch(page);
});

$("#searchbutton").click(function () {
  basicsearch(1);
});

//manage products
function manage_products(page) {
  $.ajax({
    url: "searchproductj.php",
    method: "POST",
    data: {
      page: page,
    },
    success: function (data) {
      $("#manageproductload").html(data);
    },
  });
}

$(document).on("click", ".page-link", function () {
  var page = $(this).data("page_number");
  manage_products(page);
});

manage_products(1);
