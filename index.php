<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <link href="css/grid.css" rel="stylesheet" type="text/css">
    <title>PHP Survey</title>
</head>
<body>
    <header>
        <h1>Welcome to the GeoBuster Survey</h1>
    </header>
    
    <form action="">
        <fieldset>
            <legend>Tell us about yourself</legend>
            <div>
                <label for="fname">First Name</label>
                <input id="fname" name="fname" type="text">
            </div>
            <div>
                <label for="lname">Last Name</label>
                <input id="lname" name="lname" type="text">
            </div>
            <div>
                <label for="age">Age</label>
                <input id="age" name="age" type="number">
            </div> 
            <div>
                <label for="email">Email Address</label>
                <input id="email" name="email" type="email">
            </div> 
            <div>
                <label for="city">Current City</label>
                <input id="city" name="city" type="text">
            </div>          
            <div>
                <label for="cstate">Current State/Country</label>
                <input id="cstate" name="cstate" type="text">
            </div>         
            <div>
                <label for="bstate">Country of Origin</label>
                <input id="bstate" name="bstate" type="text">
            </div>     
            <div>
                <label for="fstate">Your favorite country (other than your own)</label>
                <input id="fstate" name="fstate" type="text">
            </div>     
        </fieldset>

    </form>
</body>
</html>