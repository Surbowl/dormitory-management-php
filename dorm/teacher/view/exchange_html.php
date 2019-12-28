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
		<div class="column is-8">
			<div class="box" data-aos="flip-right" data-aos-duration="800" data-aos-once="true">
				<h2 class="has-text-centered subtitle"><i class="fas fa-exchange-alt"></i>&thinsp;学生换宿</h2>
					<?php
						if(empty($exchange_list)):
					?>
						<p class="has-text-centered">暂无学生提交申请</p>
					<?php
						else:
					?>
						<table class="table" style="width: 100%;">
							<thead>
							    <tr>
									<th>学号</th>
									<th>姓名</th>
									<th>班级</th>
									<th>申请日期</th>
									<th>原因</th>
									<th>宿管回复</th>
							    </tr>
							</thead>
					<?php
							foreach($exchange_list as $row):
					?>
								<tr>
									<td>
										<?=$row['account']?>
									</td>
									<td>
										<?=$row['student_name']?>
									</td>
									<td>
										<?=$row['class_name']?>
									</td>
									<td>
										<?=date('Y-m-d',strtotime($row['date']))?>
									</td>
									<td>
										<?=$row['request']?>
									</td>
									<td>
										<?=$row['admin_response']?>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										目标宿舍:&nbsp;<?=$row['building']?>号楼 <?=$row['number']?>户（<?=$row['bed']?>人间，已住<?=$row['count']?>人）
									</td>
								</tr>
								<tr>
									<?php
										$teacher_response=$row['teacher_response'];
										if(empty($teacher_response)):
									?>
										<td colspan="3">
											&nbsp;<br>&nbsp;
										</td>
										<td colspan="1">
											待回复:
										</td>
										<td colspan="2">
											<div class="buttons">
												<a class="button is-small is-outlined is-success" onclick="checkYes(<?=$row['id']?>,'<?=$row['student_name']?>')">批准</a>
												<a class="button is-small is-outlined is-dark" onclick="checkNo(<?=$row['id']?>,'<?=$row['student_name']?>')">否决</a>
											</div>
										</td>
									<?php
										else:
									?>
										<td colspan="3">
											&nbsp;<br>&nbsp;
										</td>
										<td colspan="1">
											已回复:
										</td>
										<td colspan="2">
											<?=$teacher_response?>
										</td>
									<?php
										endif;
									?>
								</tr>
					<?php 
							endforeach;
					?>
						</table>
						<form id="form" method="post" action="exchange.php?page=<?=$page?>">
							<!-- 提交用的隐藏表单 -->
							<input type="hidden" name="id" id="id" />
							<input type="hidden" name="response" id="response" />
						</form>
						<script>
							function checkYes(id,name){
								var r = confirm("确定批准"+name+"同学的换宿申请吗？");
								if (r == true) {
									$("#id").val(id);
									$("#response").val("同意");
								    $("form").submit();
								}
							}
							function checkNo(id,name){
								var r = confirm("确定否决"+name+"同学的换宿申请吗？");
								if (r == true) {
									$("#id").val(id);
									$("#response").val("不同意");
								    $("form").submit();
								}
							}
						</script>
						<?php
							if($max_page>1):
						?>
							<br>
							<nav class="pagination is-centered" role="navigation" aria-label="pagination">
							  <a class="pagination-previous has-background-white" href="./leave.php?page=1">首页</a>
							  <a class="pagination-previous has-background-white" href="./leave.php?page=<?=$page-1; ?>"><</a>
							  <ul class="pagination-list">
									<?php
										for($p=1;$p<=$max_page;$p++):
											if($p==$page):
									?>
												<li><a class="pagination-link is-current" href="./leave.php?page=<?=$p?>"><?=$p?></a></li>
									<?php
											else:
									?>
												<li><a class="pagination-link has-background-white" href="./leave.php?page=<?=$p?>"><?=$p?></a></li>
									<?php
											endif;
										endfor;
									?>
							  </ul>
							  <a class="pagination-next has-background-white" href="./leave.php?page=<?=$page+1; ?>">></a>
							  <a class="pagination-next has-background-white" href="./leave.php?page=<?=$max_page; ?>">尾页</a>
							</nav>
						<?php
							endif;
						?>
					<?php
						endif;
					?>
			</div>
		</div>
	</div>
</section>

<?php
	//脚部文件
	require '../public/_share/_footer.php';
?>