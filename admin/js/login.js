const form = document.querySelector(".login form"),
continueBtn = form.querySelector(".btn input"),
errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
    e.preventDefault(); /* ngăn form submit */
}

continueBtn.onclick = () => {
    //Start Ajax
    let xhr = new XMLHttpRequest(); //Tạo đối tượng XML (object để giao tiếp bất đồng bộ)
    xhr.open("POST","./php/login_back.php", true); /* (phương thức HTTP, URL mà ta sẽ gửi yêu cầu, yêu cầu có đồng bộ hay không) */
    xhr.responseType = 'text';    
    xhr.onload = () => { /* xử lí những request mà chúng ta nhận được */
        if (xhr.readyState === XMLHttpRequest.DONE){/* if (xhr.readyState === XMLHttpRequest.readyState.4)*//* chỉ định trạng thái yêu cầu */ /* request đã xong và dữ liệu trả về đã sẵn sàng để xử lí */
            if (xhr.status === 200){ /* Trạng thái của request: "OK"  để xác định request có thành công hay không*/
                let data = xhr.responseText.trim(); 
                console.log(data);
                if ((data != "success client")&&(data != "success admin")){
                    errorText.style.display = "block";
                    errorText.textContent = data; 
                } else if (data == "success client"){
                    location.href="client_shopping.php";
                } else {
                    location.href="admin_panel.php";
                    console.log('success admin');
                }
            }
        }
    }
    //Chúng ta cần gửi form dữ liệu qua Ajax đến php
    let formData = new FormData(form); //Khởi tạo đối tượng formData
    xhr.send(formData); //Gửi formData đến php
}