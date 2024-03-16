<?php

include "include/database.php";

include('include/header.php');

?>
<html>
    <head>
        <title>Places</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Play&display=swap');
            .bounce {
    font-size: 5rem;
    width: 100%;
    margin: 3rem auto;
    display: inline-flex;
    justify-content: center;
    -webkit-box-reflect: below -20px linear-gradient(transparent, #211e1e2e);
}

.bounce span {
    display: inline-flex;
    color: #738690;
    font-family: "Impact", sans-serif;
    animation: bounce 1s infinite;
    letter-spacing: 5px;
}
.space {
    margin-left: 20px; /* Adjust the value as needed */
}

@keyframes bounce {
    0%,
    50%,
    100% {
        transform: translateY(0);
    }
    25% {
        transform: translateY(-20px);
    }
}

.ten span:nth-of-type(1) {
    animation-delay: 0.1s;
}

.ten span:nth-of-type(2) {
    animation-delay: 0.2s;
}

.ten span:nth-of-type(3) {
    animation-delay: 0.3s;
}

.ten span:nth-of-type(4) {
    animation-delay: 0.4s;
}

.ten span:nth-of-type(5) {
    animation-delay: 0.5s;
}

.ten span:nth-of-type(6) {
    animation-delay: 0.6s;
}

        </style>

        <!-- CSS -->
        <!--<link href="ratingstyle.css" type="text/css" rel="stylesheet" />-->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <link href='jquery-bar-rating-master/dist/themes/fontawesome-stars.css' rel='stylesheet' type='text/css'>

        
        <!-- Script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="jquery-bar-rating-master/dist/jquery.barrating.min.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(function() {
            $('.rating').barrating({
                theme: 'fontawesome-stars',
                onSelect: function(value, text, event) {

                    // Get element id by data-id attribute
                    var el = this;
                    var el_id = el.$elem.data('id');

                    // rating was selected by a user
                    if (typeof(event) !== 'undefined') {
                        
                        var split_id = el_id.split("_");

                        var placeid= split_id[1];  // placeid

                        // AJAX Request
                        $.ajax({
                            url: 'rating_ajax.php',
                            type: 'post',
                            data: {placeid:placeid,rating:value},
                            dataType: 'json',
                            success: function(data){
                                // Update average
                                var average = data['averageRating'];
                                $('#avgrating_'+placeid).text(average);
                            }
                        });
                    }
                }
            });
        });
      
        </script>
    </head>
    <body>
        

    


        </div>

    </body>
</html>
<?php 

$query = "SELECT * FROM user_recommendations WHERE user_name= '" . $_SESSION['auth_user']['user_name'] . "'";
$query_run = mysqli_query($conn, $query);

if ($query_run && mysqli_num_rows($query_run) > 0) {
    include('recommendation.php');
    include('Allplaces.php');
} else {
    include('Allplaces.php');
}


?>


           
</div>
<?php
include('include/footer.php');
?>