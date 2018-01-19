<?php if($user) : ?>

  <div class="profile">

    <div class="profile-pic">

      <?php if ($profiles['image']): ?>
        <img src="images/<?= $profiles['image']; ?>" />
      <?php else: ?>
        <img src="images/administrator.png" />
      <?php endif; ?>

    </div> <!-- /image -->

    <table class="profile-table">
      <thead>
        <tr>
          <th>Title</th>
          <th>Value</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><strong>Name:</strong></td>
          <td><?php echo $user['name']; ?></td>
        </tr>
        <tr>
          <td><strong>Username:</strong></td>
          <td><?php echo $user['username']; ?></td>
        </tr>
        <tr>
          <td><strong>Email:</strong></td>
          <td><?php echo $user['email']; ?></td>
        </tr>
        <tr>
          <td><strong>Role:</strong></td>
          <td><?php echo Session::get('userrole'); ?></td>
        </tr>
        <tr>
          <td><strong>Date of Birth:</strong></td>
          <td><?php echo $profiles['dob']; ?></td>
        </tr>
        <tr>
          <td><strong>Gender:</strong></td>
          <td><?php echo $profiles['gender']; ?></td>
        </tr>
        <tr>
          <td><strong>Profession:</strong></td>
          <td><?php echo $profiles['profession']; ?></td>
        </tr>
        <tr>
          <td><strong>City:</strong></td>
          <td><?php echo $profiles['city']; ?></td>
        </tr>
        <tr>
          <td><strong>Address:</strong></td>
          <td><?php echo $profiles['address']; ?></td>
        </tr>
        <tr>
          <td><strong>Phone:</strong></td>
          <td><?php echo $profiles['phone']; ?></td>
        </tr>
      </tbody>
    </table> <!-- /table -->

    <div class="wrapper-post-profile">

      <?php if(isset($status)) echo $status; ?>

      <h2>Update Profile</h2>

      <form action="" method="post" enctype="multipart/form-data">
        <div class="box">
          <label>Image</label>
          <input type="file" name="image" value="<?php echo isset($profiles['image']) ? $profiles['image'] : ''; ?>">
        </div>
        <div class="box">
          <label>Date of Birth</label>
          <input type="date" name="dob" value="<?php echo isset($profiles['dob']) ? $profiles['dob'] : ''; ?>">
        </div>
        <div class="box-radio mb-15">
          <label>Gender</label>
          <?php
            switch ($profiles['gender']) {
              case 'male':
                $male = 'checked';
                break;
              case 'female':
                $female = 'checked';
                break;
              case 'other':
                $other = 'checked';
                break;

              default:
                $default = 'checked';
                break;
            }
            if (isset($female) || isset($other)) {
              $default = '';
            }
          ?>
          <input type="radio" name="gender" value="male" <?php echo isset($male) ? $male : $default; ?>> Male<br>
          <input type="radio" name="gender" value="female" <?php echo isset($female) ? $female : ''; ?>> Female<br>
          <input type="radio" name="gender" value="other" <?php echo isset($other) ? $other : ''; ?>> Other
        </div>
        <div class="box-radio mb-15">
          <label>Prodession</label>
          <?php
            if (isset($profiles['profession']) && !empty($profiles['profession'])) {
              $professions = explode(',', $profiles['profession']);
            }else{
              $professions = array('others');
            }
          ?>
          <input type="checkbox" name="profession[]" value="student" <?php echo (in_array("student", $professions)) ? 'checked' : ''; ?>> Student
          <input type="checkbox" name="profession[]" value="blogger" <?php echo (in_array("blogger", $professions)) ? 'checked' : ''; ?>> Blogger
          <input type="checkbox" name="profession[]" value="designer" <?php echo (in_array("designer", $professions)) ? 'checked' : ''; ?>> Designer
          <input type="checkbox" name="profession[]" value="developer" <?php echo (in_array("developer", $professions)) ? 'checked' : ''; ?>> Developer
          <input type="checkbox" name="profession[]" value="traveler" <?php echo (in_array("traveler", $professions)) ? 'checked' : ''; ?>> Traveler
          <input type="checkbox" name="profession[]" value="others"  <?php echo (in_array("others", $professions)) ? 'checked' : ''; ?>> Others
          <input type="checkbox" name="profession[]" value="unemployed" <?php echo (in_array("unemployed", $professions)) ? 'checked' : ''; ?>> Unemployed
        </div>
        <div class="box">
          <label>City</label>
          <?php
            if ( !isset($profiles['city']) || empty($profiles['city']) ) {
              $profiles['city'] = 'Sylhet';
            }
            $cityarr = ['Dhaka','Rajshahi','Khulna','Chittagong','Sylhet','Rangpur','Barisal','Mymensingh'];
          ?>
          <select name="city">
            <?php foreach ($cityarr as $key => $cityname) {
              if ($profiles['city'] == $cityname) {
                $selected = 'selected';
              }else{
                $selected = '';
              }
              echo "<option value='$cityname' $selected>$cityname</option>";
            } ?>
          </select>
        </div>
        <div class="box">
          <label>Address</label>
          <textarea name="address" rows="4"><?php echo isset($profiles['address']) ? $profiles['address'] : ''; ?></textarea>
        </div>
        <div class="box">
          <label>Phone</label>
          <input type="text" name="phone" value="<?php echo isset($profiles['phone']) ? $profiles['phone'] : ''; ?>">
        </div>
        <div class="box-submit">
          <input type="submit" name="profile" value="Update">
        </div>
      </form>

    </div> <!-- /.update-profile -->

  </div> <!-- /.profile -->


  <?php if($posts) : ?>
    <table class="profile-table-post mt-30">
      <thead>
        <tr>
          <th>SL.</th>
          <th>Title</th>
          <th>Content</th>
          <th>Category</th>
          <th>Comments</th>
          <th>Image</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($posts as $key => $post) : ?>
        <tr>
          <td><strong><?php echo ++$key ?>.</strong></td>
          <td><?php echo $post['title']; ?></td>
          <td><?php echo $post['content']; ?></td>
          <td>
            <?php
              if($categories) {
                foreach ($categories as $category) {
                  if($post['category_id'] == $category['id'] ){
                    echo $category['name'];
                  }
                }
              }
            ?>
          </td>
          <td>
            <?php
              if($comments){
                if ( $allcomments = $comments->getCommentsByPostId($post['id']) ) {
                  echo '<span class="author"><i class="fa fa-comments"></i> ' . count($allcomments) . '</span>';

                }
              }
            ?>
          </td>
          <td>
            <?php if($post['image']) : ?>
              <img src="images/<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" width="100"/>
            <?php else: ?>
              <span class="crosssign"><i class="fa fa-times"></i></span>
            <?php endif; ?>
          </td>
          <td>
            <a href="edit.php?id=<?= $post['id']; ?>" class="btn btn-blue">Edit</a>
            <a onclick="return confirm('Are you sure?')" href="delete.php?id=<?= $post['id']; ?>" class="btn btn-red">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>


<?php endif; ?>
