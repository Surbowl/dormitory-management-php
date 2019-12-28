<?php
	//if(!defined('APP')) die('error!<br>不能直接访问此页面');
?>
<?php
	//头部文件
	require '../public/_share/_head.php';
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
				<h2 class="subtitle">教师平台<span class="is-hidden-mobile">&emsp;&emsp;</span></h2>
			</div>
		</div>
	</div>
</div>
<section class="section">
	<div class="columns">
		<div class="column is-2 is-offset-1">
			<?php
				//菜单文件
				require './_share/_mune.php';
			?>
		</div>
		<div class="column is-8" data-aos="flip-right" data-aos-duration="800" data-aos-once="true">
			<div class="box">
				<h2 class="has-text-centered subtitle"><i class="fas fa-user"></i>&thinsp;个人信息</h2>
				<p class="has-text-centered"><span>😃</span><span id="helloMsg">Hello!</span><span><?=$user_name?></span></p>
				<br>
				<div class="has-text-centered">
					<a class="button is-info is-outlined is-small" href="../public/changepwd.php">修改密码</a>
				</div>
				<br>
				<?php
					if(empty($class_list)):
				?>
					<p class="has-text-centered">暂无班级信息</p>
				<?php
					else:
				?>
					<hr>
					<h2 class="subtitle has-text-centered"><i class="fas fa-chalkboard-teacher"></i>&thinsp;我的班级</h2>
					<table class="table" style="width: 100%;">
						<thead>
						    <tr>
								<th>院系</th>
								<th>班级</th>
						    </tr>
						</thead>
				<?php
						foreach($class_list as $row):
				?>
							<tr>
								<td>
									<?=$row['department']?>
								</td>
								<td>
									<?=$row['name']?>
								</td>
							</tr>
				<?php 
						endforeach;
				?>
					</table>
					<br>
				<?php
					endif;
				?>
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
	//脚部文件
	require '../public/_share/_footer.php';
?>