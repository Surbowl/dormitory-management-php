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
				<h2 class="subtitle">管理员平台<span class="is-hidden-mobile">&emsp;&emsp;</span></h2>
			</div>
		</div>
	</div>
</div>
<form method="post" action="exchange_detail.php?id=<?=$exchange_detail['id']?>">
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
					<a class="subtitle">换宿申请</a>
					&thinsp;<i class="fas fa-chevron-right"></i>&nbsp;详细信息
				</div>
				<br>
				<table style="width: 100%;border-collapse:separate; border-spacing:0px 10px;">
					<tr>
						<td>
							学号:
						</td>
						<td style="padding-left: 15px;">
							<?=$exchange_detail['account']?>
						</td>
					</tr>
					<tr>
						<td>
							姓名:
						</td>
						<td style="padding-left: 15px;">
							<a href="./student_detail.php?id=<?=$exchange_detail['student_id']?>">
								<?=$exchange_detail['name']?>
							</a>
						</td>
					</tr>
					<tr>
						<td>
							申请日期:
						</td>
						<td style="padding-left: 15px;">
							<?=date('Y-m-d',strtotime($exchange_detail['date']))?>
						</td>
					</tr>
					<tr>
						<td>
							当前宿舍:
						</td>
						<td style="padding-left: 15px;">
							<?php
								if(empty($exchange_detail['from_dorm_id'])):
							?>
								<span>暂未安排</span>
							<?php
								else:
							?>
								<a href="./dorm_detail?id=<?=$exchange_detail['from_dorm_id']?>">
									<?=$exchange_detail['from_dorm_building']?>号楼&nbsp;<?=$exchange_detail['from_dorm_number']?>户
								</a>
							<?php
								endif;
							?>
						</td>
					</tr>
					<tr>
						<td>
							目标宿舍:
						</td>
						<td style="padding-left: 15px;">
							<a href="./dorm_detail?id=<?=$exchange_detail['to_dorm_id']?>">
								<?=$exchange_detail['to_dorm_building']?>号楼&nbsp;<?=$exchange_detail['to_dorm_number']?>户
							</a>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							申请原因:
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<textarea class="textarea" rows="4" disabled="disabled"><?=$exchange_detail["request"]?></textarea>
						</td>
					</tr>
					<tr>
						<td>
							辅导员意见:
						</td>
						<td style="padding-left: 15px;">
							<strong><?=$exchange_detail['teacher_response']?></strong>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr>
						</td>
					</tr>
					<tr>
						<td>
							操作:
						</td>
						<td class="has-text-centered">
							<a class="button is-warning is-small" onclick="checkExchange()">一键移至目标宿舍</a>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							回复:
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?=$exchange_detail["id"]?>" />
							<textarea class="textarea" name="response" maxlength="200" rows="4"><?=$exchange_detail["admin_response"]?></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="has-text-centered"  style="padding-top: 15px;">
							<input type="submit" class="button is-info" value="&emsp;发表回复&emsp;" />
						</td>
					</tr>
					<tr>
						<td colspan="2" class="has-text-centered"  style="padding-top: 10px;">
							<a href="exchange.php"><i class="fas fa-arrow-left"></i>&thinsp;返回</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</section>
	<!-- 提交用的隐藏表单 -->
	<input type="hidden" name="student_id" value="<?=$exchange_detail['student_id']?>" />
	<input type="hidden" name="to_dorm_id" value="<?=$exchange_detail['to_dorm_id']?>" />
	<input type="hidden" name="func" id="func" value="回复" />
</form>
<script>
	function checkExchange(){
		var r = confirm(<?="'确定要将".$exchange_detail['name']."同学移至目标宿舍吗？'"?>);
		if (r == true) {
			$("#func").val('移至目标宿舍');
			$("form").submit();
		}
	}
</script>

<?php
	//脚部文件
	require '../public/_share/_footer.php';
?>