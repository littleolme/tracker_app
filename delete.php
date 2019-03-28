<?php 
	
    require "../config.php";
    require "common.php";

    if (isset($_GET["id"])) {

        try {

            $connection = new PDO($dsn, $username, $password, $options);
            
            $id = $_GET["id"];
            
            $sql = "DELETE FROM tasks WHERE id = :id";

            $statement = $connection->prepare($sql);
            
            $statement->bindValue(':id', $id);
            
            $statement->execute();
		
            $success = "task successfully deleted";

        } catch(PDOException $error) {
            // if there is an error, tell us what it is
            echo $sql . "<br>" . $error->getMessage();
        }
    };

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
    <a href='delete.php?id=<?php echo $row['id']; ?>'>Delete</a>
</p>

<hr>
<?php }; 
?>





<?php include "templates/footer.php"; ?>
