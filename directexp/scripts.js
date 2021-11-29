//declaring globals because it's 3am and I can't think of a better way to do it

//Getting value from "ajax.php".
function fill(Value) {
    //Assigning value to "search" div in "search.php" file.
    $('#search').val(Value);
    //Hiding "display" div in "search.php" file.
    $('#display').hide();
}

//Getting Coordinate values from Search Bar
$(document).ready(function () {
    $("#button1").on("click", function () {

        var search = $('#search').val();

        if (search == "") {
            $('#display').html("No Location Selected")
        }

        else {
            $.ajax({

                type: "POST",

                url: "getcoords.php",

                data: { search: $('#search').val() },

                success: function (html) {

                    $('#coordresult').html(html).show();

                }
            });
        }
    });


});



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
                    $("#display").append("<li value='" + id + "'>" + name + "</li>");
                }
            });
        }
    });
});


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


$(document).ready(function () {

    let firstClick = true
    let success = false
    var $originCode;
    var $destCode;

    $("#button").on("click", function () {
        if (firstClick) {

            $originCode = $('#search').val();
            firstClick = false
        }
        else {

            $destCode = $('#search').val();
            firstClick = true;
        }
    })

    $("#directions").on("click", function () {
        ///else{
        // $('#test').append($originCode).val();
        // $('#test').append($destCode).val();
        $.ajax({
            type: "POST",
            url: 'getDirections.php',
            data: { org: $originCode, dest: $destCode },
            success: function (directions) {
                $('#urlholder').append(directions)
                success = true;

                if(success=true){

                    const $url = $('#url').val();
                    $('#test').append($url);
                    /*
                    $.ajax({
                        type: 'GET',
                        url: $url,
                        success: function(directionsResults){console.log(directionsResults);}
                    });
                    */
        }
        else $('#test').append('no work');
            },
        });

        

    
        //}

    });

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


const map = myMap();
var InfoWindow = new google.maps.InfoWindow();
function createMarker(latlng,content){
	var marker = new google.maps.Marker({position: latlng, map:map});
	marker.addListener("click", ()=>{
		InfoWindow.setContent(content);
		InfoWindow.open(map,marker);
	});
}

//sample code for directions request, should probably implement this into an ajax query
//var config = {
//    method: 'get',
//    url: 'https://maps.googleapis.com/maps/api/directions/json?origin=Toronto&destination=Montreal&key=YOUR_API_KEY',
 //   headers: { }

 //, dest: $('h5:last').val()


//if($originCode == $destCode){
//                $('#test').html('Invalid Selection: Cannot pick same location twice');
//            }


//  };
