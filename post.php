<?php include 'inc/header.php';?>
<?php
	if(!isset($_GET['id']) || $_GET['id'] == NULL ){
		header("Location: 404.php");
	}else{
		$id = $_GET['id'];
	}
?>
<div class="contentsection contemplete clear">
<div class="maincontent clear">
	<div class="about">
		<?php 
			$query = "SELECT * FROM tbl_post WHERE id = '$id'";
			$post = $db->select($query);
			if ($post) {
				while ($result = $post->fetch_assoc()) {
		?>
		<h4><?php echo $result['title'];?></h4>
		<h4><?php echo $fm->formatdate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
		<img style="height: 240px;" src="admin/<?php echo $result['image']; ?>" alt="post image"/>
		<?php echo $result['body']; ?>
		<div class="relatedpost clear">
			<h2>Related articles</h2>
			<?php 
				$catid =  $result['cat'];
				$queryrelated = "SELECT * FROM tbl_post WHERE cat ='$catid' ORDER BY rand() LIMIT 3";
				$relatredpost = $db->select($queryrelated);
				if ($relatredpost) {
					while ($relatedresult = $relatredpost->fetch_assoc()) {
			?>
			<a href="post.php?id=<?php echo $relatedresult['id']?>">
				<img style="height: 150px;" src="admin/<?php echo $relatedresult['image']; ?>" alt="post image"/>
			</a>
			<?php } } else {
				echo "No related post avaliable !!";}?>
		</div>
		<?php } } else {header("Location: 404.php"); } ?>
	</div>
</div>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/footer.php';?>