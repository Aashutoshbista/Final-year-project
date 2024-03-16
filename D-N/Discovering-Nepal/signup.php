<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <style>
    body{
        background-image: url('image/Mount-Everest.webp');

    }
    .box{
        opacity: 0.65;
    }
    .names{
        font-weight:700;
    }
    
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  
  </head>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                
                    
                
                <div class="card my-5 col-md-7 box">
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="Element">
                                                                    <strong>Hey!
                                                                    <?php
                                                                        if(isset($_SESSION['status']))
                                                                            {
                                                                                    echo $_SESSION['status'];
                                                                                    unset($_SESSION['status']);
                                                                            }
                                                                
                                                                ?>
                                                        </strong>
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                        </div>
               
                        <div class="card-header bg-light ">
                            
                            <form action="process.php" method="POST" autocomplete="off" name="myform" >
                                <!---->
                                        <div id="step1"  >
                                        <h2 class="text-center">Sign Up</h2>
                                                <div class="form-group" id="name">
                                                            <label class="names" for="">Name:</label>
                                                            <input type="text" name="name" class="form-control" placeholder="Name">
                                                            <span class="forerror text-danger" ></span>
                                
                                                </div>
                                                <div class="form-group" id="email">
                                                            <label class="names" for="">Email:</label>
                                                            <input type="text" name="email" class="form-control" placeholder="Email">
                                                            <span class="forerror text-danger" ></span>
                                                </div>
                                                <div class="form-group" id="phone">
                                                            <label class="names" for="">Phone:</label>
                                                            <input type="text" name="phone" class="form-control" placeholder="phone">
                                                            <span class="forerror text-danger" ></span>
                                                </div>
                                                <div class="form-group" id="age">
                                                            <div class="">
                                                            <label class="names" for="">Age:</label>
                                                            <input type="text" name="age" class="form-control" placeholder="Age">
                                                            <span class="forerror text-danger" ></span>
                                                </div>
                                        </div>
                                                <div class="row mt-2">
                                                                <div class="col-9" >
                                                                            <a href="admin/login.php" class="btn btn-primary ">Log In</a></p>
                                                                </div>
                                                                <div class="button-container col">
                                                                        <button type="button" class=" next-button btn btn-success"  onclick=validateForm()>Next</button>
                                                                </div>
                                                               <!-- onclick="showStep('step2')"-->
                                                </div>
                                        </div>
                                        <div id="step2" style="display:none;">
                                                                <div class="input-group mb-3 mt-2">
                                                                                <div class="input-group-prepend">
                                                                                            <label class="input-group-text" for="inputGroupSelect01">Nationality:</label>
                                                                                </div>
                                                                        
                                                                                <select name="nationality" required>
                                                                                        <option value="">-- select one --</option>
                                                                                        <option value="afghan">Afghan</option>
                                                                                        <option value="albanian">Albanian</option>
                                                                                        <option value="algerian">Algerian</option>
                                                                                        <option value="american">American</option>
                                                                                        <option value="andorran">Andorran</option>
                                                                                        <option value="angolan">Angolan</option>
                                                                                        <option value="antiguans">Antiguans</option>
                                                                                        <option value="argentinean">Argentinean</option>
                                                                                        <option value="armenian">Armenian</option>
                                                                                        <option value="australian">Australian</option>
                                                                                        <option value="austrian">Austrian</option>
                                                                                        <option value="azerbaijani">Azerbaijani</option>
                                                                                        <option value="bahamian">Bahamian</option>
                                                                                        <option value="bahraini">Bahraini</option>
                                                                                        <option value="bangladeshi">Bangladeshi</option>
                                                                                        <option value="barbadian">Barbadian</option>
                                                                                        <option value="barbudans">Barbudans</option>
                                                                                        <option value="batswana">Batswana</option>
                                                                                        <option value="belarusian">Belarusian</option>
                                                                                        <option value="belgian">Belgian</option>
                                                                                        <option value="belizean">Belizean</option>
                                                                                        <option value="beninese">Beninese</option>
                                                                                        <option value="bhutanese">Bhutanese</option>
                                                                                        <option value="bolivian">Bolivian</option>
                                                                                        <option value="bosnian">Bosnian</option>
                                                                                        <option value="brazilian">Brazilian</option>
                                                                                        <option value="british">British</option>
                                                                                        <option value="bruneian">Bruneian</option>
                                                                                        <option value="bulgarian">Bulgarian</option>
                                                                                        <option value="burkinabe">Burkinabe</option>
                                                                                        <option value="burmese">Burmese</option>
                                                                                        <option value="burundian">Burundian</option>
                                                                                        <option value="cambodian">Cambodian</option>
                                                                                        <option value="cameroonian">Cameroonian</option>
                                                                                        <option value="canadian">Canadian</option>
                                                                                        <option value="cape verdean">Cape Verdean</option>
                                                                                        <option value="central african">Central African</option>
                                                                                        <option value="chadian">Chadian</option>
                                                                                        <option value="chilean">Chilean</option>
                                                                                        <option value="chinese">Chinese</option>
                                                                                        <option value="colombian">Colombian</option>
                                                                                        <option value="comoran">Comoran</option>
                                                                                        <option value="congolese">Congolese</option>
                                                                                        <option value="costa rican">Costa Rican</option>
                                                                                        <option value="croatian">Croatian</option>
                                                                                        <option value="cuban">Cuban</option>
                                                                                        <option value="cypriot">Cypriot</option>
                                                                                        <option value="czech">Czech</option>
                                                                                        <option value="danish">Danish</option>
                                                                                        <option value="djibouti">Djibouti</option>
                                                                                        <option value="dominican">Dominican</option>
                                                                                        <option value="dutch">Dutch</option>
                                                                                        <option value="east timorese">East Timorese</option>
                                                                                        <option value="ecuadorean">Ecuadorean</option>
                                                                                        <option value="egyptian">Egyptian</option>
                                                                                        <option value="emirian">Emirian</option>
                                                                                        <option value="equatorial guinean">Equatorial Guinean</option>
                                                                                        <option value="eritrean">Eritrean</option>
                                                                                        <option value="estonian">Estonian</option>
                                                                                        <option value="ethiopian">Ethiopian</option>
                                                                                        <option value="fijian">Fijian</option>
                                                                                        <option value="filipino">Filipino</option>
                                                                                        <option value="finnish">Finnish</option>
                                                                                        <option value="french">French</option>
                                                                                        <option value="gabonese">Gabonese</option>
                                                                                        <option value="gambian">Gambian</option>
                                                                                        <option value="georgian">Georgian</option>
                                                                                        <option value="german">German</option>
                                                                                        <option value="ghanaian">Ghanaian</option>
                                                                                        <option value="greek">Greek</option>
                                                                                        <option value="grenadian">Grenadian</option>
                                                                                        <option value="guatemalan">Guatemalan</option>
                                                                                        <option value="guinea-bissauan">Guinea-Bissauan</option>
                                                                                        <option value="guinean">Guinean</option>
                                                                                        <option value="guyanese">Guyanese</option>
                                                                                        <option value="haitian">Haitian</option>
                                                                                        <option value="herzegovinian">Herzegovinian</option>
                                                                                        <option value="honduran">Honduran</option>
                                                                                        <option value="hungarian">Hungarian</option>
                                                                                        <option value="icelander">Icelander</option>
                                                                                        <option value="indian">Indian</option>
                                                                                        <option value="indonesian">Indonesian</option>
                                                                                        <option value="iranian">Iranian</option>
                                                                                        <option value="iraqi">Iraqi</option>
                                                                                        <option value="irish">Irish</option>
                                                                                        <option value="israeli">Israeli</option>
                                                                                        <option value="italian">Italian</option>
                                                                                        <option value="ivorian">Ivorian</option>
                                                                                        <option value="jamaican">Jamaican</option>
                                                                                        <option value="japanese">Japanese</option>
                                                                                        <option value="jordanian">Jordanian</option>
                                                                                        <option value="kazakhstani">Kazakhstani</option>
                                                                                        <option value="kenyan">Kenyan</option>
                                                                                        <option value="kittian and nevisian">Kittian and Nevisian</option>
                                                                                        <option value="kuwaiti">Kuwaiti</option>
                                                                                        <option value="kyrgyz">Kyrgyz</option>
                                                                                        <option value="laotian">Laotian</option>
                                                                                        <option value="latvian">Latvian</option>
                                                                                        <option value="lebanese">Lebanese</option>
                                                                                        <option value="liberian">Liberian</option>
                                                                                        <option value="libyan">Libyan</option>
                                                                                        <option value="liechtensteiner">Liechtensteiner</option>
                                                                                        <option value="lithuanian">Lithuanian</option>
                                                                                        <option value="luxembourger">Luxembourger</option>
                                                                                        <option value="macedonian">Macedonian</option>
                                                                                        <option value="malagasy">Malagasy</option>
                                                                                        <option value="malawian">Malawian</option>
                                                                                        <option value="malaysian">Malaysian</option>
                                                                                        <option value="maldivan">Maldivan</option>
                                                                                        <option value="malian">Malian</option>
                                                                                        <option value="maltese">Maltese</option>
                                                                                        <option value="marshallese">Marshallese</option>
                                                                                        <option value="mauritanian">Mauritanian</option>
                                                                                        <option value="mauritian">Mauritian</option>
                                                                                        <option value="mexican">Mexican</option>
                                                                                        <option value="micronesian">Micronesian</option>
                                                                                        <option value="moldovan">Moldovan</option>
                                                                                        <option value="monacan">Monacan</option>
                                                                                        <option value="mongolian">Mongolian</option>
                                                                                        <option value="moroccan">Moroccan</option>
                                                                                        <option value="mosotho">Mosotho</option>
                                                                                        <option value="motswana">Motswana</option>
                                                                                        <option value="mozambican">Mozambican</option>
                                                                                        <option value="namibian">Namibian</option>
                                                                                        <option value="nauruan">Nauruan</option>
                                                                                        <option value="nepalese">Nepalese</option>
                                                                                        <option value="new zealander">New Zealander</option>
                                                                                        <option value="ni-vanuatu">Ni-Vanuatu</option>
                                                                                        <option value="nicaraguan">Nicaraguan</option>
                                                                                        <option value="nigerien">Nigerien</option>
                                                                                        <option value="north korean">North Korean</option>
                                                                                        <option value="northern irish">Northern Irish</option>
                                                                                        <option value="norwegian">Norwegian</option>
                                                                                        <option value="omani">Omani</option>
                                                                                        <option value="pakistani">Pakistani</option>
                                                                                        <option value="palauan">Palauan</option>
                                                                                        <option value="panamanian">Panamanian</option>
                                                                                        <option value="papua new guinean">Papua New Guinean</option>
                                                                                        <option value="paraguayan">Paraguayan</option>
                                                                                        <option value="peruvian">Peruvian</option>
                                                                                        <option value="polish">Polish</option>
                                                                                        <option value="portuguese">Portuguese</option>
                                                                                        <option value="qatari">Qatari</option>
                                                                                        <option value="romanian">Romanian</option>
                                                                                        <option value="russian">Russian</option>
                                                                                        <option value="rwandan">Rwandan</option>
                                                                                        <option value="saint lucian">Saint Lucian</option>
                                                                                        <option value="salvadoran">Salvadoran</option>
                                                                                        <option value="samoan">Samoan</option>
                                                                                        <option value="san marinese">San Marinese</option>
                                                                                        <option value="sao tomean">Sao Tomean</option>
                                                                                        <option value="saudi">Saudi</option>
                                                                                        <option value="scottish">Scottish</option>
                                                                                        <option value="senegalese">Senegalese</option>
                                                                                        <option value="serbian">Serbian</option>
                                                                                        <option value="seychellois">Seychellois</option>
                                                                                        <option value="sierra leonean">Sierra Leonean</option>
                                                                                        <option value="singaporean">Singaporean</option>
                                                                                        <option value="slovakian">Slovakian</option>
                                                                                        <option value="slovenian">Slovenian</option>
                                                                                        <option value="solomon islander">Solomon Islander</option>
                                                                                        <option value="somali">Somali</option>
                                                                                        <option value="south african">South African</option>
                                                                                        <option value="south korean">South Korean</option>
                                                                                        <option value="spanish">Spanish</option>
                                                                                        <option value="sri lankan">Sri Lankan</option>
                                                                                        <option value="sudanese">Sudanese</option>
                                                                                        <option value="surinamer">Surinamer</option>
                                                                                        <option value="swazi">Swazi</option>
                                                                                        <option value="swedish">Swedish</option>
                                                                                        <option value="swiss">Swiss</option>
                                                                                        <option value="syrian">Syrian</option>
                                                                                        <option value="taiwanese">Taiwanese</option>
                                                                                        <option value="tajik">Tajik</option>
                                                                                        <option value="tanzanian">Tanzanian</option>
                                                                                        <option value="thai">Thai</option>
                                                                                        <option value="togolese">Togolese</option>
                                                                                        <option value="tongan">Tongan</option>
                                                                                        <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                                                                                        <option value="tunisian">Tunisian</option>
                                                                                        <option value="turkish">Turkish</option>
                                                                                        <option value="tuvaluan">Tuvaluan</option>
                                                                                        <option value="ugandan">Ugandan</option>
                                                                                        <option value="ukrainian">Ukrainian</option>
                                                                                        <option value="uruguayan">Uruguayan</option>
                                                                                        <option value="uzbekistani">Uzbekistani</option>
                                                                                        <option value="venezuelan">Venezuelan</option>
                                                                                        <option value="vietnamese">Vietnamese</option>
                                                                                        <option value="welsh">Welsh</option>
                                                                                        <option value="yemenite">Yemenite</option>
                                                                                        <option value="zambian">Zambian</option>
                                                                                        <option value="zimbabwean">Zimbabwean</option>
                                                                                </select>
                                                                </div>

                                                    <div class="form-group" id="pass">
                                                                <label for="">Password:</label>
                                                                <input type="password" name="pass"    class="form-control" placeholder="Password">
                                                                <span class="forerror text-danger" ></span>
                                                    </div>
                                                    <div class="form-group" id="repass" >

                                                                <label for="">Re-Enter Password:</label>
                                                                <input type="password" name="repass" class="form-control" placeholder="Re-Enter password">
                                                                <span class="forerror text-danger" ></span>
                                                    </div>
                                                    
                                                    <div class="button-container">
                                                                <div class="row">
                                                                            <div class="col-9">
                                                                                            <button type="button" class="next-button btn btn-dark "  onclick="showStep('step1')">Previous</button>
                                                                            </div>
                                                                            <div class="col">
                                                                                        <button type="button" class="next-button btn btn-success"  onclick=validatesecondForm()>Next</button>
                                                                            </div>                                            
                                                                </div>
                                                    </div>
                                        </div>
                                        <div id="step3" style="display: none;">

                                    
                                            <label>Preferences and Interests:</label>
                                                    <div class="checkboxes" required>
                                                    <div class="row">
                                                    <div class="col-md-4">  <label><input type="checkbox" name="Tags[]" value="1" onclick="limitCheckboxSelection()"> Historical and Cultural Sites</label></div>
                                                   <div class="col-md-4">       <label><input type="checkbox" name="Tags[]" value="2" onclick="limitCheckboxSelection()"> Religious and Pilgrimage Sites</label></div>

                                                       <div class="col-md-4">     <label><input type="checkbox" name="Tags[]" value="3" onclick="limitCheckboxSelection()"> Hill Stations and View Towers</label></div>
                                                </div>
                                                <div class="row">
                                                <div class="col-md-4">      <label><input type="checkbox" name="Tags[]" value="4" onclick="limitCheckboxSelection()"> Trekking and Hiking Trails</label></div>
                                                <div class="col-md-4">     <label><input type="checkbox" name="Tags[]" value="5" onclick="limitCheckboxSelection()"> Trekking and Hiking</label></div>
                                                            
                                                <div class="col-md-4">   <label><input type="checkbox" name="Tags[]" value="6" onclick="limitCheckboxSelection()"> Natural Landscapes</label></div>

                                                </div>
                                                

                                                </div>
                                                    <div class="button-container">
                                                    <div class="row">
                                                                <div class="col-9">
                                                                                <button type="button" class="next-button btn btn-dark "  onclick="showStep('step2')">Previous</button>
                                                                </div>
                                                                <div class="col">
                                                                <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                                                                </div>                                            
                                                            </div>
                                                    </div>
                                        </div>
</form>
                        
                        </div>
                </div>
            </div>
        </div>
        <script>
            var element = document.getElementById("Element");
            function hideElement() {
      element.style.display = "none";
    }
    setTimeout(hideElement, 2000);



</script>
<script  src="Javascript/signup.js"></script>                     

</script>
   <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  
    </body>
</html>