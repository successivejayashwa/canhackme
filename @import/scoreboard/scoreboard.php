<?php
	$args_head = [
		'title' => 'Scoreboard - '.__SITE__['title'],
		'active' => 'scoreboard',
		'js' => ['/assets/js/chart.min.js'],
	];
	$args_foot = [
		'active' => 'scoreboard',
	];

	$user_name = Users::get_my_user('user_name');
	$ranks = Challenges::get_ranks(30);


	$chart_max_user = 30;

	$chals = [];
	for($i = 0; $i < $chart_max_user; ++$i){
		$chals[$i] = Challenges::get_solved_chals($ranks[$i]['user_no']);
	}

	$first_time = strtotime('2018-07-18');
	$last_time = strtotime(date('Y-m-d', time()));
	$time_diff = $last_time - $first_time;

	$graph_max_time = $time_diff / (60 * 60 * 24);

	$chart_y = [];
	$u = $time_diff / $graph_max_time;
	for($i = 0; $i < $graph_max_time; ++$i){
		$chart_y[$i] = date('Y-m-d', intval($u * $i + $first_time));
	}
?>
<?php Templater::render('common/head', $args_head); ?>
					<main>
						<div class="py-3">
							<h2>Scoreboard</h2>
<?php if(count($ranks) < 1): ?>
							<div class="card bg-light p-3 my-3">
								Nobody signed up yet.
							</div>
<?php else: ?>
							<div class="pb-3 d-none d-sm-block">
								<canvas id="scoreboard-chart" width="800" height="380" style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select: none;"></canvas>
							</div>
							<div class="table-responsive mt-3">
							<table class="table table-hover table-striped">
								<colgroup>
									<col style="width:10%">
									<col style="width:20%">
									<col style="width:28%">
									<col style="width:12%">
									<col style="width:30%">
								</colgroup>
								<thead>
									<tr>
										<th class="text-center" scope="col">#</th>
										<th>User</th>
										<th>Comment</th>
										<th class="text-center">Score</th>
										<th>Last solved at</th>
									</tr>
								</thead>
								<tbody>
<?php 	$cnt = 0; foreach($ranks as $rank): ?>
<?php 		if($rank['user_name'] === $user_name): ?>
									<tr class="table-info">
<?php 		else: ?>
									<tr>
<?php 		endif; ?>
										<td class="text-center" scope="row"><?php Data::text(++$cnt); ?></td>
										<td><a class="text-dark" href="/users/profile/<?php Data::url(strtolower($rank['user_name'])); ?>"><?php Data::text($rank['user_name']); ?></a></td>
										<td><?php Data::text($rank['user_comment']); ?></td>
										<td class="text-center"><?php Data::text($rank['user_score']); ?>pt</td>
<?php 		if($rank['user_last_solved_at'] === null): ?>
										<td class="text-center">Nothing solved yet</td>
<?php 		else: ?>
										<td><time data-timestamp="<?php Data::timestamp($rank['user_last_solved_at']); ?>"><?php Data::text($rank['user_last_solved_at']); ?></time></td>
<?php 		endif; ?>
									</tr>
<?php 	endforeach; ?>
								</tbody>
							</table>
							</div>
<?php endif; ?>
							<div class="text-muted px-2">
								<i class="fa fa-user mr-1" aria-hidden="true"></i> Currently signed up <?php Data::text(Users::get_user_count()); ?> peoples.
							</div>
						</div>
					</main>
					<script>
						$(function(){ 
							new Chart($("#scoreboard-chart"), {
								type: 'line',
								data: {
									labels: [
										<?php 	foreach($chart_y as $y): ?>"<?php Data::text($y); ?>", <?php 	endforeach; ?>

									],
									datasets: [
<?php 	$i = 0; foreach($ranks as $rank): ?>
										{ 
											data: [
<?php 		$sum_score = 0; foreach($chals[$i] as $chal): ?>
<?php 			$sum_score += $chal['chal_score']; ?>
												{ x: "<?php Data::text(date('Y-m-d', strtotime($chal['chal_solved_at']))); ?>", y: "<?php Data::text($sum_score); ?>" },
<?php 		endforeach; ?>
											],
											label: "<?php Data::text($rank['user_name']); ?>",
											borderColor: "#<?php Data::text(sprintf("%06x", crc32($rank['user_name']))); ?>",
											fill: false
										}, 
<?php 		if(++$i >= $chart_max_user) break; ?>
<?php 	endforeach; ?>
									]
								},
								options: {
									scales: {
										xAxes: [{
											display: false,
										}],
									},
								},
							});
						});
					</script>
<?php Templater::render('common/foot', $args_foot); ?>
