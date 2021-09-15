<div class="sidenav-menu-heading">Menu Utama</div>

<a class="nav-link" href="<?=base_url('subject')?>">
    <div class="nav-link-icon"><i data-feather="activity"></i></div>
    Subject 
</a>

<a class="nav-link" href="<?=base_url('users/lists/instruktur/2/'.$this->session->userdata('log_uc_prodi'))?>">
    <div class="nav-link-icon"><i data-feather="users"></i></div>
    Data Instruktur
</a>

<a class="nav-link" href="<?=base_url('peserta_diklat')?>">
    <div class="nav-link-icon"><i data-feather="users"></i></div>
    Data Peserta Diklat
</a>


<a class="nav-link" href="<?=base_url('period')?>">
    <div class="nav-link-icon"><i data-feather="calendar"></i></div>
   Periode Diklat
</a>

<div class="sidenav-menu-heading">Monitoring Pembelajaran</div>


<a class="nav-link" href="<?=base_url('monitoring/schedule')?>">
    <div class="nav-link-icon"><i data-feather="calendar"></i></div>
   Jadwal Pelajaran
</a>

<!-- <a class="nav-link" href="<?=base_url('classroom')?>">
    <div class="nav-link-icon"><i data-feather="message-circle"></i></div>
   Classroom
</a> -->

<a class="nav-link" href="<?=base_url('monitoring/presensi/diklat')?>">
    <div class="nav-link-icon"><i data-feather="users"></i></div>
   Presensi Instruktur
</a>