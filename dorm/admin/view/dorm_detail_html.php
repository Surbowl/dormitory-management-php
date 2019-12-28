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
<form method="post" action="dorm_detail.php?id=<?=$dorm_detail['id']?>">
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
					<a class="subtitle">宿舍管理</a>
					&thinsp;<i class="fas fa-chevron-right"></i>&nbsp;详细信息
				</div>
				<br>
				<table style="width: 100%;border-collapse:separate; border-spacing:0px 10px;">
					<tr>
						<td>
							宿舍楼座:
						</td>
						<td style="padding-left: 15px;">
							<?=$dorm_detail["building"]?>&nbsp;号楼
						</td>
					</tr>
					<tr>
						<td>
							宿舍门牌:
						</td>
						<td style="padding-left: 15px;">
							<?=$dorm_detail["number"]?>&nbsp;户
						</td>
					</tr>
					<tr>
						<td>
							性别:
						</td>
						<td style="padding-left: 15px;">
							<?=$dorm_detail['sex']?>
						</td>
					</tr>
					<tr>
						<td>
							床位:
						</td>
						<td style="padding-left: 15px;">
							<?=$dorm_detail['bed']?>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr>
						</td>
					</tr>
					</table>
					<hr>
					<br>
					<div class="columns">
						<div class="column">
							添加学生:
						</div>
						<div class="column is-8">
							<input class="input" type="text" name="account" maxlength="100" placeholder="请输入学生学号" />
						</div>
						<div class="column">
							<input class="button is-info" type="submit" value="&nbsp;添加&nbsp;"/>
						</div>
					</div>
					<br>
					<?php
						if(empty($dorm_student)):
					?>
							<p class="has-text-centered">暂无学生入住</p>
					<?php
						else:
							foreach($dorm_student as $row):
					?>
								<div class="box">
									<table style="width: 100%;border-collapse:separate; border-spacing:0px 10px;">
										<tr>
											<td>
												&thinsp;
												<input class="checkbox" id="checkbox" type="checkbox" name="student_id[]" value="<?=$row['student_id'];?>">
												&thinsp;
											</td>
											<td>
												学号:
											</td>
											<td style="padding-left: 15px;">
												<?=$row["account"]?>
											</td>
										</tr>
										<tr>
											<td></td>
											<td>
												姓名:
											</td>
											<td style="padding-left: 15px;">
												<a href="./student_detail?id=<?=$row['student_id']?>">
													<?=$row['name']?>
												</a>
											</td>
										</tr>
										<tr>
											<td></td>
											<td>
												是否舍长:
											</td>
											<td style="padding-left: 15px;">
												<?=$row['supervisor']?>
											</td>
										</tr>
									</table>
								</div>
					<?php
							endforeach;
					?>
							<br>
							<div class="buttons">
								<a class="button is-outlined is-info is-small" onclick="selectAll()">全选</a>
								<a class="button is-outlined is-info is-small" onclick="selectReverse()">反选</a>
								&emsp;
								<a class="button is-danger is-small" onclick="checkDelete()">移出宿舍</a>
								&emsp;
								<a class="button is-warning is-small" onclick="checkSuper()">设为舍长</a>
							</div>
							<script>
								//全选
								function selectAll(){
									var ids=document.getElementsByName("student_id[]");
									for(var i in ids){
										ids[i].checked=true;
									}
								}
								
								//反选
								function selectReverse(){
									var ids=document.getElementsByName("student_id[]");
									for(var i in ids){
										ids[i].checked=!ids[i].checked;
									}
								}
								
								function checkDelete(){
									var len = $("input[name='student_id[]']:checked").length;
									if(len>0){
										var r = confirm("确定将所选同学移出此宿舍吗？");
										if (r == true) {
											$("#func").val('移出宿舍');
											$("form").submit();
										}
									}else{
										alert('请先选择学生');
									}
								}
								
								function checkSuper(){
									var len = $("input[name='student_id[]']:checked").length;
									if(len==1){
										var r = confirm("确定将所选同学设为舍长吗？");
										if (r == true) {
											$("#func").val('设为舍长');
											$("form").submit();
										}
									}else{
										alert('请选中一名学生');
									}
								}
							</script>
					<?php
						endif;
					?>
				
				<br>
				<div class="has-text-centered">
					<a href="leave.php"><i class="fas fa-arrow-left"></i>&thinsp;
					<a href="JavaScript:history.go(-1)">返回</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- 提交用的隐藏表单 -->
<input type="hidden" name="func" id="func" value="添加学生" />
</form>

<?php
	//脚部文件
	require '../public/_share/_footer.php';
?>