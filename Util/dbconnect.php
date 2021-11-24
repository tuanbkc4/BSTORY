
<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $database = 'bstory';

    // Tạo đối tượng kết nối
    $conn = new mysqli($dbhost,$dbuser,$dbpass,$database);

    //Thiết lập font chữ tiếng việt
    $conn->set_charset('utf8');

    // Kiểm tra kết nối
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);        
    }

?>	