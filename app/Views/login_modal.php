<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Log In to Your Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="loginForm" method="POST" action="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>user/login">
        <div class="modal-body">
          <div class="form-group">
            <label for="loginEmailInput">Email</label>
            <input type="email" class="form-control" id="loginEmailInput" name="email" required>
          </div>
          <div class="form-group">
            <label for="loginPasswordInput">Password</label>
            <input type="password" class="form-control" id="loginPasswordInput" name="password" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Log In</button>
        </div>
      </form>
    </div>
  </div>
</div>