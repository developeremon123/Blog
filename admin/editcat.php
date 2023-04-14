<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
<?php 
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL ) {
        header('Location: catlist.php');
    }else {
        $catid = $_GET['catid'];
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock"> 
        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            if (empty($name)) {
                echo "<span class='error'>Field must not be empty</span>";
            }else {
                $query = "UPDATE tbl_category SET name = '$name' WHERE id = '$catid'";
                $update = $db->update($query);
                if ($update) {
                    echo "<span class='success'>Updated Successfully</span>";
                } else {
                    echo "<span class='error'>Not Updated Category</span>";
                }
                
            }
        }
        ?>
            <?php 
                $query = "SELECT * FROM tbl_category WHERE id = '$catid' ORDER BY id DESC";
                $category = $db->select($query);
                while ($result = $category->fetch_assoc()) {
            ?>
            <form action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name='name' value="<?php echo $result['name']; ?>" class="medium" />
                    </td>
                </tr>
                <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'?>
