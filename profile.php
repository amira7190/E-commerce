<?php
session_start();
$pageTitle = 'Profile';

include 'init.php';
?>
<h1 class="text-center">My Profile</h1>
<div class="information block">
    <div class="container">
        <div class="card">
            <div class="card-header">My Information</div>
            <div class="card-body">
                 name:Osama
            </div>
        </div>
    </div>
</div>
<div class="my-ads block">
    <div class="container">
        <div class="card">
            <div class="card-header">My Ads</div>
            <div class="card-body">
                 test ads
            </div>
        </div>
    </div>
</div>
<div class="my-comments block">
    <div class="container">
        <div class="card">
            <div class="card-header">Latest Comments</div>
            <div class="card-body">
                test comments
            </div>
        </div>
    </div>
</div>
<?php
include $tpl .'footer.php';

?>