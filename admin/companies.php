<?php
require_once(dirname(dirname(__FILE__)) . '/config/config.php');

if ( empty($_SESSION['AdminLoggedIn']) ) { 
    $helper->go(ADMIN_URL);
    exit(); 
}

$CompanySQL = mysqli_query($db, "SELECT * FROM `js_company`");

$page_name = 'Companies';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

  <body>
    <div class="page home-page">
      
      <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

      <div class="page-content d-flex align-items-stretch">
        
        <?php require_once(dirname(__FILE__) . '/templates/sidebar.php'); ?>

        <div class="content-inner">
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
                  <table id="companies" class="table table-striped table-bordered" style="width:100%">
				        <thead>
				            <tr>
				            	<th>#</th>
				                <th>Name</th>
				                <th>Email</th>
				                <th>Phone</th>
				                <th>Status</th>
				                <th>Website</th>
				                <th>Created</th>
				            </tr>
				        </thead>
				        <tbody>
				        	<?php
				        	while($Company = mysqli_fetch_assoc($CompanySQL)) {
				        	?>
					            <tr>
					            	<td>
					            		<img src="http://localhost/jobseeker/uploads/company/<?php echo $Company['Company_Unique_ID']; ?>/<?php echo $Company['Company_Photo']; ?>" alt="<?php echo $Company['Company_Name']; ?>" class="img-circle" height="60" />
					            	</td>
					                <td><?php echo $Company['Company_Name']; ?></td>
					                <td><?php echo $Company['Company_Email']; ?></td>
					                <td><?php echo $Company['Company_Phone']; ?></td>
					                <td><?php echo $Company['Company_Status']; ?></td>
					                <td>
					                	<a href="<?php echo $Company['Company_Website']; ?>" target="_blank">
					                		<?php echo $Company['Company_Website']; ?>
					                	</a>
					                </td>
					                <td><?php echo date('jS F, Y', strtotime($Company['Company_Regd_On'])); ?></td>
					            </tr>
					        <?php } ?>
				        </tbody>
				    </table>
              	</div>
            </div>
          </section>

<?php require_once(dirname(__FILE__) . '/templates/footer.php'); ?>