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
				<h2 class="has-text-centered subtitle"><i class="fas fa-clipboard-list"></i>&thinsp;违规记录</h2>
				<div class="columns">
					<div class="column">
						<table>
							<tr>
								<td>
									姓名:
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
						</table>
					</div>
				</div>
					<?php
						if(empty($maintain_list)):
					?>
						<tr><td><p class="has-text-centered">没有违规记录，请保持哟~</p></td></tr>
					<?php
						else:
					?>
						<table class="table" style="width: 100%;">
							<thead>
							    <tr>
									<th><abbr>ID</abbr></th>
									<th>日期</th>
									<th>详情</th>
									<th>辅导员意见</th>
							    </tr>
							</thead>
					<?php
							foreach($maintain_list as $row):
					?>
								<tr>
									<td>
										<?=$row['id']?>
									</td>
									<td>
										<?=date('Y-m-d',strtotime($row['date']))?>
									</td>
									<td>
										<?=$row['detail']?>
									</td>
									<td>
										<?=$row['teacher_response']?>
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