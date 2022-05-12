<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/leaderboard.css') ?>">
<div class="content-wrapper" style="min-height: 174px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Leaderboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Leaderboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
			

			<div class="row">
				<div class="col-sm-4">
					<div class="leaderboard-card">
						<div class="leaderboard-card__top">
							<h3 class="text-center">$1,051</h3>
						</div>
						<div class="leaderboard-card__body">
							<div class="text-center">
								<img src="<?php echo base_url('assets/img/user2.jpg') ?>" class="circle-img mb-2" alt="User Img">
								<h5 class="mb-0">Sandeep Sandy</h5>
								<p class="text-muted mb-0">@sandeep</p>
								<hr>
								<div class="d-flex justify-content-between align-items-center">
									<span><i class="fa fa-map-marker"></i> Bangalore</span>
									<button class="btn btn-outline-success btn-sm">Congratulate</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="leaderboard-card leaderboard-card--first">
						<div class="leaderboard-card__top">
							<h3 class="text-center">$1,254</h3>
						</div>
						<div class="leaderboard-card__body">
							<div class="text-center">
								<img src="<?php echo base_url('assets/img/user1.jpg') ?>" class="circle-img mb-2" alt="User Img">
								<h5 class="mb-0">Kiran Acharya</h5>
								<p class="text-muted mb-0">@kiranacharyaa</p>
								<hr>
								<div class="d-flex justify-content-between align-items-center">
									<span><i class="fa fa-map-marker"></i> Bangalore</span>
									<button class="btn btn-outline-success btn-sm">Congratulate</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="leaderboard-card">
						<div class="leaderboard-card__top">
							<h3 class="text-center">$1,012</h3>
						</div>
						<div class="leaderboard-card__body">
							<div class="text-center">
								<img src="<?php echo base_url('assets/img/user3.jpg') ?>" class="circle-img mb-2" alt="User Img">
								<h5 class="mb-0">John doe</h5>
								<p class="text-muted mb-0">@johndoe</p>
								<hr>
								<div class="d-flex justify-content-between align-items-center">
									<span><i class="fa fa-map-marker"></i> Bangalore</span>
									<button class="btn btn-outline-success btn-sm">Congratulate</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<h4>All Users</h4>
			<?php 
			 $single_mark=($quizdata->max_marks/$quizdata->number_of_questions);
                
			?>

			<table class="table">
				<thead>
					<tr>
						<th>User</th>
						<th>Rank</th>
						<th>Score</th>
					</tr>
				</thead>
				<tbody>
				    
				    <?php
				    $i = 3;
				    foreach($allstudents as $key => $value) {?>
					<tr>
						<td>
							<div class="d-flex align-items-center">
								<!--<img src="img/user1.jpg" class="circle-img circle-img--small mr-2" alt="User Img">-->
								<div class="user-info__basic">
									<h5 class="mb-0"><?php echo $value->first_name; ?></h5>
									<p class="text-muted mb-0"><?php echo  '@'.$value->user_name; ?></p>
								</div>
							</div>
						</td>
						<td><?php echo $i++;?></td>
						<?php 
						$correctMarks=($value->correct_ans*$single_mark);
						$totalNegmarks=($value->incorrect_ans*$quizdata->negative_marks);
						$finalresult=($correctMarks-$totalNegmarks); 
						?>
						<td><?php echo $finalresult; ?></td>
						
					</tr>
					<?php } ?>
					
				</tbody>
			</table>
		</div>
    </section>
    <!-- /.content -->
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>