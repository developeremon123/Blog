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
    if (!isset($_GET['delid']) || $_GET['delid'] == NULL) {
        header("Location: postlist.php ");
    }
    else {
        $post = $_GET['delid'];

        $query = "SELECT * FROM tbl_post WHERE id ='$post'";
        $getallpost = $db->select($query);
        if ($getallpost) {
            while ($delimg = $getallpost->fetch_assoc()) {
                $dellink = $delimg['image'];
                unlink($dellink);
            }
        }

        $delquery = "DELETE FROM tbl_post WHERE id = '$post'";
        $deldata = $db->delete($delquery);
        if ($deldata) {
            echo "<script>alert('Data Deleted Successfully');</script>";
            echo "<script>window.location = 'postlist.php';</script>";
        }else {
            echo "<script>alert('Data Not Deleted');</script>";
            echo "<script>window.location = 'postlist.php';</script>";
        }
    }
?>