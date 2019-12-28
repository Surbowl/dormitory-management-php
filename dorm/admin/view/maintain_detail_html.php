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
					<a class="subtitle">维修申请</a>
					&thinsp;<i class="fas fa-chevron-right"></i>&nbsp;详细信息
				</div>
				<br>
				<table style="width: 100%;border-collapse:separate; border-spacing:0px 10px;">
					<tr>
						<td>
							宿舍楼座:
						</td>
						<td style="padding-left: 15px;">
							<?=$maintain_detail["building"]?>&nbsp;号楼
						</td>
					</tr>
					<tr>
						<td>
							宿舍门牌:
						</td>
						<td style="padding-left: 15px;">
							<?=$maintain_detail["number"]?>&nbsp;户
						</td>
					</tr>
					<tr>
						<td>
							申请日期:
						</td>
						<td style="padding-left: 15px;">
							<?=date('Y-m-d',strtotime($maintain_detail['date']))?>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							报修内容:
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<textarea class="textarea" rows="4" disabled="disabled"><?=$maintain_detail["request"]?></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr>
						</td>
					</tr>
					<form method="post" action="maintain_detail.php">
					<tr>
						<td colspan="2">
							回复:
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?=$maintain_detail["id"]?>" />
							<textarea class="textarea" name="response" maxlength="200" rows="4"><?=$maintain_detail["admin_response"]?></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="has-text-centered"  style="padding-top: 15px;">
							<input type="submit" class="button is-info" value="&emsp;保存&emsp;" />
						</td>
					</tr>
					</form>
					<tr>
						<td colspan="2" class="has-text-centered"  style="padding-top: 10px;">
							<a href="maintain.php"><i class="fas fa-arrow-left"></i>&thinsp;返回</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</section>

<?php
	//脚部文件
	require '../public/_share/_footer.php';
?>