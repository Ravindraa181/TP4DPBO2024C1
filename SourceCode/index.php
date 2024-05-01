<?php
include("models/Template.class.php");
include("models/DB.class.php");
include("controllers/Member.controller.php");

$member = new MemberController();

// Add
if (!empty($_GET['id_add'])) {
    $member->add();
}
// Hapus
else if (!empty($_GET['id_hapus'])) {
    $id = $_GET['id_hapus'];
    $member->delete($id);
    header("location:index.php");
}
// Edit
else if (!empty($_GET['id_edit'])) {
    $id = $_GET['id_edit'];
    $member->edit($id);
}
// Tampilan data
else {
    $member->index();
}