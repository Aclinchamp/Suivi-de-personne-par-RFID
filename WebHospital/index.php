<!DOCTYPE html>
<html lang="FR">
    <head>
        <meta charset="UTF-8">
        <title>Hospital Tracking</title>
        <link href="assert/css/bootstrap.css" rel="stylesheet">

    </head>
    <body>
        <header>
            <?php include("src/navBar.php"); ?>
        </header>
        <div class="container-fluid" id="page-auth">

            <div class="row">
                <div class="col-sm">
                    <h2>Please Log In</h2>
                    <form action="src/connect.php" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="loginName" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your name">
                            <small class="form-text text-muted">We'll never share your informations with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="col-sm">

                </div>
            </div>

        </div>

        <div class="container-fluid" id="about">
            <div class="row">
                <div class="col">
                    <h2>About Hospital Tracking</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                        mollit anim id est laborum.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                        mollit anim id est laborum.
                    </p>

                    <img class="rounded mx-auto d-block" src="img/image.png">
                </div>
            </div>
        </div>

        <footer class="footer">
            <?php include("src/footer.php"); ?>
        </footer>
    </body>
</html>

<link href="assert/css/index.css" rel="stylesheet">
