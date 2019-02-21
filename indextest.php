<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="styles2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="topnav" id="myTopnav"><a href="#home" class="active">TEST TEST</a>
            <a href="#news">News</a>
            <a href="#contact">Contact</a>
            <a href="#about">About</a>
            <a href="#about">Login</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a>
            <span class="navbar_data">four 10,000</span>
            <span class="navbar_data">one 10,000</span>
        </div>



        
    <div class="grid-container">
            <div class="sidebar"></div>
                <div class="grid-container3">
                    <div>Click on a box below to view the data for that selection</div>
                    <div>Click on a box below to view the data for that selection</div>
                </div>
            <div class="sidebar">Sidebar Header</div>  
            <div class="sidebar">Sidebar
                <p>List of things</p>
                    <ul>
                        <li>One One One</li>
                        <li>Two Two Two</li>
                        <li>Three Three</li>
                        <li>Four Four Four</li>
                        <li>Five Five Five</li>
                        <li>Six Six Six Six Six</li>
                    </ul>
            </div>
        <div>
                <div class="grid-container2">
                    <div><a href="#news">TEST 123<p><img class="responsive" src="images/The Vintage Collection.jpg"/></p>TEST ABC</a></div>
                    <div><a href="#news">TEST 123<p><img class="responsive" src="images/The Vintage Collection.jpg"/></p>TEST ABC</a></div>
                    <div><a href="#news">TEST 123<p><img class="responsive" src="images/The Vintage Collection.jpg"/></p>TEST ABC</a></div>
                    <div><a href="#news">TEST 123<p><img class="responsive" src="images/The Vintage Collection.jpg"/></p>TEST ABC</a></div>
                </div>
        </div>
            <div class="sidebar">Sidebar</div>
            <div class="sidebar">Sidebar Footer</div>
            <div>

                <form action="indextest.php" method="post">
                    <select name="cars">
                        <option value="10"<?php if (isset($_POST['cars']) && ($_POST['cars'] == '10')) echo ' selected="selected"'; ?>>America</option>
                        <option value="20"<?php if (isset($_POST['cars']) && ($_POST['cars'] == '20')) echo ' selected="selected"'; ?>>Canada</option>
                        <option value="30"<?php if (isset($_POST['cars']) && ($_POST['cars'] == '30')) echo ' selected="selected"'; ?>>Europe</option>
                        <option value="50"<?php if (isset($_POST['cars']) && ($_POST['cars'] == '50')) echo ' selected="selected"'; ?>>UK</option>
                    </select>
                    <select name="cars2">
                        <option value="10"<?php if (isset($_POST['cars2']) && ($_POST['cars2'] == '10')) echo ' selected="selected"'; ?>>All</option>
                        <option value="20"<?php if (isset($_POST['cars2']) && ($_POST['cars2'] == '20')) echo ' selected="selected"'; ?>>One</option>
                        <option value="30"<?php if (isset($_POST['cars2']) && ($_POST['cars2'] == '30')) echo ' selected="selected"'; ?>>Two</option>
                        </select>
                    <select name="nums">
                        <option value="10"<?php if (isset($_POST['nums']) && ($_POST['nums'] == '10')) echo ' selected="selected"'; ?>>AB1-20</option>
                        <option value="20"<?php if (isset($_POST['nums']) && ($_POST['nums'] == '20')) echo ' selected="selected"'; ?>>AB21-40</option>
                        <option value="30"<?php if (isset($_POST['nums']) && ($_POST['nums'] == '30')) echo ' selected="selected"'; ?>>AB41-60</option>
                        <option value="50"<?php if (isset($_POST['nums']) && ($_POST['nums'] == '50')) echo ' selected="selected"'; ?>>AB61-80</option>
                    </select><p>
                    <input type="submit" value="Show">
                </form>

<?php

    $cars = $_POST['cars'];
    $cars2 = $_POST['cars2'];
    $nums = $_POST['nums'];

?>
    <hr>

    <div class="grid-container4">
                <div>A1234<img class="responsive2" src="images/carded1.jpg"/>TEST GHI</div>
                <div>B4567<img class="responsive2" src="images/carded10.jpg"/>TEST DEF</div>
                <div>C7890<img class="responsive2" src="images/carded116.jpg"/>TEST ABC</div>
                <div>1ABCD<img class="responsive2" src="images/carded118.jpg"/>TEST 123</div>
    </div>

    <hr>
    <h1>Name Heading 1</h1>

    <div class="grid-container5">

        <div class="grid-container6">

                    <div class="grid_1">A1234</div>
                    <div><img class="responsive2" src="images/carded116.jpg"/>TEST GHI</div>
                    <div>V1<br>DATA</div>
                    <div class="grid_2">A1234</div>
                    <div class="grid_3">A1234</div>
        </div>

    </div>
    <h1>Name Heading 2</h1>
    <div class="grid-container5">

        <div class="grid-container6">

                    <div class="grid_1">A1234</div>
                    <div><img class="responsive2" src="images/carded117.jpg"/>TEST GHI</div>
                    <div>V1<br>DATA</div>
                    <div class="grid_2">A1234</div>
                    <div class="grid_3">A1234</div>
        </div>

    </div>

            </div>  
            <div class="sidebar">Sidebar Footer</div>
    </div>

<script>
        function myFunction() {
          var x = document.getElementById("myTopnav");
          if (x.className === "topnav") {
            x.className += " responsive";
          } else {
            x.className = "topnav";
          }
        }
</script>

</body>
</html>