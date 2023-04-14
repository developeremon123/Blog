<?php 
	include '../lib/Session.php';
	Session::checkSession();
?>
<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>
<?php include '../helpers/Format.php';?>
<?php 
$db = new Database;
?>
<?php 
    if (!isset($_GET['deletepage']) || $_GET['deletepage'] == NULL) {
        header("Location: index.php ");
    }
    else {
        $delpage = $_GET['deletepage'];

       
        

        $delquery = "DELETE FROM tbl_page WHERE id = '$delpage'";
        $deldata = $db->delete($delquery);
        if ($deldata) {
            echo "<script>alert('Page Deleted Successfully');</script>";
            echo "<script>window.location = 'index.php';</script>";
        }else {
            echo "<script>alert('Page Not Deleted');</script>";
            echo "<script>window.location = 'index.php';</script>";
        }
    }
?>