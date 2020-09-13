<?php
    require "./Modules/Minifier/minifier.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Static Page Generator - By Bhaswanth Chiruthanuru</title>
        <meta name="author" content="Bhaswanth Chiruthanuru">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <link href="//cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <script src="//cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

        <link rel="stylesheet" type="text/css" href="./css/style.css" />

        <script type="text/javascript">
            var overlay = document.getElementById("overlay")
            window.addEventListener("load", function() {
                overlay.style.display = "none"
            })
            $('.summernote').summernote();
        </script>
    </head>
    <body>
        <!-- <div id="overlay">
            <div class="lds-spinner">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div> -->
        <nav class="navbar navbar-expand-sm navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href=".">Static Page Generator</a>
                </li>
            </ul>
        </nav>

        <div class="success">
            <?php

                if(isset($_POST['submit'])){
                    $name = $_POST['name'];
                    $title = $_POST['title'];
                    $content = $_POST['content'];

                    $template = fopen("./theme/template.html", "r") or die("Unable to open file");
                    $code = fread($template,filesize("./theme/template.html"));
                    fclose($template);

                    $post = str_replace("{{ content }}", $content, $code);
                    $post = TinyMinify::html($post);
                    
                    $url = "./theme/pages/".str_replace(" ", "-", $name) . ".html";
                    $page = fopen($url, "w");
                    fwrite($page, $post);
                    fclose($page);

                    echo "<div class='content'><p>Page Created successfully, <br/> <a href=". $url ."><button class='btn btn-lg submit'>View File</button></a></p></div>";

                    $array = array(
                        "title" => $title,
                        "name" => $name,
                        "url" => $url
                    );

                    $data = file_get_contents("./data.json");
                    $data = json_decode($data, true);
                    $data[] = $array;
                    $data = json_encode($data);
                    file_put_contents("./data.json", $data);


                    // file_put_contents($url, $post);
                } else {
                    echo "Not submitted";
                }

            ?>
        </div>
    </body>
</html>