<?php 

    require "../config.php";
    require "common.php";

    if (isset($_POST['submit'])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);  
            
            $task =[
              "id"         => $_POST['id'],
              "taskname" => $_POST['taskname'],
              "taskdate"  => $_POST['taskdate'],
              "tasktime"   => $_POST['tasktime'],
              "tasknotes"   => $_POST['tasknotes'],
              "date"   => $_POST['date'],
            ];
            
            $sql = "UPDATE `tasks` 
                    SET id = :id, 
                        taskname = :taskname, 
                        taskdate = :taskdate, 
                        tasktime = :tasktime, 
                        tasknotes = :tasknotes, 
                        date = :date 
                    WHERE id = :id";

            $statement = $connection->prepare($sql);
            

            $statement->execute($task);
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    if (isset($_GET['id'])) {
        
        try {
            $connection = new PDO($dsn, $username, $password, $options);
            
            $id = $_GET['id'];
            
            $sql = "SELECT * FROM tasks WHERE id = :id";
            
            $statement = $connection->prepare($sql);
            
            $statement->bindValue(':id', $id);
            
            $statement->execute();
            
            $task = $statement->fetch(PDO::FETCH_ASSOC);
            
        } catch(PDOExcpetion $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    } else {
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
