<html>
    
        <title>oohtini</title>
    
         <head>    
        
        <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Carter+One" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
    
        </head>
        
        <body>
            
                  <div class="headergrid">
                    
                    <div><a class="ex1" href='index.php?'><span class="title">oohtini</span></a><br><span class="tagline">Action Figure Collections</span></div>
                    <div></div>
                    <a class="links link1" href='masterlistview.php?ownorwant=own'><div><?php include 'figurecount.php'?></div></a>
                    <a class="links link2" href='masterlistview.php?ownorwant=want'><div><?php include 'figurecountwant.php'?></div></a>
                    <a class="links link3" href='index.php?'><div><?php include 'percentcomplete.php'?></div></a>
                    <a class="links link4" href='index.php?'><div> PROFILE</div></a>
                    <a class="links link5" href='index.php?'><div>LOG OUT</div></a>
              
                </div>  
            
              <div class="bodygrid">  
                
                
                  <div><?php include 'mainleft.php'?></div>
                
                    <div>

<?php // Example 26-9: starwars.php
    
    require_once 'dbconnection.php';
    require_once 'functions.php';

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
          
          $query = "INSERT INTO masterlist VALUES ('', '$figurepidm', '$reference', '$seriesname', '$ownorwant', 'Bob', '$packaging', '$accessories', '$hanger')";
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
                <option value=''>All</option>";

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

$statement = "actionfigures";
 
$results = mysqli_query($link,"SELECT * FROM {$statement} WHERE series = '$seriesname' LIMIT {$startpoint} , {$per_page} ");

echo pagination($statement,$per_page,$page,$url='?series='.$seriesname.'&');

echo '</div>';
echo '</div>';
echo '<div class="clearfloat"></div>';

//FILTER FINISH    
    
echo   "<div class='grid-container1'>
        <div>Figure Name</div>
        <div>Reference</div>
        <div>Series</div>
        <div></div>
        </div>
        ";

if (mysqli_num_rows($results) != 0) {
    
    while ($row = mysqli_fetch_array($results)) {
        
    $figurepidm = $row[0]; 
    
        echo    "<form action='figureview.php?series=$seriesname' method='post'>";
        
        echo   "<div class='grid-container2'>
                            <div class='header1'>$row[1]</div>
                            <div class='header2'>$row[2]</div>
                            <div class='header4'>$row[3]</div>
                            <div class='header5'><span class='plusminus'>Show (+)</span></div>
                        </div>
                        <div class='grid-container3'>
                          <div class='field1'><img src='images/$figurepidm.jpg'></div>
                          <div class='field2 info'>Scale</div>
                          <div class='field3'>$row[4]</div>
                          <div class='field4 info'>Select:</div>
                          <div class='field5 info'><input type='button' id='clear-button' id='but' onclick='myFunction()' value='Reset Form'></a></div>
                          <div class='field6 info'>Source</div>
                          <div class='field7'>$row[5]</div>
                          <div class='field8'><span class='hideown'><input type='radio' id='radio-a' name='ownorwant'  value='own'/>Own</span></div>
                          <div class='field9'><span class='loose'><input type='radio' id='radio-b' name='ownorwant' value='want'/>Want</span></div>
                          <div class='field10 info'>Year</div>
                          <div class='field11'>$row[6]</div>
                          <div class='field12'><span class='hideloose'><input type='radio' name='packaging' value='loose' />Loose</span></div>
                          <div class='field13'><span class='hidecarded'><input type='radio' name='packaging' value='carded' />Carded</span></div>
                          <div class='field14 info'>Type</div>
                          <div class='field15'>$row[7]</div>
                          <div class='field16'><span class='hidecomplete'><input type='radio' name='accessories' value='complete' />Complete</span></div>
                          <div class='field17'><span class='hideincomplete'><input type='radio' name='accessories' value='incomplete' />Incomplete</span></div>
                          <div class='field18 info'>Status</div>
                          <div class='field19'>$row[8]</div>
                          <div class='field20'><span class='hidepunched'><input type='radio' name='hanger' value='punched' />Punched</span></div>
                          <div class='field21'><span class='hideunpunched'><input type='radio' name='hanger' value='unpunched' />Unpunched</span></div>
                          <div class='field22 info'>Variations</div>
                          <div class='field23'>$row[9]</div>
                          <div class='field24'></div>
                          <div class='field25'><span class='save'><input type='submit' class='button1' name='save' value='save'></div>     

                </div>";
        
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
    if($(this).val() == 'own'){
        $(this).closest('.grid-container3').find('.hidecarded').removeClass( 'hidecarded' )
        $(this).closest('.grid-container3').find('.hideloose').removeClass( 'hideloose' )
        $(this).closest('.grid-container3').find('.field9').empty();
    }else {
        $(this).closest('.grid-container3').find('.hidecarded').removeClass( 'hidecarded' )
        $(this).closest('.grid-container3').find('.hideloose').removeClass( 'hideloose' )
        $(this).closest('.grid-container3').find('.field8').empty();
    }
});
 
$(document).on('click', 'input[name="packaging"]', function(){
    if($(this).val() == 'loose'){
        $(this).closest('.grid-container3').find('.hidecomplete').removeClass( 'hidecomplete' )
        $(this).closest('.grid-container3').find('.hideincomplete').removeClass( 'hideincomplete' )
        $(this).closest('.grid-container3').find('.field13').empty();
    }else{
        $(this).closest('.grid-container3').find('.hidepunched').removeClass( 'hidepunched' )
        $(this).closest('.grid-container3').find('.hideunpunched').removeClass( 'hideunpunched' )
        $(this).closest('.grid-container3').find('.field20').css({"grid-area": "5 / 4 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field21').css({"grid-area": "5 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field16').css({"grid-area": "6 / 4 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field17').css({"grid-area": "6 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field12').empty();
    }
});

$(document).on('click', 'input[name="accessories"]', function(){
    if($(this).val() == 'complete'){
        $(this).closest('.grid-container3').find('.save').removeClass( 'save' )
        $(this).closest('.grid-container3').find('.field25').css({"grid-area": "6 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field21').css({"grid-area": "7 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field17').empty();
    }else{
        $(this).closest('.grid-container3').find('.save').removeClass( 'save' )
        $(this).closest('.grid-container3').find('.field25').css({"grid-area": "6 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field21').css({"grid-area": "7 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field16').empty();
    }
});

$(document).on('click', 'input[name="hanger"]', function(){
    if($(this).val() == 'punched'){
        $(this).closest('.grid-container3').find('.save').removeClass( 'save' )
        $(this).closest('.grid-container3').find('.field25').css({"grid-area": "6 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field17').css({"grid-area": "7 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field21').empty();
    }else{
        $(this).closest('.grid-container3').find('.save').removeClass( 'save' )
        $(this).closest('.grid-container3').find('.field25').css({"grid-area": "6 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field17').css({"grid-area": "7 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container3').find('.field20').empty();
        
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
   document.getElementById('button1').addEventListener('click', function () {
      ["hideown", "loose", "radio-c"].forEach(function(id) {
        document.getElementById(id).checked = false;
      });
      return false;
    })

</script>

<script type="text/javascript">
    document.getElementById('clear-button').addEventListener('click', function () {
      
        window.location=window.location;
      });
   
</script>
<script>
  
$(".move_to").on("click", function(e){
    e.preventDefault();
    $('#contactsForm').attr('action', "/test1").submit();
});

</script>
