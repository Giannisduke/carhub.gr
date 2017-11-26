<section id="forma" class="forma">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center feedback">
        <form id="applicant-form" enctype="multipart/form-data" method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>">
     <input type="text" name="first_name" placeholder="First Name" />
     <br/>
     <input type="text" name="last_name" placeholder="Last Name" />
     <hr/>
     <input type="radio" name="gender" value="male" /> male
     <input type="radio" name="gender" value="female" /> Female
     <hr/>
     <select name="favorite_food">
       <option>Favorite Food</option>
       <option>Beef</option>
       <option>Chicken</option>
     </select>
     <hr/>
     <input type="file" name="avatar" />
     <hr/>
     <input type="hidden" name="action" value="create_applicant">
     <input type="submit" value="SUBMIT" />
</form>
      </div>
    </div>
  </div>

 </section>
