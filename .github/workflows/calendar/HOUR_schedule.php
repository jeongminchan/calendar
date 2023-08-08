<?php
// 데이터베이스 접속 정보
$host = "localhost";
$user = "root";
$password = "0000";
$database = "tool";

// POST 데이터로부터 날짜값 받아오기
$date = $_POST['date'];

// 데이터베이스 연결
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// 쿼리 작성 및 실행
$sql = "SELECT todo_title FROM events WHERE '$date' BETWEEN startdate AND enddate AND ispublic = 1";
$result = $conn->query($sql);

// 결과 처리
if ($result->num_rows > 0) {
    // 쿼리 결과에서 todo_title 값을 배열로 저장
    $titles = array();
    while ($row = $result->fetch_assoc()) {
        $titles[] = $row['todo_title'];
    }
    echo json_encode($titles); // JSON 형태로 결과 반환
} else {
    echo json_encode(array()); // 결과가 없는 경우 빈 배열 반환
}

$conn->close(); // 데이터베이스 연결 종료
?>
