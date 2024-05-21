<?php
require_once(dirname(__FILE__) . '/config/config.php');

$page_name = 'About Us';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- Body content -->
  
    <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

    <div class="content-area">
        <div class="banner-area">
            <img src="http://localhost/jobseeker/assets/img/about_banner.jpg" alt="About Us" />
        </div>
        <div class="container">
            <div class="row">
                <h1 class="text-center">About Us</h1>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="row text-justified">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eget malesuada urna. Aenean eget rhoncus sem. Donec at dolor eu nisi facilisis posuere ut tristique neque. Nullam fringilla sapien ut magna pellentesque, id dignissim turpis auctor. In hac habitasse platea dictumst. Phasellus elementum nisl aliquam, convallis enim nec, porttitor tortor. Aenean vitae fringilla libero, ut accumsan ipsum. Etiam luctus vehicula felis. Curabitur iaculis sem vitae sapien vehicula, at congue justo aliquam. Praesent arcu odio, dapibus quis eros at, molestie laoreet nulla. Proin tempus mi sit amet sapien tempus efficitur. Praesent a ante tellus.</p>
                    <p>Integer tempus, magna dignissim vehicula porttitor, arcu nisi imperdiet libero, tincidunt tempor erat tortor id enim. Nulla molestie interdum euismod. Nullam euismod nisl non felis porta varius. Fusce pulvinar enim ut quam vestibulum, ut posuere nibh lacinia. Aenean non orci non nunc pulvinar volutpat. Nulla elit quam, tincidunt sit amet nulla et, interdum mattis leo. Donec aliquet elementum ornare. Quisque vel bibendum diam. Suspendisse non laoreet sapien.</p>
                    <p>Pellentesque elementum commodo arcu, eu imperdiet est tempor eu. Sed feugiat consectetur metus, non tempor erat efficitur sed. Aliquam porttitor efficitur lectus. Etiam eget dolor quis enim vulputate hendrerit quis nec massa. Mauris porttitor ante quis risus commodo, id posuere justo mollis. Ut fringilla malesuada lorem at porttitor. Fusce nunc enim, porttitor a turpis quis, sollicitudin lobortis mi. Morbi eget dignissim massa, et suscipit dolor. Donec sed sagittis elit, a consequat leo. Curabitur eu pretium felis. Fusce fringilla lorem nulla, eu pretium metus condimentum nec. Nulla bibendum tellus id lorem malesuada pretium. Fusce vehicula odio lorem, vel pharetra mi laoreet at.</p>
                    <p>Sed in eros mi. Ut vel libero eget risus pulvinar ornare vel condimentum augue. Nullam odio urna, ornare a gravida quis, ullamcorper vel erat. Morbi ac mi est. Maecenas vitae quam ac quam elementum placerat sed ut est. Nunc at accumsan libero, eu auctor risus. Aliquam vel feugiat erat, a auctor risus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                    <p>Vivamus sagittis suscipit diam, sed faucibus tellus lacinia a. Proin non eros non mauris rutrum hendrerit et in mauris. Nulla vel justo sed tellus condimentum blandit id in sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec vitae molestie quam. Pellentesque molestie suscipit justo, sit amet feugiat sapien aliquet in. Fusce lobortis consequat ligula, eget scelerisque erat condimentum ut. Ut hendrerit massa et purus pharetra, suscipit iaculis ligula euismod. Sed facilisis condimentum massa in congue.</p>
                </div>
                <div class="col-sm-12">
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>

<?php require_once(dirname(__FILE__) . '/templates/footer.php'); ?>