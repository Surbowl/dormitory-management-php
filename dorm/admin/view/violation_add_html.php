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
				<h2 class="subtitle">管理员平台<span class="is-hidden-mobile">&emsp;&emsp;</span></h2>
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
					<a class="subtitle">学生违规</a>
					&thinsp;<i class="fas fa-chevron-right"></i>&nbsp;违规登记
				</div>
				<br>
				<table style="width: 100%;border-collapse:separate; border-spacing:0px 10px;">
					<tr>
						<td>
							姓名:
						</td>
						<td style="padding-left: 15px;">
							<a href="./student_detail.php?id=<?=$student_detail["student_id"]?>">
								<?=$student_detail["name"]?>
							</a>
						</td>
					</tr>
					<tr>
						<td>
							学号:
						</td>
						<td style="padding-left: 15px;">
							<?=$student_detail["account"]?>
						</td>
					</tr>
					<tr>
						<td>
							性别:
						</td>
						<td style="padding-left: 15px;">
							<?=$student_detail["sex"]?>
						</td>
					</tr>
					<tr>
						<td>
							是否舍长:
						</td>
						<td style="padding-left: 15px;">
							<?=$student_detail["supervisor"]?>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr>
						</td>
					</tr>
					<form method="post" action="violation_add.php?id=<?=$student_detail["student_id"]?>">
					<tr>
						<td colspan="2">
							违规日期:
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?=$student_detail["student_id"]?>" required="required" />
							<input class="input" name="date" id="date" required="required" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							违规内容:
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<textarea class="textarea" name="detail" maxlength="200" rows="4" required="required" placeholder="请输入学生违规具体内容..."><?=isset($detail)?$detail:''?></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="has-text-centered"  style="padding-top: 15px;">
							<input type="submit" class="button is-info" value="&emsp;提交&emsp;" />
						</td>
					</tr>
					</form>
					<tr>
						<td colspan="2" class="has-text-centered"  style="padding-top: 10px;">
							<a href="JavaScript:history.go(-1)"><i class="fas fa-arrow-left"></i>&thinsp;返回</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</section>
<script>
	$(function(){
		var options={lang:'ch',format:'Y-m-d'};
		$('#date').datetimepicker(options);
	})
</script>

<?php
	//脚部文件
	require '../public/_share/_footer.php';
?>