<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Theme</h2>
        <div class="block copyblock"> 
        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $theme = mysqli_real_escape_string($db->link,$_POST['theme']);
            
                $query = "UPDATE tbl_theme SET theme = '$theme' WHERE id = 1";
                $update = $db->update($query);
                if ($update) {
                    echo "<span class='success'>Change Theme Successfully</span>";
                } else {
                    echo "<span class='error'>Theme Not Change</span>";
                }
            }
        ?>
        <?php 
            $query = "SELECT * FROM tbl_theme WHERE id = 1";
            $themes = $db->select($query);
            while ($result = $themes->fetch_assoc()) {
        ?>
            <form action="" method="POST">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="radio" <?php if($result['theme'] == 'default'){echo 'Checked';}?> name='theme' value="default" />Default
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" <?php if($result['theme'] == 'green'){echo 'Checked';}?> name='theme' value="green"/>Green
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" <?php if($result['theme'] == 'red'){echo 'Checked';}?> name='theme' value="red"/>Red
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Change" />
                        </td>
                    </tr>
                </table>
            </form>
        <?php } ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'?>
