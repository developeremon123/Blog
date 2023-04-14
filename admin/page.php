<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
<?php 
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL ) {
        header('Location: catlist.php');
    }else {
        $id = $_GET['pageid'];
    }
?>
<style>
    .actiondel{
        margin-left: 10px;
    }
    .actiondel a{
        border: 1px solid #ddd;
        color: red;
        cursor: pointer;
        font-size: 20px;
        padding: 2px 10px;
        font-weight: normal;
        background: #f0f0f0 none repeat scroll 0 0;
    }
</style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Page</h2>
        <?php 
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $name  = mysqli_real_escape_string($db->link,$_POST['name']);
            $body   = mysqli_real_escape_string($db->link,$_POST['body']);
            
            if($name == "" || $body == "" ){
                 echo "<span class='error'>Field must not be empty!!</span>";
                } else{
                    $query = "UPDATE tbl_page SET name = '$name', body ='$body' WHERE id = '$id'";
                    $update = $db->update($query);
                    if ($update) {
                        echo "<span class='success'>Page Updated Successfully.</span>";
                    }else {
                        echo "<span class='error'>Page Not Updated!</span>";
                    }
                }
            }
        ?>
        <div class="block">   
        <?php 
            $pagequery = "SELECT * FROM tbl_page WHERE id = $id";
            $getpages = $db->select($pagequery);
            if ($getpages) {
                while ($result = $getpages->fetch_assoc()) {
        ?>            
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Body</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"><?php echo $result['body'];?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input style="color: green;" type="submit" name="submit" Value="Update" />
                            <span class="actiondel"><a onclick= "return confirm('Are you sure to Delete this page!');" href="delpage.php?deletepage=<?php echo $result['id'];?>">Delete</a></span>
                        </td>
                    </tr>
                </table>
            </form>
            <?php }}?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'?>