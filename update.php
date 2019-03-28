<?php 
	
    require "../config.php"; 
    
	try {
        $connection = new PDO($dsn, $username, $password, $options);
		
        $sql = "SELECT * FROM tasks";
        
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        $result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}	
?>

<?php include "templates/header.php"; ?>


<h2>Results</h2>

<?php foreach($result as $row) { ?>

<p>
    ID:
    <?php echo $row['id']; ?><br> Artist Name:
    <?php echo $row['taskname']; ?><br> Task Name:
    <?php echo $row['taskdate']; ?><br> Complete By:
    <?php echo $row['tasktime']; ?><br> Time:
    <?php echo $row['tasknotes']; ?><br> Notes:
    <a href='update-task.php?id=<?php echo $row['id']; ?>'>Edit</a>
</p>

<hr>
<?php };
?>





<?php include "templates/footer.php"; ?>
