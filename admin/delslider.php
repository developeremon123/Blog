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
    if (!isset($_GET['delslider']) || $_GET['delslider'] == NULL) {
        header("Location: sliderlist.php ");
    }
    else {
        $delslider = $_GET['delslider'];

        $query = "SELECT * FROM tbl_slider WHERE id ='$delslider'";
        $getallpost = $db->select($query);
        if ($getallpost) {
            while ($delimg = $getallpost->fetch_assoc()) {
                $dellink = $delimg['image'];
                unlink($dellink);
            }
        }

        $delquery = "DELETE FROM tbl_slider WHERE id = '$delslider'";
        $deldata = $db->delete($delquery);
        if ($deldata) {
            echo "<script>alert('Slider Deleted Successfully');</script>";
            echo "<script>window.location = 'sliderlist.php';</script>";
        }else {
            echo "<script>alert('Slider Not Deleted');</script>";
            echo "<script>window.location = 'sliderlist.php';</script>";
        }
    }
?>