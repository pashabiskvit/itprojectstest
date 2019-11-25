<div class="row" style="margin-top: 20px">
    <div class="col-sm">
    </div>
    <div class="col-sm">
        <form data-type-send="ajaxLogin" action="/api/user/signin">
            <div class="form-group">
                <label for="InputEmail"><?php echo $this->phrase[5]?></label>
                <input type="email" class="form-control" id="InputEmail" placeholder="<?php echo $this->phrase[6]?>" required data-validation="email" name="email" >
            </div>
            <div class="form-group">
                <label for="InputPassword"><?php echo $this->phrase[8]?></label>
                <input type="password" class="form-control" id="InputPassword" placeholder="<?php echo $this->phrase[28]?>" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary"><?php echo $this->phrase[10]?></button>
        </form>
    </div>
    <div class="col-sm">
    </div>
</div>
<div class="row">
    <div class="col-sm">
    </div>
    <div class="col-sm">
        <a class="btn btn-secondary" href="/signup" role="button"><?php echo $this->phrase[11]?></a>
    </div>
    <div class="col-sm">
    </div>
</div>