<?php
	if(!defined('APP')) die('error!<br>不能直接访问此页面');
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
				<h2 class="subtitle">学生平台<span class="is-hidden-mobile">&emsp;&emsp;</span></h2>
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
				<table>
					<tr>
						<td>
							ID:
						</td>
						<td style="padding-left: 15px;">
							<?=$user_id?>
						</td>
					</tr>
					<tr>
						<td>
							账号（学号）:
						</td>
						<td style="padding-left: 15px;">
							<?=$user_account?>
						</td>
					</tr>
					<tr>
						<td>
							宿舍楼座:
						</td>
						<td style="padding-left: 15px;">
							<?=isset($dorm_building)?$dorm_building."号楼":"未安排"?>
						</td>
					</tr>
					<tr>
						<td>
							宿舍门牌:
						</td>
						<td style="padding-left: 15px;">
							<?=isset($dorm_number)?$dorm_number."户":"未安排"?>
						</td>
					</tr>
					<tr>
						<td>
							是否舍长:
						</td>
						<td style="padding-left: 15px;">
							<?=isset($is_supervisor)?$is_supervisor:"未安排"?>
						</td>
					</tr>
				</table>
				<br>
				<div class="has-text-right">
					<a class="button is-info is-outlined is-small" href="../public/changepwd.php">修改密码</a>
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
	//脚部文件
	require '../public/_share/_footer.php';
?>