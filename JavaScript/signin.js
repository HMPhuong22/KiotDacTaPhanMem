function validate(){
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var passRepeat = document.getElementById("passRepeat").value;
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,16}$/;

    

    // Kiểm tra nhật đầy đủ thông tin
    if(username === ""){
        alert ("Vui lòng nhật tên đăng nhập");
        return false;
    }
    if(password === ""){
        alert ("Vui lòng nhập mật khẩu");
        return false;
    }

    // Kiểm tra biểu thức chính quy
    if(!regex.test(password)){
        alert ("Nhập không đúng định dạng mật khẩu");
        return false;
    }

    if(passRepeat === ""){
        alert ("Vui lòng xác nhận lại mật khẩu");
        return false;
    }

    // Xác nhận lại mật khẩu
    if(passRepeat !== password){
        alert ("Mật khẩu không khớp");
        return false;
    }
    return true;
}