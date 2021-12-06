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



//directions request
$(document).ready(function () {


    $('#confirm').on('click', function () {

        var $search = $('#search').val();

        if (search == "") {
            $('#display').html("No Location Selected")
        }


        else {

            //$('#message').html($search);


            $.ajax({

                type: "POST",
                url: "getcoords.php",
                data: { search: $search },
                success: function (result) {

                    $('#coordinate').attr("value", result);
                    $("#message").html('Valid Location Confirmed')

                }
            });

        }


    });

    $('#confirm2').on('click', function () {

        var $search2 = $('#search2').val();

        if ($search2 == "") {
            $('#display2').html("No Location Selected")
        }
        else {
            $.ajax({

                type: "POST",
                url: "getcoords.php",
                data: { search: $search2 },
                success: function (result) {


                    $('#coordinate2').attr("value", result);
                    $("#message2").html('Valid Location Confirmed')
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

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function () {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

//map callback function. anything relating to the map goes here
function myMap() {

    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();

    var mapProp = {
        center: new google.maps.LatLng('32.8275', '-83.6494'),
        zoom: 16,
        //does the hide thing
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: [{
            "featureType": "poi",
            "stylers": [{
                "visibility": "off"
            }]
        }]


    };

    var map = new google.maps.Map(document.getElementById("map"), mapProp);
    directionsRenderer.setMap(map);

    let markers = {};
    let infowindows = {};



    const coordsArr = JSON.parse($('#totalCoords').text());

    for (let i = 1; i < coordsArr.length; i++) {

        const coord = coordsArr[i];
        markers[coord.bcode] = new google.maps.Marker({
            position: new google.maps.LatLng(coord.lat, coord.lon),
            title: coord.bcode
        });

        infowindows[coord.bcode] = new google.maps.InfoWindow({ content: coord.bcode + " - " + coord.bname });

        markers[coord.bcode].setMap(map);
        markers[coord.bcode].addListener("mouseover", () => { infowindows[coord.bcode].open({ anchor: markers[coord.bcode], map }) });
        markers[coord.bcode].addListener("mouseout", () => { infowindows[coord.bcode].close() });
        markers[coord.bcode].addListener("click", () => { showInfoDiv(coord.indx) });
    }

    $("#directions").on('click', function () {

        var $origin = $('#coordinate').val();
        var $destination = $('#coordinate2').val();

        var $request = {

            origin: $origin,
            destination: $destination,
            travelMode: 'WALKING'

        };

        directionsService.route($request, function (result, status) {

            if (status == 'OK') {
                directionsRenderer.setDirections(result);
            }


        });
    });

    $('#filterbar').on('keyup', function () {

        var input = $('#filterbar').val()


        if (input == "") {
            addMarkers();
        }
        else {
            clearMarkers(input);

            $.ajax({

                type: "POST",
                url: "filter.php",
                data: { input: input },
                success: function (result) {

                    for (let i = 0; i < result.length; i++) {

                        markers[result[i]].setMap(map);

                    }

                },
                dataType: "json",
                error: function () { console.log('filter failed') }
            });
        }



    });

    $(".details-pane-close").on('click', function () {
        $('.detailsBar').removeClass('details-pane-visible');
    })

    function clearMarkers() {
        for (let i = 0; i < coordsArr.length; i++) {

            const coord = coordsArr[i];
            markers[coord.bcode].setMap(null);

        }

    }

    function addMarkers() {
        for (let i = 0; i < coordsArr.length; i++) {

            const coord = coordsArr[i];
            markers[coord.bcode].setMap(map);

        }
    }

    function showInfoDiv(indx) {


        var realIndex = indx - 1;



        let markerData = coordsArr[realIndex]
        const $detailsDiv = $('.detailsBar')
        const $titleDiv = $('.details-pane-title');
        const $contentDiv = $('.details-pane-content');
        const $imageDiv = $('#locationImage');


        $detailsDiv.removeClass('details-pane-visible');

        $imageDiv.attr('src', markerData.image);
        $titleDiv.text(markerData.bname);
        $contentDiv.text(markerData.description);



        $detailsDiv.addClass('details-pane-visible');


        $detailsDiv.removeClass('details-pane--visible');



    }
};

//};


