<?php
    class MemberView{
      // Untuk menampilkan bagian index tabel data member
      public function render($data){
        $no = 1;
        $dataMember = null;
        $dataHeader = null;
        $groupIndex = null;
        $homeLabel = null;
        $addNew = null;
        
        // Navbar
        $homeLabel .= "index.php";
        $groupIndex .= "group-index.php";

        // Menyimpan variabel link add
        $addNew .= "index.php?id_add=1";

        // Header tabel
        $dataHeader .= "
        <thead>
          <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>PHONE</th>
            <th>JOINING DATE</th>
            <th>GROUP</th>
            <th>ACTIONS</th>
          </tr>
        </thead>";

        // Tabel data member
        foreach($data as $val){
          list($id, $name, $email, $phone,  $join,$group_name) = $val;
              $dataMember .= "
              <tbody>
                      <tr>
                      <td>" . $no++ . "</td>
                      <td>" . $name . "</td>
                      <td>" . $email . "</td>
                      <td>" . $phone . "</td>
                      <td>" . $join . "</td>
                      <td>" . $group_name . "</td>
                      <td>
                      <a href='index.php?id_edit=" . $id .  "' class='btn btn-warning''>Edit</a>
                      <a href='index.php?id_hapus=" . $id . "' class='btn btn-danger' onclick='return confirmDelete()'>Hapus</a>
                      </td>
                      </tr>
              </tbody>";
              
        }
  
        // Membuka template baru
        $tpl = new Template("templates/skin.html");

        // Menukar isi variabel
        $tpl->replace("HOME_LABEL", $homeLabel);
        $tpl->replace("GROUP_INDEX", $groupIndex);
        $tpl->replace("ADD_NEW", $addNew);
        $tpl->replace("DATA_HEADER", $dataHeader);
        $tpl->replace("DATA_TABEL", $dataMember);
        $tpl->write();
      }

      // Form add data member
      public function formMember($dataGroup) {
        $dropdownOptions = '';

        $crudLabel = null;
        $homeLabel = null;
        $processLabel = null;
        $formControl = null;
        $cancelLabel = null;
        $addNew = null;

        // Navbar
        $crudLabel .= "index.php";
        $homeLabel .= "index.php";
        
        // Judul
        $processLabel .= "Create New Member";

        // Menyimpan variabel link add
        $addNew .= "index.php?id_add=1";

        // Form member
        $formControl .= "
          <label> NAME: </label>
          <input type='text' name='name' class='form-control'> <br>

          <label> EMAIL: </label>
          <input type='text' name='email' class='form-control'> <br>

          <label> PHONE: </label>
          <input type='text' name='phone' class='form-control'> <br>

          <label> JOINING DATE: </label>
          <input type='date' name='join_date' class='form-control'> <br>

          <label>GROUP:</label>
          <select name='id_group' class='form-control'>
            DROPDOWN
          </select><br>";

        // Button cancel
        $cancelLabel .= "index.php";
        
        // Dropdown group
        foreach ($dataGroup as $group) {
          $groupId = $group['group_id'];
          $groupName = $group['group_name'];
          
          $dropdownOptions .= "<option value=\"$groupId\">$groupName</option>";
        }
      
        // Membuka template baru
        $tpl = new Template("templates/skinform.html");
        
        // Menukar isi variabel
        $tpl->replace("CRUD_LABEL", $crudLabel);
        $tpl->replace("HOME_LABEL", $homeLabel);
        $tpl->replace("ADD_NEW", $addNew);
        $tpl->replace("PROCESS_LABEL", $processLabel);
        $tpl->replace("FORM_CONTROL", $formControl);
        $tpl->replace("CANCEL_LABEL", $cancelLabel);
        $tpl->replace("DROPDOWN", $dropdownOptions);
        $tpl->write();
      }
      
      // Form edit
      public function formMemberEdit($dataGroup, $member)
      {
          $dropdownOptions = '';
      
          $crudLabel = null;
          $homeLabel = null;
          $processLabel = null;
          $formControl = null;
          $cancelLabel = null;
          $addNew = null;
      
          // Navbar
          $crudLabel .= "index.php";
          $homeLabel .= "index.php";

          // Judul
          $processLabel .= "Edit Member";
      
          // Menyimpan variabel link add
          $addNew .= "index.php?id_add=1";
      
          // Form edit member
          $formControl .= "
              <label> NAME: </label>
              <input type='text' name='name' class='form-control' value='" . $member['name'] . "'> <br>
      
              <label> EMAIL: </label>
              <input type='text' name='email' class='form-control' value='" . $member['email'] . "'> <br>
      
              <label> PHONE: </label>
              <input type='text' name='phone' class='form-control' value='" . $member['phone'] . "'> <br>

              <label> JOINING DATE: </label>
              <input type='date' name='join_date' class='form-control' value='" . $member['join_date'] . "'> <br>
      
              <label>GROUP:</label>
              <select name='id_group' class='form-control'>
                  DROPDOWN
              </select><br>";
      
              // Button cancel
          $cancelLabel .= "index.php";
      
          // Dropdown group
          foreach ($dataGroup as $group) {
              $groupId = $group['group_id'];
              $groupName = $group['group_name'];
      
              if ($groupId == $member['id_group']) {
                  $dropdownOptions .= "<option value=\"$groupId\" selected>$groupName</option>";
              } else {
                  $dropdownOptions .= "<option value=\"$groupId\">$groupName</option>";
              }
          }
      
          // Membuka template baru
          $tpl = new Template("templates/skinform.html");

          // Menukar isi variabel
          $tpl->replace("CRUD_LABEL", $crudLabel);
          $tpl->replace("HOME_LABEL", $homeLabel);
          $tpl->replace("ADD_NEW", $addNew);
          $tpl->replace("PROCESS_LABEL", $processLabel);
          $tpl->replace("FORM_CONTROL", $formControl);
          $tpl->replace("CANCEL_LABEL", $cancelLabel);
          $tpl->replace("DROPDOWN", $dropdownOptions);
          $tpl->write();
      }
    }

?>