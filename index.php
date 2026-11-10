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

        <fieldset>
            <legend>Which ones of these Asian countries do you view the most favorably?</legend>
            <div>
                <input id="afg" name="asia[]" type="checkbox" value="Afghanistan">
                <label for="afg">Afghanistan</label>
            </div>
            <div>
                <input id="isr" name="asia[]" type="checkbox" value="Israel">
                <label for="isr">Israel</label>
            </div>
            <div>
                <input id="pal" name="asia[]" type="checkbox" value="Palestine">
                <label for="pal">Palestine</label>
            </div>
            <div>
                <input id="sar" name="asia[]" type="checkbox" value="SaudiArabia">
                <label for="sar">Saudi Arabia</label>
            </div>
            <div>
                <input id="pak" name="asia[]" type="checkbox" value="Pakistan">
                <label for="pak">Pakistan</label>
            </div>
            <div>
                <input id="ind" name="asia[]" type="checkbox" value="India">
                <label for="ind">India</label>
            </div>
            <div>
                <input id="chn" name="asia[]" type="checkbox" value="China">
                <label for="chn">China</label>
            </div>
            <div>
                <input id="tha" name="asia[]" type="checkbox" value="Thailand">
                <label for="tha">Thailand</label>
            </div>
            <div>
                <input id="jpn" name="asia[]" type="checkbox" value="Japan">
                <label for="jpn">Japan</label>
            </div>
            <div>
                <input id="skr" name="asia[]" type="checkbox" value="SouthKorea">
                <label for="skr">South Korea</label>
            </div>
        </fieldset>

        <fieldset>
            <legend>Which ones of these African countries do you view the most favorably?</legend>
            <div>
                <input id="alg" name="africa[]" type="checkbox" value="Alegria">
                <label for="alg">Algeria</label>
            </div>
            <div>
                <input id="egy" name="africa[]" type="checkbox" value="Egypt">
                <label for="egy">Egypt</label>
            </div>
            <div>
                <input id="nig" name="africa[]" type="checkbox" value="Nigeria">
                <label for="nig">Nigeria</label>
            </div>
            <div>
                <input id="etp" name="africa[]" type="checkbox" value="Ethiopia">
                <label for="etp">Ethiopia</label>
            </div>
            <div>
                <input id="ghn" name="africa[]" type="checkbox" value="Ghana">
                <label for="ghn">Ghana</label>
            </div>
            <div>
                <input id="saf" name="africa[]" type="checkbox" value="SouthAfrica">
                <label for="saf">South Africa</label>
            </div>
            <div>
                <input id="tzn" name="africa[]" type="checkbox" value="Tanzania">
                <label for="tzn">Tanzania</label>
            </div>
            <div>
                <input id="mrc" name="africa[]" type="checkbox" value="Morocco">
                <label for="mrc">Morocco</label>
            </div>
        </fieldset>

        <fieldset>
            <legend>Which ones of these European countries do you view the most favorably?</legend>
            <div>
                <input id="bri" name="europe[]" type="checkbox" value="UnitedKingdom">
                <label for="bri">United Kingdom</label>
            </div>
            <div>
                <input id="fra" name="europe[]" type="checkbox" value="France">
                <label for="fra">France</label>
            </div>
            <div>
                <input id="ger" name="europe[]" type="checkbox" value="Germany">
                <label for="ger">Germany</label>
            </div>
            <div>
                <input id="hun" name="europe[]" type="checkbox" value="Hungary">
                <label for="bri">Hungary</label>
            </div>
            <div>
                <input id="pol" name="europe[]" type="checkbox" value="Poland">
                <label for="bri">Poland</label>
            </div>
            <div>
                <input id="spa" name="europe[]" type="checkbox" value="Spain">
                <label for="spa">Spain</label>
            </div>
            <div>
                <input id="gre" name="europe[]" type="checkbox" value="Greece">
                <label for="gre">Greece</label>
            </div>
            <div>
                <input id="ita" name="europe[]" type="checkbox" value="Italy">
                <label for="bri">Italy</label>
            </div>
            <div>
                <input id="rus" name="europe[]" type="checkbox" value="Russia">
                <label for="bri">Russia</label>
            </div>
            <div>
                <input id="ukr" name="europe[]" type="checkbox" value="Ukraine">
                <label for="ukr">Ukraine</label>
            </div>
        </fieldset>

        <fieldset>
            <legend>Let us know your opinions</legend>
            <div>
                <label for="life">Can you share about the current life condition of citizens from your nation?</label>
                <textarea id="life" name="life">Write more here</textarea>
            </div>
            <div>
                <label for="eco">Do you think that a more developed economy guarantees better life condition? Why?</label>
                <textarea id="eco" name="eco">Write more here</textarea>
            </div>
        </fieldset>

    </form>
</body>
</html>