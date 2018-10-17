<?php // Example 26-9: starwars.php
    require 'header_user.php';
    require_once 'dbconnection.php';
    require_once 'functions.php';
?>
    <div class="bodygrid">
    <div><?php include 'mainleft.php'?></div>
<?php 

    $seriesname = "The Vintage Collection";
    echo '<div>';

            $result5 = mysqli_query($link, "SELECT series FROM actionfigures WHERE series='$seriesname'");
            $num_rows = mysqli_num_rows($result5);
            $figures= $num_rows;
            
            $result6 = mysqli_query($link, "SELECT COUNT(`reference`)FROM linkedvariation WHERE series='The Vintage Collection'");
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
    $seriesname = "The Vintage Collection";
    $statement = "allfigures";

    $results = mysqli_query($link,"SELECT *, COUNT(0) FROM `linkedvariation` WHERE reference = 'VC116' GROUP BY `reference`");
    //echo pagination($statement,$per_page,$page,$url='?series='.$seriesname.'&');

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

$results = mysqli_query($link,"SELECT *, COUNT(*) FROM `linkedvariation` GROUP BY `reference`");

while ($rows = mysqli_fetch_array($results))
    {
    
    $count = $rows['COUNT(*)'];
    
    echo   "<div class='grid-container2'>
                    <div class='header1'>$rows[0]</div>
                    <div class='header2'>$rows[2]</div>
                    <div class='header3'>$code</div>
                    <div class='header4'>$count</div>
                    <div class='header5'>1 January 2010</div>    
                    <div class='header6'><span class='plusminus'>Show (+)</span></div>
            </div>";
    

    $results2 = mysqli_query($link,"SELECT region, card, sticker, figure  FROM `linkedvariation` WHERE reference = '" . $rows['reference'] . "'");
    
            while ($rows2 = mysqli_fetch_array($results2)) {
                
                $region = $rows2['region'];
                $variation = $rows2['card'];
                $sticker = $rows2['sticker'];
                $figure = $rows2['figure'];
                
                    echo   "<div class='grid-container5'>
                            <div class='headervar1'>$region - $variation</div>
                            <div class='headervar2'><span class='plusminus1'>Show (+)</span></div>
                            </div>";
            
            
            $results3 = mysqli_query($link,"SELECT DISTINCT * FROM `actionfigures` WHERE reference = '" . $rows['reference'] . "'");
    
            while ($rows3 = mysqli_fetch_array($results3)) {
             
            $source = $rows3['source'];
            $year = $rows3['year'];
            
          echo "<div class='grid-container3'>
                    <div class='field1'><img class='figureImage' src='images/carded.jpg'></div>
                    <div class='field2 info'>Scale</div>
                    <div class='field3'></div>
                    <div class='field6 info'>Source</div>
                    <div class='field7'>$source</div>    
                    <div class='field10 info'>Year</div>
                    <div class='field11'>$year</div>
                    <div class='field14 info'>Type</div>
                    <div class='field15'></div>
                    <div class='field18 info'>Status</div>
                    <div class='field19'></div>
                    <div class='field22 info'>Variations</div>
                    <div class='field23'></div></div>";
            }
    }}

?>

        </div>

            <div><?php include 'mainright.php'?></div>

        </div>
            
    </body>

</html>
                        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
   
    $(".grid-container5").hide();
    
    
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
  $(".grid-container3").hide();
  $(".grid-container2").click(function() {
        if ($('.grid-container5').is(':visible')) {
            $(".grid-container5").slideUp(300)
            $(".grid-container3").slideUp(300)
            $(".plusminus").text('Show (+)');
            $(".plusminus1").text('Show (+)');
        }
        //someting in this section causing slide error:
        if ($(this).next(".grid-container5").is(':visible')) {
            $(this).next(".grid-containe5").slideUp(300);
            $(".plusminus").text('Show (+)');
        } else {
           $(this).nextUntil(".grid-container2").slideDown(300);
           $(".grid-container3").hide();
           $(this).find(".plusminus").text('Hide (-)');
    }
  });
});

$(document).ready(function() {
  //toggle the component with class accordion_body
  
  $(".grid-container5").click(function() {
        if ($('.grid-container3').is(':visible')) {
            $(".grid-container3").slideUp(300)
            $(".plusminus1").text('Show (+)');
        }
        if ($(this).next(".grid-container3").is(':visible')) {
            $(this).next(".grid-container3").slideUp(300);
            $(".plusminus1").text('Show (+)');
        } else {
           $(this).nextUntil(".grid-container5").slideDown(300);
           $(this).find(".plusminus1").text('Hide (-)');
    }
  });
});


</script>    

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

