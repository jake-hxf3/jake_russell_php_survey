<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/includes/helpers.php';

$errors = $_SESSION['form_errors'] ?? [];
$warning = $_SESSION['warning'];
$submittedInputs = $_SESSION['form_input'] ?? [];

$_SESSION['form_input'] = [];
$_SESSION['form_errors'] = [];
$_SESSION['warning'] = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php 
            // this is to link the CSS files into PHP
            include "css/main.css";
            include "css/grid.css"; 
        ?>
    </style>
    <title>GEOBUSTERS Survey</title>
</head>
<body id="survey">
    <header id="main-header">
        <section id="hero" class="grid-con">
            <h1 class="col-span-full">Welcome to the<br>GeoBusters Survey</h1>            
        </section>

        <div id="header-nav" class="grid-con">
            <div id="main-logo" class="col-span-1 m-col-span-2">
                GEOBUSTERS
            </div>
            <button id="burger" aria-label="toggle mobile menu" class=" col-start-4 col-end-5">≡</button>
            <nav id="burger-menu" class="col-span-full m-col-start-3 m-col-end-13">
                <h2 class="hidden">Main Navigation</h2>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Learn</a></li>
                    <li><a href="#">Quizzes</a></li>
                    <li><a href="#">Games</a></li>
                    <li><a href="#">Contacts</a></li>
                </ul>                
            </nav>
        </div>
    </header>

    <input aria-hidden="true" type="hidden" value="<?php errorCountReset($errors); ?>">

    <p id="notification" class="error" aria-hidden="true">
        <?php
            errorCountReset($warning);
        ?>
    </p>
    
    <form id="survey-form" action="includes/scripts/process_survey.php" method="POST">
        <fieldset class="grid-con" id="step1">
            <legend class="col-span-full">Tell us about yourself</legend>
            <p class="col-span-full">(*) are required</p>
            <div class="col-start-1 col-end-4 m-col-start-1 m-col-end-6">
                <label for="fname" class="<?php errorStyle($errors, "fname")?>">First Name*</label>
                <input id="fname" name="fname" type="text" autocomplete="on">
            </div>
            <div class="col-start-2 col-end-5 m-col-start-6 m-col-end-11">
                <label for="lname" class="<?php errorStyle($errors, "lname")?>">Last Name*</label>
                <input id="lname" name="lname" type="text" autocomplete="on">
            </div>
            <div class="col-start-1 col-end-4 m-col-start-3 m-col-end-5">
                <label for="age" class="<?php errorStyle($errors, "age")?>">Age</label>
                <input id="age" name="age" type="number">
            </div> 
            <div class="col-start-2 col-end-5 m-col-start-5 m-col-end-12">
                <label for="email" class="<?php errorStyle($errors, "email")?>">Email Address*</label>
                <input id="email" name="email" type="email" autocomplete="on" placeholder="name@email.com">
            </div> 
            <div class="col-start-1 col-end-4 m-col-start-1 m-col-end-6">
                <label for="city" class="<?php errorStyle($errors, "city")?>">Current City*</label>
                <input id="city" name="city" type="text" autocomplete="on">
            </div>          
            <div class="col-start-2 col-end-5 m-col-start-6 m-col-end-11">
                <label for="cstate" class="<?php errorStyle($errors, "cstate")?>">Current State/Country*</label>
                <input id="cstate" name="cstate" type="text" autocomplete="on">
            </div>         
            <div class="col-start-1 col-end-4 m-col-start-2 m-col-end-7">
                <label for="bstate" class="<?php errorStyle($errors, "bstate")?>">Country of Origin*</label>
                <input id="bstate" name="bstate" type="text" autocomplete="on">
            </div>     
            <div class="col-start-2 col-end-5 m-col-start-7 m-col-end-12">
                <label for="fstate" class="<?php errorStyle($errors, "fstate")?>">Your favorite country (other than your own)</label>
                <input id="fstate" name="fstate" type="text" autocomplete="on">
            </div>     
        </fieldset>

        <fieldset id="step2" class="grid-con <?php errorStyle($errors, "asia")?>">
            <legend class="col-span-full">Which ones of these Asian countries do you view the most favorably?</legend>
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
                <input id="sar" name="asia[]" type="checkbox" value="Saudi Arabia">
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
                <input id="skr" name="asia[]" type="checkbox" value="South Korea">
                <label for="skr">South Korea</label>
            </div>
        </fieldset>

        <fieldset id="step3" class="grid-con <?php errorStyle($errors, "africa")?>">
            <legend class="col-span-full">Which ones of these African countries do you view the most favorably?</legend>
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
                <input id="saf" name="africa[]" type="checkbox" value="South Africa">
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

        <fieldset id="step4" class="grid-con <?php errorStyle($errors, "europe")?>">
            <legend class="col-span-full">Which ones of these European countries do you view the most favorably?</legend>
            <div>
                <input id="bri" name="europe[]" type="checkbox" value="United Kingdom">
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

        <fieldset id="step5" class="grid-con <?php errorStyle($errors, "cont")?>">
            <legend class="col-span-full">Which continent are you living in right now?</legend>
            <div>
                <input id="asia" name="cont" type="radio" value="Asia">
                <label for="asia">Asia</label>                
            </div>
            <div>
                <input id="africa" name="cont" type="radio" value="Africa">
                <label for="africa">Africa</label>                
            </div>
            <div>
                <input id="europe" name="cont" type="radio" value="Europe">
                <label for="europe">Europe</label>                
            </div>
            <div>
                <input id="nAmerica" name="cont" type="radio" value="North America">
                <label for="nAmerica">North America</label>                
            </div>
            <div>
                <input id="sAmerica" name="cont" type="radio" value="South America">
                <label for="sAmerica">South America</label>                
            </div>
            <div>
                <input id="oceania" name="cont" type="radio" value="Oceania">
                <label for="oceania">Oceania</label>                
            </div>
            <div>
                <input id="antarc" name="cont" type="radio" value="Antarctica">
                <label for="antarc">Antarctica</label>                
            </div>
        </fieldset>

        <fieldset id="step6" class="grid-con <?php errorStyle($errors, "gov")?>">
            <legend class="col-span-full">What government system is your country under?</legend>
            <div>
                <input id="pres" name="gov" type="radio" value="Presidental Republic">
                <label for="pres">Presidental Republic</label>                
            </div>
            <div>
                <input id="spres" name="gov" type="radio" value="Semi Presidental Republic">
                <label for="spres">Semi-presidental Republic</label>                
            </div>
            <div>
                <input id="opstate" name="gov" type="radio" value="One Party State">
                <label for="opstate">One-party State</label>                
            </div>
            <div>
                <input id="parl" name="gov" type="radio" value="Parliamentary Republic">
                <label for="parl">Parliamentary Republic</label>                
            </div>
            <div>
                <input id="cmon" name="gov" type="radio" value="Constitutional Monarchy">
                <label for="cmon">Constitutional Monarchy</label>                
            </div>
            <div>
                <input id="scmon" name="gov" type="radio" value="Semi Constitutional Monarchy">
                <label for="scmon">Semi-constitutional Monarchy</label>                
            </div>
            <div>
                <input id="amon" name="gov" type="radio" value="Absolute Monarchy">
                <label for="amon">Absolute Monarchy</label>                
            </div>
            <div>
                <input id="unk" name="gov" type="radio" value="Unknown">
                <label for="unk">I don't know</label>                
            </div>
        </fieldset>

        <fieldset id="step7" class="grid-con <?php errorStyle($errors, "view")?>">
            <legend class="col-span-full">Do you view your own country favorably?</legend>
            <div>
                <input id="yview" name="view" type="radio" value="yes">
                <label for="yview">Yes</label>                
            </div>
            <div>
                <input id="nview" name="view" type="radio" value="no">
                <label for="nview">No</label>                
            </div>
            <div>
                <input id="unkView" name="view" type="radio" value="unknown">
                <label for="unkView">It depends/No opinions</label>                
            </div>
        </fieldset>

        <fieldset id="step8" class="grid-con <?php errorStyle($errors, "strive")?>">
            <legend class="col-span-full">Do you think your country should strive to be economically developed?</legend>
            <div>
                <input id="ystrive" name="strive" type="radio" value="yes">
                <label for="ystrive">Yes</label>                
            </div>
            <div>
                <input id="nstrive" name="strive" type="radio" value="no">
                <label for="nstrive">No</label>                
            </div>
            <div>
                <input id="unkStrive" name="strive" type="radio" value="unknown">
                <label for="unkStrive">It depends/No opinions</label>                
            </div>
        </fieldset>

        <fieldset id="step9" class="grid-con">
            <legend class="col-span-full">Let us know your opinions</legend>
            <div class="col-span-full m-col-start-1 m-col-end-9">
                <label for="life">Can you share about the current life condition of citizens from your nation?</label>
                <textarea id="life" name="life" maxlength="850" placeholder="Write more here..." class="<?php errorStyle($errors, "life")?>"></textarea>
            </div>
            <div class="col-span-full m-col-start-5 m-col-end-13">
                <label for="eco">Do you think that a more developed economy guarantees better life condition? Why?</label>
                <textarea id="eco" name="eco" maxlength="850" placeholder="Write more here..." class="<?php errorStyle($errors, "eco")?>"></textarea>
            </div>
        </fieldset>
        
        <fieldset id="step10" class="grid-con">
            <legend class="col-span-full">Trivias</legend>
            <div class="col-span-full subgrid-con">
                <label for="govdate" class="col-span-2 m-col-span-6">When was your country's modern government established?</label>
                <input id="govdate" name="govdate" type="date" class="col-span-2 m-col-start-1 m-col-end-7 <?php errorStyle($errors, "govdate")?>">
            </div>
            <div class="col-span-full subgrid-con">
                <label for="col" class="col-span-2 m-col-start-4 m-col-end-8">If you paint a world map, what would be the color of favorite country? It may or may not be your own, nor it has to be the dominant flag color.</label>
                <input id="col" name="col" type="color" value="#888888" class="m-col-span-3 <?php errorStyle($errors, "govdate")?>">
            </div>
        </fieldset>

        <div class="grid-con">
            <button type="submit" class="col-start-2 col-end-4 m-col-start-4 m-col-end-7">Submit</button>
        </div>
        
    </form>

    <footer id="main-footer">
        <h2 class="hidden">Main Footer</h2>
        <p>©2026 GEOBUSTERS, gmbh</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>
    <script type="text/javascript" src="/jake_russell_php_survey/main.js"></script>
</body>
</html>