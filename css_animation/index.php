<?php include_once(dirname(dirname(__FILE__)) . '/parts/header.php'); ?>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/sidebar.php'); ?>
<style>
.cv_btn {
  margin: 0 auto;
}
.cv_btn img {
  animation: anime1 1.0s ease-out 0s infinite normal;
  transform-origin:center;
}
@keyframes anime1 {
  from {
    transform: scale(0.9,0.9);
    opacity: 1;
  }
  to {
    transform: scale(1.5,1.5);
    opacity: 0;
  }
}
#ico_activity {
  display: block;
  width: 47px;
  height: 47px;
}
#updated {
  position: relative;
  right: -35px;
  top: 17px;
}
</style>
<div class="wrapper">
    <div id="ico_activity">
        <div class="cv_btn" id="updated">
        <a href="#"><img src="updated.svg"></a>
        </div>
        <div><img src="vital_data.svg"></div>
    </div>
</div>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/footer.php'); ?>


