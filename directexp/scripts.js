//declaring globals because it's 3am and I can't think of a better way to do it

//Getting value from "ajax.php".
function fill(Value) {
    //Assigning value to "search" div in "search.php" file.
    $('#search').val(Value);
    //Hiding "display" div in "search.php" file.
    $('#display').hide();
}

function fill2(Value2) {
    //Assigning value to "search" div in "search.php" file.
    $('#search2').val(Value2);
    //Hiding "display" div in "search.php" file.
    $('#display2').hide();
}

$(document).ready(function (){


    $('#confirm').on('click', function (){

    var $search = $('#search').val();
    
        if (search == "")
        {
            $('#display').html("No Location Selected")
        } 
        

        else{

            //$('#message').html($search);

            
            $.ajax({

                type: "POST",
                url: "getcoords.php",
                data: {search: $search},
                success: function(result){

                   // $('#message').html('it work');
                    //$('#message').html(result);
                    $('#coordinate').attr("value", result);
                    $("#message").html('Valid Location Confirmed')

                }
            });
            
        }


    });

    $('#confirm2').on('click', function (){

        var $search2 = $('#search2').val();

        if ($search2 == "")
        {
            $('#display2').html("No Location Selected")
        } 
        else{
            $.ajax({

                type: "POST",
                url: "getcoords.php",
                data: {search: $search2},
                success: function(result){

                    //$('#message2').html('it work');
                    //$('#message2').html(result);
                    $('#coordinate2').attr("value", result);
                    $("#message2").html('Valid Location Confirmed')
                }
            });
        }


    });


});



//bad code? maybe useful later
$(document).ready(function () {
    $("#button1").on("click", function () {

        var search = $('#search').val();
        var search = $('search2').val();

        if (search == "") {
            $('#display').html("No Location Selected")
        }

        else {
            $.ajax({

                type: "POST",

                url: "getcoords.php",

                data: { search: $('#search').val() },

                success: function (html) {

                    $('#coordinate').attr("value", html);

                }
            });
            $.ajax({

                type: "POST",

                url: "getcoords.php",

                data: { search: $('#search2').val() },

                success: function (html) {

                    $('#coordinate2').attr("value", html);

                }
            });
        }
    });


});


//origin live search bar
$(document).ready(function () {
    //On pressing a key on "Search box" in "search.php" file. This function will be called.
    $("#search").keyup(function () {
        //Assigning search box value to javascript variable named as "name".
        var name = $('#search').val();
        //Validating, if "name" is empty.
        if (name == "") {
            //Assigning empty value to "display" div in "search.php" file.
            $("#display").html("");
        }
        //If name is not empty.
        else {
            //AJAX is called.
            $.ajax({
                //AJAX type is "Post".
                type: "POST",
                //Data will be sent to "ajax.php".
                url: "ajax.php",
                //Data, that will be sent to "ajax.php".
                data: {
                    //Assigning value of "name" into "search" variable.
                    search: name
                },
                //If result found, this funtion will be called.
                success: function (html) {
                    //Assigning result to "display" div in "search.php" file.
                    $("#display").html(html).show();
                   // $("#display").append("<li value='" + id + "'>" + name + "</li>");
                }
            });
        }
    });
});
//destination live search bar
$(document).ready(function () {
    //On pressing a key on "Search box" in "search.php" file. This function will be called.
    $("#search2").keyup(function () {
        //Assigning search2 box value to javascript variable named as "name".
        var name = $('#search2').val();
        //Validating, if "name" is empty.
        if (name == "") {
            //Assigning empty value to "display" div in "search.php" file.
            $("#display2").html("");
        }
        //If name is not empty.
        else {
            //AJAX is called.
            $.ajax({
                //AJAX type is "Post".
                type: "POST",
                //Data will be sent to "ajax.php".
                url: "ajax2.php",
                //Data, that will be sent to "ajax.php".
                data: {
                    //Assigning value of "name" into "search" variable.
                    search: name
                },
                //If result found, this funtion will be called.
                success: function (html) {
                    //Assigning result to "display2" div in "search.php" file.
                    $("#display2").html(html).show();
                    //$("#display2").append("<li value='" + id + "'>" + name + "</li>");
                }
            });
        }
    });
});

//old code for janky UX. 
$(document).ready(function () {

    let origin = false;
    const $search = $('#search');
    const $originDiv = $('#originresult')
    const $destinationDiv = $('#destinationresult')

    const displayAddress = function ($el) {

        $("#input").html("Please Enter Origin Location")

        $.ajax({

            type: "POST",
            url: "getcoords.php",
            data: { search: $search.val() },
            success: function (address) {
                $el.html(address)
            },
        });

    }

    $("#button").on("click", function () {
        if (origin) {
            displayAddress($destinationDiv);
            $("#input").html("Please Enter Origin Location")
        } else {
            displayAddress($originDiv);
            $("#input").html("Please Enter Destination Location")
            origin = true;
        }
    })
});

//more bullshit code
$(document).ready(function () {

    let firstClick = true
    let success = false
    var $originCode;
    var $destCode;

    $("#button2").on("click", function () {
        if (firstClick) {

            $originCode = $('#search').val();
            firstClick = false
        }
        else {

            $destCode = $('#search').val();
            firstClick = true;
        }
    })

});

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

