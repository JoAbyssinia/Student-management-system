<?php
session_start();
$_SESSION['user']=="";
$_SESSION['who']=="";
session_unset();
session_destroy();

?>
<script language="javascript">
document.location="index.php";
</script>
