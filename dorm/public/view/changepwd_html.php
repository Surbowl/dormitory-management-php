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
					<h2 class="subtitle"><i class="fas fa-key"></i>&thinsp;修改密码</h2>
				</div>
				<p class="has-text-centered"><span>😃</span><span id="helloMsg">Hello!</span><span><?=$user_name?></span></p>
				<br>
				<form method="post" action="./changepwd.php">
					<div class="field">
					  <div class="control">
						<input class="input" type="password" name="old_pwd" required="required" maxlength="200" placeholder="当前旧密码">
					  </div>
					</div>
					<div class="field">
					  <div class="control">
						<input class="input" type="password" name="new_pwd" required="required" maxlength="200" placeholder="新密码">
					  </div>
					</div>
					<div class="field">
					  <div class="control">
						<input class="input" type="password" name="check_pwd" required="required" maxlength="200" placeholder="再次输入新密码">
					  </div>
					</div>
					<?php
						if(isset($msg)){
							echo "<span class=\"has-text-danger\">$msg</span><br>";
						}
					?>
					<br>
					  <button type="submit" class="button is-info">
						  <span>&emsp;</span>
						<span class="icon">
						  <i class="fas fa-unlock-alt"></i>
						</span>
						<span>&thinsp;修改&emsp;</span>
					  </button>
				</form>
				<br>
				<div class="has-text-centered">
					<a href="../<?=$user_type?>/home.php"><i class="fas fa-arrow-left"></i>&thinsp;返回</a>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	window.onload = function () {
		//打招呼
		now = new Date(), hour = now.getHours()
		if (hour < 6) { $('#helloMsg').text("凌晨好，") }
		else if (hour < 9) { $('#helloMsg').text("早上好！") }
		else if (hour < 12) { $('#helloMsg').text("上午好！") }
		else if (hour < 14) { $('#helloMsg').text("中午好！") }
		else if (hour < 17) { $('#helloMsg').text("下午好！") }
		else if (hour < 19) { $('#helloMsg').text("傍晚好！") }
		else { $('#helloMsg').text("晚上好，") }
	}
</script>

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