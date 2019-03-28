<?php 

if (isset($_POST['submit'])) {
	
    require "../config.php"; 
    
	try {

        $connection = new PDO($dsn, $username, $password, $options);

        $new_task = array( 
            "taskname" => $_POST['taskname'], 
            "taskdate" => $_POST['taskdate'],
            "tasktime" => $_POST['tasktime'],
            "tasknotes" => $_POST['tasknotes'], 
        );
        
        $sql = "INSERT INTO tasks (taskname, taskdate, tasktime, tasknotes) VALUES (:taskname, :taskdate, :tasktime, :tasknotes)";        
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_task);
        
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}	
}
?>


<?php include "templates/header.php"; ?>

<h2>Add a Task</h2>

<?php if (isset($_POST['submit']) && $statement) { ?>
<p>task successfully added!</p>
<?php } ?>

<form method="post">
    <label for="taskname">Task Name</label>
    <input type="text" name="taskname" id="taskname">

    <label for="taskdate">Complete By</label>
    <input type="text" name="taskdate" id="taskdate">

    <label for="tasktime">Time</label>
    <input type="text" name="tasktime" id="tasktime">

    <label for="tasknotes">Notes</label>
    <input type="text" name="tasknotes" id="tasknotes">

    <input type="submit" name="submit" value="Submit">

</form>

<?php include "templates/footer.php"; ?>
