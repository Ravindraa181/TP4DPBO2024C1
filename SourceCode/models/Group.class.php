<?php

class Group extends DB
{
    // Mengambil data group
    function getGroup()
    {
        $query = "SELECT * FROM `group`;
";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Mengambil data group berdasarkan id
    function getGroupById($id)
    {
        $query = "SELECT * FROM `group` WHERE group_id=$id";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Menambah data group

    function addGroup($data)
    {
        // Data tabel group
        $group = $data['group_name'];
    
        // Operasi add
        $query = "INSERT INTO `group` (`group_name`) VALUES ('$group')";
    
        // Mengeksekusi query
        return $this->execute($query);
    }
    

    // Mengedit data group
    function editGroup($data)
    {
        // Data tabel group
        $id = $data['group_id'];
        $group_name = $data['group_name'];

        // Operasi edit
        $query = "UPDATE `group` SET group_name = '$group_name' WHERE group_id = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Menghapus data group
    function deleteGroup($id)
    {
        // Operasi delete
        $query = "DELETE FROM `group` WHERE group_id=$id";

        // Mengeksekusi query
        return $this->execute($query);
    }
}