<div class="row">
    <div class="col-sm">
    </div>
    <div class="col-sm">
        <div class="card" style="width: 18rem; margin-top: 30px">
            <img src="<?php echo $this->userInfo["avatarPatch"]?>" class="card-img-top" alt="<?php echo $this->userInfo["FirstName"]?> <?php echo $this->userInfo["LastName"]?>">
            <div class="card-body">
                <p class="card-text"><?php echo $this->userInfo["FirstName"]?> <?php echo $this->userInfo["LastName"]?></p>
                <p class="card-text"><?php echo $this->userInfo["email"]?></p>
                <p class="card-text"><?php echo $this->userInfo["ip"]?></p>
            </div>
            <div class="card-body">
                <a href="#" class="card-link" id="logout"><?php echo $this->phrase[33]?></a>
            </div>
        </div>
    </div>
    <div class="col-sm">
    </div>
</div>

