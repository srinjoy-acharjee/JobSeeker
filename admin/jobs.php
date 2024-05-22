<?php
require_once(dirname(dirname(__FILE__)) . '/config/config.php');

if ( empty($_SESSION['AdminLoggedIn']) ) { 
    $helper->go(ADMIN_URL);
    exit(); 
}

$JobSQL = mysqli_query($db, "SELECT * FROM `js_Job`");

$page_name = 'Jobs';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

  <body>
    <div class="page home-page">
      
      <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

      <div class="page-content d-flex align-items-stretch">
        
        <?php require_once(dirname(__FILE__) . '/templates/sidebar.php'); ?>

        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid page-container">
              <h2 class="no-margin-bottom"><?php echo $page_name; ?></h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="no-padding-bottom">
            <div class="container-fluid">
              	<div class="row bg-white has-shadow">
                  <table id="jobs" class="table table-striped table-bordered" style="width:100%">
				        <thead>
				            <tr>
				            	<th>#</th>
				                <th>Title</th>
				                <th>Category</th>
				                <th>Type</th>
				                <th>Location</th>
				                <th>Salary</th>
				                <th>Post Require</th>
				                <th>Photo</th>
				            </tr>
				        </thead>
				        <tbody>
				        	<?php
				        	while($Job = mysqli_fetch_assoc($JobSQL)) {
				        	?>
					            <tr>
					            	<td>
					            		<img src="http://localhost/jobseeker/uploads/job/<?php echo $Job['Job_Unique_ID']; ?>/<?php echo $Job['Job_Image']; ?>" alt="<?php echo $Job['Job_Title']; ?>" class="img-circle" height="60" />
					            	</td>
					                <td><?php echo $Job['Job_Title']; ?></td>
					                <td><?php echo $Job['Job_Category']; ?></td>
					                <td><?php echo $Job['Job_Type']; ?></td>
					                <td><?php echo $Job['Job_Location']; ?></td>
					                <td>&#8377; <?php echo $Job['Job_Salary']; ?>/-</td>
					                <td><?php echo $Job['Job_Post_Require']; ?></td>
					                <td><?php echo date('jS F, Y', strtotime($Job['Job_Posted_On'])); ?></td>
					            </tr>
					        <?php } ?>
				        </tbody>
				    </table>
              	</div>
            </div>
          </section>

<?php require_once(dirname(__FILE__) . '/templates/footer.php'); ?>