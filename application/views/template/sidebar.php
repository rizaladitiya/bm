<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/img/bmlogo.jpg') ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata("nama"); ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Cari..."/>
                <span class="input-group-btn">
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Menu Utama</li>
            <li class="treeview <?=kontroler('dashboard');?>">
                <a href="<?=base_url("dashboard");?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
                </a>
            </li>
            <li class="treeview <?=kontroler('beritaacara');?>" <?=showmenu($this->session->userdata("kelompok"),array(2,12,6))?>>
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Berita Acara</span><span class="label label-primary pull-right"></span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url("beritaacara/add");?>"><i class="fa fa-plus"></i> Add</a></li>
                    <li><a href="<?=base_url("beritaacara/viewall");?>"><i class="fa fa-search"></i> View</a></li>
					<li <?=showmenu($this->session->userdata("kelompok"),array(6))?>><a href="<?=base_url("beritaacara");?>"><i class="fa fa-search"></i> View All</a></li>
                    <li><a href="<?=base_url("beritaacara/cetak");?>"><i class="fa fa-print"></i> Cetak</a></li>
                    <li><a href="<?=base_url("beritaacara/viewcetak");?>"><i class="fa fa-book"></i>Data Cetak</a></li>
                </ul>
            </li>
             <li class="treeview <?=kontroler('reject');?>" <?=showmenu($this->session->userdata("kelompok"),array(2,3,6))?>>
                <a href="#">
                    <i class="fa fa-recycle"></i>
                    <span>Roll Reject</span><span class="label label-primary pull-right"></span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url("reject/add");?>"><i class="fa fa-plus"></i> Add</a></li>
                    <li><a href="<?=base_url("reject/index");?>"><i class="fa fa-search"></i> View</a></li>
                    <li><a href="<?=base_url("reject/kirim");?>"><i class="fa fa-truck"></i> Kirim</a></li>
                    <li><a href="<?=base_url("reject/lapkirim");?>"><i class="fa fa-truck"></i> Lap. Kirim</a></li>
                    <li><a href="<?=base_url("reject/lapstock");?>"><i class="fa fa-search"></i> Stok</a></li>
                </ul>
          </li>
            <li class="treeview <?=kontroler('po');?>" <?=showmenu($this->session->userdata("kelompok"),array(2,6))?>>
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span>PO</span><span class="label label-primary pull-right"></span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url("po/tigabulan");?>"><i class="fa fa-archive"></i> Lebih 3 Bulan</a></li>
                </ul>
            </li>
            
            <li class="treeview <?=kontroler('grinding');?>" <?=showmenu($this->session->userdata("kelompok"),array(100))?>>
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span>Grinding</span><span class="label label-primary pull-right"></span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url("grinding/add");?>"><i class="fa fa-plus"></i> Add Grinding</a></li>
                    <li><a href="<?=base_url("grinding/view");?>"><i class="fa fa-search"></i> View Grinding</a></li>
                </ul>
            </li>
            <li class="treeview <?=kontroler('costcontrol');?>" <?=showmenu($this->session->userdata("kelompok"),array(4))?>><a href="#">Cost Control</a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url("costcontrol/hargajenis");?>"><i class="fa fa-plus"></i> Harga Plan Per Jenis</a></li>
                    <li><a href="<?=base_url("costcontrol/hargadetail");?>"><i class="fa fa-search"></i> Harga Plan Detail</a></li>
                </ul>
            </li>
            <li class="treeview <?=kontroler('wip');?>" <?=showmenu($this->session->userdata("kelompok"),array(202,1000))?>>
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span>Stok WIP</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url("wip/view");?>"><i class="fa fa-search"></i>Kemasan</a></li>
                    <li><a href="<?=base_url("wip/hitung");?>"><i class="fa fa-search"></i>Hitung</a></li>
                    <li><a href="<?=base_url("wip/addwip");?>"><i class="fa fa-plus"></i>Add WIP</a></li>
                </ul>
          </li>
          <li class="treeview <?=kontroler('gudang');?>" <?=showmenu($this->session->userdata("kelompok"),array(202,1000,300))?>>
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span>Gudang</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url("gudang/lappp");?>"><i class="fa fa-search"></i>Laporan PP</a></li>
                </ul>
          </li>
		  <li class="treeview <?=kontroler('checklist');?>" <?=showmenu($this->session->userdata("kelompok"),array(202,1000,300))?>>
                <a href="#">
                    <i class="fa fa-check-square-o"></i>
                    <span>Checklist</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url("checklist/laporantgl");?>"><i class="fa fa-search"></i>Laporan Kerja</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url("checklist/checklisttgl");?>"><i class="fa fa-search"></i>Data Checklist</a></li>
                </ul>
          </li>
		  <li class="treeview <?=kontroler('wiring');?>" <?=showmenu($this->session->userdata("kelompok"),array(202,1000,300))?>>
                <a href="#">
                    <i class="fa fa-bolt"></i>
                    <span>Wiring</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url("wiring/view");?>"><i class="fa fa-exchange"></i>Data Wiring</a></li>
                </ul>
          </li>
            <li class="header">Notifikasi</li>
            <li><a href="#"><i class="fa fa-circle-o text-danger"></i> Important</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-warning"></i> Warning</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-info"></i> Information</a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">