<?php
  $server_name = 'localhost';
  $username = 'LocalUser';
  $password = 'allen2000';
  $db_name = 'strdata';
  
  // mysqli 的四個參數分別為：伺服器名稱、帳號、密碼、資料庫名稱
  $conn = new mysqli($server_name, $username, $password, $db_name);

  if (!empty($conn->connect_error)) {
    die('資料庫連線錯誤:' . $conn->connect_error); // die()：終止程序
  } else {
    echo "連線成功" . "<br/>";
  }

  if (empty($_POST["key_data"]) || empty($_POST["data_text"])) { 
    die('資料接收錯誤'); 
  } else {
    echo "成功收到編號:" . $_POST['key_data'] . "<br/>";
    echo "成功收到資料:" . $_POST['data_text'] . "<br/>";
  }

  $num_data = $_POST['key_data'];
  $data_text = $_POST['data_text']; 

  $sql = sprintf(  // sprintf() 裡面可以放入替代字元
    // 插入新欄位，%s 代表字串，值是第二個參數
    "INSERT INTO staticdata(key_data, str_data) VALUES('%d', '%s')", $num_data, $data_text);
  
  // 執行結果存在 $result 這個變數中
  $result = $conn->query($sql);
  
  // 確認是否有拿到結果
  if (!$result) {
    die($conn->error);
    echo "上傳失敗";
  } else {
    echo "上傳成功";
  }

  $conn->close();

?>