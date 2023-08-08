<?php
// POST 요청 처리
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 캘린더 이름 가져오기
    $calendarName = $_POST["favoritecalendarName"];

    // 데이터베이스 연결 설정
    $servername = "localhost";
    $username = "root";
    $password = "0000";
    $dbname = "tool";

    // 데이터베이스 연결
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 연결 확인
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // INSERT 쿼리 실행
    $sql = "INSERT INTO favorite_calendar_list (fav_cal_name) VALUES ('$calendarName')";

    if ($conn->query($sql) === TRUE) {
        // 캘린더 추가 성공 메시지 전달
        $message = "관심 캘린더 목록에 추가되었습니다.";
        echo json_encode($message);
    } else {
        // 에러 메시지 전달
        $message = "Error: " . $sql . "<br>" . $conn->error;
        echo json_encode($message);
    }

    // 연결 종료
    $conn->close();
}
?>
