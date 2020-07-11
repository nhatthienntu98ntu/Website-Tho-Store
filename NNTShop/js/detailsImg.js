let changeImg = (id) => {
    // Đầu tiên ta lấy đường link ảnh của img bằng thuộc tính getAtribute 
    // bằng id sau đó ta gán đường link đó
    // cho div còn lại bằng thuộc tính setAtribute
    var imgPath = document.getElementById(id).getAttribute('src')
    document.getElementById('main-image').setAttribute('src',imgPath)
    console.log("aaaa");
}