<?php
if($_SESSION["uname"]){

}else{
    header("location:index.php?error=Login First");
}
?>