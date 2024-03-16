function clearErrors(){
    errors=document.getElementsByClassName('forerror');
    for (let item of errors){
        item.innerHTML="";
    }
}
function seterror(id,error){
    //sets error inside tags of id
    element=document.getElementById(id);
    element.getElementsByClassName('forerror')[0].innerHTML=error;



}
function validatePlace(){
    var returnval=true;
    clearErrors();
    var placename=document.forms['myform']["p_name"].value;
    var description=document.forms['myform']["p_description"].value;
    var longitude=document.forms['myform']["p_longitude"].value;
    var latitude=document.forms['myform']["p_latitude"].value;

    if(placename.length==0){
        seterror("p_name","Name field cannot be empty");
        returnval=false;
    }else if(!/^[A-Za-z]+$/.test(placename)){
        seterror("name","Name field must contain alphabetical characters ");
        returnval=false;
    }else if(description.length==0){
        seterror("p_description","Discription field cannot be empty");
        returnval=false;

    }else{
        onclick=showStep('step2');
    }



    return returnval;
}
/*
function validatePlace2(){
    var returnval=true;
    clearErrors();
    if(longitude.length==0){
        seterror("p_name","longitude cannot be empty");
        returnval=false;
    }else if(latitude.length==0){
        seterror("latitude","latitude cannot be empty");
        returnval=false;
    }else{
        
    }
}*/


function showStep(step) {
    if (step === 'step1') {
        document.getElementById('step1').style.display = 'block';
        document.getElementById('step2').style.display = 'none';
        
    }else if(step === 'step2'){
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'block';
        
      

    } 
}

function limitCheckboxSelection() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"][name="interests[]"]');
    var checkedCount = 0;
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
        checkedCount++;
        }
    }
    if (checkedCount >= 3) {
        for (var i = 0; i < checkboxes.length; i++) {
        if (!checkboxes[i].checked) {
            checkboxes[i].disabled = true;
        }
        }
    } else {
        for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].disabled = false;
        }
    }
    }