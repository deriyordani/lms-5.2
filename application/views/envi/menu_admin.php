 <div class="sidenav-menu-heading">Menu Utama</div>
 <a class="nav-link" href="<?=base_url('dashboard')?>">
    <div class="nav-link-icon"><i data-feather="activity"></i></div>
    Dashboard 
</a>
<div class="sidenav-menu-heading">Data Master</div>

   <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
        <div class="nav-link-icon"><i data-feather="grid"></i></div>
        Group
        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapseDashboards" data-parent="#accordionSidenav">
        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
            <a class="nav-link" href="<?=base_url('prodi')?>">Prodi</a>
            <a class="nav-link" href="<?=base_url('level')?>">Level</a>
            <a class="nav-link" href="<?=base_url('diklat')?>">Program Diklat</a>
            <a class="nav-link" href="<?=base_url('dkp')?>">Diklat DKP</a>
            <a class="nav-link" href="<?=base_url('subject')?>">Subject</a>
        </nav>
    </div>

    <a class="nav-link" href="<?=base_url('period')?>">
        <div class="nav-link-icon"><i data-feather="calendar"></i></div>
       Periode Diklat
    </a>

    <a class="nav-link" href="<?=base_url('users')?>">
        <div class="nav-link-icon"><i data-feather="users"></i></div>
        User Management
    </a>

    <div class="sidenav-menu-heading">Classroom Manage</div>

   <!--  <a class="nav-link" href="<?=base_url('classroom/manage')?>">
        <div class="nav-link-icon"><i data-feather="message-circle"></i></div>
       Class
    </a> -->

    <a class="nav-link" href="<?=base_url('peserta_diklat')?>">
        <div class="nav-link-icon"><i data-feather="users"></i></div>
        Peserta Diklat
    </a>