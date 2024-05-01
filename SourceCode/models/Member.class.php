<?php

class Member extends DB
{
    // Mengambil data member kemudian join dengan data group
    function getMember()
    {
        // Operasi join
        $query = "SELECT members.id, members.name, members.email, members.phone, members.join_date, `group`.group_name
        FROM members
        INNER JOIN `group` ON members.id_group = `group`.group_id
        ORDER BY members.id";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Mengambil data member berdasarkan id
    function getMemberById($id)
    {
        $query = "SELECT * FROM members WHERE id = '$id'";
        $this->open();
        $this->execute($query);
        $result = $this->getResult();
        $this->close();

        // Mengambil result berupa id
        return $result;
    }

    // Menambah data member
    function addMember($data)
    {
        // Data tabel members
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $join = $data['join_date'];
        $group = $data['id_group'];

        // Operasi add
        $query = "INSERT INTO members (`name`, `email`, `phone`,`join_date`, `id_group`) VALUES ('$name', '$email', '$phone', '$join', $group)";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Mengedit data member
    function editMember($data)
    {
        // Data tabel members
        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $join = $data['join_date'];
        $group = $data['id_group'];

        // Operasi edit
        $query = "UPDATE members SET name='$name', email='$email', phone='$phone', join_date='$join', id_group='$group'WHERE id=$id";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Menghapus data member
    function deleteMember($id)
    {
        // Operasi delete
        $query = "DELETE FROM members WHERE id=$id";

        // Mengeksekusi query
        return $this->execute($query);
    }

}