<?php
include('include/authentication.php');
include('include/database.php');
include('include/header.php');


$searchErr = '';
$Destinations = '';
    

 

    if (isset($_POST['submitsearch'])) {
        if (!empty($_POST['search'])) {
            $search = $_POST['search'];
            
            
    
            // Assuming $conn is the mysqli connection object
            $stmt = $conn->prepare("SELECT * FROM places WHERE p_name LIKE ? OR p_name LIKE ?");
            $searchTerm = "%$search%"; // Prepare the search term with wildcards
            $stmt->bind_param("ss", $searchTerm, $searchTerm); // Bind the parameters to the prepared statement
            $stmt->execute();
            $result = $stmt->get_result();
    
            // Fetch rows from the result set
            $Destinations = array();
            while ($row = $result->fetch_assoc()) {
                $Destinations[] = $row;
            }
    
            // Free the result set and close the statement
            $result->free();
            $stmt->close();
        } else {
            $searchErr = "Please enter the information";
        }
    }
    
    
    if (isset($_POST['save'])) {
        $uID = $conn->real_escape_string($_POST['uID']);
        $ratedIndex = $conn->real_escape_string($_POST['ratedIndex']);
        $ratedIndex++;
    
        if (!$uID) {
            $conn->query("INSERT INTO stars (rateIndex) VALUES ('$ratedIndex')");
            $sql = $conn->query("SELECT id FROM stars ORDER BY id DESC LIMIT 1");
            $uData = $sql->fetch_assoc();
            $uID = $uData['id'];
        } else
            $conn->query("UPDATE stars SET rateIndex='$ratedIndex' WHERE id='$uID'");
    
        exit(json_encode(array('id' => $uID)));
    }
    
    $sql = $conn->query("SELECT id FROM stars");
    $numR = $sql->num_rows;
    
    $sql = $conn->query("SELECT SUM(rateIndex) AS total FROM stars");
    $rData = $sql->fetch_array();
    $total = $rData['total'];
    
    $avg = $total / $numR;
    if (isset($_POST['submitsearch'])) {
        if (!empty($_POST['search'])) {
            $search = $_POST['search'];
            
            
    
            // Assuming $conn is the mysqli connection object
            $stmt = $conn->prepare("SELECT * FROM places WHERE p_name LIKE ? OR p_name LIKE ?");
            $searchTerm = "%$search%"; // Prepare the search term with wildcards
            $stmt->bind_param("ss", $searchTerm, $searchTerm); // Bind the parameters to the prepared statement
            $stmt->execute();
            $result = $stmt->get_result();
    
            // Fetch rows from the result set
            $Destinations = array();
            while ($row = $result->fetch_assoc()) {
                $Destinations[] = $row;
            }
    
            // Free the result set and close the statement
            $result->free();
            $stmt->close();
        } else {
            $searchErr = "Please enter the information";
        }
    }
    
    
    
    
    function displayPosts($userid, $conn,$postiD,$place)
    {
        $output = '';
        $postid = $postiD;
        $place = $place;
        //$query = "SELECT * FROM places";
        //$result = mysqli_query($conn, $query);
    
        //while ($row = mysqli_fetch_array($result)) {
            //$postid = $row['p_id'];
           // $title = $row['p_name'];
            //$content = $row['p_discription'];
            $type = -1;
    
            // Checking user status
            $status_query = "SELECT count(*) as cntStatus,type FROM like_unlike WHERE userid=".$userid." and postid=".$postid;
            $status_result = mysqli_query($conn, $status_query);
            $status_row = mysqli_fetch_array($status_result);
            $count_status = $status_row['cntStatus'];
            if ($count_status > 0) {
                $type = $status_row['type'];
            }
    
            // Count post total likes and unlikes
            $like_query = "SELECT COUNT(*) AS cntLikes FROM like_unlike WHERE type=1 and postid=".$postid;
            $like_result = mysqli_query($conn, $like_query);
            $like_row = mysqli_fetch_array($like_result);
            $total_likes = $like_row['cntLikes'];
    
            $unlike_query = "SELECT COUNT(*) AS cntUnlikes FROM like_unlike WHERE type=0 and postid=".$postid;
            $unlike_result = mysqli_query($conn, $unlike_query);
            $unlike_row = mysqli_fetch_array($unlike_result);
            $total_unlikes = $unlike_row['cntUnlikes'];
    
            // Build HTML output
            /*$output .= '<div class="post">';
            $output .= '<h2>'.$title.'</h2>';
            $output .= '<div class="post-text">'.$content.'</div>';
            $output .= '<div class="post-action">';*/
            $output .= '<input type="button" value="Like" id="like_'.$postid.'" class="like" style="'.($type == 1 ? "color: #ffa449;" : "").'" /> <i id= "like_'.$postid.'_icon" style="'.($type == 1 ? "color: #ffa449;" : "").'" class="fa">&#xf087;</i>&nbsp;(<span id="likes_'.$postid.'">'.$total_likes.'</span>)&nbsp;';
    
    
            $output .= '<input type="button" value="Dislike" id="unlike_'.$postid.'" class="unlike" style="'.($type == 0 ? "color: #ffa449;" : "").'" /><i id= "unlike_'.$postid.'_icon" style="'.($type == 1 ? "color: #ffa449;" : "").'" class="fa">&#xf165;</i>&nbsp;(<span id="unlikes_'.$postid.'">'.$total_unlikes.'</span>)';
            $output .= '</div>';
            $output .= '</div>';
        //}
    
        return $output;
    }
    
    
    ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rating System</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
    
