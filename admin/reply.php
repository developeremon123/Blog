<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
<?php 
    if (!isset($_GET['replyid']) || $_GET['replyid'] == NULL ) {
        header('Location: inbox.php');
    }else {
        $id = $_GET['replyid'];
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>View Message</h2>
<?php 
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $to_mail = $fm->validation($_POST['to_mail']);
        $subject = $fm->validation($_POST['subject']);
        $message = $fm->validation($_POST['message']);
        $from_mail = "From: ".$fm->validation($_POST['from_mail']);
        
        $sendmail = mail($to_mail,$subject,$message,$from_mail);
        if ($sendmail) {
            echo "<span class='success'>Message Reply Successfully.</span>";
        }else {
            echo "<span class='error'> Somethings Went Wrong !</span>";
        }
    }
?>
    <div class="block">               
            <form action="" method="post">
            <?php 
                $query = "SELECT * FROM tbl_contact WHERE id ='$id'";
                $reply = $db->select($query);
                if ($reply) {
                    while ($result = $reply->fetch_assoc()) {
		        ?>
                <table class="form">
                    <tr>
                        <td>
                            <label>To</label>
                        </td>
                        <td>
                            <input type="email" name="to_mail" readonly value="<?php echo $result['email'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>From</label>
                        </td>
                        <td>
                            <input type="email" name="from_mail" placeholder="Enter your email address" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Subject</label>
                        </td>
                        <td>
                            <input type="text" name="subject" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="message"></textarea>
                        </td>
                    </tr>
                    
                    <tr>
                        <td></td>
                        <td>
                            <input style="color: green; background:black ;" type="submit" name="submit" Value="Send" />
                        </td>
                    </tr>
                </table>
                <?php } }?>
            </form>
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