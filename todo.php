<?php 
 $con = new MongoClient("mongodb://127.0.0.1:27017");
 $db=$con->todo;
 $collection = $db->createCollection("lisy");
 //echo "connection created";
 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Todo list</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.css" >
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> 
</head>
<body><br>
 <div class="container text-center">
 	<br>
 	<h3 class="text-success">
 		This is ToDo list
  	</h3>
     <form action="todo.php" method="post"  class="container text-justify justify-content-center ">
       <div class="container">
        <input type="text" name="item" class="form-control"  required> 	
       </div>
       <br>
      <div class="container text-center">
        <input type="submit"  name="submit" class="btn btn-success text-center" required>   	
      </div>
     </form>
    

   <br><br>
   <div class="container text-center">
   	 <?php 
        if (isset($_POST['submit'])) {
        	# code...
         $arr = array('item' => $_POST['item'] );
         $collection->insert($arr);
        }       	 
      $result = $collection->find();
      echo "<div class='container'><table class='table table-bordered text-center table-hover table-striped table-responsive-sm'>";
      echo "<tr><th>List</th><th>Action</th></tr>";
      foreach ($result as $key ) {

        echo "<tr><td>".$key['item']."</td>";  
        echo "<td><a class='btn btn-success' href='todo.php?del=".$key['item']."'";
        //echo  $key['item'];
        echo ">Delete</a> </td></tr>";
         //echo "<br>".$_GET['del'];  
      }
       echo "</table></div>";
     // delete button working
       if(isset($_GET['del'])){
       	  $id = $_GET['del'];
       	   $arr = array('item'=>$id);
           $collection->remove($arr);
       	  header("location:todo.php");
       }

   	 ?>
   </div>

 </div>	

</body>
</html>