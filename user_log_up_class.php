<?php
session_start();
?>
<table cellpadding="0" cellspacing="0" border="0">
  <tbody>
    <?php
    //Connect to database
    require 'connectDB.php';
    if (isset($_POST['log_date'])) {
      if ($_POST['student_class'] != 0) {
        $_SESSION['student_class'] = $_POST['student_class'];
        $_SESSION['tanggal'] = $_POST['tanggal'];
      } else {
        $_SESSION['student_class'] = "";
        $_SESSION['tanggal'] = "";
      }
    }

    // var_dump($_SESSION['student_class']);
    // var_dump($_SESSION['tanggal']);

    if ($_POST['select_date'] == 1) {
      $_SESSION['tanggal'] = date("Y-m-d");
      $_SESSION['student_class'] = "";
    } else if ($_POST['select_date'] == 0) {
      if (isset($_SESSION['student_class'])) {
        $student_class = $_SESSION['student_class'];
        $tanggal = $_SESSION['tanggal'];
      }
    }

    if (isset($_SESSION['student_class'])) {
      $sql = "SELECT * FROM users_logs WHERE student_class='$student_class' AND checkindate='$tanggal' ORDER BY id DESC";
      $result = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($result, $sql)) {
        echo '<p class="error">SQL Error</p>';
      } else {
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if (mysqli_num_rows($resultl) > 0) {
          while ($row = mysqli_fetch_assoc($resultl)) {
    ?>
            <TR>
              <TD><?php echo $row['id']; ?></TD>
              <TD><?php echo $row['username']; ?></TD>
              <TD><?php echo $row['serialnumber']; ?></TD>
              <TD><?php echo $row['fingerprint_id']; ?></TD>
              <TD><?php echo $row['parent_number']; ?></TD>
              <TD><?php echo $row['student_number']; ?></TD>
              <TD><?php echo $row['checkindate']; ?></TD>
              <TD><?php echo $row['timein']; ?></TD>
              <TD><?php echo $row['timeout']; ?></TD>
            </TR>
    <?php
          }
        }
      }
    }
    ?>
  </tbody>
</table>