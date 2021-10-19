<?php
include '../process.php';
require "connection.php";

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

$limit = '5';
$page = 1;
if ($_POST['page'] > 1) {
        $start = (($_POST['page'] - 1) * $limit);
        $page = $_POST['page'];
} else {
        $start = 0;
}

$query = "
SELECT * FROM product INNER JOIN brand ON product.brand=brand.id";

$query .= '
  WHERE name LIKE "' . str_replace(' ', '%', $_POST['query']) . '%" 
  ';
$query .= '
  or brand.brand LIKE "' . str_replace(' ', '%', $_POST['query']) . '%" 
  ';

$query .= 'ORDER BY pro_id ASC ';

$filter_query = $query . 'LIMIT ' . $start . ', ' . $limit . '';

$statement = $conn->query($query);

$total_data = $statement->num_rows;

$statement = $conn->query($filter_query);
$result = $statement;
$total_filter_data = $statement->num_rows;

$output = '
<table class=" table table-border ">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col ">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Product</th>
                                </tr>
                            </thead>
                            <tbody >
';
if ($total_data > 0) {
        while ($row = $result->fetch_assoc()) {
                $img = str_replace('C:fakepath', '', $row['img']);

                $output .= "
    <tr class='align-middle'>
                                            <th scope='row'>{$row['pro_id']}</th>
                                            <td >{$row['name']}</td>
                                            <td>{$row['brand']}</td>
                                            <td>{$row['qty']}</td>
                                            <td>Rs.{$row['price']}</td>
                                            <td><img class='img-thumbnail productimg' src='../upload/$img'>
                                            </td>
                                        </tr>
    ";
        }
} else {
        $output .= '
  <tr>
    <td colspan="6" align="center">No Data Found</td>
  </tr>
  ';
}

if ($total_data > 0) {
        $output .= '
    </tbody>
</table>
<br />
<div align="center">
  <ul class="pagination justify-content-center">
';

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
      <a class="page-link" href="#">' . $page_array[$count] . ' <span class="sr-only">(current)</span></a>
    </li>
    ';

                        $previous_id = $page_array[$count] - 1;
                        if ($previous_id > 0) {
                                $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $previous_id . '">Previous</a></li>';
                        } else {
                                $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Previous</a>
      </li>
      ';
                        }
                        $next_id = $page_array[$count] + 1;
                        if ($next_id >= $total_links) {
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
      <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a></li>
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