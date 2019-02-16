<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary">Login</button>
            <button type="button" class="btn btn-success">Sign Up</button>
        </div>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <!-- login -->
        <form style="text-align:left;" id="login" action="index.php" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
            </div>
            <button type="submit" name='login' class="btn btn-primary" style='width:100%;'>Login</button>
        </form>
        <!-- sign up -->
        <form style="text-align:left;display:none;" id="register" action="index.php" method="POST" >
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="email" class="form-control" name="email" value="<?php getInputValue('email') ?>" aria-describedby="emailHelp" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Address</label>
                <input type="text" class="form-control" name="address" value="<?php getInputValue('address') ?>" aria-describedby="emailHelp" placeholder="Address" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Phone</label>
                <input type="text" class="form-control" name="phone" value="<?php getInputValue('phone') ?>" aria-describedby="emailHelp" placeholder="Phone" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password1" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input type="password" class="form-control" name="password2" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-success" style='width:100%;' name="signup">Sign Up</button>
        </form>
      </div>
    </div>
  </div>
</div>
