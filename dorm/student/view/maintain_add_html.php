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
		<div class="column is-8">
			<div class="box" data-aos="flip-right" data-aos-duration="800" data-aos-once="true">
				<div class="has-text-centered">
					<i class="fas fa-wrench"></i>&thinsp;
					<a class="subtitle">物业报修</a>
					&thinsp;<i class="fas fa-chevron-right"></i>&nbsp;提交申请
				</div>
				<br>
				<form method="post" action="maintain_add.php">
					<table style="width: 100%;">
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
							<td colspan="2">
								报修内容:
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<textarea class="textarea" name="request" rows="6" maxlength="200" required="required" placeholder="请输入报修内容..."></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="has-text-centered"  style="padding-top: 15px;">
								<input type="submit" class="button is-info" value="&emsp;提交&emsp;" />
							</td>
						</tr>
						<tr>
							<td colspan="2" class="has-text-centered"  style="padding-top: 10px;">
								<a href="maintain.php"><i class="fas fa-arrow-left"></i>&thinsp;返回</a>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</section>

<?php
	//脚部文件
	require '../public/_share/_footer.php';
?>