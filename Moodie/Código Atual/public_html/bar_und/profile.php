<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 p-0 pt-lg-3 pr-lg-2 pl-lg-0 pt-xl-3 pr-xl-2 pl-xl-0">
    <div class="profile border-bottom">                
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="30000">
            <ol class="carousel-indicators m-0">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item">
                    <?php echo "<img class='personal-cover to-fit mx-auto' src='$url/user/img/cover/$user_cover'/>"; ?>
                </div>
                <div class="carousel-item active">
                    <img class='personal-cover to-fit mx-auto' src='https://cdn.vox-cdn.com/thumbor/QiRFL14R4fy4lWj76A0Wmk4FS3Q=/0x0:2040x1360/1200x800/filters:focal(807x264:1133x590)/cdn.vox-cdn.com/uploads/chorus_image/image/62419018/SpiderVerse_cropped.0.jpg'/>
                </div>                
                <div class="carousel-item">
                    <img class='personal-cover to-fit mx-auto' src='https://media1.fdncms.com/pittsburgh/imager/u/original/11744472/bohemian-rhapsody-df-11915_r2_rgb.jpg'/>
                </div>
            </div>
        </div>
        <div class="row m-0 pt-2 pr-1 pb-0 pl-1">
            <div class="col-4">
                <?php echo "<img class='personal-photo to-fit' src='https://gomoodie.com/user/img/photo/$user_photo'/>"; ?>
            </div>
            <div class="col-8 font-weight-bold">
                <?php echo "<a href='https://gomoodie.com/user/profile.php'>$name</a>"; ?>
                <!-- <a><i class="fas fa-cog"></i></a> -->
            </div>
        </div>
        <div class="row m-0 pt-0 pr-1 pb-2 pl-1">
            <div class="col-4"></div>
            <div class="col-8">
                <?php echo "<a href='https://gomoodie.com/user/profile.php'>@$account</a>"; ?>
            </div>
        </div>
        <div class="row m-0 justify-content-center pt-2 pr-3 pb-0 pl-3 font-weight-bold">
            <div class="col-4">
                <a href='https://gomoodie.com/user/profile.php'>Filmes</a>
            </div>
            <div class="col-4">
                <a href='https://gomoodie.com/user/seguindo.php'>Seguindo</a>
            </div>
            <div class="col-4">
                <a href='https://gomoodie.com/user/seguidores.php'>Seguidores</a>
            </div>
        </div>
        <div class="row m-0 justify-content-center pt-0 pr-3 pb-4 pl-3">
            <div class="col-4">
                <a href='https://gomoodie.com/user/profile.php'><?php echo $watched;?></a>
            </div>
            <div class="col-4">
                <a href='https://gomoodie.com/user/seguindo.php'><?php echo $following;?></a>
            </div>
            <div class="col-4">
                <a href='https://gomoodie.com/user/seguidores.php'><?php echo $followed;?></a>
            </div>
        </div>
    </div>
</div>