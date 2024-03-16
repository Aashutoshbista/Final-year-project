






<?php

include('authentication.php');
include('database.php');
include('headerforothers.php');




$searchErr = '';
$Destinations='';
if(isset($_POST['submitsearch']))
{
    if(!empty($_POST['search']))
    {
    
        $search = $_POST['search'];
        echo $search;
        $stmt = $conn->prepare("select * from places where p_name like '%$search%' or p_name like '%$search%'");
        $stmt->execute();
        $Destinations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($employee_details);
        
         
    }
    else
    {
        $searchErr = "Please enter the information";
    }
    
}











//************************************************
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
<!DOCTYPE html>
<html>
<head>
	<title></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
<div class="content-wrapper pt-2">
            <div class="content">
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

                                            <div id="first"  class="col-md-6">
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
                                                                <div class="col-4  ">
                                                                                <h4>Name:<h4>

                                                                            </div>
                                                                            <div class="col mt-1">
                                                                            <h6 class="d-inline float-left"><?php echo $value['p_name'];  ?></h6>
                                                                            </div>
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
                  $destination = 'like_unlike';
                  echo displayPosts(212, $conn,7,$destination); 

                     ?>
                </span>
<!--rough-->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--rough-->
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
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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
<script>
    $(document).ready(function(){
      // like and unlike click
      $(".like, .unlike").click(function(){
        // Rest of your JavaScript code
        // ...

        var id = this.id;   // Getting Button id
        var split_id = id.split("_");

        var text = split_id[0];
        var postid = split_id[1];  // postid

        var places = <?php echo json_encode($destination); ?>;

        // Finding click type
        var type = 0;
        if(text == "like"){
            type = 1;
        }else{
            type = 0;
        }

        // AJAX Request
        $.ajax({
            url: 'likeunlike.php',
            type: 'post',
            data: {postid:postid,type:type,places:places},
            dataType: 'json',
            success: function(data){
                var likes = data['likes'];
                var unlikes = data['unlikes'];

                $("#likes_"+postid).text(likes);        // setting likes
                $("#unlikes_"+postid).text(unlikes);    // setting unlikes

                if(type == 1){
                    $("#like_"+postid).css("color","#ffa449");
                    $("#unlike_"+postid).css("color","lightseagreen");
                    $("#like_"+postid+ "_icon").css("color","#ffa449");
                    $("#unlike_"+postid+ "_icon").css("color","lightseagreen");
                }

                if(type == 0){
                    $("#unlike_"+postid).css("color","#ffa449");
                    $("#like_"+postid).css("color","lightseagreen");
                    $("#unlike_"+postid+ "_icon").css("color","#ffa449");
                    $("#like_"+postid+ "_icon").css("color","lightseagreen");
                }


            }
            
        });
      });
    });
  </script>
<?php
include('footer.php');
?>