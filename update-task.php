<?php 
    // include the config file that we created last week
    require "../config.php";
    require "common.php";
    // run when submit button is clicked
    if (isset($_POST['submit'])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);  
            
            //grab elements from form and set as varaible
            $task =[
              "id"         => $_POST['id'],
              "taskname" => $_POST['taskname'],
              "taskdate"  => $_POST['taskdate'],
              "tasktime"   => $_POST['tasktime'],
              "tasknotes"   => $_POST['tasknotes'],
              "date"   => $_POST['date'],
            ];
            
            // create SQL statement
            $sql = "UPDATE `tasks` 
                    SET id = :id, 
                        taskname = :taskname, 
                        taskdate = :taskdate, 
                        tasktime = :tasktime, 
                        tasknotes = :tasknotes, 
                        date = :date 
                    WHERE id = :id";
            //prepare sql statement
            $statement = $connection->prepare($sql);
            
            //execute sql statement
            $statement->execute($task);
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
    // GET data from DB
    //simple if/else statement to check if the id is available
    if (isset($_GET['id'])) {
        //yes the id exists 
        
        try {
            // standard db connection
            $connection = new PDO($dsn, $username, $password, $options);
            
            // set if as variable
            $id = $_GET['id'];
            
            //select statement to get the right data
            $sql = "SELECT * FROM tasks WHERE id = :id";
            
            // prepare the connection
            $statement = $connection->prepare($sql);
            
            //bind the id to the PDO id
            $statement->bindValue(':id', $id);
            
            // now execute the statement
            $statement->execute();
            
            // attach the sql statement to the new task variable so we can access it in the form
            $task = $statement->fetch(PDO::FETCH_ASSOC);
            
        } catch(PDOExcpetion $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    } else {
        // no id, show error
        echo "No id - something went wrong";
        //exit;
    };
?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<p>task successfully updated.</p>
<?php endif; ?>

<h2>Edit a Task</h2>

<form method="post">
    
    <label for="id">ID</label>
    <input type="text" name="id" id="id" value="<?php echo escape($task['id']); ?>" >
    
    <label for="taskname">Task Name</label>
    <input type="text" name="taskname" id="taskname" value="<?php echo escape($task['taskname']); ?>">

    <label for="taskdate">Complete By</label>
    <input type="text" name="taskdate" id="taskdate" value="<?php echo escape($task['taskdate']); ?>">

    <label for="tasktime">Time</label>
    <input type="text" name="tasktime" id="tasktime" value="<?php echo escape($task['tasktime']); ?>">

    <label for="tasknotes">Notes</label>
    <input type="text" name="tasknotes" id="tasknotes" value="<?php echo escape($task['tasknotes']); ?>">
    
    <label for="date">Updated </label>
    <input type="text" name="date" id="date" value="<?php echo escape($task['date']); ?>">

    <input type="submit" name="submit" value="Save">

</form>





<?php include "templates/footer.php"; ?>