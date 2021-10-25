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
SELECT * FROM user  ";

$query .= '
  WHERE  `email` LIKE  "' . str_replace(' ', '%', $_POST['query']) . '%" 
  ';

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

$output = '';
if ($total_data > 0) {
    $x = 0;
    while ($profile = $result->fetch_assoc()) {
        $x += 1;
        $img = database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $profile["email"] . "'");
        $img = $img->fetch_assoc();


        if (isset($img['code'])) $img = $img['code'];
        else $img = "resources//Profile.jpg";
        if ($profile['status'] == 2) $status = '';
        else $status = '';
        $date = date('Y-m-d', strtotime($profile["register_date"]));
        $us = $profile["status"];

        if ($us == 1) {
            $btncls = "btn-danger";
            $btntxt = "block";
        } else {
            $btncls = "btn-success";
            $btntxt = "Unblock";
        }
        $output .= "
        <div class='col-12 mb-2' >
                <div class='row'>


<div class='col-2 col-lg-1 bg-primary pt-2 pb-2 text-end'>
<span class='fs-4 fw-bold text-white'>$x</span>
</div>

                <div class='col-2 bg-light d-none d-lg-block'>
<img onclick='viewmsgmodal(\"{$profile['email']}\");loadmessages(\"{$profile['email']}\",\"chatrow{$profile['email']}\");' src='$img' style='height: 70px; margin-left: 120px;'>
</div>






<div class='col-2  bg-primary pt-2 pb-2 d-none d-lg-block'>
<span class='fs-5 fw-bold'>{$profile['email']}</span>
</div>

<div class='col-6 col-lg-2 bg-light pt-2 pb-2'>
<span class='fs-5 fw-bold'>{$profile['fname']} {$profile['lname']}</span>
</div>

<div class='col-2  bg-primary pt-2 pb-2 d-none d-lg-block'>
<span class='fs-5 fw-bold text-white'>{$profile['mobile']}</span>
</div>

<div class='col-2 bg-light pt-2 pb-2 d-none d-lg-block'>
<span class='fs-5 fw-bold'>$date</span>
</div>






                 

                    <div class=' col-4 col-lg-1 bg-light pt-2 pb-2 d-grid'>
                                                <button id='blb{$profile['email']}' onclick=\"blockuser('{$profile['email']}');\" class='btn $btncls'>$btntxt</button>
                        
                    </div>

                </div>
            </div>


   <!-- Modal -->
            <div class='modal modal-dialog-scrollable fade' id='msgmodal{$profile['email']}' tabindex='-1'
                aria-labelledby='exampleModalLabel' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='exampleModalLabel'>My Messages</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <!-- messages body -->


                            <div class='col-12 py-5 px-4'>
                                <div class='row rounded-lg overflow-hidden shadow'>
                                    <div class='col-12'>
                                        <div class='bg-white'>

                                            <div class='bg-gray px-4 py-2 bg-light'>
                                                <p class='h5 mb-0 py-1'>Recent</p>
                                            </div>

                                            <div class='messages-box'>
                                                <div class='list-group rounded-0' id='rcv'>



                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- massage box -->
                                    <div class='col-12 '>
                                        <div class='row px-4 py-5 chat-box bg-white' id='chatrow{$profile['email']}'>
                                            <!-- massage load venne methana -->


                                        </div>
                                    </div>

                                    <div class='col-12'>
                                        <div class='row bg-white'>

                                            <!-- text -->
                                            <div class='col-12'>
                                                <div class='row bg-white'>
                                                    <div class='input-group mb-3'>
                                                        <input type='text' id='msgtxt{$profile['email']}' placeholder='Type a message'
                                                            aria-describedby='button-addon2'
                                                            class='form-control rounded-0 border-0 py-4 bg-light'>
                                                        <div class='input-group-append'>
                                                            <button id='button-addon2' class='btn btn-link fs-1'
                                                                onclick='sendmessage(\"{$profile['email']}\",\"msgtxt{$profile['email']}\");'>
                                                                <i class='bi bi-cursor-fill'></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- text -->

                                        </div>
                                    </div>

                                </div>
                            </div>


                            <!-- messages body -->
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Close</button>

                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->




    ";
    }
} else {
    $output .= '
    <h1 class="mt-5" align="center">No Data Found</h1>

  ';
}

if ($total_data > 0) {
    $output .= '<br/>
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