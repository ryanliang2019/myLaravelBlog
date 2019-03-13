<!-- Please refer to: https://codepen.io/asheabbott/pen/GoMrzW-->

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

<style>
#share {
    width: 100%;
    margin: 20px auto;
    text-align: center;
}

/* buttons */

#share a {
    width: 50px;
    height: 50px;
    display: inline-block;
    margin: 8px;
    border-radius: 50%;
    font-size: 24px;
    color: #fff;
    opacity: 0.75;
    transition: opacity 0.15s linear;
}

#share a:hover {
    opacity: 1;
}

/* icons */

#share i {
    position: relative;
    top: 50%;
    transform: translateY(-50%);
}

/* colors */

.facebook {
    background: #3b5998;
}

.twitter {
    background: #55acee;
}

.googleplus {
    background: #dd4b39;
}

.linkedin {
    background: #0077b5;
}

.pinterest {
    background: #cb2027;
}
</style>


<div id="share">
	<!-- facebook -->
	<a class="facebook" href="https://www.facebook.com/share.php?u={{''}}&title={{''}}" target="blank"><i class="fa fa-facebook"></i></a>

	<!-- twitter -->
	<a class="twitter" href="https://twitter.com/intent/tweet?status={{''}}+{{''}}" target="blank"><i class="fa fa-twitter"></i></a>

	<!-- google plus -->
	<a class="googleplus" href="https://plus.google.com/share?url={{''}}" target="blank"><i class="fa fa-google-plus"></i></a>

	<!-- linkedin -->
	<a class="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url={{''}}&title={{''}}&source={{''}}" target="blank"><i class="fa fa-linkedin"></i></a>

	<!-- pinterest -->
	<a class="pinterest" href="https://pinterest.com/pin/create/bookmarklet/?media={{''}}&url={{''}}&is_video=false&description={{''}}" target="blank"><i class="fa fa-pinterest-p"></i></a>
</div>

