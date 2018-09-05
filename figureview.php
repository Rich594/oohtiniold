<?php // Example 26-9: starwars.php
    require 'header_user.php';
    require_once 'dbconnection.php';
    require_once 'functions.php';
?>
    <div class="bodygrid">
    <div><?php include 'mainleft.php'?></div>
<?php 

    $seriesname = (isset($_GET['series']) ? $_GET['series'] : null);
    echo '<div>';

            $result5 = mysqli_query($link, "SELECT series FROM actionfigures WHERE series='$seriesname'");
            $num_rows = mysqli_num_rows($result5);
            $figures= $num_rows;
            
            $result6 = mysqli_query($link, "SELECT SUM(variation)FROM allfigures WHERE series='$seriesname'");
            $row = mysqli_fetch_row($result6);
            $variations= $row[0];

                 echo    "<div class='datagrid'>
            <div class='info1'>$seriesname</div>
            <div class='info2'><span class='datagridnumber'>$figures</span> Figures</div>
            <div class='info2'><span class='datagridnumber'>$variations</span> Variations </div>
            </div>"; 
            

    if (isset($_SESSION['first_name'])) {
        $user = ($_SESSION['user_id']); 
    }
        $seriesname = (isset($_GET['series']) ? $_GET['series'] : null);
    
    if (isset($_POST['save'])) {
          echo "<meta http-equiv='refresh' content='0'>"; 
          $accessories = (isset($_POST['accessories']) ? $_POST['accessories'] : null);
          $hanger = (isset($_POST['hanger']) ? $_POST['hanger'] : null);
          $ownorwant = get_post($link, 'ownorwant');
          $reference = get_post($link, 'reference');
          $seriesname = get_post($link, 'series');
          $packaging = get_post($link, 'packaging');
          $figurepidm = get_post($link, 'figurepidm');
          
          $query = "INSERT INTO masterlist VALUES ('', '$figurepidm', '$reference', '$seriesname', '$ownorwant', '$user', '$packaging', '$accessories', '$hanger')";
          $result = $link->query($query);
          if (!$result) echo "Insert failed: $query<br>" .
          $link->error . "<br><br>";
    }
    
    echo '<div class="topbar">';   
    echo '<div class="optionvalue">';   
    
    if(isset($_GET['series'])){
        $seriesname = $_GET['series'];  // Storing Selected Value In Variable
    }
    
    echo     "<form method='get' action='figureview.php?series=$seriesname'>
                <select name='series' class='form-control'>
                <option value='' disabled selected>Select Series";

                $sql = mysqli_query($link, "SELECT DISTINCT series FROM actionfigures");
                $row6 = mysqli_num_rows($sql);
                while ($row6 = mysqli_fetch_array($sql)){
                echo "<option value='". $row6['series'] ."'>" .$row6['series'] ."</option>" ;
                }

                echo "</select>
                  <input type='submit' value='Submit'/>
            </form>";

    $row6 = isset($_GET['series']) ? $_GET['series'] : false;
    echo '</div>'; 
    echo '<div class="optionvalue2">'; 
    //START PAGINATION 

    $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);

    if ($page <= 0) $page = 1;

    $per_page = 10; // Set how many records to display per page.

    $startpoint = ($page * $per_page) - $per_page;

    $statement = "allfigures";

    $results = mysqli_query($link,"SELECT * FROM {$statement} WHERE series = '$seriesname' LIMIT {$startpoint} , {$per_page}");

    echo pagination($statement,$per_page,$page,$url='?series='.$seriesname.'&');

    echo '</div>';
    echo '</div>';
    echo '<div class="clearfloat"></div>';

    //FILTER FINISH    

    $query = "SELECT code FROM series WHERE seriesname = '$seriesname'";
    $result = $link->query($query);
    if (!$result) die($link->error);

    for ($j = 0 ; $j < $rows ; ++$j) {
        
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_ASSOC);
    } 

    $code = $row['code'];
    
    echo   "<div class='grid-container1'>
            <div class='header2'>Figure Name</div>
            <div class='header2'>Ref.</div>
            <div class='header3'>Series</div>
            <div class='header4'>Variations</div>
            <div class='header5'>1st Issue</div>
            <div></div>
            </div>
            ";

    if (mysqli_num_rows($results) != 0) {

        while ($row = mysqli_fetch_array($results)) {

        $figurepidm = $row[0]; 
    
    echo   "<form action='figureview.php?series=$seriesname' method='post'>";

    echo   "<div class='grid-container2'>
                    <div class='header1'>$row[1]</div>
                    <div class='header2'>$row[2]</div>
                    <div class='header3'>$code</div>
                    <div class='header4'>$row[7]</div>
                    <div class='header5'>1 January 2010</div>    
                    <div class='header6'><span class='plusminus'>Show (+)</span></div>
            </div>
                    <div class='grid-container3'>
                    <div class='field1'><img class='figureImage' src='images/carded$figurepidm.jpg'></div>
                    <div class='field2 info'>Scale</div>
                    <div class='field3'></div>
                    <div class='field6 info'>Source</div>
                    <div class='field7'>$row[4]</div>    
                    <div class='field10 info'>Year</div>
                    <div class='field11'>$row[5]</div>
                    <div class='field14 info'>Type</div>
                    <div class='field15'></div>
                    <div class='field18 info'>Status</div>
                    <div class='field19'></div>
                    <div class='field22 info'>Variations</div>
                    <div class='field23'>$row[7]</div>";

        if (isset($_SESSION['first_name'])) {
               
    echo           "<div class='grid-container4 fieldxx'>
                          
                    <div class='block1'><span class='hideown place'><input type='radio' id='radio-a' name='ownorwant'  value='Own'/>Own</span></div>
                    <div class='block2'><span class='loose place'><input type='radio' id='radio-b' name='ownorwant' value='Want'/>Want</span></div>

                    <div class='block3'><span class='hideloose place'><input type='radio' name='packaging' value='Loose' />Loose</span></div>
                    <div class='block4'><span class='hidecarded place'><input type='radio' name='packaging' value='Carded' />Carded</span></div>

                    <div class='block5'><span class='hidecomplete place'><input type='radio' name='accessories' value='Complete' />Complete</span></div>
                    <div class='block6'><span class='hideincomplete place'><input type='radio' name='accessories' value='Incomplete' />Incomplete</span></div>

                    <div class='block7'><span class='hidepunched place'><input type='radio' name='hanger' value='Punched' />Punched</span></div>
                    <div class='block8'><span class='hideunpunched place'><input type='radio' name='hanger' value='Unpunched' />Unpunched</span></div>

                    <div class='block9'></div>
                    <div class='block10'></div>     

                    <div class='block11 noborder'><input type='submit' class='resetbutton' onclick='myFunction()' value='Reset Form'></a></div>
                    <div class='block12 noborder'><span class='save'><input type='submit' class='savebutton' name='save' value='save'></div>   
                    </div></div>";}
         
    else {
            echo    "<div class='notLoggedIn info'></div>
                    </div>";
         }
        
                echo    "<input type='hidden' name='ref' value='$row[0]'>";
                echo    "<input type='hidden' name='figurepidm' value=".($row['figurepidm']).">";
                echo    "<input type='hidden' name='reference' value='$row[2]'>";
                echo    "<input type='hidden' name='series' value='$row[3]'>"."</form>";
    }
    
} else {
    
     echo "<br><br><br><br>No records are found.";
}

function get_post($link, $var)
        
{
    return $link->real_escape_string($_POST[$var]);
}

?>

        </div>

            <div><?php include 'mainright.php'?></div>

        </div>
            
    </body>

</html>
                        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
   $(".grid-container3").hide();
    
    $(document).on('click', 'input[name="ownorwant"]', function(){
    if($(this).val() == 'Own'){
        $(this).closest('.grid-container3').find('.hidecarded').removeClass( 'hidecarded' )
        $(this).closest('.grid-container3').find('.hideloose').removeClass( 'hideloose' )
        $(this).closest('.grid-container3').find('.block2').empty();
    }else {
        $(this).closest('.grid-container3').find('.hidecarded').removeClass( 'hidecarded' )
        $(this).closest('.grid-container3').find('.hideloose').removeClass( 'hideloose' )
        $(this).closest('.grid-container3').find('.block1').empty();
    }
});
 
$(document).on('click', 'input[name="packaging"]', function(){
    if($(this).val() == 'Loose'){
        $(this).closest('.grid-container3').find('.hidecomplete').removeClass( 'hidecomplete' )
        $(this).closest('.grid-container3').find('.hideincomplete').removeClass( 'hideincomplete' )
        $(this).closest('.grid-container3').find('.block4').empty();
    }else{
        $(this).closest('.grid-container3').find('.hidepunched').removeClass( 'hidepunched' )
        $(this).closest('.grid-container3').find('.hideunpunched').removeClass( 'hideunpunched' )
        $(this).closest('.grid-container3').find('.field20').css({"grid-area": "5 / 4 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field21').css({"grid-area": "5 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field16').css({"grid-area": "6 / 4 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field17').css({"grid-area": "6 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.block3').empty();
    }
});

$(document).on('click', 'input[name="accessories"]', function(){
    if($(this).val() == 'Complete'){
        $(this).closest('.grid-container3').find('.save').removeClass( 'save' )
        $(this).closest('.grid-container3').find('.field25').css({"grid-area": "6 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field21').css({"grid-area": "7 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.block6').empty();
    }else{
        $(this).closest('.grid-container3').find('.save').removeClass( 'save' )
        $(this).closest('.grid-container3').find('.field25').css({"grid-area": "6 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field21').css({"grid-area": "7 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.block5').empty();
    }
});

$(document).on('click', 'input[name="hanger"]', function(){
    if($(this).val() == 'Punched'){
        $(this).closest('.grid-container3').find('.save').removeClass( 'save' )
        $(this).closest('.grid-container3').find('.field25').css({"grid-area": "6 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field17').css({"grid-area": "7 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.block8').empty();
    }else{
        $(this).closest('.grid-container3').find('.save').removeClass( 'save' )
        $(this).closest('.grid-container3').find('.field25').css({"grid-area": "6 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field17').css({"grid-area": "7 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.block7').empty();
    }
}); 

$(document).ready(function() {
  //toggle the component with class accordion_body
  $(".grid-container2").click(function() {
        if ($('.grid-container3').is(':visible')) {
            $(".grid-container3").slideUp(600)
            $(".plusminus").text('Show (+)');
        }
        if ($(this).next(".grid-container3").is(':visible')) {
            $(this).next(".grid-containe3").slideUp(600);
            $(".plusminus").text('Show (+)');
        } else {
           $(this).next(".grid-container3").slideDown(600);
           $(this).find(".plusminus").text('Hide (-)');
    }
  });
});
</script>    

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>