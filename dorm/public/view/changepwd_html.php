<?php
	if(!defined('APP')) die('error!<br>不能直接访问此页面');
?>
<?php
	//头部文件
	require './_share/_head.php';
?>

<div class="hero is-info">
	<div class="hero-body">
		<div class="columns is-gapless">
			<div class="column is-hidden-mobile is-1">
				<figure class="image is-64x64">
				  <img src="../img/fjut.png">
				</figure>
			</div>
			<div class="column has-text-centered">
				<h1 class="title">工院宿舍管理系统<span class="is-hidden-mobile">&emsp;&emsp;</span></h1>
				<h2 class="subtitle">统一账号中心<span class="is-hidden-mobile">&emsp;&emsp;</span></h2>
			</div>
		</div>
	</div>
</div>
<section class="section">
	<div class="columns is-centered">
		<div class="column is-two-fifths has-text-centered">
			<div class="box" data-aos="flip-right" data-aos-duration="800" data-aos-once="true">
				<div class="field is-centered">
					<h2 class="subtitle">用户登录</h2>
				</div>
				<form method="post" action="login.php">
					<div class="field">
					  <div class="control">
						<input class="input" type="text" name="account" value="<?=isset($account)?$account:''?>" required="required" placeholder="账号">
					  </div>
					</div>
					<div class="field">
					  <div class="control">
						<input class="input" type="password" name="pwd" value="<?=isset($pwd)?$pwd:''?>" required="required" placeholder="密码">
					  </div>
					</div>
					<div class="field">
					  <div class="control">
						  <div class="columns">
							  <div class="column is-two-thirds">
								  <input class="input" type="text" name="captch" required="required" autocomplete="off" placeholder="验证码">
							  </div>
							  <div class="column">
									  <div style="max-height: 36px;max-width: 120px;border-radius: 4px;overflow: hidden;">
										  <a href="">
									<figure class="image is-2by1">
										<img src="./_share/_captch.php"/>
									</figure>
								  </a>
							  </div>
						  </div>
					  </div>
					</div>
					<div class="field is-inline-block">
						<div class="control">
						  <label class="radio">
							<input type="radio" name="type" value="student" checked="checked">
							学生&nbsp;
						  </label>
						  <label class="radio">
							<input type="radio" name="type" value="teacher">
							教师&nbsp;
						  </label>
						  <label class="radio">
							<input type="radio" name="type" value="admin">
							宿管&nbsp;
						  </label>
						</div>
					</div>
					<?php
						if(isset($msg)){
							echo "<br><span class=\"has-text-danger\">$msg</span>";
						}
					?>
					<br><br>
					  <button type="submit" class="button is-info">
						  <span>&emsp;</span>
						<span class="icon">
						  <i class="fas fa-sign-in-alt"></i>
						</span>
						<span>&thinsp;登录&emsp;</span>
					  </button>
				</form>
			</div>
		</div>
	</div>
</section>
<?php
	//自动选中radio
	if(isset($type)){
		echo "<script>$(\"input[name='type'][value='$type']\").attr('checked','true');</script>";
	}
?>

<?php
	//脚部文件
	require './_share/_footer.php';
?>