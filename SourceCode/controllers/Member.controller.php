<?php
include("Connection.php");
include("models/Member.class.php");
include("models/Group.class.php");
include("views/Member.view.php");

class MemberController {
  // Atribut
  private $member;
  private $group;

  // Constructor
  function __construct(){
    $this->member = new Member(Connection::$db_hostname, Connection::$db_username, Connection::$db_password, Connection::$db_name);
    $this->group = new Group(Connection::$db_hostname, Connection::$db_username, Connection::$db_password, Connection::$db_name);
  }

  // Controller untuk menampilkan tampilan index atau bagian tabel data member
  public function index() {
    $this->member->open();
    $this->member->getMember();
    
    $dataMember = array();

    while($row = $this->member->getResult()){
      array_push($dataMember, $row);
    }

    $this->member->close();

    $view = new MemberView();
    $view->render($dataMember);
  }

  // Controller untuk bagian menambahkan data
  function add() {
    $view = new MemberView();
  
    // Jika menekan tombol submit
    if (isset($_POST['submit'])) {
      $dataMember = array(
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'join_date' => $_POST['join_date'],
        'id_group' => $_POST['id_group']
      );
  
      $this->member->open();
      $this->member->addMember($dataMember);
      $this->member->close();
  
      header("location:index.php");
    } else { // Menampilkan form add member
      $dataGroup = $this->getGroupOptions();
      $view->formMember($dataGroup);
    }
  }

  // Controller untuk bagian edit data
  function edit($id)
  {
    $view = new MemberView();

    // Jika menekan tombol submit
    if (isset($_POST['submit'])) {
        $dataMember = array(
            'id' => $id,
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'join_date' => $_POST['join_date'],
            'id_group' => $_POST['id_group']
        );

        $this->member->open();
        $this->member->editMember($dataMember);
        $this->member->close();

        header("location:index.php");
    } else { //Menampilkan form edit
        $member = $this->member->getMemberById($id);
        $dataGroup = $this->getGroupOptions();
        $view->formMemberEdit($dataGroup, $member);
    }
  }

  // Controller untuk menghapus data
  function delete($id){
    $this->member->open();
    $this->member->deleteMember($id);
    $this->member->close();

    header("location:index.php");
  }

  // Controller dropdown group
  function getGroupOptions() {
    $this->group->open();
    $this->group->getGroup();
    
    $dataGroup = array();
  
    while($row = $this->group->getResult()){
      array_push($dataGroup, $row);
    }
  
    $this->group->close();
  
    return $dataGroup;
  }

}