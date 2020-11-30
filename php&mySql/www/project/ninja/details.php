<?php

// check the get request id parameter
include 'config/db_connect.php';

if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    // use the double quotation is important " "
    $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

    if(mysqli_query($conn, $sql)){
        // success
        header('Location:index.php');
    }{
        //failure
        echo 'query error:' . mysqli_error($conn);
    }
}

    // -1
if ( isset( $_GET['id'] ) ) {
    // -2 check the dataBase has this id
    $id = mysqli_real_escape_string( $conn, $_GET['id'] );

    //-3 select the data from dataBase
    $sql = "SELECT * FROM pizzas WHERE id = $id";

    //-4 get query result
    $result = mysqli_query( $conn, $sql );

    //-5 fetch result in array format
    $pizza = mysqli_fetch_assoc( $result );

    // -6 make it free
    mysqli_free_result( $result );
    mysqli_close( $conn );
}

?>
<!DOCTYPE html>
<html lang="en">
    <?php include 'template/header.php';?>

    <div class="container center">
        <?php if ( $pizza ): ?>

            <h4><?php echo htmlspecialchars( $pizza['title'] ); ?></h4>
            <p> Created By: <?php echo htmlspecialchars( $pizza['email'] ); ?></p>
            <p> With ID: <?php echo htmlspecialchars( $pizza['id'] ); ?></p>
            <p><?php echo date($pizza['created_at']); ?></p>
            <h5>Ingredients: </h5>
            <p><?php echo htmlspecialchars( $pizza['ingredients'] ); ?></p>
            
            <!-- Delete Form  -->
            <form action="details.php" method="POST">
                <input type="hidden" name ="id_to_delete" value ="<?php echo $pizza['id']?> ;">
                <input type="submit" name="delete" value ="Delete" class="btn brand z-depth-0">
            </form>
        <?php else: ?>
            <h5>No such pizza exists </h5>

        <?php endif;?>

    </div>

    <?php include 'template/footer.php';?>

</html>