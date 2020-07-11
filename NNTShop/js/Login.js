// Hàm kiểm tra có phải số hay không ?
let checkNumber = (number) => {
    for (let index = 0; index < number.length; index++) {
        if (number[index] <= '0' || number[index] >= '9') {
            return true;
        }
    }
    return false;
}
window.addEventListener('keydown', (e) => {
    // keyCode === 9 ==> Nút Tab
    if (e.keyCode === 9 && e.srcElement.name === 'userName') {
        if (taiKhoan.value.length > 8) {
            document.getElementById('error-username').innerHTML = "Tên đăng nhập không được quá 8 kí tự";
        } else {
            document.getElementById('error-username').innerHTML = "";
        }
        if (checkNumber(taiKhoan.value) === true) {
            document.getElementById('error-username').innerHTML = "Tên đăng nhập không được chứa kí tự đặc biệt"
        }
    }
    if (e.srcElement.name === 'userPass' && e.keyCode === 9){
        if (_.isEmpty(taiKhoan.value)) {
            document.getElementById('error-username').innerHTML = "Tài khoản không được để trống"
        }
    
        if (_.isEmpty(matKhau.value)) {
            document.getElementById('error-password').innerHTML = "Mật khẩu không được để trống"
        }
        else {
            document.getElementById('error-password').innerHTML = ""
        }
    }
})
let matKhau = document.getElementById('matKhau');
matKhau.onclick = function () {
    if (taiKhoan.value.length > 8) {
        document.getElementById('error-username').innerHTML = "Tên đăng nhập không được quá 8 kí tự";
    } else{
        document.getElementById('error-username').innerHTML = "";
    }
    if (checkNumber(taiKhoan.value) === true) {
        document.getElementById('error-username').innerHTML = "Tên đăng nhập không được chứa kí tự đặc biệt"
    }
    // _.isEmpty có trong hàm lodash js
    if (_.isEmpty(taiKhoan.value    )) {
        document.getElementById('error-username').innerHTML = "Vui lòng nhập tài khoản"
    }
}
