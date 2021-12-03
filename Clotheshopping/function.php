<?php 

$db = mysqli_connect("localhost","root","","shopping");


function getWCats(){

    global $db;
    
    $get_p_cats = "select * from product_categories where cat_id=2";
    
    $run_p_cats = mysqli_query($db,$get_p_cats);

    while($row_p_cats=mysqli_fetch_array($run_p_cats)){

        $p_cat_id = $row_p_cats['p_cat_id'];

        $p_cat_title = $row_p_cats['p_cat_title'];
        
        echo "
            <li> 
                <a href='category.php?p_cat=$p_cat_id'> $p_cat_title </a>            
            </li>
        ";

    }

}

function getMCats(){

    global $db;
    
    $get_p_cats = "select * from product_categories where cat_id=1";
    
    $run_p_cats = mysqli_query($db,$get_p_cats);

    while($row_p_cats=mysqli_fetch_array($run_p_cats)){

        $p_cat_id = $row_p_cats['p_cat_id'];

        $p_cat_title = $row_p_cats['p_cat_title'];
        
        echo "
            <li> 
                <a href='category.php?p_cat=$p_cat_id'> $p_cat_title </a>            
            </li>
        ";

    }

}

?>





