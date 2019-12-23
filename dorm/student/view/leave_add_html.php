<?php
	if(!defined('APP')) die('error!<br>不能直接访问此页面');
?>
<?php
	//头部文件
	require '../public/_share/_head.php';
?>
<script src="../lib/jquery.datetimepicker.js" type="text/javascript"></script>
<link href="../lib/jquery.datetimepicker.css" rel="stylesheet"/>
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
					<i class="fas fa-suitcase-rolling"></i>&thinsp;
					<a class="subtitle">外宿请假</a>
					&thinsp;<i class="fas fa-chevron-right"></i>&nbsp;提交申请
				</div>
				<br>
				<form method="post" action="leave_add.php">
					<table style="width: 100%;">
						<tr>
							<td>
								学生姓名:
							</td>
							<td style="padding-left: 15px;">
								<?=$user_name?>
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
							<td colspan="2">
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								起始时间:
							</td>
							<td style="padding-left: 15px;">
								<input class="input" name="date_start" id="date_start" required="required" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								返校时间:
							</td>
							<td style="padding-left: 15px;">
								<input class="input" name="date_end" id="date_end" required="required" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
								&nbsp;
							</td>
						</tr>
						<tr>
							<td colspan="2">
								请假原因:
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<textarea class="textarea" name="request" rows="6" maxlength="200" required="required" placeholder="请输入请假原因..."><?=isset($request)?$request:''?></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="has-text-centered" style="padding-top: 15px;">
								<input type="submit" class="button is-info" value="&emsp;提交&emsp;" />
							</td>
						</tr>
						<tr>
							<td colspan="2" class="has-text-centered" style="padding-top: 10px;">
								<a href="leave.php"><i class="fas fa-arrow-left"></i>&thinsp;返回</a>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</section>
<script>
	$(function(){
		var options={lang:'ch',format:'Y-m-d H:i'};
		$('#date_start').datetimepicker(options);
		$("#date_end").datetimepicker(options);
	})
</script>
<?php
	//脚部文件
	require '../public/_share/_footer.php';
?>