<section class="sidebar fixed ">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <!--        <li class="header">MAIN NAVIGATION</li>-->
        <li class="treeview">
            <a href="<?php echo site_url('admin/dashboard/index'); ?>">
                <i class="fa fa-home"></i> <span>Dashboard</span>
            </a>
        </li>
        <?php 
        

        if ($this->ion_auth->is_admin()){ ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Master Data</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/outlets/'); ?>">
                            <i class="fa fa-edit"></i> <span>Manage Outlet</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/barangs/'); ?>">
                            <i class="fa fa-edit"></i> <span>Manage Barang</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/satuans/'); ?>">
                            <i class="fa fa-edit"></i> <span>Manage Satuan</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/satuanparents/'); ?>">
                            <i class="fa fa-edit"></i> <span>Manage Satuan Parent</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/stockbarangs/'); ?>">
                            <i class="fa fa-edit"></i> <span>Manage Stock Barang</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/jeniss/'); ?>">
                            <i class="fa fa-edit"></i> <span>Manage Jenis</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/gudangs/'); ?>">
                            <i class="fa fa-edit"></i> <span>Manage Gudang</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/brands/'); ?>">
                            <i class="fa fa-edit"></i> <span>Manage Brand</span>
                        </a>
                    </li>            
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/suppliers/'); ?>">
                            <i class="fa fa-edit"></i> <span>Manage Supplier</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span> Transactions</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/requests/'); ?>">
                            <i class="fa fa-edit"></i> <span> Purchase Requisition</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/deliverys/'); ?>">
                            <i class="fa fa-edit"></i> <span> Delivery Order </span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/receives/'); ?>">
                            <i class="fa fa-edit"></i> <span> Good Receiving </span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/wips/'); ?>">
                            <i class="fa fa-edit"></i> <span> Work in Process </span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/tgins/'); ?>">
                            <i class="fa fa-edit"></i> <span> Transfer Goods In </span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/tgouts/'); ?>">
                            <i class="fa fa-edit"></i> <span> Transfer Goods Out </span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/oprrequests/'); ?>">
                            <i class="fa fa-edit"></i> <span> Operational Request </span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/adjusments/'); ?>">
                            <i class="fa fa-edit"></i> <span> Adjusment </span>
                        </a>
                    </li>

                    <li class="treeview">
                        <a href="<?php echo site_url('admin/opnames/'); ?>">
                            <i class="fa fa-edit"></i> <span> Stock Opname </span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>User Management</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/user/'); ?>">
                            <i class="fa fa-edit"></i> <span>Manage Users</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/user_groups/'); ?>">
                            <i class="fa fa-edit"></i> <span>Manage Groups</span>
                        </a>
                    </li>
                </ul>
            </li>             
			<li class="treeview">
               <a href="<?php echo site_url('admin/settings/index'); ?>">
                   <i class="fa fa-cogs"></i> <span>Settings Apps</span>
               </a>
           </li>
           
<?php } else {
    
    $user_groups = $this->ion_auth->get_users_groups()->row();
    echo $user_groups->name ;
    if ($user_groups->name=='user'){
?>
<li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>User </span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/user/'); ?>">
                            <i class="fa fa-edit"></i> <span>Manage Users</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo site_url('admin/user_groups/'); ?>">
                            <i class="fa fa-edit"></i> <span>Manage Groups</span>
                        </a>
                    </li>
                </ul>
            </li>            
			<li class="treeview">
               <a href="<?php echo site_url('admin/settings/index'); ?>">
                   <i class="fa fa-cogs"></i> <span>Settings</span>
               </a>
           </li>
        
<?php 
    }elseif ($user_groups->name=='manager'){
?><li class="treeview">
<a href="#">
    <i class="fa fa-users"></i>
    <span>Manager </span><i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
    <li class="treeview">
        <a href="<?php echo site_url('admin/user/'); ?>">
            <i class="fa fa-edit"></i> <span>Manage Users</span>
        </a>
    </li>
    <li class="treeview">
        <a href="<?php echo site_url('admin/user_groups/'); ?>">
            <i class="fa fa-edit"></i> <span>Manage Groups</span>
        </a>
    </li>
</ul>
</li>            
<li class="treeview">
<a href="<?php echo site_url('admin/settings/index'); ?>">
   <i class="fa fa-cogs"></i> <span>Settings</span>
</a>
</li>
<?php 

    }
       
?> 

<?php 

        }
        ?>

            
    </ul>
</section>
<!-- /.sidebar -->
<script type="text/javascript">
    $(document).ready(function () {

        $('.sidebar ul li').each(function () {
            if (window.location.href.indexOf($(this).find('a:first').attr('href')) > -1) {
                $(this).closest('ul').closest('li').attr('class', 'active');
                $(this).addClass('active').siblings().removeClass('active');
            }
        });

    });
</script>