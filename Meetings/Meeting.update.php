<?php
/* 
Connects to the database
Enables the update function
*/
include '../classes/db.php';

class MeetingUpdate extends database
{
  private $dbconnect;


  //initialize the database connection
  function __construct()
  {
    $dbconnect = new database();
    $this->dbconnect = $dbconnect;
  }

  //fetch the data from the database as an array
  function selectMeeting()
  {
    //calls the connect function from the database class
    $connection = $this->dbconnect->connect();
    //holds the id of each post
    $id = $_GET['id'] ?? null;


    //If the id does not exist then exit the program 

    if (!$id) {
      header('Location:../MeetingView.php? errorid');
      exit;
    }
    //run the insert query
    $stmt = $connection->prepare('SELECT * FROM meetings WHERE id=:id');

    //assign the id from the database to the variable id
    $stmt->bindvalue(':id', $id);
    $stmt->execute();

    //fetch the all the data from the databse as an array
    $meetings = $stmt->fetch(PDO::FETCH_ASSOC);

    //created an array to hold the errors if they occur
    $error = [];

    //Assigning the values in the array gotten form the database
    $name = $meetings['name'];
    $link = $meetings['link'];
    $date = $meetings['date'];


    //Validation for the update

    //check if the button submitting is a post function
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $link = $_POST['link'];
      $date = $_POST['date'];

      //this makes sure the name field is not empty
      if (!$name) {
        $error[] = 'Name is required';
      }

      //Checks if there are no errors 
      //if there are no errors then run the query statements
      //then bind the values to the variables
      if (empty($error)) {
        $stmt = $connection->prepare("UPDATE meetings SET name=:name,link=:link,date=:date WHERE id=:id");
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':link', $link);
        $stmt->bindValue(':date', $date);
        $stmt->bindValue(':id', $id);

        //executes the query statement
        $stmt->execute();

        //redirects to the MeetingView
        header('Location:../MainInterface/Meetings.php');
      }
    }
    //return the array of values gotten from the database
    return $meetings;
  }
}


?>

<!-- 
    Example of the front end implementation
 -->
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href="app.cs">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Product CRUD</title>
</head>

<body>


  <div class="container border p-5 mt-5" style="justify-content: center; width:500px; background-color: rgba(34, 138, 214, 0.4);">
    <h3>Update Meeting</h3>


    <!-- Check if the error array is empty-->
    <?php if (!empty($errors)) : ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $error) : ?>
          <div><?php echo $error ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">

      <!-- Display the  values -->
      <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?php
                                                                    $test = new MeetingUpdate();
                                                                    $value =  $test->selectMeeting();
                                                                    echo $value['name'] ?>">
      </div>



      <div class="mb-3">
        <label>Link</label>
        <textarea type="text" name="link" class="form-control"><?php $test = new MeetingUpdate();
                                                                $value =  $test->selectMeeting();
                                                                echo $value['link'] ?></textarea>
      </div>


      <div class="mb-3">
        <label>Time</label>
        <input type="datetime-local" name="date" class="form-control" value="<?php $test = new MeetingUpdate();
                                                                              $value =  $test->selectMeeting();
                                                                              echo $value['date'] ?> ">
      </div>


      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <div>

    </table>
</body>

</html>