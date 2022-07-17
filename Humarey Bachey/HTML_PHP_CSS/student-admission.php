<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student Admission Form | Humarey Bachchey</title>

    <link rel="stylesheet" href="style.css?v=<? echo time(); ?>">
    <link rel="shortcut icon" href="favicon.ico">
  </head>
  <body>
    <div class="header">
        <center><table>
          <tr>
            <td>Humarey Bachchey</td>
          </tr>
        </table></center>
    </div>

    <div class="main">
      <h1>Humarey Bachchey<img src="favicon.ico" style="transform: translate(10px,12px);"><br>Student Admission Form</h1><hr>
      <form action="register.php" method="post" enctype="multipart/form-data">
        <h2>Student Information</h2><hr>
        <div class="form-input">
          <table>
            <tr>
              <td><label for="">First Name</label></td>
              <td><input type="text" name="stu-fname" required></td>
            </tr>
            <tr>
              <td><label for="">Last Name</label></td>
              <td><input type="text" name="stu-lname" required></td>
            </tr>
            <tr>
              <td><label for="">Date of Birth</label></td>
              <td><input type="date" name="stu-dob" required></td>
            </tr>
            <tr>
              <td><label for="">Gender</label></td>
              <td>
              Male<input type="radio" name="gender" value="M">
              Female<input type="radio" name="gender" value="F"></td>
            </tr>
			<tr>
              <td><label for="">Co Education</label></td>
              <td>
              Yes<input type="radio" name="co" value="Y">
              No<input type="radio" name="co" value="N"></td>
            </tr>
          </table>
        </div>
        <h2><hr>Parent Information</h2><hr>
        <div class="form-input-2" style="top: 230px;">
          <div class="photo">
            <input id="profile-image"  type="file" name="avatar" class="hidden">
          </div>
        </div>
        <div class="form-input">
          <table>
            <tr>
              <td><label for="">Mother First Name</label></td>
              <td><input type="text" name="m-fname" required></td>
            </tr>
            <tr>
              <td><label for="">Mother Last Name</label></td>
              <td><input type="text" name="m-lname" required></td>
            </tr>
            <tr>
              <td><label for="">Mother Contact</label></td>
              <td><input type="text" name="m-contact" required></td>
            </tr>
            <tr>
              <td><label for="">Mother CNIC</label></td>
              <td><input type="text" name="m-cnic" required></td>
            </tr>
            <tr>
              <td><label for="">Mother Email</label></td>
              <td><input type="email" name="m-email" required></td>
            </tr>
            <tr>
              <td><label for="">Mother Address</label></td>
              <td><input type="text" name="m-address" required></td>
            </tr>
            <tr>
              <td><label for="">Is your father or mother a member of staff?</label></td>
              <td>
                Yes<input type="radio" name="staff" value="1">
                No<input type="radio" name="staff" value="0">
              </td>
            </tr>
            </table>
        </div>
        <div class="form-input-2" style=" right:-100px;padding: 15px; top:455px;">
          <table>
          <tr>
			<br/>
            <td><label for="">Father First Name</label></td>
            <td><input type="text" name="f-fname" required></td>
          </tr>
          <tr>
            <td><label for="">Father Last Name</label></td>
            <td><input type="text" name="f-lname" required></td>
          </tr>
          <tr>
            <td><label for="">Father Contact</label></td>
            <td><input type="text" name="f-contact" required></td>
          </tr>
          <tr>
            <td><label for="">Father CNIC</label></td>
            <td><input type="text" name="f-cnic" required></td>
          </tr>
          <tr>
            <td><label for="">Father Email</label></td>
            <td><input type="email" name="f-email" required></td>
          </tr>
          <tr>
            <td><label for="">Father Address</label></td>
            <td><input type="text" name="f-address" required></td>
          </tr></table>
        </div>

        <h2><hr>Guardian Information<hr></h2>
        <div class="form-input">
          <table>
            <tr>
              <td><label for="">Guardian Name</label></td>
              <td><input type="text" name="g-name" required></td>
            </tr>
            <tr>
              <td><label for="">Guardian Contact</label></td>
              <td><input type="text" name="g-contact" required></td>
            </tr>
            <tr>
              <td><label for="">Guardian CNIC</label></td>
              <td><input type="text" name="g-cnic" required></td>
            </tr>
            <tr>
              <td><label for="">Guardian Gender</label></td>
              <td>
                Male<input type="radio" name="g-gender" value="M">
                Female<input type="radio" name="g-gender" value="F">
              </td>
            </tr>
            <tr>
              <td><label for="">Relation</label></td>
              <td><input type="text" name="relation" required></td>
            </tr></table>
        </div>
        <center><button type="submit" name="submit">Submit</button></center>
      </form>
    </div>
  </body>
</html>
