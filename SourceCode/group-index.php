<?php
include("models/Template.class.php");
include("models/DB.class.php");
include("controllers/Group.controller.php");

$group = new GroupController();

// Add
if (!empty($_GET['id_add'])) {
    $group->add();
} 
// Hapus
else if (!empty($_GET['id_hapus'])) {
    $id = $_GET['id_hapus'];
    $group->delete($id);

    header("location:group-index.php");
} 
// Edit
else if (!empty($_GET['id_edit'])) {
    $id = $_GET['id_edit'];
    $group->edit($id);
} 
// Tampilan data
else {
    $group->index();
}