<div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>
                                    Search Result:
                                      
                                    </h4>
                                </div>
                                <div class="row ">
                                  

                                            <div id="first"  class="col-md-5">
                                            <?php
                                                    if(!$Destinations)
                                                    {
                                                        echo '<tr>No data found</tr>';
                                                    }
                                                    else{
                                                        foreach($Destinations as $key=>$value)
                                                            {
                                                                ?>
                                                            <div style="height:60px;width:100%;">
                                                    
                                                                <div>
                                                                    <?php
                                                                     $query="SELECT * FROM images WHERE place_id=$value[p_id]";
                                                                     $query_run= mysqli_query($conn,$query);
                                                                     if(mysqli_num_rows($query_run) > 0)
                                                                     {
                                                                                 foreach($query_run as $row)
                                                                                 {?>

                                                                     <img class="mt-2 d-inline pl-1" src="<?php echo"admin/images/". $row['image_name']; ?>" alt="img" width="200px " height="300px">
                                                                    <?php
                                                                                 }}
                                                                    ?>
                                                                  
                                                                    
                                                                </div>
                                                                <div class="row  mt-3 ml-2">
                                                                <div class="col-4 ">
                                                                                <h4>Name:<h4>

                                                                            </div>
                                                                            <div class="col mt-1">
                                                                            <h6 class="d-inline float-left"><?php echo $value['p_name'];  ?></h6>
                                                                            </div>
                                                                            </div>
                                                                            <div class="row  mt-3 ml-2">
                                                                              <div class="col-md-2"><h5>Rating:<h5></div>
                                                                              <div class="col-md-6 "> 

                                                                             
                                                                                  <i class="fa fa-star bg-dark fa-2x" data-index="0"></i>
                                                                                  <i class="fa fa-star bg-dark fa-2x" data-index="1"></i>
                                                                                  <i class="fa fa-star bg-dark fa-2x" data-index="2"></i>
                                                                                  <i class="fa fa-star bg-dark fa-2x" data-index="3"></i>
                                                                                  <i class="fa fa-star bg-dark fa-2x" data-index="4"></i>
                                                                                  <?php echo round($avg,2) ?>
                                                                                  <br><br>
                                                                                  
                                                                              

                                                                              </div>
                                                                              <div class="col"></div>
                                                         
                                                        </div>
                                                            </div>
                                                                
                                                                <?php
                                                            }
                                                            
                                                        }
                                                        ?>
                                                        </div>
                                                        <div id="second" class="col-md-6">
                                                          <?php
                                                                if(!$Destinations)
                                                                {
                                                                    echo '<tr>No data found</tr>';
                                                                }
                                                                else{
                                                                    foreach($Destinations as $key=>$value)
                                                                        {
                                                                            ?>
                                                                        <div style="height:60px;width:100%;">
                                                                    
                                                                          
                                                                            <div>
                                                                                <h4>Description</h4><p><?php echo $value['p_discription'];  ?></P>

                                                                            </div>

                                                                        </div>
                                                                            
                                                                            <?php
                                                                        }
                                                                        
                                                                    }
                                                                    ?>
                                                                    <span>
                <button type="button" class="" data-toggle="modal" data-target="#exampleModalLong" style="float:right;margin-top:55%;border: 1px solid #000;">Comment</button></span>
                <span style="float:right;margin-top:55%;">
                  <?php 
                  $destination = 'like_unlike'; // destinstion means places name 
                  echo displayPosts(212, $conn,7,$destination); // 212 userid and  7 is postid

                     ?>
                </span>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="text-align:center;">Comment</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <!--<h2 align="center"><a href="#">Comment System using PHP and Ajax</a></h2>-->
        <br />
          <div class="modal_container">
              <form method="POST" id="comment_form">
                <!--<div class="form-group">
                  <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" />
                </div>-->
                <div class="form-group">
                  <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" name="comment_id" id="comment_id" value="0" />
                    <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
                </div>
              </form>
            <span id="comment_message"></span>
            <br />
          <div id="display_comment"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
  </div>
</div>

    <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script>
        var ratedIndex = -1, uID = 0;

        $(document).ready(function () {
            resetStarColors();

            if (localStorage.getItem('ratedIndex') != null) {
                setStars(parseInt(localStorage.getItem('ratedIndex')));
                uID = localStorage.getItem('uID');
            }

            $('.fa-star').on('click', function () {
               ratedIndex = parseInt($(this).data('index'));
               localStorage.setItem('ratedIndex', ratedIndex);
               saveToTheDB();
            });

            $('.fa-star').mouseover(function () {
                resetStarColors();
                var currentIndex = parseInt($(this).data('index'));
                setStars(currentIndex);
            });

            $('.fa-star').mouseleave(function () {
                resetStarColors();

                if (ratedIndex != -1)
                    setStars(ratedIndex);
            });
        });

        function saveToTheDB() {
            $.ajax({
               url: "index.php",
               method: "POST",
               dataType: 'json',
               data: {
                   save: 1,
                   uID: uID,
                   ratedIndex: ratedIndex
               }, success: function (r) {
                    uID = r.id;
                    localStorage.setItem('uID', uID);
               }
            });
        }

        function setStars(max) {
            for (var i=0; i <= max; i++)
                $('.fa-star:eq('+i+')').css('color', 'green');
        }

        function resetStarColors() {
            $('.fa-star').css('color', 'white');
        }


        $(document).ready(function(){
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_name').focus();
   var modalBody = $(this).closest('.modal-content').find('.modal-body');
  modalBody.animate({
    scrollTop: 0
  }, "slow");

  console.log("Reply button clicked!");
  


 });
 
});
    </script>
</body>
</html>