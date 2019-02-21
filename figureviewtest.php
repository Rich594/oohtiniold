<?php // Example 26-9: starwars.php
    require 'header_user_test.php';
    require_once 'dbconnection.php';
    require_once 'functions.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="http:///ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="figureview.js"></script>
   
</head>
<body>

<div id="loadingMask" style="width: 100%; height: 100%; position: fixed; background: #fff;">Loading...</div>

    <div class="bodygrid">
    <!-- <div><?php include 'mainleft.php'?></div> -->
<?php 

    $seriesname = (isset($_GET['series']) ? $_GET['series'] : null);
?>    
    <div>
<?php
            $result5 = mysqli_query($link, "SELECT series FROM actionfigures WHERE series='$seriesname'");
            $num_rows = mysqli_num_rows($result5);
            $figures= $num_rows;
            
            $result6 = mysqli_query($link, "SELECT COUNT(`reference`)FROM linkedvariation3 WHERE series='$seriesname'");
            $row = mysqli_fetch_row($result6);
            $variations= $row[0];
?>
    <div class="topbar">   
       <div class='datagrid'>
            <div class='info1'><?php echo $seriesname ?></div>
            <div class='info2'><span class='datagridnumber'><?php echo $figures ?></span> Figures</div>
            <div class='info2'><span class='datagridnumber'><?php echo $variations ?></span> Variations </div>
            </div>


<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">Location</a>

<?php    
    if(isset($_GET['series'])){
        $seriesname = $_GET['series'];  // Storing Selected Value In Variable
    }
?>    
        <form method='get' class="formtest" action='figureviewtest.php?series=<?php echo $seriesname?>'>
        <select name='series' class='form-control'>
        <option value='' disabled selected>Select Series
<?php
                $sql = mysqli_query($link, "SELECT DISTINCT series FROM actionfigures");
                $row6 = mysqli_num_rows($sql);
                while ($row6 = mysqli_fetch_array($sql)){
               
?>
                <option value="<?php echo $row6['series'] ?>">  <?php echo $row6['series'] ?></option>


<?php
                }
?>
                </select>
                  <input type='submit' value='Submit'/>
            </form>
<?php
    $row6 = isset($_GET['series']) ? $_GET['series'] : false;
?>  

  <a href="#">Location</a>
  <a href="#">Packaging</a>
  <a href="#">Type</a>
</div>

<?php 



$selected_val = $_GET['series'];  // Storing Selected Value In Variable

?>






<span class="filter" onclick="openNav()">&#9776; filter</span>



        <div class="optionvalue">   

            </div></div> 

           
<?php            

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
?>    

    <div class="optionvalue2"> 
     
<?php
    //START PAGINATION
    $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);

    if ($page <= 0) $page = 1;

    $per_page = 10; // Set how many records to display per page.

    $startpoint = ($page * $per_page) - $per_page;
    $statement = "allfigures";

    $results = mysqli_query($link,"SELECT *, COUNT(0) FROM `linkedvariation3` WHERE reference = 'VC01' GROUP BY `reference`");
    //echo pagination($statement,$per_page,$page,$url='?series='.$seriesname.'&');
    //FILTER FINISH
?>
    </div>
    </div>
    <div class="clearfloat"></div>
        
<?php
    $query = "SELECT code FROM series WHERE seriesname = '$seriesname'";
    $result = $link->query($query);
    if (!$result) die($link->error);

    for ($j = 0 ; $j < $rows ; ++$j) {
        
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_ASSOC);
    } 

    $code = $row['code'];
?>    
            <div class='grid-container1'>
            <div class='header2'>Ref.</div>
            <div class='header2'>Figure Name</div>
            
            </div>
<?php            

$results = mysqli_query($link,"SELECT *, COUNT(*) FROM `linkedvariation3` WHERE series = '$seriesname' GROUP BY `reference`");

while ($rows = mysqli_fetch_array($results))
    {
    
    $count = $rows['COUNT(*)'];
?>    
            <div class='grid-container2'>
                    
                    <div class='header2'><?php echo $rows[2] ?></div>
                    <div class='header1'><?php echo $rows[1] ?></div>
                    <div class='header6'><span class='plusminus2'>Show (+)</span></div>
            </div>
    
            <div class='grid-container3'>
                    <div class='header4'>Figures <?php echo $rows['COUNT(*)']; ?> <span class='plusminus3'>(+)</span></div>
                    <div class='header4'>Carded <?php echo $rows['COUNT(*)']; ?><span class='plusminus3'>(+)</span></div>
                    <div class='header6'>All <?php echo $rows['COUNT(*)']; ?><span class='plusminus3'>(+)</span></div>
            </div>
<?php

    $results2 = mysqli_query($link,"SELECT region, name  FROM `linkedvariation3` WHERE reference = '" . $rows['reference'] . "'");
    
            while ($rows2 = mysqli_fetch_array($results2)) {
                
                $region = $rows2['region'];
                $variation = $rows2['name'];
                // $sticker = $rows2['sticker'];
                // $figure = $rows2['figure'];
?>               
                    <div class='grid-container4'>
                    <div class='headervar1'><?php echo $region ?></div>
                    <div class='headervar1'><?php echo $variation ?></div>
                    <div class='headervar2'><span class='plusminus4'>Show (+)</span></div>
                    </div>
<?php            
            
            $results3 = mysqli_query($link,"SELECT DISTINCT * FROM `actionfigures` WHERE reference = '" . $rows['reference'] . "'");
    
            while ($rows3 = mysqli_fetch_array($results3)) {
             
            $source = $rows3['source'];
            $year = $rows3['year'];
?>            
                    <div class='grid-container5'>
                    <div class='field1'><img class='figureImage' src='images/Carded1.jpg'></div>
                    <div class='field2'><img class='figureImage imagesize' src='images/CB US 1.1.jpg'></div>
                    <div class='field3'>Source</div>
                    <div class='field6 info'><?php echo $source ?></div>
                      
                    <div class='field10 info'>Year</div>
                    <div class='field11'><?php echo $year ?></div>
                    <div class='field14 info'>Type</div>
                    <div class='field15'></div>
                    <div class='field18 info'>Status</div>
                    <div class='field19'></div>
                    <div class='field22 info'>Variations</div>
                    <div class='field23'></div>
                    </div>
<?php                    
            }
    }}

?>

<script>

</script>


</body>
</html>     

                        



