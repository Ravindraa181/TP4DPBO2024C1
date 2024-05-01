<?php
    class GroupView{
      // Untuk menampilkan bagian index tabel data group
      public function render($data){
        $no = 1;
        $dataGroup = null;
        $dataHeader = null;
        $groupIndex = null;
        $homeLabel = null;
        $addNew = null;

        // Navbar
        $homeLabel .= "index.php";
        $groupIndex .= "group-index.php";

        // Menyimpan variabel link add
        $addNew .= "group-index.php?id_add=1";

        // Header tabel
        $dataHeader .= "
        <thead>
          <tr>
            <th>ID</th>
            <th>GROUP</th>
            <th>ACTIONS</th>
          </tr>
        </thead>";
        
        // Tabel data group
        foreach($data as $val){
          list($id, $groupName) = $val;
              $dataGroup .= "<tr>
                      <td>" . $no++ . "</td>
                      <td>" . $groupName . "</td>
                      <td>
                      <a href='group-index.php?id_edit=" . $id .  "' class='btn btn-warning''>Edit</a>
                      <a href='group-index.php?id_hapus=" . $id . "' class='btn btn-danger' onclick='return confirmDelete()'>Hapus</a>
                      </td>
                      </tr>";
        }
  
        // Membuka template baru
        $tpl = new Template("templates/skin.html");

        // Menukar isi variabel
        $tpl->replace("HOME_LABEL", $homeLabel);
        $tpl->replace("GROUP_INDEX", $groupIndex);
        $tpl->replace("ADD_NEW", $addNew);
        $tpl->replace("DATA_HEADER", $dataHeader);
        $tpl->replace("DATA_TABEL", $dataGroup);
        $tpl->write();
      }

      // Form add data group
      public function formGroup(){
        $crudLabel = null;
        $homeLabel = null;
        $processLabel = null;
        $formControl = null;
        $cancelLabel = null;
        $addNew = null;

        // Navbar
        $crudLabel .= "group-index.php";
        $homeLabel .= "index.php";
        
        // Judul
        $processLabel .= "Create New group";

        // Menyimpan variabel link add
        $addNew .= "group-index.php?id_add=1";

        // Form group
        $formControl .= "
        <label>GROUP:</label>
        <input type='text' name='group_name' class='form-control'> 
        <br>";

        // Button cancel
        $cancelLabel .= "group-index.php";

        // Membuka template baru
        $tpl = new Template("templates/skinform.html");

        // Menukar isi variabel
        $tpl->replace("CRUD_LABEL", $crudLabel);
        $tpl->replace("HOME_LABEL", $homeLabel);
        $tpl->replace("ADD_NEW", $addNew);
        $tpl->replace("PROCESS_LABEL", $processLabel);
        $tpl->replace("FORM_CONTROL", $formControl);
        $tpl->replace("CANCEL_LABEL", $cancelLabel);
        $tpl->write();
      }

      // Form edit
      public function formGroupEdit($data = null)
      {
          $crudLabel = null;
          $homeLabel = null;
          $processLabel = null;
          $formControl = null;
          $cancelLabel = null;
          $addNew = null;

          // Navbar
          $crudLabel .= "group-index.php";
          $homeLabel .= "index.php";
          
          // Judul
          $processLabel .= "Edit Group";

          // Menyimpan variabel link add
          $addNew .= "group-index.php?id_add=1";

          // Form edit group
          $formControl .= "
          <label>GROUP:</label>
          <input type='text' name='group_name' class='form-control' value='" . ($data ? $data['group_name'] : "") . "'> 
          <br>";

          // Button cancel
          $cancelLabel .= "group-index.php";

          // Membuka template baru
          $tpl = new Template("templates/skinform.html");

          // Menukar isi variabel
          $tpl->replace("CRUD_LABEL", $crudLabel);
          $tpl->replace("HOME_LABEL", $homeLabel);
          $tpl->replace("ADD_NEW", $addNew);
          $tpl->replace("PROCESS_LABEL", $processLabel);
          $tpl->replace("FORM_CONTROL", $formControl);
          $tpl->replace("CANCEL_LABEL", $cancelLabel);
          $tpl->write();
      }
    }

?>