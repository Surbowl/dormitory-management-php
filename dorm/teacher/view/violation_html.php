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
				<h2 class="has-text-centered subtitle"><i class="fas fa-clipboard-list"></i>&thinsp;学生违规</h2>
					<?php
						if(empty($violation_list)):
					?>
						<p class="has-text-centered">暂无学生违规记录</p>
					<?php
						else:
					?>
						<table class="table" style="width: 100%;">
							<thead>
							    <tr>
									<th>学号</th>
									<th>姓名</th>
									<th>班级</th>
									<th>时间</th>
									<th>详情</th>
									<th>状态</th>
							    </tr>
							</thead>
					<?php
							foreach($violation_list as $row):
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
										<?=date('Y-m-d H:i',strtotime($row['date']))?>
									</td>
									<td>
										<?=$row['detail']?>
									</td>
									<?php
										$teacher_response=$row['teacher_response'];
										if(empty($teacher_response)):
									?>
										<td>
											<a class="button is-small is-outlined is-link" onclick="check(<?=$row['id']?>)">设为已读</a>
										</td>
									<?php
										else:
									?>
										<td>
											<span class="tag is-success is-light">已读</span>
										</td>
									<?php
										endif;
									?>
								</tr>
					<?php 
							endforeach;
					?>
						</table>
						<form id="form" method="post" action="violation.php?page=<?=$page?>">
							<!-- 提交用的隐藏表单 -->
							<input type="hidden" name="id" id="id" />
						</form>
						<script>
							function check(id){
								$("#id").val(id);
								$("form").submit();
							}
						</script>
						<?php
							if($max_page>1):
						?>
							<br>
							<nav class="pagination is-centered" role="navigation" aria-label="pagination">
							  <a class="pagination-previous has-background-white" href="./violation.php?page=1">首页</a>
							  <a class="pagination-previous has-background-white" href="./violation.php?page=<?=$page-1; ?>"><</a>
							  <ul class="pagination-list">
									<?php
										for($p=1;$p<=$max_page;$p++):
											if($p==$page):
									?>
												<li><a class="pagination-link is-current" href="./violation.php?page=<?=$p?>"><?=$p?></a></li>
									<?php
											else:
									?>
												<li><a class="pagination-link has-background-white" href="./violation.php?page=<?=$p?>"><?=$p?></a></li>
									<?php
											endif;
										endfor;
									?>
							  </ul>
							  <a class="pagination-next has-background-white" href="./violation.php?page=<?=$page+1; ?>">></a>
							  <a class="pagination-next has-background-white" href="./violation.php?page=<?=$max_page; ?>">尾页</a>
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