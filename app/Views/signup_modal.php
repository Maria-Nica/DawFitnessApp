<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Create Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="signupForm" method="POST" action="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>user/register">

        <div class="modal-body">
            <div id="signupMessage" class="mb-3" style="display: none;"></div>

            <div class="form-group">
                <label for="nameInput">Name</label>
                <input type="text" class="form-control" id="nameInput" name="name" required>
            </div>
            <div class="form-group">
                <label for="emailInput">Email</label>
                <input type="email" class="form-control" id="emailInput" name="email" required>
            </div>
            <div class="form-group">
                <label for="passwordInput">Password</label>
                <input type="password" class="form-control" id="passwordInput" name="password" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Sign Up</button>
        </div>
      </form>
    </div>
  </div>
</div>