<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body class="bodyContent">


<form action="" enctype="multipart/form-data" 
method="post"><div>
Select image :
<input type="file" name="file"><br/><br/></div>
<input type="submit" value="Upload" style="margin-bottom:1em"
name="Submit1"> <br/>
</form>
<?php
if(isset($_POST['Submit1']))
{
$target_path = "images.jpeg" . $_FILES["file"]["name"];

}

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    // Call Python script to process the image
    $command = escapeshellcmd('python3 app.py ' . $target_file);
    $output = shell_exec($command);
    $formatted_output = nl2br($output);
   
    $output_lines = explode("<br />", $formatted_output);
    echo "<img src=".$_FILES["file"]["name"]." height=200 width=300 /></br></br>";
    // Remove the first two lines
    if (count($output_lines) >= 2) {
        unset($output_lines[0]);
        unset($output_lines[1]);
        unset($output_lines[2]);
    }
    
    // Rejoin the remaining lines and echo the result
    $formatted_output = implode("<br />", $output_lines);
    echo "<b>".$formatted_output;


    // Clean up the uploaded image
    unlink($target_file);
?>


</body>
<style>
    html {
        display:flex; 
        height: 100vh;
        width: 100vw;
        align-items:center;
        justify-content:center;
        background: #d1e9ff;
    }
    .bodyContent {
        min-height: 80vh;
        min-width: 50vw;
        display:flex;
        flex-direction: column;
        gap: 1em;
        align-items:center;
        justify-content:center;
        box-shadow: 1px 1px 10px gray;
        border-radius: 10px;
        font-size: 2em;
        padding: 1.5em 0;
        background: #eaeaea;
        font-weight:bold;
    }

    input {
        font-size: 0.6em;
        max-width: fit-content;
        padding: 0 1.6em;
        align-self:center;
    }

    form {
        display:flex;
        flex-direction:column;
        gap: 1em;
    }
</style>
</html>