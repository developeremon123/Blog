<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
<?php 
    if (!isset($_GET['viewid']) || $_GET['viewid'] == NULL) {
        echo "<script>window.location = 'postlist.php';</script>";
    }else {
        $post = $_GET['viewid'];
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>View Post</h2>
        <?php 
            if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                
            }
        ?>
        <div class="block">      
            <?php 
                $query = "SELECT * FROM tbl_post WHERE id = '$post' ORDER BY id DESC";
                $getpost = $db->select($query);
                while ($postres = $getpost->fetch_assoc()){
            ?>         
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" readonly value="<?php echo $postres['title']?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select">
                                <option >Select Category </option>
                                <?php 
                                    $query = "SELECT * FROM tbl_category";
                                    $categrory = $db->select($query);
                                    if ($categrory) {
                                        while ($result = $categrory->fetch_assoc()) {
                                ?>
                                <option 
                                <?php 
                                    if ($postres['cat'] == $result['id']) {?>
                                        selected = "selected"
                                    
                                <?php } ?>
                                    value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?>
                                </option>
                                <?php }} ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $postres['image']?>" height="100px" width="200px">
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" readonly ><?php echo $postres['body']?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" readonly value="<?php echo $postres['tags']?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" readonly value="<?php echo $postres['author']?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="OK" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php } ?>
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