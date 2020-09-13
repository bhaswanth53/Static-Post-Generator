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
    </head>
    <body>
        <div id="overlay">
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
        </div>
        <nav class="navbar navbar-expand-sm navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href=".">Static Page Generator</a>
                </li>
            </ul>
        </nav>

        <div class="content">
            <p>
                Create your blog posts as a static page using your own custom layout.
            </p>
        </div>

        <div class="container py-5">
            <div class="row">
                <div class="col-md-8">
                    <h1>Create Blog Post</h1>
                    <form method="POST" action="./process.php">
                        <div class="form-group">
                            <label class="control-label" for="title">Page Title</label>
                            <input type="text" class="form-control" name="title" />
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Page Name(Without extension)</label>
                            <input type="text" class="form-control" name="name" />
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="content">Content</label>
                            <textarea class="form-control summernote" name="content" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-lg submit" value="Build Page" />
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <h4>Previously Generated Pages</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $data = file_get_contents("./data.json");
                                    $data = json_decode($data, true);
                                    if(isset($data) && count($data) > 0) {
                                        foreach($data as $page) {
                                ?>
                                            <tr>
                                                <td><?php echo $page['title']; ?></td>
                                                <td><?php echo $page['name']; ?></td>
                                                <td>
                                                    <a href="<?php echo $page['url']; ?>" target="_blank">View File</a>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="3">No pages yet.</td></tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            var overlay = document.getElementById("overlay")
            window.addEventListener("load", function() {
                overlay.style.display = "none"
            })
            $('.summernote').summernote();
        </script>
    </body>
</html>