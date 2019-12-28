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
					<?php
						//搜索学生的页面有多种形态
						if(isset($html_func)):
					?>
							<a class="subtitle"><?=$html_func?></a>
							&thinsp;<i class="fas fa-chevron-right"></i>&nbsp;搜索学生
					<?php
						else:
					?>
							<h2 class="has-text-centered subtitle"><i class="fas fa-user-graduate"></i>&thinsp;搜索学生</h2>
					<?php
						endif;
					?>
				</div>
				<br>
				<div>
					<form action="./student.php" method="GET">
						<div class="columns">
							<div class="column is-9">
								<input class="input" type="text" name="keyword" placeholder="学号或姓名" required="required" maxlength="20" value="<?=isset($keyword)?$keyword:''?>"/>
							</div>
							<div class="column is-3 has-text-centered">
								<input class="button is-info" type="submit" value="&nbsp;搜索&nbsp;"/>
							</div>
						</div>
					</form>
				</div>
				<br>
					<?php
						if(empty($student_list)):
							if(isset($keyword)):
					?>
								<p class="has-text-centered"><i class="fas fa-question"></i>&thinsp;查无此学生</p>
					<?php
							else:
					?>
								<p class="has-text-centered"><i class="fas fa-search"></i>&thinsp;立即输入关键词开始搜索吧</p>
					<?php
							endif;
						else:
					?>
						<table class="table" style="width: 100%;">
							<thead>
							    <tr>
									<th>学号</th>
									<th>姓名</th>
									<th>性别</th>
									<th>班级</th>
									<th>宿舍</th>
							    </tr>
							</thead>
					<?php
							foreach($student_list as $row):
					?>
								<tr>
									<td>
										<?=$row['account']?>
									</td>
									<td>
										<a href="./student_detail?id=<?=$row['student_id']?>">
											<?=$row['student_name']?>
										</a>
									</td>
									<td>
										<?=$row['sex']?>
									</td>
									<td>
										<?=$row['class_name']?>
									</td>
									<td>
										<?php
											if(empty($row['dorm_id'])):
										?>
											<span>暂未安排</span>
										<?php
											else:
										?>
											<a href="./dorm_detail?id=<?=$row['dorm_id']?>">
												<?=$row['building']?>号楼&nbsp;<?=$row['number']?>户
											</a>
										<?php
											endif;
										?>
									</td>
								</tr>
					<?php 
							endforeach;
					?>
						</table>
						<?php
							if($max_page>1):
								//根据URL参数构造链接
								$link="./student.php?";
								if(!empty($keyword)):
									$link=$link."keyword=".$keyword."&";
								endif;
								if(isset($html_func)):
									$link=$link."func=".$html_func."&";
								endif;
						?>
							<br>
							<nav class="pagination is-centered" role="navigation" aria-label="pagination">
							  <a class="pagination-previous has-background-white" href="<?=$link?>page=1">首页</a>
							  <a class="pagination-previous has-background-white" href="<?=$link?>page=<?=$page-1; ?>"><</a>
							  <ul class="pagination-list">
									<?php
										for($p=1;$p<=$max_page;$p++):
											if($p==$page):
									?>
												<li><a class="pagination-link is-current" href="<?=$link?>page=<?=$p?>"><?=$p?></a></li>
									<?php
											else:
									?>
												<li><a class="pagination-link has-background-white" href="<?=$link?>page=<?=$p?>"><?=$p?></a></li>
									<?php
											endif;
										endfor;
									?>
							  </ul>
							  <a class="pagination-next has-background-white" href="<?=$link?>page=<?=$page+1; ?>">></a>
							  <a class="pagination-next has-background-white" href="<?=$link?>page=<?=$max_page; ?>">尾页</a>
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