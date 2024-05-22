<?php
require_once(dirname(dirname(__FILE__)) . '/config/config.php');

if ( empty($_SESSION['AdminLoggedIn']) ) { 
    $helper->go(ADMIN_URL);
    exit(); 
}

$SeekerSQL = mysqli_query($db, "SELECT * FROM `js_Seeker`");

$page_name = 'Seekers';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

  <body>
    <div class="page home-page">
      
      <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

      <div class="page-content d-flex align-items-stretch">
        
        <?php require_once(dirname(__FILE__) . '/templates/sidebar.php'); ?>

        <div class="content-inner page-container">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom"><?php echo $page_name; ?></h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="no-padding-bottom">
            <div class="container-fluid">
              	<div class="row bg-white has-shadow">
                  <table id="seekers" class="table table-striped table-bordered" style="width:100%">
				        <thead>
				            <tr>
				            	<th>#</th>
				                <th>Name</th>
				                <th>Email</th>
				                <th>Phone</th>
				                <th>Skill</th>
				                <th>Status</th>
				                <th>Created</th>
				            </tr>
				        </thead>
				        <tbody>
				        	<?php
				        	while($Seeker = mysqli_fetch_assoc($SeekerSQL)) {
				        	?>
					            <tr>
					            	<td>
					            		<img src="http://localhost/jobseeker/uploads/seeker/<?php echo $Seeker['Seeker_Unique_ID']; ?>/<?php echo $Seeker['Seeker_Photo']; ?>" alt="<?php echo $Seeker['Seeker_Name']; ?>" class="img-circle" height="60" />
					            	</td>
					                <td><?php echo $Seeker['Seeker_Name']; ?></td>
					                <td>
					                	<a href="mailto:<?php echo $Seeker['Seeker_Email']; ?>">
					                		<?php echo $Seeker['Seeker_Email']; ?>
					                	</a>
					                </td>
					                <td><?php echo $Seeker['Seeker_Phone']; ?></td>
					                <td><?php echo $Seeker['Seeker_Skill']; ?></td>
					                <td><?php echo $Seeker['Seeker_Status']; ?></td>
					                <td><?php echo date('jS F, Y', strtotime($Seeker['Seeker_Regd_On'])); ?></td>
					            </tr>
					        <?php } ?>
				        </tbody>
				    </table>
              	</div>
            </div>
          </section>

<?php require_once(dirname(__FILE__) . '/templates/footer.php'); ?>