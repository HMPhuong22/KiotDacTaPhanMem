function checkNameandEmail(){
    var name = document.getElementById("fullname").value;
    var email = document.getElementById("email").value;

    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; 

    if(name == ""){
        alert("Vui lòng nhập tên");
        return false;
    }
    if(email == ""){
        alert("Vui lòng nhập Email");
        return false;
    } 
    if(!emailPattern.test(email)){
        alert('Định dạng không đúng');
        return false;
    }
}

function checkGioitinh(){
    var gender = document.querySelector("gender");
    if(gender === null){
        alert("Vui lòng chọn giới tính");
        return  false;
    }   
    return true;
}

function Main(){
    if(checkNameandEmail()){
        if(checkGioitinh()){
            return true;
        }
    }
    return false;
}