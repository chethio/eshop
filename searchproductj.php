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
$limit = '6';
$page = 1;
if ($_POST['page'] > 1) {
    $start = (($_POST['page'] - 1) * $limit);
    $page = $_POST['page'];
} else {
    $start = 0;
}

$query = "
SELECT * FROM `product` ";

// $query .= '
//   or brand.brand LIKE "' . str_replace(' ', '%', $_POST['query']) . '%" 
//   ';

// $query .= 'ORDER BY pro_id ASC ';

$filter_query = $query . 'LIMIT ' . $start . ', ' . $limit . '';

$statement = database::search($query);

$total_data = $statement->num_rows;

$statement = database::search($filter_query);
$result = $statement;
$total_filter_data = $statement->num_rows;

$x = $start;
$output = '';
if ($total_data > 0) {
    while ($product = $result->fetch_assoc()) {
        $x += 1;
        $img = database::search("SELECT * FROM `image` WHERE `product_id`='" . $product["id"] . "'");
        $img = $img->fetch_assoc();
        if ($product['status_id'] == 2) $check = 'checked';
        else $check = '';
        if ($product['status_id'] == 2) $status = 'Unblock';
        else $status = 'Block';
        $us = $product["status_id"];

        if ($us == 1) {
            $btncls = "btn-danger";
            $btntxt = "Block";
        } else {
            $btncls = "btn-success";
            $btntxt = "Unblock";
        }
        $output .= "
        <div class='col-2 col-lg-1 bg-primary pt-2 pb-2 text-end'>
        <span class='fs-5 fw-bold text-white'>$x</span>
    </div>

    <div class='col-2 col-lg-2 bg-light p-1 d-none d-lg-block'>

        <div class='text-center'>
            <img onclick='singleviewmodal({$product['id']});'
src='{$img['code']}' style='height: 100px;'>
</div>

</div>

<div class='col-2 bg-primary pt-2 pb-2 d-none d-lg-block'>
    <span class='fs-5 fw-bold text-white'>{$product['title']}</span>
</div>

<div class='col-6 col-lg-2 bg-light pt-2 pb-2'>
    <span class='fs-5 fw-bold'>{$product['price']}</span>
</div>

<div class='col-2 bg-primary pt-2 pb-2 d-none d-lg-block'>
    <span class='fs-5 fw-bold text-white'>{$product['user_email']}</span>
</div>

<div class='col-2 bg-light pt-2 pb-2 d-none d-lg-block'>
    <span class='fs-5 fw-bold'>{$product['description']}</span>
</div>

<div class='col-4 col-lg-1 bg-light pt-2 pb-2 d-grid'>
<button id='blb{$product['id']}' onclick=\"blockproduct('{$product['id']}');\" class='btn $btncls'>$btntxt</button>

</div>


<div class='modal fade' id='singleproductview{$product['id']}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel'>{$product['title']}</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>

                <div class='text-center'>
                    <img style='height: 300px;' class='rounded rounded-5'
                        src='{$img['code']}'>
                </div>
                <span class='fs-5 fw-bold'>Price</span>
                <span>Rs.{$product['price']}.00</span>
                <br>
                <span class='fs-5 fw-bold'>Quantity</span>
                <span>{$product['qty']} Items Left</span>
                <br>
                <span class='fs-5 fw-bold'>Seller</span>
                <span>{$product['user_email']}</span>
                <br>
                <span class='fs-5 fw-bold'>Description</span>
                <p>{$product['description']}</p>

            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                <button onclick='savecategory();' type='button' class='btn btn-primary'>Save
                    Category</button>
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
    $output .= '<br />
<div align="center ">
    <ul class="pagination col-9 offset-2 offset-md-3 col-md-6 mt-3">';

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
        for (
            $count = 1;
            $count <= $total_links;
            $count++
        ) {
            $page_array[] = $count;
        }
    }
    for ($count = 0; $count <
        count($page_array); $count++) {
        if ($page == $page_array[$count]) {
            $page_link .= '
    <li class="page-item active">
      <a class="page-link " href="#" data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a>
    </li>
    ';
            $previous_id = $page_array[$count] - 1;
            if ($previous_id > 0) {
                $previous_link = '<li class="page-item "><a class="page-link" href="javascript:void(0)"
                        data-page_number="' . $previous_id . '">Previous</a></li>';
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
                $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)"
                        data-page_number="' . $next_id . '">Next</a></li>';
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
                <li class="page-item"><a class="page-link" href="#" data-page_number="' . $page_array[$count] . '">' .
                    $page_array[$count] . '</a></li>
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