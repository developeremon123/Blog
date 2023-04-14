<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
<?php
    if (isset($_GET['seenid'])) {
        $seenid = $_GET['seenid'];
        $query = "UPDATE tbl_contact SET status = '1' WHERE id = '$seenid'";
        $update = $db->update($query);
        if ($update) {
            echo "<span class='success'>Message sent in the seen box</span>";
        } else {
            echo "<span class='error'>Something Went Wrong</span>";
        }
    }
?>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $query = "SELECT * FROM tbl_contact WHERE status ='0' ORDER BY id DESC";
                    $contact = $db->select($query);
                    if ($contact) {
                        $i=0;
                        while ($result = $contact->fetch_assoc()) {
                            $i++
		        ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i;?></td>
                        <td><?php echo $result['firstname'].' '.$result['lastname'];?></td>
                        <td><?php echo $result['email'];?></td>
                        <td><?php echo $fm->textShorten($result['body'], 50);?></td>
                        <td><?php echo $fm->formatdate($result['date']);?></td>
                        <td>
                            <a href="view.php?msgid=<?php echo $result['id'];?>">View</a> ||
                            <a href="reply.php?replyid=<?php echo $result['id'];?>">Reply</a> ||
                            <a onclick= "return confirm('Are you sure to move the message !');" href="?seenid=<?php echo $result['id'];?>">Seen</a>
                        </td>
                    </tr>
                    <?php } }?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box round first grid">
        <h2>Seen Message</h2>
        <?php 
            if (isset($_GET['delid'])) {
                $delcat = $_GET['delid'];
                $query = "DELETE FROM tbl_contact WHERE id = '$delcat'";
                $delete = $db->delete($query);
                if ($delete) {
                    echo "<span class='success'>Deleted Successfully.</span>";
                } else {
                    echo "<span class='error'>Message Not Deleted.</span>";
                }
            }
            ?>
        <div class="block">        
        <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $query = "SELECT * FROM tbl_contact WHERE status ='1' ORDER BY id DESC";
                    $contact = $db->select($query);
                    if ($contact) {
                        $i=0;
                        while ($result = $contact->fetch_assoc()) {
                            $i++
		        ?>
                <?php
                    if (isset($_GET['unseenid'])) {
                        $unseenid = $_GET['unseenid'];
                        $query = "UPDATE tbl_contact SET status = '0' WHERE id = '$unseenid'";
                        $update = $db->update($query);
                        if ($update) {
                            echo "<span class='success'>Message sent in the unseen box</span>";
                        } else {
                            echo "<span class='error'>Something Went Wrong</span>";
                        }
                    }
                ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i;?></td>
                        <td><?php echo $result['firstname'].' '.$result['lastname'];?></td>
                        <td><?php echo $result['email'];?></td>
                        <td><?php echo $fm->textShorten($result['body'], 50);?></td>
                        <td><?php echo $fm->formatdate($result['date']);?></td>
                        <td>
                            <a href="view.php?msgid=<?php echo $result['id'];?>">View</a> ||
                            <a onclick= "return confirm('Are you sure to move the message !');" href="?unseenid=<?php echo $result['id'];?>">Unseen</a> ||
                            <a onclick= "return confirm('Are you sure to Delete!');" href="?delid=<?php echo $result['id'];?>">Delete</a>
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