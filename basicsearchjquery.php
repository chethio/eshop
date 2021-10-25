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

$u = $_SESSION['u'];
$limit = '6';
$page = 1;
if ($_POST['page'] > 1) {
    $start = (($_POST['page'] - 1) * $limit);
    $page = $_POST['page'];
} else {
    $start = 0;
}

$query = "
SELECT * FROM product WHERE `user_email`='" . $u["email"] . "'  ";

$query .= '
  AND  `title` LIKE  "%' . $_POST['query'] . '%" 
  ';
echo $_POST['category'];

if ($_POST['category'] != 0) $query .= "AND  `category_id` =  '{$_POST['category']}'  ";
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

$output = '
<div class="row" id="div1">
';
if ($total_data > 0) {
    while ($product = $result->fetch_assoc()) {
        $img = database::search("SELECT * FROM `image` WHERE `product_id`='" . $product["id"] . "'");
        $img = $img->fetch_assoc();
        if ((int)$product['qty'] > 0) $status = "In Stock";
        else $status = "Out Of Stock";
        $output .= "<div class='card col-6 col-lg-2 mt-1 mb-1 ms-3' style='width: 18rem;'>

                                            <img style='object-fit: contain;' src='{$img['code']}' class='card-img-top cardimg' alt='...'>
                                            <div class='card-body'>
                                                <h5 class='card-title'>{$product['title']}<span class='badge bg-primary'>New</span>
                                                </h5>
                                                <span class='card-text text-primary'>Rs.{$product['price']}</span>
                                                <br><span class='card-text text-warning'>$status</span>
                                                <input id='qtytext{$product['id']}' type='number' class='form-control mb-2' value='1' min='0'>
                                                <a href='singleproductview.php?id={$product['id']}' class='btn btn-success'>Buy Now</a>
                                                <a onclick='addtocart({$product['id']})' class='btn btn-danger'>Add To
                                                    Cart</a>
                                                <a id='heart' onclick='addtowishlist({$product['id']}' href='#' class='btn btn-secondary'><i class='bi bi-heart-fill'></i></a>
                                            </div>
                                        </div>";
    }
} else {
    $output .= '
    <h1 class="mt-5" align="center">No Data Found</h1>

  ';
}

if ($total_data > 0) {
    $output .= '</div ><br/>
    
<div align="center">
    <ul class="pagination  text-center col-md-3">';

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