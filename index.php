<?php 
//DB Connection
//INSERT INTO `notes` (`sno`, `title`, `description`, `timestamp`) VALUES (NULL, 'perform crud', 'Hey dev you have to perform crud today. please be professional to do so.', current_timestamp());
$insert=false;
$server="localhost";
$username="root";
$dbpass="";
$dbname="iNotes";
  
    $conn= mysqli_connect($server,$username,$dbpass,$dbname)  ;
    if(!$conn){
        die("failed to connect" .mysqli_connect_error());
    }
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  
        $title=$_POST['title'];
        $description=$_POST['description'];

        $query= "INSERT INTO `notes` ( `title`, `description`) VALUES ( '$title', '$description');";

$result1=mysqli_query($conn,$query);
if(!$result1){
    echo " <script>alert('Failed to insert record.')</script>";
}else{
    $insert=true;
} 
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iNotes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
   
  </head>
  <body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Crud Ops</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">ABOUT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">CONTACT US</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">HOME</a>
        </li>
       
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<?php 

if ($insert) {
  echo'  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Note Added!</strong> Your note has been added successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>
    </header>
    <main>
        <div class="container my-4">
            <h2>Add a Note</h2>
        <form class="my-4" action="/crud/index.php" method="POST">
  <div class="mb-3">
    <label for="title" class="form-label">Note Title</label>
    <input type="text" class="form-control" id="title" name="title" >
    
  </div>
  <div class="mb-3">
    <label for="desc" class="form-label">Note Description</label>
    <textarea class="form-control" name="description" id="description"  rows="3"></textarea>
  </div>
 
  <button type="submit" class="btn btn-primary">Add Note</button>
</form>
        </div>

        <div class="container">



        <?php 
        $sql="SELECT * FROM `notes`;";

        $result=mysqli_query($conn,$sql) or   die("failed to execute");
        // print_r($result);
    
        if(mysqli_num_rows($result) > 0){
    
    
            ?>
              
                <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S. NO</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
            // echo "record found";
    while($row=mysqli_fetch_assoc($result)){
    
    
    
    echo "<tr>";
    echo "<th scope='row'>".$row["sno"]."</th>";
    echo "<td>".$row["title"]."</td>";
    echo "<td>".$row["description"]."</td>";
  
    echo "<td>
    <a href='update.php?id=".$row["sno"]."' class='btn btn-success'>Update</a>
    <a href='' class='btn btn-danger'>Delete</a>
    </td>";
    
    
    echo "</tr>";
    
    }
    
    echo "  </tbody>";
    echo "</table>";
    
      }else{
            echo "record not found";
    
        }

        
        ?>
        </div>
    </main>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
 
    <script>
        	
let table = new DataTable('#myTable');

    </script>
  </body>
</html>