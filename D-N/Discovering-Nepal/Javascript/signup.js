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
function validateForm(){
    var returnval=true;
    clearErrors();
    var pattern=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;
   
    var name=document.forms['myform']["name"].value;
    var email=document.forms['myform']["email"].value;
    var age=document.forms['myform']["age"].value;
    var phone=document.forms['myform']["phone"].value;
    if (name.length === 0) {
        seterror("name", "Name field cannot be empty");
        returnval = false;
    }else if (!/^[A-Za-z\s]+$/.test(name)) {
        console.log(name); // Output the name to the console for debugging
        seterror("name", "Name field must contain alphabetical characters");
        returnval = false;
    } else if (name.length < 4) {
        seterror("name", "Length of the name is too short");
        returnval = false;
    
    
    }else if(email.length=== 0 ){
        seterror("email","Email field cannot be Empty");
        returnval=false;
    }else if(!pattern.test(email)){
        seterror("email","Email pattern did not match");
        returnval=false;
    }else if(phone.length===0){
        seterror("phone","Phone cannot be empty");
        returnval=false;

    }else if(!/^[0-9]{10}$/.test(phone)){
        seterror("phone","Phone should only contain numbers of 10 digit");
        returnval=false;
    }
    else if(age.length===0){
        seterror("age","Age cannot be empty");
        returnval=false;

    }else if(isNaN(age)){
        seterror("age","Age should only be in number");
    }else{
        onclick=showStep('step2');
    }

    
    
    return returnval;

}
function validatesecondForm(){
    var returnval=true;
    clearErrors();
    var PasswordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    
    var pass=document.forms['myform']["pass"].value;
    var repass=document.forms['myform']["repass"].value;

    if(pass.length==0){
        seterror("pass","Password cannot be empty");
        returnval=false;

    }else if(pass.length < 6){
        seterror("pass","Password should be 6 character long");
        returnval=false;

    }else if(!PasswordPattern.test(pass)){
        seterror("pass","Password pattern did not match");
        returnval=false;

    }else if(pass !== repass){
        seterror("repass","Password didnot match");
        returnval=false;

    }else{
        showStep('step3');
    }
    return returnval;


    
    console.log(pass);
    console.log(repass);

}
function showStep(step) {
    if (step === 'step1') {
        document.getElementById('step1').style.display = 'block';
        document.getElementById('step2').style.display = 'none';
        
    }else if(step === 'step2'){
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'block';
        document.getElementById('step3').style.display = 'none';
      

    } 
    else if(step === 'step3') {
        document.getElementById('step1').style.display = 'none';
        
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step3').style.display = 'block';
    }
    }

    function validateEmail() {
    // Email validation logic
    return true;
    }

function limitCheckboxSelection() {
var checkboxes = document.querySelectorAll('input[type="checkbox"][name="Tags[]"]');
var checkedCount = 0;
for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
    checkedCount++;
    }
}
if (checkedCount >= 2) {
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
