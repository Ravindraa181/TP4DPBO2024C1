<?php
include("Connection.php");
include("models/Group.class.php");
include("views/Group.view.php");

class GroupController
{
    // Atribut
    private $group;

    // Constructor
    function __construct()
    {
        $this->group = new Group(Connection::$db_hostname, Connection::$db_username, Connection::$db_password, Connection::$db_name);
    }

    // Controller untuk menampilkan tampilan index atau bagian tabel data group
    public function index()
    {
        $this->group->open();
        $this->group->getGroup();

        $dataGroup = array();

        while ($row = $this->group->getResult()) {
            array_push($dataGroup, $row);
        }

        $this->group->close();

        $view = new groupView();
        $view->render($dataGroup);
    }

    // Controller untuk bagian menambahkan data
    function add()
    {
        $view = new groupView();

        // Jika menekan tombol submit
        if (isset($_POST['submit'])) {
            $dataGroup = array(
                'group_name' => $_POST['group_name']
            );

            $this->group->open();
            $this->group->addGroup($dataGroup);
            $this->group->close();

            header("location:group-index.php");
        } else { // Menampilkan form add group
            $view->formgroup();
        }
    }

    // Controller untuk bagian edit data
    function edit($id)
    {
        $view = new groupView();

        // Jika menekan tombol submit
        if (isset($_POST['submit'])) {
            $dataGroup = array(
                'group_id' => $id,
                'group_name' => $_POST['group_name']
            );

            $this->group->open();
            $this->group->editGroup($dataGroup);
            $this->group->close();

            header("location:group-index.php");
        } else { //Menampilkan form edit
            $this->group->open();
            $this->group->getGroupById($id);
            $row = $this->group->getResult();
            $this->group->close();

            $data = array(
                'group_id' => $row['group_id'],
                'group_name' => $row['group_name']
            );

            $view->formgroupEdit($data);
        }
    }

    // Controller untuk menghapus data
    function delete($id)
    {
        $this->group->open();
        $this->group->deleteGroup($id);
        $this->group->close();

        header("location:group-index.php");
    }
}