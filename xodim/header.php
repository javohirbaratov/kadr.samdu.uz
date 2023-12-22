<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" href="index.php" style="font-family: 'TIMES New Roman'; ">ADMIN</a>
  <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
  <!-- Navbar Right Menu-->
  <ul class="app-nav">
    

    <!-- User Menu-->
    <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
      <ul class="dropdown-menu settings-menu dropdown-menu-right">
        <li><a class="dropdown-item" href="../logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
      </ul>
    </li>
  </ul>
</header>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="images/user.png" width="55" height="50">
    <div>
      <p class="app-sidebar__user-name"><?=strtoupper($_SESSION['ism'])?></p>
      <p class="app-sidebar__user-designation"><?=($_SESSION['rol'])?></p>
    </div>
  </div>
  <ul class="app-menu">
    <li><a class="app-menu__item <?php if($_SESSION['page']==1){ echo "active"; } ?>" href="index.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Bosh sahifa</span></a></li>

    <li class="treeview <?php if($_SESSION['page']>120 && $_SESSION['page']<150){ echo "is-expanded"; } ?>">
      <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-briefcase">
      </i><span class="app-menu__label">Xodimlar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
       

      

        <li><a class="treeview-item <?php if($_SESSION['page']==122){ echo "active"; } ?>" href="xodims-qabul.php"><i class="icon fa fa-circle-o"></i> Xodimlar</a></li>

        <li><a class="treeview-item <?php if($_SESSION['page']==123){ echo "active"; } ?>" href="foto-jadval.php"><i class="icon fa fa-circle-o"></i> Foto jadval</a></li>

      </ul>
    </li>




    <li class="treeview <?php if($_SESSION['page']>100 && $_SESSION['page']<120){ echo "is-expanded"; } ?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-briefcase"></i><span class="app-menu__label">Buyruqlar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item <?php if($_SESSION['page']==111){ echo "active"; } ?>" href="buyruq_tur.php"><i class="icon fa fa-circle-o"></i>Buyruq turlari</a></li>
        <li><a class="treeview-item <?php if($_SESSION['page']==114){ echo "active"; } ?>" href="buyruq.php"><i class="icon fa fa-circle-o"></i>Buyruq raqamlari</a></li>

      </ul>
    </li>






    <!--<li class="treeview <?php if($_SESSION['page']>10 && $_SESSION['page']<11){ echo "is-expanded"; } ?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-briefcase"></i><span class="app-menu__label"> Avvalgi ish joyini kiritish</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item <?php if($_SESSION['page']==10.1){ echo "active"; } ?>" href="mehnat-faoliyat.php"><i class="icon fa fa-circle-o"></i> Kiritilganlarni ko'rish</a></li>
        <li><a class="treeview-item <?php if($_SESSION['page']==10.2){ echo "active"; } ?>" href="add-mehnat-faoliyat.php"><i class="icon fa fa-circle-o"></i> Kiritish</a></li>
      </ul>
    </li>-->


    <!--<li><a class="app-menu__item <?php if($_SESSION['page']>11 && $_SESSION['page']<12){ echo "active"; } ?>" href="foto-jadval.php"><i class="app-menu__icon fa fa-table"></i><span class="app-menu__label">Foto jadval</span></a></li>
      <li><a class="app-menu__item" href="hisobot.php"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Hisobot</span></a></li>-->
      <li class="treeview <?php if($_SESSION['page']>3 && $_SESSION['page']<4){ echo "is-expanded"; } ?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Tuzilma</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item <?php if($_SESSION['page']==3.1){ echo "active"; } ?>" href="bulim.php"><i class="icon fa fa-circle-o"></i> Bo'lim va bo'linmalarni ko'rish</a></li>
          <li><a class="treeview-item <?php if($_SESSION['page']==3.2){ echo "active"; } ?>" href="bulim-create.php"><i class="icon fa fa-circle-o"></i> Bo'lim va bo'linma kiritish</a></li>
          <li><a class="treeview-item <?php if($_SESSION['page']==3.3){ echo "active"; } ?>" href="lavozim.php"><i class="icon fa fa-circle-o"></i> Lavozimlarni ko'rish</a></li>
          <li><a class="treeview-item <?php if($_SESSION['page']==3.4){ echo "active"; } ?>" href="lavozim-create.php"><i class="icon fa fa-circle-o"></i> Lavozimlarni kiritish</a></li>
        </ul>
      </li>

      <!--<li><a class="app-menu__item <?php if($_SESSION['page']==5){ echo "active"; } ?>" href="recieve-data.php"><i class="app-menu__icon fa fa-table"></i><span class="app-menu__label">Kelib tushgan malumotlar</span></a></li>-->

        <li class="treeview <?php if($_SESSION['page']>150 && $_SESSION['page']<200){ echo "is-expanded"; } ?>">
      <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-briefcase">
      </i><span class="app-menu__label">Ma'lumotlar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item <?php if($_SESSION['page']==151){ echo "active"; } ?>" href="recieve-data.php"><i class="icon fa fa-circle-o"></i>Kelib tushgan ma'lumotlar</a></li>

        <li><a class="treeview-item <?php if($_SESSION['page']==152){ echo "active"; } ?>" href="recieve-data2.php"><i class="icon fa fa-circle-o"></i>Qabul qilinganlar</a></li>

      

      </ul>
    </li>


      <li><a class="app-menu__item" href="manual.php"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">Qo'llanma</span></a></li>

      <!--<li><a class="app-menu__item <?php if($_SESSION['page']==8){ echo "active"; } ?>"  href="recieve-data2.php"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">Xodimlar</span></a></li>-->

    </ul>
  </aside>



