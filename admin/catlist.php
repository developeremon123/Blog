<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <div class="block">        
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $query = "SELECT * FROM tbl_category ORDER BY id DESC";
                $post = $db->select($query);
                if ($post) {
                    $i=0;
                    while ($result = $post->fetch_assoc()) {
                        $i++;
		    ?>
            <?php 
            if (isset($_GET['delcat'])) {
                $delcat = $_GET['delcat'];
                $query = "DELETE FROM tbl_category  WHERE id = '$delcat'";
                $delete = $db->delete($query);
                if ($delete) {
                    echo "<span class='success'>Deleted Successfully.</span>";
                } else {
                    echo "<span class='error'>Category Not Deleted.</span>";
                }
            }
            ?>
                <tr class="odd gradeX">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $result['name'];?></td>
                    <td>
                        <a href="editcat.php?catid=<?php echo $result['id'];?>">Edit</a> || 
                        <a onclick= "return confirm('Are you sure to Delete!');"href="?delcat=<?php echo $result['id'];?>">Delete</a>
                    </td>
                </tr>
                <?php } }?>
            </tbody>
        </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'?>