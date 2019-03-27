<?php 

// this code will only execute after the submit button is clicked
if (isset($_POST['submit'])) {
	
    // include the config file that we created before
    require "../config.php"; 
    
    // this is called a try/catch statement 
	try {
        // FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
		
        // SECOND: Get the contents of the form and store it in an array
        $new_task = array( 
            "taskname" => $_POST['taskname'], 
            "taskdate" => $_POST['taskdate'],
            "tasktime" => $_POST['tasktime'],
            "tasknotes" => $_POST['tasknotes'], 
        );
        
        // THIRD: Turn the array into a SQL statement
        $sql = "INSERT INTO tasks (taskname, taskdate, tasktime, tasknotes) VALUES (:taskname, :taskdate, :tasktime, :tasknotes)";        
        
        // FOURTH: Now write the SQL to the database
        $statement = $connection->prepare($sql);
        $statement->execute($new_task);
        
	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}	
}
?>


<?php include "templates/header.php"; ?>

<h2>Add a Task</h2>

<?php if (isset($_POST['submit']) && $statement) { ?>
<p>task successfully added!</p>
<?php } ?>

<!--form to collect data for each artwork-->

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