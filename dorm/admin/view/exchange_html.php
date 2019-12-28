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
				<h2 class="has-text-centered subtitle"><i class="fas fa-exchange-alt"></i>&thinsp;换宿申请</h2>
					<?php
						if(empty($exchange_list)):
					?>
						<p class="has-text-centered">暂无换宿申请</p>
					<?php
						else:
					?>
						<table class="table" style="width: 100%;">
							<thead>
							    <tr>
									<th>学号</th>
									<th>姓名</th>
									<th>申请日期</th>
									<th>当前宿舍</th>
									<th>目标宿舍</th>
									<th>状态</th>
									<th></th>
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
										<a href="./student_detail.php?id=<?=$row['student_id']?>">
											<?=$row['name']?>
										</a>
									</td>
									<td>
										<?=date('Y-m-d',strtotime($row['date']))?>
									</td>
									<td>
										<?php
											if(!empty($row['from_dorm_id'])):
										?>
												<a href="./dorm_detail?id=<?=$row['from_dorm_id']?>">
													<?=$row['from_dorm_building']?>号楼&nbsp;<?=$row['from_dorm_number']?>户
												</a>
										<?php
											else:
										?>
												<span>暂未安排</span>
										<?php
											endif;
										?>
									</td>
									<td>
										<a href="./dorm_detail?id=<?=$row['to_dorm_id']?>">
											<?=$row['to_dorm_building']?>号楼&nbsp;<?=$row['to_dorm_number']?>户
										</a>
									</td>
									<td>
										<?php
											if(empty($row['admin_response'])):
										?>
												<a class="button is-outlined is-info is-small" href="./exchange_detail?id=<?=$row['id']?>">
													待回复
												</a>
										<?php
											else:
										?>
												<a class="button is-outlined is-success is-small" href="./exchange_detail?id=<?=$row['id']?>">
													已回复
												</a>
										<?php
											endif;
										?>
									</td>
									<td>
										
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
							  <a class="pagination-previous has-background-white" href="./exchange.php?page=1">首页</a>
							  <a class="pagination-previous has-background-white" href="./exchange.php?page=<?=$page-1; ?>"><</a>
							  <ul class="pagination-list">
									<?php
										for($p=1;$p<=$max_page;$p++):
											if($p==$page):
									?>
												<li><a class="pagination-link is-current" href="./exchange.php?page=<?=$p?>"><?=$p?></a></li>
									<?php
											else:
									?>
												<li><a class="pagination-link has-background-white" href="./exchange.php?page=<?=$p?>"><?=$p?></a></li>
									<?php
											endif;
										endfor;
									?>
							  </ul>
							  <a class="pagination-next has-background-white" href="./exchange.php?page=<?=$page+1; ?>">></a>
							  <a class="pagination-next has-background-white" href="./exchange.php?page=<?=$max_page; ?>">尾页</a>
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