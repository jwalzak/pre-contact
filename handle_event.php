<?php 
require_once('connect.php');

if(isset($_GET['action'])){
  header('Content-type: application/json');

  if($_GET['action'] == 'load') {
    fetchData($db);
  }

  if($_GET['action'] == 'new') {
    newContact($db);
  }

  if($_GET['action'] == 'delete') {
    removeContact($db);
  }

  if($_GET['action'] == 'update') {
    if(isset($_GET['id'])){
      updateContact($db);
    }
  }
}


function fetchData($dbc) {
  $data = array();
  $query = 'SELECT * FROM user_contact';
  $rs = $dbc->query($query); // Result Set

  while($info = $rs->fetch_assoc()) {
    array_push($data, $info);
  }// End While
  
  echo json_encode($data);
}// End fetchData()

function newContact($dbc) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $birthday = $_POST['birthday'];
  $homepage = $_POST['homepage'];
  $relationship = $_POST['relationship'];
  if($_POST['step'] == 'on') {
    $step = 1;
  } else {
    $step = 0;
  }// End if
  $background = $_POST['background'];

  evalStepRel($step, $relationship);
  fixRel($relationship);
  
  $query = 'INSERT INTO user_contact (fname, lname, email, phone, birthday, 
              relationship, homepage, step_rel, background_col) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
  $stmt = $dbc->prepare($query);
  $stmt->bind_param('sssssssis', $fname, $lname, $email, $phone, 
        $birthday, $relationship, $homepage, $step, $background);
  $stmt->execute();

  $returnArr = ['It', 'Works'];

  echo json_encode($_POST);
}// End newContact()

function removeContact($dbc) {
  $query = 'DELETE FROM user_contact WHERE id = ?';
  $stmt = $dbc->prepare($query);
  $stmt->bind_param('i', $_GET['id']);
  $stmt->execute();

  echo json_encode('File Successfully Deleted');
}// End removeContact()

function updateContact($dbc) {
  // If the next two lines aren't here $_POST will be empty
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json, true);

  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $birthday = $_POST['birthday'];
  $homepage = $_POST['homepage'];
  $relationship = $_POST['relationship'];
  if($_POST['step'] == 'on') {
    $step = 1;
  } else {
    $step = 0;
  }// End if
  $background = $_POST['background'];
  $id = $_GET['id'];

  evalStepRel($step, $relationship);
  fixRel($relationship);

  $query = 'UPDATE user_contact 
            SET fname=?, lname=?, email=?, phone=?, birthday=?, relationship=?, 
              homepage=?, step_rel=?, background_col=? 
            WHERE id = ' . $id;
  $stmt = $dbc->prepare($query);
  $stmt->bind_param('sssssssis', $fname, $lname, $email, $phone, 
        $birthday, $relationship, $homepage, $step, $background);
  $stmt->execute();
  $returnArr = ['It', 'here'];

  echo json_encode($returnArr);
}// End updateContact()

function evalStepRel($stepRel, $rel) {
  switch ($stepRel) {
    case 1:
      if($rel == 'Mother' || $rel == 'Father' || $rel == 'Brother' || $rel == 'Aunt' || $rel == 'Uncle'){
        $rel = 'Step-'.$rel;
      }
      break;
    
    default:
      $rel = $rel;
      break;
  }
  return $rel;
}

function fixRel($rel) {
  switch ($rel) {
    case 'professional-contact':
      $rel = 'Professional Contact';
      break;

    case 'best-friend':
      $rel = 'Best Friend';
      break;

    case 'significant-other':
      $rel = 'Significant Other';
      break;

    case 'co-worker':
      $rel = 'Co-worker';
      break;

    default:
      $rel = $rel;
      break;
  }
  return $rel;
}
