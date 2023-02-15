<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //if submit button is clicked
    if (isset($_POST['submit']) && !empty($_POST['gallery'])) {

        //check if post data is alphanumeirc
        if (ctype_alnum($_POST['gallery'])) {
            //if this is true
            $gallery = $_POST['gallery'];

            //get all images in the gallery folder
            $files = glob("gallery" . $gallery . "/*");

            //loop through the files
            foreach ($files as $file) {
                //check if the selected gallery is equal to the session variable
                if ($gallery == $file) {
                    //if true, get the images from a particular gallery
                    $images = glob("gallery$file/*.{jpg,png,gif}", GLOB_BRACE);
                }
            }

            // asign gallery to a session variable
            $_SESSION['files'] = $files;
            //redirect back home
            header('Location: index.php');
        } else {
            //if false, redirect
            $_SESSION['error'] = 'You must a select a gallery';
            header('Location: index.php');
        }
    }
}
