<!DOCTYPE html>
<html lang="en">
<head>
  <title>MarketSort</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script src="https://d3js.org/d3.v4.min.js"></script>

  <link rel="stylesheet" href="css/product.css">
</head>
<!-- <style>
    div.row, div.col {
        border-style: solid;
    }
</style> -->
<body>
    <?php
        $productId = $_GET["productId"];
        include "DBConnect.php";
        $sql = "select * from phones where id=" . $productId;
        $result = pg_query($conn, $sql);
        $row = pg_fetch_assoc($result);

        function getUserRating($conn, $id) {
            $userRatings = pg_query($conn, "select * from user_reviews where id=" . $id);
            $colsUser = pg_num_fields($userRatings);
    
            $finalUserRating = 0;
            $totalRatings = 0;
            for ($x = 1; $x < $colsUser; $x++) {
                $currentRatings = pg_fetch_result($userRatings, 0, $x);
                $totalRatings = $totalRatings + $currentRatings;
                $weight = 5 - (($x - 1) % 5);
                $finalUserRating = $finalUserRating + $currentRatings * $weight * 20;
            }
            return round($finalUserRating / $totalRatings);
        }
    
        function getExpertRating($conn, $id) {
            $expertRatings = pg_query($conn, "select * from expert_ratings where id=" . $id);
            $colsExpert = pg_num_fields($expertRatings);
            $finalExpertRating = 0;
            for ($x = 1; $x < $colsExpert; $x++) {
                $finalExpertRating = $finalExpertRating + pg_fetch_result($expertRatings, 0, $x);
            }
            return round($finalExpertRating / $colsExpert);
        }
    ?>
  
  <!--Navigation bar-->
<div id="nav-placeholder">
    <?php
        include 'nav.php';
    ?>
</div>

<div class="container-fluid">
    <div class="row m-5">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <center><h2>
            <?php
                echo $row["phone_name"];
            ?>
            </h2></center>
        </div>
    </div>
</div>

<div class="toolTip"></div>

<?php
    function getRatingCols($conn) {
        $ratings = array();
        $res = pg_query($conn, "select * from expert_ratings where id = 1");
        $i = pg_num_fields($res);
        for ($j = 0; $j < $i; $j++) {
            $ratings[] = pg_field_name($res, $j);
        }
        return $ratings;
    }

    function getSummaryCols($conn) {
        $summaries = array();
        $res = pg_query($conn, "select * from expert_summaries where id = 1");
        $i = pg_num_fields($res);
        for ($j = 0; $j < $i; $j++) {
            $fieldname = pg_field_name($res, $j);
            if ($fieldname != 'ID') {
                $summaries[] = $fieldname;
            }
        }
        return $summaries;
    }

    function selectColumns($table, $cols, $productId) {
        $sql = "SELECT ";
        foreach ($cols as $col) {
            $sql = $sql . $col . ",";
        }
        $sql = substr($sql, 0, -1);
        return $sql . " FROM " . $table . " WHERE ID=" . $productId;
    }
?>

<div class="container-fluid">
    <div class="row m-5">
        <div class="col">
            <!-- Here goes the pictures of the phone -->
            <?php 
                include 'with-jquery.php';
            ?>
        </div>
    </div>
    <div class="row m-5">
    <div class="col">
        <!-- Here goes the user reviews visualization -->
            <?php
                include "rating.php";
            ?>
        </div>
    </div>
    <div class="row m-5">
        <div class="col">
            <?php
                include "expertReviews.php";
            ?>
        </div>
    </div>
</div>

</body>
</html>