<?php // Example 26-9: starwars.php
    require 'header_user.php';
    require_once 'dbconnection.php';
    require_once 'functions.php';
?>

    <div class="bodygrid">
    <div><?php include 'mainleft.php'?></div>
    
<?php   

    echo '<div>';
    
    $ownorwant = (isset($_GET['ownorwant']) ? $_GET['ownorwant'] : null);
    $seriesname = (isset($_GET['series']) ? $_GET['series'] : false);
    $ref = (isset($_GET['ref']) ? $_GET['ref'] : null);
    $user = ($_SESSION['user_id']);
    
    $result1 = mysqli_query($link, "SELECT series FROM masterlist WHERE ownorwant='own' and user='$user' and series='$seriesname'");
            $num_rows = mysqli_num_rows($result1);
            $own = $num_rows;
            
            $result1 = mysqli_query($link, "SELECT series FROM masterlist WHERE ownorwant='want' and user='$user' and series='$seriesname'");
            $num_rows = mysqli_num_rows($result1);
            $want = $num_rows;
            
            $total = $want + $own;
            
            if ($total > 0) {
            
            $total = $own / $total * 100;
            $total = round($total,0);
    
            }
    
    echo   "<div class='datagrid'>
            <div class='info1'>$seriesname</div>
            <div class='info2'>Own <span class='datagridnumber'>$own</span> - <span class='datagridnumber'>$want</span> Want</div>
            <div class='info3'><span class='datagridnumber'>$total%</span> Complete</div>
            </div>"; 
      
    echo   '<div class="topbar">';   
    
    echo   '<div class="filterDiv1">'; 
    
    
    echo    "<form method='GET' action='masterlistview.php?'>
                <select name='series' id='series_select'>
                <option value='' disabled selected>Select Series</option> 
                ";

                $sql = mysqli_query($link, "SELECT DISTINCT series FROM masterlist WHERE user='$user'");
                $row6 = mysqli_num_rows($sql);
                while ($row6 = mysqli_fetch_array($sql)){
                echo "<option value='". $row6['series'] ."'>" .$row6['series'] ."</option>" ;
                }

                echo "</select>

                <input type='submit' value='Submit'/>
                <input type='hidden' name='ownorwant' value='$ownorwant'>
                <input type='hidden' name='user' value='$user'>
                
            </form>";

    echo    '</div>'; 

    echo    '<div class="filterDiv2">'; 
    
    echo    "<form method='GET' action='masterlistview.php?'>
                <select name='ownorwant'>
                <option value='' disabled selected>Select Ownership</option>         
                <option value='All'>All</option>"; 

                $sql = mysqli_query($link, "SELECT DISTINCT ownorwant FROM masterlist WHERE user='$user' AND series = '$seriesname'");

                $row7 = mysqli_num_rows($sql);

                while ($row7 = mysqli_fetch_array($sql)){
                echo "<option value='". $row7['ownorwant'] ."'>" .$row7['ownorwant'] ."</option>" ;
                }

                echo "</select>

                <input type='submit' value='Submit'/>
                <input type='hidden' name='series' value='$seriesname'>
                <input type='hidden' name='user' value='$user'>
            </form>";

    echo '</div>'; 

    echo '<div class="paginationDiv">'; 

    //START PAGINATION 

    $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);

    if ($page <= 0) $page = 1;

    $per_page = 10; // Set how many records to display per page.

    $startpoint = ($page * $per_page) - $per_page;

    $statement = "masterlist";

    if(empty($ownorwant)){
                $where = "user='$user' AND masterlist.series = '$seriesname'";
                    } else {
            if($_GET['ownorwant'] == 'All') {
                $where = "user='$user' AND masterlist.series = '$seriesname'";
                    } else {
                $where = "user='$user' AND masterlist.ownorwant = '$ownorwant' AND masterlist.series = '$seriesname'";
                    }}

    $results = mysqli_query($link,"SELECT masterlist.figurepidm, masterlist.ref, masterlist.reference, masterlist.series, actionfigures.figurename, masterlist.packaging, masterlist.accessories, masterlist.hanger, masterlist.ownorwant FROM {$statement} INNER JOIN actionfigures ON masterlist.figurepidm = actionfigures.figurepidm WHERE $where ORDER BY masterlist.reference LIMIT {$startpoint} , {$per_page} ");

    echo pagination($statement,$per_page,$page,$url='?ownorwant='.$ownorwant.'&series='.$seriesname.'&user='.$user.'&');

    echo '</div>';
    echo '</div>';

        if(isset($_POST['Want'])){
             echo "<meta http-equiv='refresh' content='0'>";
             $ref = get_post($link, 'ref');
             $query = "UPDATE masterlist SET ownorwant='Want' WHERE ref ='$ref'";
             $result = $link->query($query);
             if (!$result) echo "Change failed: $query<br>" .
             $link->error . "<br><br>";
       } else if(isset($_POST['Own'])){
             echo "<meta http-equiv='refresh' content='0'>";
             $ref = get_post($link, 'ref');
             $query = "UPDATE masterlist SET ownorwant='Own' WHERE ref ='$ref'";
             $result = $link->query($query);
             if (!$result) echo "Change failed: $query<br>" .
             $link->error . "<br><br>";
       } else if (isset($_POST['delete'])){
             echo "<meta http-equiv='refresh' content='0'>";  
             $ref = get_post($link, 'ref');
             $query = "DELETE FROM masterlist WHERE ref='$ref'";
             $result = $link->query($query);
             if (!$result) echo "Delete failed: $query<br>" .
             $link->error . "<br><br>";
       }

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
            <div class='header4'>Ownership</div>
            <div class='header5'></div>
            <div></div>
            </div>
            ";

    if (mysqli_num_rows($results) != 0) {

        while ($row = mysqli_fetch_array($results)) {

        $figurepidm = $row[0];
        
            if ($row[5] == "loose") {
              $figurepidm = $row[5] . $figurepidm;
            } else {
              $figurepidm = $row[5] . $figurepidm;
            }
     
    echo   "<form action='masterlistview.php?ownorwant=$ownorwant&series=$seriesname' method='POST'>";

    echo   "<div class='grid-container2'>
                        <div class='header1'>$row[4]</div>
                        <div class='header2'>$row[2]</div>
                        <div class='header3'>$code</div>
                        <div class='header4'>$row[8]</div> 
                        <div class='header5'></div>
                        <div class='header6'><span class='plusminus'>Show (+)</span></div>
            </div>
            <div class='grid-container3'>
                        <div class='field1'><img class='figureImage' src='images/$figurepidm.jpg'></div>
                        <div class='field2 info'>Packaging:</div>
                        <div class='field3'>$row[5]</div>
                        <div class='field4 info'>Variation:</div>
                        <div class='field5 info'></div>
                        <div class='field6 info'>Accessory:</div>
                        <div class='field7'>$row[6]</div>
                        <div class='field8 info'>oohtini Reference:</div>
                        <div class='field9'></div>
                        <div class='field10 info'>Hanger:</div>
                        <div class='field11'>$row[7]</div>
                        <div class='field12 info'>Card:</div>
                        <div class='field13'></div>
                        <div class='field14 info'></div>
                        <div class='field15'></div>
                        <div class='field16 info'>Bubble:</div>
                        <div class='field17'></div>
                        <div class='field18 info'></div>
                        <div class='field19'></div>
                        <div class='field20 info'>Sticker:</div>
                        <div class='field21'></div>
                        <div class='field22 info'></div>
                        <div class='field23'></div>";
?>
<?php
                if ($row[8] == "Own"){
                    echo "<div class='field24'><input type='submit' name='Want' value='Mark As Wanted'></div>";            
                      } else if ($row[8] == "Want") {
                    echo "<div class='field24'><input type='submit' name='Own' value='Mark As Owned'></div>";
                  }
?>
<?php
                echo "<div class='field25'><input type='submit' name='delete' value='DELETE'></div>     
                    </div>";

                echo    "<input type='hidden' name='ref' value='$row[1]'>";
                echo    "</form>";  
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

  $(".field11").each(function () {
        if ($(this).is(":empty")) {
            $(this).prev().empty();
        }
    });
 
   $(".field7").each(function () {
        if ($(this).is(":empty")) {
            $(this).prev().empty();
            $(this).closest('.grid-container3').find('.field6').css({"grid-area": "4 / 2 / span 1 / span 1"})
            $(this).closest('.grid-container3').find('.field7').css({"grid-area": "4 / 3 / span 1 / span 1"})
            $(this).closest('.grid-container3').find('.field10').css({"grid-area": "3 / 2 / span 1 / span 1"})
            $(this).closest('.grid-container3').find('.field11').css({"grid-area": "3 / 3 / span 1 / span 1"})
        }
    });
  
  
$("#series_select").change(function(){    
   $("#series_select option:selected").text($("#series_select").val());
});

</script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>