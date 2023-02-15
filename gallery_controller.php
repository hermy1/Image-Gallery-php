<?php
session_start();

//if method is post
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  //if submit button is clicked
  if(isset($_POST['submit'])){
    //call the function
    
//selected value
$gallery = $_POST['gallery'];


//get all files in the gallery folder
$files = glob("gallery".$gallery."/*");

//loop through the files
foreach($files as $file){
  //check if the selected value is equal to the session variable
  if($gallery == $file){
    //if true, get the images from the selected gallery
    $images = glob("gallery$file/*.{jpg,png,gif}", GLOB_BRACE);
  }
}

//add images in a session variable
$_SESSION['files'] = $files;

//redirect
header('Location: index.php');


  }
} 



