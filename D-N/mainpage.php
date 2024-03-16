<?php
include('Discovering-Nepal/database.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="index1.css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e5823df915.js" crossorigin="anonymous"></script>
     <script>
    $(document).ready(function() {
      $('#slideshow').carousel();
      $('#slideshow3').carousel();
    });
  </script>
    <title>Discovering Nepal</title>
    <style>
        body{
          overflow-x: hidden;
            color: white;
            background-color:black;
        }
        .navbar{
            background:rgba(0, 0, 0, 0.6);
        }
        .navbar-brand{
            height: 2rem;
        }

      .video-background{
            position:relative;
            width: 100%;
            min-height: 100%;
            background-color: rgba(0, 0, 0, 0.2);
        }
       .caption{
        position:absolute;
            top: 38%;
            width: 100%;
            color:#bbfaeb;
            

        }
        .caption h1{
           
            font-weight:700;
            letter-spacing: .2rem;
            text-shadow: .1rem .1rem .8rem black;
        }
        .caption h3{
           	color:#e2f59d;
           	font-size:800px;
            letter-spacing: .2rem;
            text-shadow: .1rem .1rem .5rem black;
          	font-family: monospace;

        }
        .links li{
          
        }
     
   		.carousel-item {
      		text-align: center;
    	}
  
    .carousel-item h3 {
      font-size: 24px;
      font-weight: bold;
    }
  
    .carousel-item p {
      font-size: 18px;
      margin-top: 20px;
    }
    .left-align {
    text-align: left;
    color:black;
  }
   .image-div {
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    border-radius: 10%;
  }

    </style>
</head>
    <body>
        <!--navbar-->
    <nav class="navbar navbar-dark fixed-top">
                 <a class="navbar-brand mx-auto" href="#Home"><h3>D-N </h3></a>
                 <div class="d-inline " style="padding: 5px; margin: 5px;"><a href="Discovering-Nepal/admin/login.php" class="text-white btn btn-primary   ">Log In</a></div>
   <div class="d-inline " style="padding: 5px; margin: 5px;"> <a href="Discovering-Nepal/signup.php" class="text-white btn btn-danger btn-md  ">SignUp</a></div>
           
    
    </nav>
    
 <!--ending of nav bar-->
 <!--video playout without music-->

<div class="video-background">
     <div class="video--wrap">
         <div id="video">
             <video class="ratio ratio-16×9" id="vid" autoplay loop muted>
                 <source src="Nepal_ Nepal.mp4" type="video/mp4">
             </video>
            </div>
            <div class="caption text-center d-block ">
              <h2 class="text">Welcome to Discovering nepal</h2>
       


                       <div id="slideshow" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#slideshow" data-slide-to="0" class="active"></li>
      <li data-target="#slideshow" data-slide-to="1"></li>
      <li data-target="#slideshow" data-slide-to="2"></li>
      <!-- Add more li elements for additional slides -->
    </ol>
  
    <!-- Slides -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <h3>A journey of a lifetime</h3>
      </div>
      <div class="carousel-item">
        <h3>There’s nothing like a mountain view to clear your head</h3>
      </div>
      <div class="carousel-item">
        <h3>The best way to find peace is by exploring new places.</h3>
      </div>
       <div class="carousel-item">
        <h3>The best way to get away from it all is by traveling to new places.</h3>
      </div>
      <!-- Add more div.carousel-item elements for additional slides -->
    </div>
    <!-- <button class="btn btn-primary btn-circle">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                </svg>
                </button>-->
  
    <!-- Controls 
    <a class="carousel-control-prev" href="#slideshow" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#slideshow" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>-->
  </div>
 
           
              <!--<a class="btn btn-outline-light btn-lg" href="#footer">Get Started</a>-->
          </div>
      </div>
          
</div>
  
<!--video playout end here-->

  <div id="slideshow3" class="carousel slide" data-ride="carousel" style="background-color:#c9d1d1;">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#slideshow3" data-slide-to="0" class="active"></li>
      <li data-target="#slideshow3" data-slide-to="1"></li>
      <li data-target="#slideshow3" data-slide-to="3"></li>
      <li data-target="#slideshow3" data-slide-to="4"></li>
      <li data-target="#slideshow3" data-slide-to="5"></li>
      <li data-target="#slideshow3" data-slide-to="6"></li>
      <li data-target="#slideshow3" data-slide-to="7"></li>
      <!-- Add more li elements for additional slides -->
    </ol>
  
    <!-- Slides -->
    <div class="carousel-inner">
      <div class="carousel-item active">
         <div class="container" style="height: 600px; padding: 5px;">
        <h1>Province 1</h1>
        	




    
    <div class="row" style="height:90%;">
      <div class="col-md-8" >
      	<div class="row" style="height:100%;">
     		<div class="col-md-6" style="height:50%; width :100%;">
     				<div class="row" style="height:100%;">
      					<div class="col-md-6" style="background-color:;border-radius: 10%;">
      						<div class="image-div" style="background-image: url('images/one/1.3.jpg'); height: 100%; width:100%;"></div>
      					</div>
        				<div class="col-md-6" style="background-color:;border-radius: 10%;">
        					<div class="image-div" style="background-image: url('images/one/1.2.jpg');height: 100%;"></div>
        				</div>
        			</div>
      		</div>

        	<div class="col-md-6" style="background-color:;height:50%; width :100%;border-radius: 10%;">
          		<div class="image-div" style="background-image: url('images/one/1.1.jpg');height: 100%;"></div>
      		</div>
        </div>  
      </div>
      <div class="col-md-4" style="background-color:#ebfffe;border-radius: 10%;">
          <ul>
          	 <h4 style="color:black;text-align:left;">Features</h4>
          	 	<ul class="left-align">
            		<li>Capital:Biratnagar</li>
            		<li>Area:25,905sq.km</li>
            		<li>The Hill region comprises 33.53% of Province land area.</li>
            		<li>The Inner Terai region comprises 7.96% of Province land area.</li>
            		<li>The Himalayas and Inner Himalayas have an Alpine, Dry & Arid type of climate. The temperature is 30 to 100. The average annual rainfall is 15-20cm and in the higher regions precipitation is in the form of snow</li>
            	</ul>
            	<h4 style="color:black;text-align:left;">Places</h4>
          	 	<ul class="left-align">
            		<li> Sagaramatha (29028ft. /8848m)</li>
            		<li> Choyu (8201m)</li>
            		<li>Lhotse (27,809 ft./ 8,516m)</li>
            		<li>Sagarmatha National Park </li>
            		<li>Koshi River</li>
            	</ul>
         	   
        
          </ul>
          
        </div>
      </div>











      </div>
      </div>
      <div class="carousel-item">
        <div class="container" style="height:600px; padding:5px;">
  	<h1>Province 2</h1>
    <div class="row" style="height:90%;">
      <div class="col-md-8" >
      	<div class="row" style="height:100%;">
     		<div class="col-md-6" style="height:50%; width :100%;">
     				<div class="row" style="height:100%;">
      					<div class="col-md-6" style="background-color:; border-radius: 10%;">
      						<div class="image-div" style="background-image: url('images/two/2.2.jpg');height: 100%;"></div>
      					</div>
        				<div class="col-md-6" style="background-color:;border-radius: 10%;">
        					<div class="image-div" style="background-image: url('images/two/2.3.jpg');height: 100%;"></div>
        				</div>
        			</div>
      		</div>

        	<div class="col-md-6" style="background-color:;height:50%; width :100%;border-radius: 10%;">
          		<div class="image-div" style="background-image: url('images/two/2.1.jpg');height: 100%;"></div>
      		</div>
        </div>  
      </div>
      <div class="col-md-4" style="background-color:#ebfffe;border-radius: 10%;">
          <ul>
          	 <h4 style="color:black;">Features</h4>
          	 	<ul class="left-align">
            		<li>Capital:Janakpur </li>
            		<li>Area:20,300 km2</li>
            		<li>Maithils are the largest ethnolinguistic group</li>
            		<li>Bhabar zone comprises 25.62% of Province land area. This region extends from the base of Chure Mountain to plain lands of Terai Madhesh.</li>
            		<li> Nepal's most densely populated province and smallest province by area</li>
            	</ul>
            	<h4 style="color: black;">Places</h4>
          	 	<ul class="left-align">
            		<li>Parsa National Park</li>
            		<li>Janaki Temple</li>
            		<li>Viva Mandap</li>
            		<li>Baba Lake</li>
            		<li>Koshi Tappu</li>
            	</ul>
         	   
        
          </ul>
        </div>
      </div>
  </div>
      </div>


      <div class="carousel-item">
         <div class="container" style="height:600px; padding:5px;">
  	<h1>Province 3</h1>
    <div class="row" style="height:90%;">
      <div class="col-md-8"  >
      	<div class="row" style="height:100%;">
     		<div class="col-md-6" style="height:50%; width :100%;">
     				<div class="row" style="height:100%;">
      					<div class="col-md-6" style="background-color:; border-radius: 10%;">
      						<div class="image-div" style="background-image: url('images/three/3.1.jpg');height: 100%;"></div>
      					</div>
        				<div class="col-md-6" style="background-color:;border-radius: 10%;">
        					<div class="image-div" style="background-image: url('images/three/3.2.jpg');height: 100%;"></div>
        				</div>
        			</div>
      		</div>

        	<div class="col-md-6" style="background-color:;height:50%; width :100%; border-radius: 10%;">
          		<div class="image-div" style="background-image: url('images/three/3.3.jpg');height: 100%;"></div>
      		</div>
        </div>  
      </div>
      <div class="col-md-4" style="background-color:#ebfffe; border-radius: 10%;">
          <ul>
          	 <h4 style="color:black;">Features</h4>
          	 	<ul class="left-align">
            		<li>Capital:Hetauda </li>
            		<li>Area:9,661 km2 </li>
            		<li>The most populous province of Nepal, it possesses rich cultural diversity with resident communities and castes i</li>
            		<li> Climatic zone of Bagmati province starts from High Himalaya in the north, above 5000 m with tundra and arctic climate to Siwalik region in the south, 500–1000 m with sub-tropical climatic zone</li>
            		<li>The province has an altitude low enough to support deciduous, coniferous, and alpine forests and woodlands</li>
            	</ul>
            	<h4 style="color:black;">Places</h4>
          	 	<ul class="left-align">
          	 		<li>Kathmandu valley</li>
            		<li>Gaurishankar</li>
            		<li>Langtang National Park</li>
            		<li>Gosaikunda Lake</li>
            		<li>Chitwan National Park</li>
            	</ul>

            	
         	   
        
          </ul>
        </div>
      </div>


    </div>
  
      <!-- Add more div.carousel-item elements for additional slides -->
    </div>

<div class="carousel-item">
        <div class="container" style="height:600px; padding:5px;">
  			<h1>Province 4</h1>
    <div class="row" style="height:90%;">
      <div class="col-md-8">
      	<div class="row" style="height:100%;">
     		<div class="col-md-6" style="height:50%; width :100%;">
     				<div class="row" style="height:100%;">
      					<div class="col-md-6" style="background-color:; border-radius: 10%;">
      						<div class="image-div" style="background-image: url('images/four/4.1.jpg');height: 100%;"></div>
      					</div>
        				<div class="col-md-6" style="background-color:;border-radius: 10%;">
        					<div class="image-div" style="background-image: url('images/four/4.2.jpg');height: 100%;"></div>
        				</div>
        			</div>
      		</div>

        	<div class="col-md-6" style="background-color:;height:50%; width :100%; border-radius: 10%;">
          		<div class="image-div" style="background-image: url('images/four/4.3.jpg');height: 100%;"></div>
      		</div>
        </div>  
      </div>
      <div class="col-md-4" style="background-color:#ebfffe;border-radius: 10%;">
          <ul>
          	 <h4 style="color: black;">Features</h4>
          	 	<ul class="left-align">
            		<li>Capital:Pokhara </li>
            		<li>Area:21,504 km2</li>
            		<li>Its unique essence that makes the entire province full of beautiful rendezvous</li>
            		<li>The province is 26.8% Mountain region, 67.2% Hilly region, and 6% Terai region</li>
            		<li>An adventure hub for thrill-seekers as the province offers an extensive list of daring and exhilarating activities such as bungee jumping, Canyoning, abseiling, white water rafting, paragliding, sky diving, and many more</li>
            	</ul>
            	<h4 style="color:black;">Places</h4>
          	 	<ul class="left-align">
          	 		<li> Annapurna Base Camp</li>
            		<li>Pokhara</li>
            		<li>Manaslu Circuit Trek</li>
            		<li>Tilicho lake</li>
            		<li>Gorkha Durbar</li>
            	</ul>

            	
         	   
        
          </ul>
       
        </div>
      </div>	
  </div>
 </div>




 <div class="carousel-item">
        <div class="container" style="height:600px; padding:5px;">
  			<h1>Province 5</h1>
    <div class="row" style="height:90%;">
      <div class="col-md-8" >
      	<div class="row" style="height:100%;">
     		<div class="col-md-6" style="height:50%; width :100%; border-radius: 10%;">
     				<div class="row" style="height:100%;">
      					<div class="col-md-6" style="background-color:; border-radius: 10%;">
      						<div class="image-div" style="background-image: url('images/five/5.1.jpg');height: 100%;"></div>
      					</div>
        				<div class="col-md-6" style="background-color:;border-radius: 10%;">
        					<div class="image-div" style="background-image: url('images/five/5.2.jpg');height: 100%;"></div>
        				</div>
        			</div>
      		</div>

        	<div class="col-md-6" style="background-color:;height:50%; width :100%;border-radius: 10%;">
          		<div class="image-div" style="background-image: url('images/five/5.3.jpg');height: 100%;"></div>
      		</div>
        </div>  
      </div>
      <div class="col-md-4" style="background-color:#ebfffe;border-radius: 10%;">
          <ul>
          	 <h4 style="color: black;">Features</h4>
          	 	<ul class="left-align">
            		<li>Capital:Deukhuri </li>
            		<li>Area:22,288 km2</li>
            		<li>Lumbini Province houses the only hunting reserve of the country- Dhorpatan Hunting Reserve.</li>
            		<li>The dense jungle of Bardiya National Park, home to a wide assortment of animals and flora</li>
            		<li>Lumbini province is home to the World Heritage Site of Lumbini, where according to the Buddhist tradition, the founder of Buddhism, Gautama Buddha was born</li>
            	</ul>
            	<h4 style="color:black;">Places</h4>
          	 	<ul class="left-align">
          	 		<li>Lumbini</li>
            		<li>Banke National Park</li>
            		<li>Ranighat Palace</li>
            		<li>Bardiya National Park,</li>
            		<li>Sworgadwari</li>
            	</ul>

            	
         	   
        
          </ul>
         
        </div>
      </div>
  </div>
 </div>



<div class="carousel-item">
        <div class="container" style="height:600px; padding:5px;">
  			<h1>Province 6</h1>
    <div class="row" style="height:90%;">
      <div class="col-md-8" >
      	<div class="row" style="height:100%;">
     		<div class="col-md-6" style="height:50%; width :100%; ">
     				<div class="row" style="height:100%;">
      					<div class="col-md-6" style="background-color:; border-radius: 10%;">
      						<div class="image-div" style="background-image: url('images/six/6.1.jpg');height: 100%;"></div>	
      					</div>
        				<div class="col-md-6" style="background-color:; border-radius: 10%;">
        					<div class="image-div" style="background-image: url('images/six/6.3.jpg');height: 100%;"></div>
        				</div>
        			</div>
      		</div>

        	<div class="col-md-6" style="background-color:;height:50%; width :100%;border-radius: 10%;">
          		<div class="image-div" style="background-image: url('images/six/6.2.jpg');height: 100%;"></div>
      		</div>
        </div>  
      </div>
      <div class="col-md-4" style="background-color:#ebfffe; border-radius: 10%;">
          <ul>
          	 <h4 style="color: black;">Features</h4>
          	 	<ul class="left-align">
            		<li>Capital: Birendranagar</li>
            		<li>Area:27,984 sq km</li>
            		<li> Being the largest in area, the province has the least population of all other provinces</li>
            		<li>The region gives rise to deep gorges, vast valleys, exceptional trans-Himalayas, and giant snow-capped pinnacles with high mountains</li>
            		<li>It occupies the higher mountains on the North and the mid-hills of Nepal and therefore has to offer beautiful water bodies along with some stunning views of Himalayan ranges.</li>
            	</ul>
            	<h4 style="color:black;">Places</h4>
          	 	<ul class="left-align">
          	 		<li>Shey Phoksundo National Park.</li>
            		<li>Rara lake </li>
            		<li>Upper Dolpo</li>
            		<li>Mount Putha Adventure,</li>
            		<li>Karnali</li>
            	</ul>

            	
         	   
        
          </ul>
         
        </div>
      </div>
  </div>
 </div>



 <div class="carousel-item">
        <div class="container" style="height:600px; padding:5px;">
  			<h1>Province 7</h1>
    <div class="row" style="height:90%;">
      <div class="col-md-8">
      	<div class="row" style="height:100%;">
     		<div class="col-md-6" style="height:50%; width :100%; ">
     				<div class="row" style="height:100%;">
      					<div class="col-md-6" style="background-color:; border-radius: 10%;">
      						<div class="image-div" style="background-image: url('images/seven/7.1.jpg');height: 100%;"></div>
      					</div>
        				<div class="col-md-6" style="background-color:; border-radius: 10%;">
        					<div class="image-div" style="background-image: url('images/seven/7.2.png');height: 100%;"></div>
        				</div>
        			</div>
      		</div>

        	<div class="col-md-6" style="background-color:;height:50%; width :100%; border-radius: 10%;">
          		<div class="image-div" style="background-image: url('images/seven/7.4.jpg');height: 100%;"></div>
      		</div>
        </div>  
      </div>
      <div class="col-md-4" style="background-color:#ebfffe; border-radius: 10%;">
          <ul>
          	 <h4 style="color: black;">Features</h4>
          	 	<ul class="left-align">
            		<li>Capital: Godawari</li>
            		<li>Area: 19,539sq km</li>
            		<li> The province occupies hills and plains, and road access is not very good</li>
            		<li> The province is still preserving medieval culture and traditions</li>
            		<li>Home to several sacred temples such as Badiamalika temple, Khaptad Baba Mandir, Ram mandir, Kada, Devisthan Mandir, and many more</li>
            	</ul>
            	<h4 style="color: black;">Places</h4>
          	 	<ul class="left-align">
          	 		<li>Saipal Himal</li>
            		<li>Khaptad National Park</li>
            		<li>Api Mountain</li>
            		<li>Badimalika </li>
            		<li>Tripura Sundari in Baitadi</li>
            	</ul>

            	
         	   
        
          </ul>
        
        </div>
      </div>
  </div>
 </div>






  
    <!-- Controls -->
	<a class="carousel-control-prev" href="#slideshow3" role="button" data-slide="prev" style="color:white;">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#slideshow3" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>   
  </div>








<!-- <div class="container" style="height:600px; padding:5px;">
  	<h1>Bagmati</h1>
    <div class="row" style="height:90%;">
      <div class="col-md-8" style="background-color:red;" >
      	<div class="row" style="height:100%;">
     		<div class="col-md-6" style="height:50%; width :100%; background-color:black;">
     				<div class="row" style="height:100%;">
      					<div class="col-md-6" style="background-color:orange;"></div>
        				<div class="col-md-6" style="background-color:purple;"></div>
        			</div>
      		</div>

        	<div class="col-md-6" style="background-color:pink;height:50%; width :100%;">
          
      		</div>
        </div>  
      </div>
      <div class="col-md-4" style="background-color:gold;">
          <ul>
          	 <h4>Features</h4>
          	 	<ul>
            		<li>Capital: Godawari</li>
            		<li>Area: 19,539sq km</li>
            		<li> The province occupies hills and plains, and road access is not very good</li>
            		<li> The province is still preserving medieval culture and traditions</li>
            		<li>Home to several sacred temples such as Badiamalika temple, Khaptad Baba Mandir, Ram mandir, Kada, Devisthan Mandir, and many more</li>
            	</ul>
            	<h4>Places</h4>
          	 	<ul>
          	 		<li>Saipal Himal</li>
            		<li>Khaptad National Park</li>
            		<li>Api Mountain</li>
            		<li>Badimalika </li>
            		<li>Tripura Sundari in Baitadi</li>
            	</ul>

            	
         	   
        
          </ul>
        
        </div>
      </div>
    </div>
  </div>-->




  
    
  
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  
  </body>
</html>
  