<?php
require "connection.php";
session_start();
/*function get_total_row($connect)
{
  $query = "
  SELECT * FROM tbl_webslesson_post
  ";
  $statement = $connect->prepare($query);
  $statement->execute();
  return $statement->rowCount();
}

$total_record = get_total_row($connect);*/


$limit = '4';
$page = 1;
if ($_POST['page'] > 1) {
    $start = (($_POST['page'] - 1) * $limit);
    $page = $_POST['page'];
} else {
    $start = 0;
}

$query = "
SELECT * FROM `product`  ";



$q = $_POST['query'];
$query .= "
 WHERE `title` LIKE '%" . $q . "%'
  ";

if ($_POST['category'] != 0) $query .= "AND `category_id`='{$_POST['category']}'";
if ($_POST['brand'] != 0) $query .= "AND `model_has_brand_id` IN (SELECT `id` FROM `model_has_brand` WHERE `brand_id`='{$_POST['brand']}' )";
if ($_POST['model'] != 0) $query .= "AND `model_has_brand_id` IN (SELECT `id` FROM `model_has_brand` WHERE `model_id`='{$_POST['model']}' )";
if ($_POST['condition'] != 0) $query .= "AND `condition_id`='{$_POST['condition']}'";
if ($_POST['color'] != 0) $query .= "AND `color_id`='{$_POST['color']}'";
if (!empty($_POST['pto']) && !empty($_POST['pfrom'])) {
    $query .= "AND `price` BETWEEN '{$_POST['pfrom']}' AND '{$_POST['pto']}'";
    # code...
} else {

    if (!empty($_POST['pto'])) $query .= "AND `price`<='{$_POST['pto']}'";
    if (!empty($_POST['pfrom'])) $query .= "AND `price`>='{$_POST['pfrom']}'";
}
// $query .= 'ORDER BY pro_id ASC ';

$filter_query = $query . 'LIMIT ' . $start . ', ' . $limit . '';

$statement = database::search($query);

$total_data = $statement->num_rows;

$statement = database::search($filter_query);
$result = $statement;
$total_filter_data = $statement->num_rows;

$output = '
<div class="row" id="div1">
';
if ($total_data > 0) {
    while ($product = $result->fetch_assoc()) {
        $img = database::search("SELECT * FROM `image` WHERE `product_id`='" . $product["id"] . "'");
        $img = $img->fetch_assoc();
        if ($product['status_id'] == 2) $check = 'checked';
        else $check = '';
        if ($product['status_id'] == 2) $status = 'Activate Product';
        else $status = 'Deactivate Product';
        $output .= "
        <div class='col-6 g-5'>
                <div class='card mb-3 mt-3 ms-0'>
                    <div class='row mx-2'>

                        <div class='col-md-4 mt-3'>
                            
                            <img src='{$img['code']}' class='img-fluid rounded-start' alt='...'>
                        </div>
                        <div class='col-md-8'>
                            <div class='card-body'>
                                <h5 class='card-title fw-bold'>{$product['title']}</h5>
                                <span class='card-text text-primary fw-bold'>Rs.{$product['price']}</span>
                                <br>
                                <span class='card-text text-success fw-bold'>{$product['qty']}&nbsp;
                                    Items
                                    Left</span>
                                <br>
                                <div class='form-check form-switch mb-2'>

                                    <input class='form-check-input' type='checkbox' id='check' onchange='changestatus({$product['id']});' $check>
                                    <label class='form-check-label text-info fw-bold' for='check' id='checklabel{$product['id']}'>$status</label>
                                </div>
                                <dic class='col-12'>
                                    <div class='row'>
                                        <div class='col-lg-6 col-12'>
                                            <a onclick='send_id({$product['id']});' class='btn btn-success d-grid' href='#'>Update</a>
                                        </div>

                                        <div class='col-lg-6 col-12 mt-1 mt-lg-0'>
                                            <a class='btn btn-danger d-grid' href='#' onclick='deletemodal({$product['id']});'>Delete
                                            </a>
                                        </div>
                                    </div>
                                </dic>


                            </div>
                        </div>

                    </div>
                </div>
        </div>




    ";
    }
} else {
    $output .= '
    <h1 class="mt-5" align="center">No Data Found</h1>

  ';
}

if ($total_data > 0) {
    $output .= '</div ><br/>
<div align="center ">
    <ul class="pagination col-9 offset-2 offset-md-3 col-md-6">';

    $total_links = ceil($total_data / $limit);
    $previous_link = '';
    $next_link = '';
    $page_link = '';

    //echo $total_links;

    if ($total_links > 4) {
        if ($page < 5) {
            for ($count = 1; $count <= 5; $count++) {
                $page_array[] = $count;
            }
            $page_array[] = '...';
            $page_array[] = $total_links;
        } else {
            $end_limit = $total_links - 5;
            if ($page > $end_limit) {
                $page_array[] = 1;
                $page_array[] = '...';
                for ($count = $end_limit; $count <= $total_links; $count++) {
                    $page_array[] = $count;
                }
            } else {
                $page_array[] = 1;
                $page_array[] = '...';
                for ($count = $page - 1; $count <= $page + 1; $count++) {
                    $page_array[] = $count;
                }
                $page_array[] = '...';
                $page_array[] = $total_links;
            }
        }
    } else {
        for ($count = 1; $count <= $total_links; $count++) {
            $page_array[] = $count;
        }
    }

    for ($count = 0; $count < count($page_array); $count++) {
        if ($page == $page_array[$count]) {
            $page_link .= '
    <li class="page-item active">
      <a class="page-link " href="#" data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a>
    </li>
    ';

            $previous_id = $page_array[$count] - 1;

            if ($previous_id > 0) {
                $previous_link = '<li class="page-item "><a class="page-link" href="javascript:void(0)" data-page_number="' . $previous_id . '">Previous</a></li>';
            } else {

                $previous_link = ' 
                                
      <li class="page-item disabled">
        <a class="page-link " href="#">Previous</a>
      </li>
      ';
            }
            $next_id = $page_array[$count] + 1;
            if ($next_id > $total_links) {
                $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Next</a>
      </li>
        ';
            } else {
                $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $next_id . '">Next</a></li>';
            }
        } else {
            if ($page_array[$count] == '...') {
                $page_link .= '
      <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
      </li>
      ';
            } else {
                $page_link .= '
      <li class="page-item"><a class="page-link" href="#" data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a></li>
      ';
            }
        }
    }

    $output .= $previous_link . $page_link . $next_link;
    $output .= '
  </ul>

</div>
';
}
echo $output;