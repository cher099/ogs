<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

      <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo $navbar['main']; ?>">
        <div class="sidebar-brand-icon">
          <i class="fas fa-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo $navbar['title']; ?></div>
      </a>

      <hr class="sidebar-divider my-0">
 <?php foreach($navbar['links'] as $key => $links) { ?>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <?php if (is_array($links)) { ?>
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#<?php echo $key; ?>" aria-expanded="true" aria-controls="<?php echo $key; ?>">
          <span><?php echo str_replace("-"," ",$key); ?></span>
        </a>
        <div id="<?php echo $key; ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-success py-2 collapse-inner rounded">
            <?php foreach($links as $key2 => $link) { ?>
            <a class="collapse-item text-dark" href="<?php echo $link ?>"><?php echo $key2; ?></a>
            <?php } ?>
          </div>
        </div>
        <?php } else { ?>
        <a class="nav-link" href="<?php echo $links ?>"><?php echo str_replace("-"," ",$key) ?></a>
        <?php } ?>
      </li>
      <hr class="sidebar-divider my-0">
  <?php } ?>
    

      <div class="text-center d-none d-md-inline mt-2">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->

  <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
      

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- TO DO CONTENT -->
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">