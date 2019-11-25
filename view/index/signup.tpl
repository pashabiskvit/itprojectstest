<div class="row" style="margin-top: 20px">
    <div class="col-sm">
    </div>
    <div class="col-sm">
        <form data-type-send="ajax" action="/api/user/signup" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="FirstName"><?php echo $this->phrase[14]?></label>
                    <input type="text" class="form-control" id="FirstName" placeholder="<?php echo $this->phrase[14]?>" required name="FirstName" minlength="3" maxlength="18"  data-validation="length" data-validation-length="3-18">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="LastName"><?php echo $this->phrase[15]?></label>
                    <input type="text" class="form-control" id="LastName" placeholder="<?php echo $this->phrase[15]?>" required name="LastName" minlength="3" maxlength="18" data-validation="length" data-validation-length="3-18">
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail1"><?php echo $this->phrase[5]?></label>
                <input type="email" class="form-control" id="InputEmail" placeholder="<?php echo $this->phrase[6]?>" required data-validation="email" name="email">
            </div>
            <div class="form-group">
                <label for="InputPassword"><?php echo $this->phrase[8]?></label>
                <input type="password" class="form-control" id="InputPassword" placeholder="<?php echo $this->phrase[8]?>" data-validation="length" data-validation-length="6-18" name="password_confirmation" required>
            </div>
            <div class="form-group">
                <label for="InputPasswordReplay"><?php echo $this->phrase[21]?></label>
                <input type="password" class="form-control" id="InputPasswordReplay" placeholder="<?php echo $this->phrase[21]?>" name="password" data-validation="confirmation" required data-validation-error-msg="<?php echo $this->phrase[20]?>">
            </div>
            <div class="form-group">
                <label for="photo"> <?php echo $this->phrase[22]?></label>
                <input type="file" class="form-control-file" id="photo" data-validation="size" data-validation-max-size="512kb" data-validation-allowing="jpg, png, gif" name="avatar">
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="check" required name="check">
                    <label class="form-check-label" for="check">
                        <?php echo $this->phrase[18]?>
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><?php echo $this->phrase[11]?></button>
        </form>
    </div>
    <div class="col-sm">
    </div>
</div>
<div class="row">
    <div class="col-sm">
    </div>
    <div class="col-sm">
        <a class="btn btn-secondary" href="/signin" role="button"><?php echo $this->phrase[1]?></a>
    </div>
    <div class="col-sm">
    </div>
</div>