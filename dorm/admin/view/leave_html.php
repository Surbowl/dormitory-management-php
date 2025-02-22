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
				<h2 class="has-text-centered subtitle"><i class="fas fa-suitcase-rolling"></i>&thinsp;学生假条</h2>
				<p class="has-text-centered has-text-grey"><i class="fas fa-info-circle"></i>&thinsp;此处显示的假条均已通过辅导员批准</p>
				<br>
					<?php
						if(empty($leave_list)):
					?>
						<p class="has-text-centered">暂无学生假条</p>
					<?php
						else:
					?>
						<table class="table" style="width: 100%;">
							<thead>
							    <tr>
									<th>学号</th>
									<th>姓名</th>
									<th>宿舍</th>
									<th>离校时间</th>
									<th>返校时间</th>
							    </tr>
							</thead>
					<?php
							foreach($leave_list as $row):
					?>
								<tr>
									<td>
										<?=$row['account']?>
									</td>
									<td>
										<a href="./student_detail.php?id=<?=$row['student_id']?>">
											<?=$row['name']?>
										</a>
									</td>
									<td>
										<a href="./dorm_detail?id=<?=$row['dorm_id']?>">
											<?=$row['building']?>号楼&nbsp;<?=$row['number']?>户
										</a>
									</td>
									<td>
										<?=date('Y-m-d H:i',strtotime($row['date_start']))?>
									</td>
									<td>
										<?=date('Y-m-d H:i',strtotime($row['date_end']))?>
									</td>
								</tr>
								<tr>
									<td colspan="4">
										请假原因:&nbsp;<?=$row['request']?>
										<br>
										&nbsp;										
									</td>
									<td>
										<?php
											if(strtotime($row['date_end'])>time()):
										?>
												<span class="tag is-success">有效</span>
										<?php
											else:
										?>
												<span class="tag is-warning is-light">过期</span>
										<?php
											endif;
										?>
										<br>
										&nbsp;
									</td>
								</tr>
					<?php 
							endforeach;
					?>
						</table>
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