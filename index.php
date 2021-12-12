<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Captec Group</title>
</head>

<body>
    <div class="container-fluid captec-blue">
        <div class="container">
            <img src="images/captec_logo.png" class="img-fluid py-5" alt="Captec logo">
        </div>
    </div>
    <div class="container-fluid bg-nav">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link active" href="#"></a>
                        <!--Home <span class="sr-only">(current)</span></a>-->
                        <a class="nav-item nav-link" href="#">Login</a>
                        <a class="nav-item nav-link" href="#">View</a>
                        <a class="nav-item nav-link disabled" href="#">Manage</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="container d-flex justify-content-center align-items-center test">

        <div class="form-container ">
            <form>
                <h3 class="login-text">Please login</h3>
                <div class="form-group my-1 ">
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group ">
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    <button type="submit" class="btn-login">Submit</button>
                </div>
            </form>
        </div>
    </div>







    <div class="container-fluid fixed-bottom captec-blue border-top border-5 border-warning">
        <div class="container"></div>
    </div>
    <script src="login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
</body>

</html>