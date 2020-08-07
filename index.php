<?php  include "database/db.php"  ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css
">




    <!-- Style CSS -->
      <link rel="stylesheet" href="css/style.css">

    <title>ERGDN Notebook</title>
  </head>
  <body>
    
 <!--home section-->
 <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Welcome to <span class="ergdn">ERGDN</span>  Notebook</h1>
    <p class="lead"><span class="ergdn">ERGDN</span> Notebook is basic PHP notebook and to do list applications.
      You can take notes and create lists with ergdn.
    </p>
  </div>
</div>
<?php  # added note before get note datas
              if(isset($_POST["addnote"])){
                  $addnote = $db->prepare("INSERT INTO note SET note=:note");
                  $addnote->execute([
                    "note"=> $_POST["note"]
                  ]);
                  if($addnote){   ?>
                    <div class="alert alert-success" role="alert">
                    Note added successfully!!
                    </div>

                <?php    }else{   ?>
                  <div class="alert alert-danger" role="alert">
                Error!!!
                  </div>
              <?php          }

              }
              
              ?>

              <?php 
              
              #added todo before get todo datas
              if(isset($_POST["addtodo"])){
                $addtodo = $db->prepare("INSERT INTO todo SET todo=:todo");
                $addtodo->execute([
                  "todo"=> $_POST["todo"]
                ]);
                if($addtodo){   ?>
                  <div class="alert alert-success" role="alert">
                  Todo added successfully!!
                  </div>

              <?php    }else{   ?>
                <div class="alert alert-danger" role="alert">
              Error!!!
                </div>
            <?php          }

            }
            

              
              ?>

    <div class="container">
      <div class="row">
          <div class="col-md-6 offset-md-3 mt-2">
              <!--button of Notebook-->
              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#notebook" aria-expanded="false" aria-controls="collapseExample">
                 Notebook
              </button>
               <!--button of To do List-->
              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#todo" aria-expanded="false" aria-controls="collapseExample">
                 Todo list
              </button>
             

          </div>
      </div>
    


      <div class="collapse mt-2" id="notebook">
          <div id="content">

            <form action="index.php" method="POST">


              <div class="form-group">
                <label for="exampleFormControlTextarea1">Please enter write note</label>
                <textarea class="form-control" name="note" id="note" rows="3"></textarea>
              </div>
      
              <button type="submit" name="addnote" class="btn btn-primary">Add to note</button>

             
            
            </form> 
            <?php 
                  
                  #delete note datas
                  if(isset($_GET["deletenote"])){
                    $delete_note= $db->prepare("DELETE FROM note WHERE id=:id");
                    $delete_note->execute(["id" => $_GET["deletenote"]]);


                    if($delete_note){
                      ?>  <div class="alert alert-primary" role="alert">
                      Deleted note
                    </div> 
                    <?php
                      header("Refresh:2, url=index.php ");   
                    }else{ ?>
                        <div class="alert alert-danger" role="alert">
                 Error!!
                    </div>
                    <?php header("Refresh:2, url=index.php");     
                  }
 
                   
                  }
                  
                  ?>


                    



            <?php 
                #get datas
            $notebook = $db->prepare("SELECT * FROM note");
            $notebook->execute();
            $row = $notebook->fetchAll(PDO::FETCH_OBJ);


 
              ?>
              <table id="books" class="table mt-3" collpading="10px" style="text-align: center">
                  <thead>
                      <tr>
                          <th>Not Id</th>
                         <th>Note</th>
                         <th>Operation</th>

                      </tr>


                  </thead>
                  <tbody>

                  <?php foreach($row as $notebook_row){         ?>
                      <tr>
                        <td><?php echo $notebook_row->id;  ?></td>
                        <td><?php echo $notebook_row->note;  ?></td>
                        <td>
                        <a href="?deletenote=<?php echo $notebook_row->id ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>


                        </td>
                      </tr>


               <?php   }        ?>

                  </tbody>



              </table>
             


          </div>
      </div>


      <!-- to do section-->
      <div class="collapse mt-5 " id="todo">
      <form action="index.php" method="post">

        <div class="form-group">
          <label for="exampleInputEmail1">Add to To Do List</label>
          <input type="text" class="form-control" name="todo" id="todolist" aria-describedby="emailHelp">
         </div>
         <button type="submit" name="addtodo" class="btn btn-primary">Add </button>

      </form>


      <?php

#delete todo list
  if(isset($_GET["deletetodo"])){
    $delete_todo= $db->prepare("DELETE FROM todo WHERE id=:id");
    $delete_todo->execute(["id" => $_GET["deletetodo"]]);


    if($delete_todo){
      ?>  <div class="alert alert-primary" role="alert">
      Deleted Todo
    </div> 
    <?php
      header("Refresh:2, url=index.php ");   
    }else{ ?>
        <div class="alert alert-danger" role="alert">
 Error!!
    </div>
    <?php header("Refresh:2, url=index.php");     
  }

   
  }


?>

        <?php
        #get todo datas
        $todo = $db->prepare("SELECT * FROM todo");
        $todo->execute();
        $todo_row = $todo->fetchAll(PDO::FETCH_OBJ);
        ?>

      <table id="books" class="table mt-3" collpading="10px" style="text-align: center">
                  <thead>
                      <tr>
                          <th>Todo Id</th>
                         <th>Todo</th>

                      </tr>


                  </thead>
                  <tbody>

                  <?php foreach($todo_row as $row_todo){         ?>
                      <tr>
                        <td><?php echo $row_todo->id;  ?></td>
                        <td><?php echo $row_todo->todo;  ?></td>
                        <td>
                        <a href="?deletetodo=<?php echo $row_todo->id ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>


                        </td>
                      </tr>


               <?php   }        ?>

                  </tbody>



              </table>




      
      
      </div>
      

   

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>