<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/JobOpening.php";
    require_once __DIR__."/../src/Contact.php";

    $app = new Silex\Application();

    // Home Page
    $app->get("/", function() {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
            <title>Post a Job</title>
        </head>

        <body>
            <div class='container'>
                <div class='row'>
                  <div class='col-sm-6'>
                    <h1>Post a Job</h1>
                    <form action='/results'>
                        <div class='form-group'>
                            <label for='title'>Enter the job title:</label>
                            <input id='title' name='title' class='form-control' type='text'>
                        </div>
                        <div class='form-group'>
                            <label for='description'>Enter the job description:</label>
                            <input id='description' name='description' class='form-control' type='text'>
                        </div>
                        <div class='form-group'>
                            <label for='name'>Enter your name:</label>
                            <input id='name' name='name' class='form-control' type='text'>
                        </div>
                        <div class='form-group'>
                            <label for='phone'>Enter your phone number:</label>
                            <input id='phone' name='phone' class='form-control' type='number'>
                        </div>
                        <div class='form-group'>
                            <label for='email'>Enter your email:</label>
                            <input id='email' name='email' class='form-control' type='text'>
                        </div>
                        <button type='submit' class='btn-success'>Submit</button>
                    </form>
                  </div>
                </div>
            </div>
        </body>
        </html>";
    });

    // Results Page
    $app->get("/results", function() {
        $contact = new Contact($_GET['name'], $_GET['phone'], $_GET['email']);
        $newJob = new JobOpening($_GET['title'], $_GET['description'], $contact);

        $output =
        "<h3>Job: " . $newJob->getTitle() . "</h3>
        <h4>Description: " . $newJob->getDescription() . "</h4>
        <p>Name: " . $contact->getName() . "</p>
        <p>Phone: " . $contact->getPhone() . "</p>
        <p>email: " . $contact->getEmail() . "</p><hr>";

        return "
        <!DOCTYPE html>
        <html>
        <head>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
            <title>Posted Job</title>
        </head>

        <body>
            <div class='container'>
                <div class='row'>
                  <div class='col-sm-8'>"
                    . $output .
                  "</div>
                </div>
            </div>
        </body>
        </html>";
    });
    return $app;

?>
