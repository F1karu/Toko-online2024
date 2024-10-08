<?php
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Success message for user
$logout_message = "Anda berhasil logout!";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logout</title>
  <script src="https://unpkg.com/sweetalert2@11"></script> </head>
<body>

<script>
  Swal.fire({
    icon: 'success',
    title: 'Logout Berhasil!',
    text: '<?php echo $logout_message; ?>',
  }).then((result) => {
    if (result.isConfirmed) {
      // Redirect to login page after confirmation
      window.location.href = "login.php";
    }
  })
</script>

</body>
</html>