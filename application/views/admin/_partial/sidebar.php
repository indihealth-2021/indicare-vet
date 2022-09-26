    <!-- <div class="">
        <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
        <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
    </div> -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <div class="logo">
                    <a href="#" class="">
                      <div class="bg-logo-sidebar p-2 text-center"><img src="<?php echo base_url('assets/dashboard/img/logo.png'); ?>" class="ml-3" alt=""><span></span></div>
                    </a>
                </div>
                <ul>
                    <?php if ($user->id_user_level == 1) { ?>
                        <h5 class="ml-3">Main Menu</h5>
                        <li class="<?php if (isset($this->uri->segments[2])) {
                                        echo strtolower($this->uri->segments[2]) == 'admin' && !isset($this->uri->segments[3]) ? 'active' : '';
                                    } ?>">
                            <a href="<?php echo base_url('admin/admin') ?>" style="font-size: 16px"><!-- <i class="fa fa-dashboard"></i>  -->
                                <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                                <path d="M9 3H15V7.5H9V3ZM9 15.75V8.25H15V15.75H9ZM2.25 15.75V11.25H8.25V15.75H2.25ZM2.25 10.5V3H8.25V10.5H2.25ZM3 3.75V9.75H7.5V3.75H3ZM9.75 3.75V6.75H14.25V3.75H9.75ZM9.75 9V15H14.25V9H9.75ZM3 12V15H7.5V12H3Z" fill="black"/>
                                </svg></i>
                                <!-- <img src="<?php echo base_url('assets/dashboard/img/iconsvg/dashboard.svg')?>"> -->
                                <span>Dashboard</span></a>
                        </li>
                        <li class="submenu">
                            <a href="#" class=""><!-- <i class="fas fa-user"></i> --> 
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M15.0908 13.4227C14.7592 12.6372 14.278 11.9238 13.674 11.3221C13.0719 10.7186 12.3585 10.2375 11.5734 9.90527C11.5664 9.90176 11.5594 9.9 11.5524 9.89648C12.6475 9.10547 13.3594 7.81699 13.3594 6.36328C13.3594 3.95508 11.4082 2.00391 9.00001 2.00391C6.59181 2.00391 4.64064 3.95508 4.64064 6.36328C4.64064 7.81699 5.35255 9.10547 6.44767 9.89824C6.44064 9.90176 6.43361 9.90352 6.42658 9.90703C5.63908 10.2393 4.93243 10.7156 4.32599 11.3238C3.72255 11.926 3.24143 12.6393 2.90919 13.4244C2.58281 14.193 2.40678 15.0171 2.39064 15.852C2.39017 15.8707 2.39346 15.8894 2.40032 15.9068C2.40717 15.9243 2.41746 15.9402 2.43056 15.9537C2.44367 15.9671 2.45933 15.9778 2.47662 15.9851C2.49392 15.9923 2.5125 15.9961 2.53126 15.9961H3.58595C3.66329 15.9961 3.72482 15.9346 3.72658 15.859C3.76173 14.502 4.30665 13.2311 5.26993 12.2678C6.26661 11.2711 7.59025 10.7227 9.00001 10.7227C10.4098 10.7227 11.7334 11.2711 12.7301 12.2678C13.6934 13.2311 14.2383 14.502 14.2734 15.859C14.2752 15.9363 14.3367 15.9961 14.4141 15.9961H15.4688C15.4875 15.9961 15.5061 15.9923 15.5234 15.9851C15.5407 15.9778 15.5564 15.9671 15.5695 15.9537C15.5826 15.9402 15.5929 15.9243 15.5997 15.9068C15.6066 15.8894 15.6099 15.8707 15.6094 15.852C15.5918 15.0117 15.4178 14.1943 15.0908 13.4227V13.4227ZM9.00001 9.38672C8.19318 9.38672 7.4338 9.07207 6.86251 8.50078C6.29122 7.92949 5.97658 7.17012 5.97658 6.36328C5.97658 5.55645 6.29122 4.79707 6.86251 4.22578C7.4338 3.65449 8.19318 3.33984 9.00001 3.33984C9.80685 3.33984 10.5662 3.65449 11.1375 4.22578C11.7088 4.79707 12.0234 5.55645 12.0234 6.36328C12.0234 7.17012 11.7088 7.92949 11.1375 8.50078C10.5662 9.07207 9.80685 9.38672 9.00001 9.38672Z" fill="black"/>
                                    </svg></i>
                                <span>User Management</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li class="<?php if (isset($this->uri->segments[3])) {
                                        echo strtolower($this->uri->segments[3]) == 'manage_admin' ? 'active' : '';
                                    } ?>">
                                    <a href="<?php echo base_url('admin/admin/manage_admin') ?>"><span>Admin</span></a>
                                </li>
                                <li class="<?php if (isset($this->uri->segments[2])) {
                                        echo strtolower($this->uri->segments[2]) == 'dokter' && !isset($this->uri->segments[3]) ? 'active' : '';
                                    } ?>>">
                                    <a href="<?php echo base_url('admin/dokter') ?>"><span>Dokter</span></a>
                                </li>
                                <li class="<?php echo strtolower($this->uri->segments[2]) == 'pasien' && !isset($this->uri->segments[3]) ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('admin/pasien') ?>"><span>Pasien</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#" ><!-- <i class="fas fa-hospital"></i> --> 
                                <i class="stroke"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M2.25 15.75H15.75" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.75 15.75V3.75C3.75 3.35218 3.90804 2.97064 4.18934 2.68934C4.47064 2.40804 4.85218 2.25 5.25 2.25H12.75C13.1478 2.25 13.5294 2.40804 13.8107 2.68934C14.092 2.97064 14.25 3.35218 14.25 3.75V15.75" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.75 15.75V12.75C6.75 12.3522 6.90804 11.9706 7.18934 11.6893C7.47064 11.408 7.85218 11.25 8.25 11.25H9.75C10.1478 11.25 10.5294 11.408 10.8107 11.6893C11.092 11.9706 11.25 12.3522 11.25 12.75V15.75" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.5 6.75H10.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 5.25V8.25" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg></i>
                                <span>Rumah Sakit</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li class="<?php echo strtolower($this->uri->segments[2]) == 'config' ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('admin/Config/poli') ?>"><span>Poli</span></a>
                                </li>
                                <li class="<?php echo strtolower($this->uri->segments[2]) == 'obat' ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('admin/Obat/manage_obat') ?>"><span>Obat</span></a>
                                </li>
                            </ul>
                        </li>
                        <hr>
                        <h5 class="ml-3">Homecare</h5>
                        <li class="<?php if(isset($this->uri->segments[2]) && isset($this->uri->segments[3])){echo strtolower($this->uri->segments[2]) == 'homecare' && strtolower($this->uri->segments[3]) == 'pendaftaran' ? 'active' : '';} ?>">
                            <a href="<?php echo base_url('admin/homecare/pendaftaran') ?>"><!-- <i class="fa fa-dashboard"></i> -->
                            <i><svg xmlns="http://www.w3.org/2000/svg" width="30" height="auto" viewBox="0 0 18 18" fill="none">
                                    <path d="M8.66667 6.33333C9.40304 6.33333 10 5.811 10 5.16667C10 4.52233 9.40304 4 8.66667 4C7.93029 4 7.33333 4.52233 7.33333 5.16667C7.33333 5.811 7.93029 6.33333 8.66667 6.33333Z" fill="black"/>
                                    <path d="M4.83333 14C5.47767 14 6 13.403 6 12.6667C6 11.9303 5.47767 11.3333 4.83333 11.3333C4.189 11.3333 3.66667 11.9303 3.66667 12.6667C3.66667 13.403 4.189 14 4.83333 14Z" fill="black"/>
                                    <path d="M4.83333 10.3333C5.47767 10.3333 6 9.73638 6 9C6 8.26362 5.47767 7.66666 4.83333 7.66666C4.189 7.66666 3.66667 8.26362 3.66667 9C3.66667 9.73638 4.189 10.3333 4.83333 10.3333Z" fill="black"/>
                                    <path d="M4.83333 6.33333C5.47767 6.33333 6 5.811 6 5.16667C6 4.52233 5.47767 4 4.83333 4C4.189 4 3.66667 4.52233 3.66667 5.16667C3.66667 5.811 4.189 6.33333 4.83333 6.33333Z" fill="black"/>
                                    <path d="M12.3333 6.33333C13.0697 6.33333 13.6667 5.811 13.6667 5.16667C13.6667 4.52233 13.0697 4 12.3333 4C11.597 4 11 4.52233 11 5.16667C11 5.811 11.597 6.33333 12.3333 6.33333Z" fill="black"/>
                                    <path d="M7.9697 12.7777V13.6833C7.9697 13.8607 8.1097 14 8.28788 14H9.17879C9.26151 14 9.34424 13.9683 9.40151 13.905L13.1115 10.2127L11.7624 8.87L8.06515 12.5497C8.00151 12.613 7.9697 12.6953 7.9697 12.7777V12.7777ZM8.62515 10.2L9.87879 8.95233V8.93333C9.87879 8.23666 9.30606 7.66666 8.60606 7.66666C7.90606 7.66666 7.33333 8.23666 7.33333 8.93333C7.33333 9.63 7.90606 10.2 8.60606 10.2H8.62515ZM14.2379 8.65466L13.3406 7.76166C13.2133 7.635 13.0161 7.635 12.8888 7.76166L12.2142 8.433L13.5633 9.77566L14.2379 9.10433C14.3652 8.97766 14.3652 8.78133 14.2379 8.65466V8.65466Z" fill="black"/>
                                    </svg></i>
                             <span>Pendaftaran</span></a>
                        </li>
                        <li class="submenu">
                            <a href="#" class="<?php if(isset($this->uri->segments[2]) && isset($this->uri->segments[3])){echo strtolower($this->uri->segments[2]) == 'homecare' && strtolower($this->uri->segments[3]) == 'pembayaran' ? 'active' : '';} ?>"><!-- <i class="fas fa-money-bill"></i>  -->
                                <i class="stroke"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M1.5 5.25C1.5 4.85218 1.65804 4.47064 1.93934 4.18934C2.22064 3.90804 2.60218 3.75 3 3.75H15C15.3978 3.75 15.7794 3.90804 16.0607 4.18934C16.342 4.47064 16.5 4.85218 16.5 5.25V12.75C16.5 13.1478 16.342 13.5294 16.0607 13.8107C15.7794 14.092 15.3978 14.25 15 14.25H3C2.60218 14.25 2.22064 14.092 1.93934 13.8107C1.65804 13.5294 1.5 13.1478 1.5 12.75V5.25Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 11.25C10.2426 11.25 11.25 10.2426 11.25 9C11.25 7.75736 10.2426 6.75 9 6.75C7.75736 6.75 6.75 7.75736 6.75 9C6.75 10.2426 7.75736 11.25 9 11.25Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1.5 6.75C2.29565 6.75 3.05871 6.43393 3.62132 5.87132C4.18393 5.30871 4.5 4.54565 4.5 3.75" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.5 14.25C13.5 13.4544 13.8161 12.6913 14.3787 12.1287C14.9413 11.5661 15.7044 11.25 16.5 11.25" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg></i>
                                <span> Pembayaran </span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li class="<?php echo strtolower($this->uri->segments[2]) == 'homecare' && strtolower($this->uri->segments[3]) == 'pembayaran' && strtolower($this->uri->segments[4]) == 'layanan' ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('admin/homecare/pembayaran/layanan') ?>"><span>Layanan</span></a>
                                </li>
                                <li class="<?php echo strtolower($this->uri->segments[2]) == 'homecare' && strtolower($this->uri->segments[3]) == 'obat' ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('admin/homecare/pembayaran/obat') ?>"><span>Obat</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#" class=""><!-- <i class="fas fa-truck"></i> -->
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M19 7C19 5.9 18.1 5 17 5H14V7H17V9.65L13.52 14H10V9H6C3.79 9 2 10.79 2 13V16H4C4 17.66 5.34 19 7 19C8.66 19 10 17.66 10 16H14.48L19 10.35V7ZM4 14V13C4 11.9 4.9 11 6 11H8V14H4ZM7 17C6.45 17 6 16.55 6 16H8C8 16.55 7.55 17 7 17Z" fill="black"/>
                                    <path d="M5 6H10V8H5V6ZM19 13C17.34 13 16 14.34 16 16C16 17.66 17.34 19 19 19C20.66 19 22 17.66 22 16C22 14.34 20.66 13 19 13ZM19 17C18.45 17 18 16.55 18 16C18 15.45 18.45 15 19 15C19.55 15 20 15.45 20 16C20 16.55 19.55 17 19 17Z" fill="black"/>
                                    </svg></i>
                             <span>Pengiriman Obat</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li class="<?php if (isset($this->uri->segments[4])) {
                                        echo strtolower($this->uri->segments[2]) == 'homecare' && strtolower($this->uri->segments[3]) == 'pengirimanobat' && strtolower($this->uri->segments[4]) == 'biaya' ? 'active' : '';
                                    } ?>">
                                    <a href="<?php echo base_url('admin/homecare/PengirimanObat/biaya') ?>"><span>Biaya Pengiriman</span></a>
                                </li>
                                <li class="<?php if (isset($this->uri->segments[4])) {echo strtolower($this->uri->segments[2]) == 'homecare' && strtolower($this->uri->segments[3]) == 'pengirimanobat' && !$this->uri->segments[4] ? 'active' : '';
                            } ?>">
                                    <a href="<?php echo base_url('admin/homecare/PengirimanObat/') ?>"><span>Pengiriman</span></a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="submenu <?php //if(isset($this->uri->segments[2])){echo strtolower($this->uri->segments[2]) == 'pembayaran' ? 'active' : '';} ?>">
                            <a href="#" class=""><!-- <i class="fas fa-file-invoice-dollar"></i> --> 
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M6.33333 6.99998H8C8.17681 6.99998 8.34638 6.92974 8.4714 6.80472C8.59643 6.67969 8.66667 6.51012 8.66667 6.33331C8.66667 6.1565 8.59643 5.98693 8.4714 5.86191C8.34638 5.73688 8.17681 5.66664 8 5.66664H7.33333V5.33331C7.33333 5.1565 7.2631 4.98693 7.13807 4.86191C7.01305 4.73688 6.84348 4.66664 6.66667 4.66664C6.48986 4.66664 6.32029 4.73688 6.19526 4.86191C6.07024 4.98693 6 5.1565 6 5.33331V5.69998C5.59495 5.78223 5.23491 6.01205 4.98977 6.34482C4.74463 6.6776 4.63189 7.08959 4.67343 7.50081C4.71497 7.91204 4.90782 8.29316 5.21456 8.57019C5.52129 8.84722 5.92002 9.00039 6.33333 8.99998H7C7.08841 8.99998 7.17319 9.0351 7.2357 9.09761C7.29821 9.16012 7.33333 9.24491 7.33333 9.33331C7.33333 9.42172 7.29821 9.5065 7.2357 9.56901C7.17319 9.63153 7.08841 9.66665 7 9.66665H5.33333C5.15652 9.66665 4.98695 9.73688 4.86193 9.86191C4.73691 9.98693 4.66667 10.1565 4.66667 10.3333C4.66667 10.5101 4.73691 10.6797 4.86193 10.8047C4.98695 10.9297 5.15652 11 5.33333 11H6V11.3333C6 11.5101 6.07024 11.6797 6.19526 11.8047C6.32029 11.9297 6.48986 12 6.66667 12C6.84348 12 7.01305 11.9297 7.13807 11.8047C7.2631 11.6797 7.33333 11.5101 7.33333 11.3333V10.9666C7.73838 10.8844 8.09843 10.6546 8.34356 10.3218C8.5887 9.98903 8.70144 9.57704 8.6599 9.16581C8.61837 8.75459 8.42551 8.37347 8.11878 8.09644C7.81204 7.81941 7.41332 7.66623 7 7.66665H6.33333C6.24493 7.66665 6.16014 7.63153 6.09763 7.56901C6.03512 7.5065 6 7.42172 6 7.33331C6 7.24491 6.03512 7.16012 6.09763 7.09761C6.16014 7.0351 6.24493 6.99998 6.33333 6.99998ZM14 7.99998H12V1.99998C12.0005 1.8825 11.9699 1.76699 11.9113 1.66514C11.8528 1.56329 11.7684 1.47871 11.6667 1.41998C11.5653 1.36147 11.4504 1.33066 11.3333 1.33066C11.2163 1.33066 11.1013 1.36147 11 1.41998L9 2.56664L7 1.41998C6.89865 1.36147 6.78369 1.33066 6.66667 1.33066C6.54964 1.33066 6.43468 1.36147 6.33333 1.41998L4.33333 2.56664L2.33333 1.41998C2.23199 1.36147 2.11702 1.33066 2 1.33066C1.88298 1.33066 1.76801 1.36147 1.66667 1.41998C1.56493 1.47871 1.48052 1.56329 1.42199 1.66514C1.36345 1.76699 1.33287 1.8825 1.33333 1.99998V12.6666C1.33333 13.1971 1.54405 13.7058 1.91912 14.0809C2.29419 14.4559 2.8029 14.6666 3.33333 14.6666H12.6667C13.1971 14.6666 13.7058 14.4559 14.0809 14.0809C14.456 13.7058 14.6667 13.1971 14.6667 12.6666V8.66665C14.6667 8.48983 14.5964 8.32027 14.4714 8.19524C14.3464 8.07022 14.1768 7.99998 14 7.99998ZM3.33333 13.3333C3.15652 13.3333 2.98695 13.2631 2.86193 13.1381C2.7369 13.013 2.66667 12.8435 2.66667 12.6666V3.15331L4 3.91331C4.10289 3.96705 4.21725 3.99512 4.33333 3.99512C4.44941 3.99512 4.56378 3.96705 4.66667 3.91331L6.66667 2.76664L8.66667 3.91331C8.76956 3.96705 8.88392 3.99512 9 3.99512C9.11608 3.99512 9.23044 3.96705 9.33333 3.91331L10.6667 3.15331V12.6666C10.6685 12.8941 10.7091 13.1195 10.7867 13.3333H3.33333ZM13.3333 12.6666C13.3333 12.8435 13.2631 13.013 13.1381 13.1381C13.013 13.2631 12.8435 13.3333 12.6667 13.3333C12.4899 13.3333 12.3203 13.2631 12.1953 13.1381C12.0702 13.013 12 12.8435 12 12.6666V9.33331H13.3333V12.6666Z" fill="black"/>
                                </svg></i>
                                <span> Riwayat Pembayaran </span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li class="<?php if(isset($this->uri->segments[4])){echo strtolower($this->uri->segments[2]) == 'homecare' && strtolower($this->uri->segments[4]) == 'riwayat_pembayaran_layanan' ? 'active' : '';} ?>"><a href="<?php echo base_url('admin/homecare/pembayaran/riwayat_pembayaran_layanan') ?>">Layanan</a></li>
                                <li class="mb-5 <?php if(isset($this->uri->segments[4])){echo strtolower($this->uri->segments[2]) == 'homecare' && strtolower($this->uri->segments[4]) == 'riwayat_pembayaran_obat' ? 'active' : '';} ?>"><a href="<?php echo base_url('admin/homecare/Pembayaran/riwayat_pembayaran_obat') ?>">Obat</a></li>
                            </ul>
                        </li>
                        <hr>
                        <h5 class="ml-3">Telekonsultasi</h5>
                        <li class="submenu">
                            <a href="#" class=""><!-- <i class="fas fa-truck"></i> -->
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M19 7C19 5.9 18.1 5 17 5H14V7H17V9.65L13.52 14H10V9H6C3.79 9 2 10.79 2 13V16H4C4 17.66 5.34 19 7 19C8.66 19 10 17.66 10 16H14.48L19 10.35V7ZM4 14V13C4 11.9 4.9 11 6 11H8V14H4ZM7 17C6.45 17 6 16.55 6 16H8C8 16.55 7.55 17 7 17Z" fill="black"/>
                                    <path d="M5 6H10V8H5V6ZM19 13C17.34 13 16 14.34 16 16C16 17.66 17.34 19 19 19C20.66 19 22 17.66 22 16C22 14.34 20.66 13 19 13ZM19 17C18.45 17 18 16.55 18 16C18 15.45 18.45 15 19 15C19.55 15 20 15.45 20 16C20 16.55 19.55 17 19 17Z" fill="black"/>
                                    </svg></i>
                             <span>Pengiriman Obat</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li class="<?php if (!isset($this->uri->segments[3])) {
                                        echo strtolower($this->uri->segments[2]) == 'pengirimanobat' ? 'active' : '';
                                    } ?>">
                                    <a href="<?php echo base_url('admin/PengirimanObat') ?>"><span>Biaya Pengiriman</span></a>
                                </li>
                                <li class="<?php if (isset($this->uri->segments[3])) {echo strtolower($this->uri->segments[3]) == 'status_resep' ? 'active' : '';
                            } ?>">
                                    <a href="<?php echo base_url('admin/PengirimanObat/status_resep') ?>"><span>Pengiriman</span></a>
                                </li>
                                
                            </ul>
                        </li>
                        <!-- <li class="<?php if (!isset($this->uri->segments[3])) {
                                        echo strtolower($this->uri->segments[2]) == 'pengirimanobat' ? 'active' : '';
                                    } ?>">
                            <a href="<?php echo base_url('admin/PengirimanObat') ?>"><i class="fas fa-file-invoice-dollar"></i> <span>Biaya Pengiriman Obat</span></a>
                        </li> -->
                        <li class="submenu">
                            <a href="#" class="<?php //cho strtolower($this->uri->segments[3]) == 'jadwal_dokter' ? 'active' : ''; ?>"><!-- <i class="far fa-calendar-alt"></i> -->
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M5.25 8.25H6.75V9.75H5.25V8.25ZM15.75 4.5V15C15.75 15.825 15.075 16.5 14.25 16.5H3.75C3.35218 16.5 2.97064 16.342 2.68934 16.0607C2.40804 15.7794 2.25 15.3978 2.25 15L2.2575 4.5C2.2575 3.675 2.9175 3 3.75 3H4.5V1.5H6V3H12V1.5H13.5V3H14.25C15.075 3 15.75 3.675 15.75 4.5ZM3.75 6H14.25V4.5H3.75V6ZM14.25 15V7.5H3.75V15H14.25ZM11.25 9.75H12.75V8.25H11.25V9.75ZM8.25 9.75H9.75V8.25H8.25V9.75Z" fill="black"/>
                                    </svg></i>
                             <span>Jadwal</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li class="<?php if (isset($this->uri->segments[3])) {
                                        echo strtolower($this->uri->segments[3]) == 'jadwal_dokter' ? 'active' : '';
                                    } ?>">
                                    <a href="<?php echo base_url('admin/dokter/jadwal_dokter') ?>"><span>Jadwal Dokter</span></a>
                                </li>
                                <li class="<?php echo strtolower($this->uri->segments[2]) == 'teleconsultasi' ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('admin/teleconsultasi') ?>"><span>Jadwal Telekonsultasi</span></a>
                                </li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="#" class="<?php echo strtolower($this->uri->segments[2]) == 'payment' || strtolower($this->uri->segments[2]) == 'history' ? 'active' : ''; ?>"><!-- <i class="fas fa-money-bill"></i>  -->
                                <i class="stroke"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M1.5 5.25C1.5 4.85218 1.65804 4.47064 1.93934 4.18934C2.22064 3.90804 2.60218 3.75 3 3.75H15C15.3978 3.75 15.7794 3.90804 16.0607 4.18934C16.342 4.47064 16.5 4.85218 16.5 5.25V12.75C16.5 13.1478 16.342 13.5294 16.0607 13.8107C15.7794 14.092 15.3978 14.25 15 14.25H3C2.60218 14.25 2.22064 14.092 1.93934 13.8107C1.65804 13.5294 1.5 13.1478 1.5 12.75V5.25Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 11.25C10.2426 11.25 11.25 10.2426 11.25 9C11.25 7.75736 10.2426 6.75 9 6.75C7.75736 6.75 6.75 7.75736 6.75 9C6.75 10.2426 7.75736 11.25 9 11.25Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1.5 6.75C2.29565 6.75 3.05871 6.43393 3.62132 5.87132C4.18393 5.30871 4.5 4.54565 4.5 3.75" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.5 14.25C13.5 13.4544 13.8161 12.6913 14.3787 12.1287C14.9413 11.5661 15.7044 11.25 16.5 11.25" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg></i>
                                <span> Pembayaran </span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li class="<?php echo strtolower($this->uri->segments[2]) == 'payment' ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('admin/payment') ?>"><span>Telekonsultasi</span></a>
                                </li>
                                <li class="<?php echo strtolower($this->uri->segments[2]) == 'pembayaranobat' ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('admin/PembayaranObat') ?>"><span>Obat</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#" class="<?php echo strtolower($this->uri->segments[2]) == 'invoice' ? 'active' : ''; ?>">
                               <!--  <i class="far fa-sticky-note"></i>  -->
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M12.6 2.7C13.2887 2.69996 13.9514 2.96309 14.4524 3.43556C14.9535 3.90802 15.2551 4.5541 15.2955 5.2416L15.3 5.4V9.3411C15.2999 9.76369 15.1511 10.1728 14.8797 10.4967L14.7726 10.6137L10.6137 14.7726C10.3149 15.0714 9.92045 15.2556 9.4995 15.2928L9.3411 15.3H5.4C4.71131 15.3 4.04863 15.0369 3.54756 14.5644C3.04649 14.092 2.7449 13.4459 2.7045 12.7584L2.7 12.6V5.4C2.69996 4.71131 2.96309 4.04864 3.43555 3.54757C3.90801 3.04649 4.55409 2.7449 5.2416 2.7045L5.4 2.7H12.6ZM12.6 3.6H5.4C4.94588 3.59986 4.50849 3.77137 4.1755 4.08015C3.84252 4.38893 3.63856 4.81216 3.6045 5.265L3.6 5.4V12.6C3.59985 13.0541 3.77136 13.4915 4.08014 13.8245C4.38893 14.1575 4.81216 14.3614 5.265 14.3955L5.4 14.4H9V11.7C8.99996 11.0113 9.26309 10.3486 9.73555 9.84757C10.208 9.34649 10.8541 9.0449 11.5416 9.0045L11.7 9H14.4V5.4C14.4001 4.94588 14.2286 4.50849 13.9199 4.17551C13.6111 3.84252 13.1878 3.63856 12.735 3.6045L12.6 3.6ZM14.2047 9.9009L11.7 9.9C11.2459 9.89986 10.8085 10.0714 10.4755 10.3801C10.1425 10.6889 9.93856 11.1122 9.9045 11.565L9.9 11.7V14.2029L9.9774 14.1363L14.1363 9.9774C14.1606 9.9531 14.1831 9.9279 14.2038 9.9009H14.2047Z" fill="black"/>
                                    </svg></i>
                                <span>Laporan</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li class="<?php if (isset($this->uri->segments[3])) {
                                                echo strtolower($this->uri->segments[3]) == 'invoice_diagnosa_terbanyak' ? 'active' : '';
                                            } ?>">
                                    <a href="<?php echo base_url('admin/Invoice/invoice_diagnosa_terbanyak') ?>"><span>Diagnosa Terbanyak</span></a>
                                </li>
                                <li class="<?php if (isset($this->uri->segments[3])) {
                                                echo strtolower($this->uri->segments[3]) == 'invoice_telekonsultasi' ? 'active' : '';
                                            } ?>">
                                    <a href="<?php echo base_url('admin/Invoice/invoice_telekonsultasi') ?>"><span>Telekonsultasi</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="<?php if (isset($this->uri->segments[3])) {
                                        echo strtolower($this->uri->segments[3]) == 'antrian_pasien' ? 'active' : '';
                                    } ?>">
                            <a href="<?php echo base_url('admin/pasien/antrian_pasien') ?>"><!-- <i class="fas fa-stream"></i> -->
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M5.625 3.375H15.75V4.5H5.625V3.375Z" fill="black"/>
                                    <path d="M5.625 6.75H15.75V7.875H5.625V6.75Z" fill="black"/>
                                    <path d="M8.4375 10.125H15.75V11.25H8.4375V10.125Z" fill="black"/>
                                    <path d="M5.625 13.5H15.75V14.625H5.625V13.5Z" fill="black"/>
                                    <path d="M2.25 7.875L6.1875 10.6875L2.25 13.5V7.875Z" fill="black"/>
                                    </svg></i>
                             <span>Antrian Pasien</span></a>
                        </li>
                        <li>
                            
                        </li>
                        <li class="d-mobile-none<?php echo strtolower($this->uri->segments[2]) == 'news' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('admin/news') ?>"><!-- <i class="fa fa-newspaper-o"></i> --> 
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M14.0625 15H3.9375C3.3149 15 2.71588 14.7618 2.26333 14.3342C1.81078 13.9067 1.539 13.3221 1.50375 12.7005L1.5 12.5625V4.6875C1.49995 4.25991 1.66222 3.84823 1.95403 3.53569C2.24583 3.22314 2.64541 3.03302 3.072 3.00375L3.1875 3H12.5625C12.9901 2.99995 13.4018 3.16222 13.7143 3.45403C14.0269 3.74583 14.217 4.14541 14.2463 4.572L14.25 4.6875V5.25H14.8125C15.2401 5.24995 15.6518 5.41222 15.9643 5.70403C16.2769 5.99583 16.467 6.39541 16.4963 6.822L16.5 6.9375V12.5625C16.5 13.1851 16.2618 13.7841 15.8342 14.2367C15.4067 14.6892 14.8221 14.961 14.2005 14.9963L14.0625 15H3.9375H14.0625ZM3.9375 13.875H14.0625C14.392 13.875 14.7095 13.751 14.9518 13.5277C15.1941 13.3044 15.3436 12.9982 15.3705 12.6697L15.375 12.5625V6.9375C15.375 6.80157 15.3258 6.67024 15.2364 6.5678C15.1471 6.46536 15.0237 6.39874 14.889 6.38025L14.8125 6.375H14.25V12.1875C14.25 12.3234 14.2008 12.4548 14.1114 12.5572C14.0221 12.6596 13.8987 12.7263 13.764 12.7448L13.6875 12.75C13.5516 12.75 13.4202 12.7008 13.3178 12.6114C13.2154 12.5221 13.1487 12.3987 13.1302 12.264L13.125 12.1875V4.6875C13.125 4.55157 13.0758 4.42024 12.9864 4.3178C12.8971 4.21536 12.7737 4.14874 12.639 4.13025L12.5625 4.125H3.1875C3.05157 4.12501 2.92024 4.17423 2.8178 4.26358C2.71536 4.35292 2.64874 4.47633 2.63025 4.611L2.625 4.6875V12.5625C2.62501 12.8919 2.74888 13.2092 2.97201 13.4515C3.19514 13.6938 3.50122 13.8434 3.8295 13.8705L3.9375 13.875H14.0625H3.9375ZM9.1845 10.875H11.439C11.5815 10.875 11.7187 10.9292 11.8228 11.0265C11.927 11.1238 11.9903 11.257 12 11.3992C12.0097 11.5413 11.9651 11.6819 11.8752 11.7925C11.7852 11.903 11.6567 11.9753 11.5155 11.9948L11.439 12H9.1845C9.04198 12 8.90479 11.9458 8.80066 11.8485C8.69652 11.7512 8.63319 11.618 8.62348 11.4758C8.61377 11.3337 8.65839 11.1931 8.74832 11.0825C8.83826 10.972 8.96681 10.8997 9.108 10.8802L9.1845 10.875H11.439H9.1845ZM6.93225 8.25375C7.08143 8.25375 7.22451 8.31301 7.33 8.4185C7.43549 8.52399 7.49475 8.66707 7.49475 8.81625V11.4375C7.49475 11.5867 7.43549 11.7298 7.33 11.8352C7.22451 11.9407 7.08143 12 6.93225 12H4.311C4.16182 12 4.01874 11.9407 3.91325 11.8352C3.80776 11.7298 3.7485 11.5867 3.7485 11.4375V8.81625C3.7485 8.66707 3.80776 8.52399 3.91325 8.4185C4.01874 8.31301 4.16182 8.25375 4.311 8.25375H6.93225ZM6.36975 9.37875H4.8735V10.875H6.36975V9.37875ZM9.1845 8.25375H11.439C11.5815 8.25379 11.7187 8.30793 11.8228 8.40523C11.927 8.50253 11.9903 8.63572 12 8.77791C12.0097 8.9201 11.9651 9.06067 11.8752 9.17122C11.7852 9.28178 11.6567 9.35407 11.5155 9.3735L11.439 9.37875H9.1845C9.04097 9.38021 8.90231 9.32674 8.79691 9.2293C8.69152 9.13185 8.62736 8.9978 8.61759 8.85459C8.60781 8.71139 8.65315 8.56986 8.74432 8.45899C8.83549 8.34813 8.9656 8.27631 9.108 8.25825L9.1845 8.25375H11.439H9.1845ZM4.311 5.6265H11.439C11.5825 5.62504 11.7212 5.67851 11.8266 5.77595C11.932 5.8734 11.9961 6.00745 12.0059 6.15066C12.0157 6.29386 11.9704 6.43539 11.8792 6.54626C11.788 6.65712 11.6579 6.72894 11.5155 6.747L11.439 6.7515H4.311C4.16848 6.75146 4.03129 6.69732 3.92716 6.60002C3.82302 6.50272 3.75969 6.36953 3.74998 6.22734C3.74027 6.08515 3.78489 5.94458 3.87482 5.83403C3.96476 5.72347 4.09331 5.65118 4.2345 5.63175L4.311 5.6265H11.439H4.311V5.6265Z" fill="black"/>
                                    </svg></i>
                                <span>Berita</span></a>
                        </li> 
                        <li class="d-mobile-none <?php echo strtolower($this->uri->segments[2]) == 'resep_obat' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('admin/Config/resep_obat') ?>"><i class="fas fa-file-invoice"></i><span>Pengaturan Resep Obat</span></a>
                        </li>
                        <li class="d-mobile-none mb-5 pb-5 <?php echo strtolower($this->uri->segments[2]) == 'pengaturanweb' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('admin/PengaturanWeb') ?>"><i class="fa fa-wrench"></i> <span>Pengaturan Web</span></a>
                        </li> 

                       
                        <li class="d-mobile-show<?php echo strtolower($this->uri->segments[2]) == 'news' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('admin/news') ?>"><!-- <i class="fa fa-newspaper-o"></i> -->
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M14.0625 15H3.9375C3.3149 15 2.71588 14.7618 2.26333 14.3342C1.81078 13.9067 1.539 13.3221 1.50375 12.7005L1.5 12.5625V4.6875C1.49995 4.25991 1.66222 3.84823 1.95403 3.53569C2.24583 3.22314 2.64541 3.03302 3.072 3.00375L3.1875 3H12.5625C12.9901 2.99995 13.4018 3.16222 13.7143 3.45403C14.0269 3.74583 14.217 4.14541 14.2463 4.572L14.25 4.6875V5.25H14.8125C15.2401 5.24995 15.6518 5.41222 15.9643 5.70403C16.2769 5.99583 16.467 6.39541 16.4963 6.822L16.5 6.9375V12.5625C16.5 13.1851 16.2618 13.7841 15.8342 14.2367C15.4067 14.6892 14.8221 14.961 14.2005 14.9963L14.0625 15H3.9375H14.0625ZM3.9375 13.875H14.0625C14.392 13.875 14.7095 13.751 14.9518 13.5277C15.1941 13.3044 15.3436 12.9982 15.3705 12.6697L15.375 12.5625V6.9375C15.375 6.80157 15.3258 6.67024 15.2364 6.5678C15.1471 6.46536 15.0237 6.39874 14.889 6.38025L14.8125 6.375H14.25V12.1875C14.25 12.3234 14.2008 12.4548 14.1114 12.5572C14.0221 12.6596 13.8987 12.7263 13.764 12.7448L13.6875 12.75C13.5516 12.75 13.4202 12.7008 13.3178 12.6114C13.2154 12.5221 13.1487 12.3987 13.1302 12.264L13.125 12.1875V4.6875C13.125 4.55157 13.0758 4.42024 12.9864 4.3178C12.8971 4.21536 12.7737 4.14874 12.639 4.13025L12.5625 4.125H3.1875C3.05157 4.12501 2.92024 4.17423 2.8178 4.26358C2.71536 4.35292 2.64874 4.47633 2.63025 4.611L2.625 4.6875V12.5625C2.62501 12.8919 2.74888 13.2092 2.97201 13.4515C3.19514 13.6938 3.50122 13.8434 3.8295 13.8705L3.9375 13.875H14.0625H3.9375ZM9.1845 10.875H11.439C11.5815 10.875 11.7187 10.9292 11.8228 11.0265C11.927 11.1238 11.9903 11.257 12 11.3992C12.0097 11.5413 11.9651 11.6819 11.8752 11.7925C11.7852 11.903 11.6567 11.9753 11.5155 11.9948L11.439 12H9.1845C9.04198 12 8.90479 11.9458 8.80066 11.8485C8.69652 11.7512 8.63319 11.618 8.62348 11.4758C8.61377 11.3337 8.65839 11.1931 8.74832 11.0825C8.83826 10.972 8.96681 10.8997 9.108 10.8802L9.1845 10.875H11.439H9.1845ZM6.93225 8.25375C7.08143 8.25375 7.22451 8.31301 7.33 8.4185C7.43549 8.52399 7.49475 8.66707 7.49475 8.81625V11.4375C7.49475 11.5867 7.43549 11.7298 7.33 11.8352C7.22451 11.9407 7.08143 12 6.93225 12H4.311C4.16182 12 4.01874 11.9407 3.91325 11.8352C3.80776 11.7298 3.7485 11.5867 3.7485 11.4375V8.81625C3.7485 8.66707 3.80776 8.52399 3.91325 8.4185C4.01874 8.31301 4.16182 8.25375 4.311 8.25375H6.93225ZM6.36975 9.37875H4.8735V10.875H6.36975V9.37875ZM9.1845 8.25375H11.439C11.5815 8.25379 11.7187 8.30793 11.8228 8.40523C11.927 8.50253 11.9903 8.63572 12 8.77791C12.0097 8.9201 11.9651 9.06067 11.8752 9.17122C11.7852 9.28178 11.6567 9.35407 11.5155 9.3735L11.439 9.37875H9.1845C9.04097 9.38021 8.90231 9.32674 8.79691 9.2293C8.69152 9.13185 8.62736 8.9978 8.61759 8.85459C8.60781 8.71139 8.65315 8.56986 8.74432 8.45899C8.83549 8.34813 8.9656 8.27631 9.108 8.25825L9.1845 8.25375H11.439H9.1845ZM4.311 5.6265H11.439C11.5825 5.62504 11.7212 5.67851 11.8266 5.77595C11.932 5.8734 11.9961 6.00745 12.0059 6.15066C12.0157 6.29386 11.9704 6.43539 11.8792 6.54626C11.788 6.65712 11.6579 6.72894 11.5155 6.747L11.439 6.7515H4.311C4.16848 6.75146 4.03129 6.69732 3.92716 6.60002C3.82302 6.50272 3.75969 6.36953 3.74998 6.22734C3.74027 6.08515 3.78489 5.94458 3.87482 5.83403C3.96476 5.72347 4.09331 5.65118 4.2345 5.63175L4.311 5.6265H11.439H4.311V5.6265Z" fill="black"/>
                                    </svg></i>
                             <span>Berita</span></a>
                        </li>
                        <li class="d-mobile-show<?php echo strtolower($this->uri->segments[2]) == 'pengaturanweb' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('admin/PengaturanWeb') ?>"><i class="fa fa-wrench"></i> <span>Pengaturan Web</span></a>
                        </li>
                        
                        <li class="d-mobile-show <?php echo strtolower($this->uri->segments[2]) == 'news' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('admin/Profil'); ?>"><!-- <i class="fas fa-cog"></i> -->
                            <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M1.719 6.6447C2.05155 5.61787 2.59784 4.67314 3.3219 3.8727C3.38175 3.80656 3.4599 3.7597 3.54643 3.73807C3.63296 3.71644 3.72397 3.72101 3.8079 3.7512L5.5341 4.3686C5.65699 4.41248 5.78795 4.42912 5.9179 4.41735C6.04786 4.40559 6.17371 4.3657 6.28671 4.30047C6.39972 4.23523 6.4972 4.1462 6.57238 4.03954C6.64755 3.93289 6.69864 3.81116 6.7221 3.6828L7.0506 1.8774C7.06651 1.78951 7.10821 1.70835 7.1704 1.64424C7.23258 1.58013 7.31244 1.53598 7.3998 1.5174C8.45447 1.29275 9.54463 1.29275 10.5993 1.5174C10.6867 1.53598 10.7665 1.58013 10.8287 1.64424C10.8909 1.70835 10.9326 1.78951 10.9485 1.8774L11.2779 3.6828C11.3014 3.81116 11.3524 3.93289 11.4276 4.03954C11.5028 4.1462 11.6003 4.23523 11.7133 4.30047C11.8263 4.3657 11.9521 4.40559 12.0821 4.41735C12.2121 4.42912 12.343 4.41248 12.4659 4.3686L14.193 3.7512C14.2769 3.72131 14.3678 3.71698 14.4541 3.73877C14.5405 3.76056 14.6184 3.80748 14.6781 3.8736C15.4017 4.67386 15.9477 5.61827 16.2801 6.6447C16.3075 6.72949 16.3092 6.82051 16.2848 6.90623C16.2605 6.99195 16.2112 7.06851 16.1433 7.1262L14.7438 8.3142C14.6444 8.39869 14.5645 8.50378 14.5098 8.6222C14.455 8.74062 14.4266 8.86953 14.4266 9C14.4266 9.13047 14.455 9.25938 14.5098 9.3778C14.5645 9.49622 14.6444 9.60131 14.7438 9.6858L16.1433 10.8738C16.2112 10.9315 16.2605 11.0081 16.2848 11.0938C16.3092 11.1795 16.3075 11.2705 16.2801 11.3553C15.9478 12.3821 15.4018 13.3268 14.6781 14.1273C14.6183 14.1934 14.5401 14.2403 14.4536 14.2619C14.367 14.2836 14.276 14.279 14.1921 14.2488L12.4659 13.6314C12.343 13.5875 12.2121 13.5709 12.0821 13.5826C11.9521 13.5944 11.8263 13.6343 11.7133 13.6995C11.6003 13.7648 11.5028 13.8538 11.4276 13.9605C11.3524 14.0671 11.3014 14.1888 11.2779 14.3172L10.9476 16.1235C10.9316 16.2111 10.8899 16.292 10.8279 16.3559C10.7659 16.4198 10.6864 16.4639 10.5993 16.4826C9.54464 16.7073 8.45446 16.7073 7.3998 16.4826C7.31244 16.464 7.23258 16.4199 7.1704 16.3558C7.10821 16.2917 7.06651 16.2105 7.0506 16.1226L6.7221 14.3172C6.69864 14.1888 6.64755 14.0671 6.57238 13.9605C6.4972 13.8538 6.39972 13.7648 6.28671 13.6995C6.17371 13.6343 6.04786 13.5944 5.9179 13.5826C5.78795 13.5709 5.65699 13.5875 5.5341 13.6314L3.807 14.2488C3.7231 14.2787 3.63223 14.283 3.54587 14.2612C3.45952 14.2394 3.38157 14.1925 3.3219 14.1264C2.59825 13.3262 2.05227 12.3817 1.7199 11.3553C1.69246 11.2705 1.69082 11.1795 1.71517 11.0938C1.73953 11.0081 1.78878 10.9315 1.8567 10.8738L3.2562 9.6858C3.35562 9.60131 3.43548 9.49622 3.49025 9.3778C3.54501 9.25938 3.57338 9.13047 3.57338 9C3.57338 8.86953 3.54501 8.74062 3.49025 8.6222C3.43548 8.50378 3.35562 8.39869 3.2562 8.3142L1.8567 7.1262C1.78878 7.06851 1.73953 6.99195 1.71517 6.90623C1.69082 6.82051 1.69246 6.72949 1.7199 6.6447H1.719ZM2.6739 6.6393L3.8385 7.6275C4.03764 7.79648 4.19763 8.00677 4.30736 8.24377C4.41709 8.48078 4.47392 8.73883 4.47392 9C4.47392 9.26118 4.41709 9.51922 4.30736 9.75623C4.19763 9.99323 4.03764 10.2035 3.8385 10.3725L2.6739 11.3607C2.9367 12.0645 3.3165 12.7197 3.7944 13.2975L5.2308 12.7845C5.47664 12.6967 5.73862 12.6635 5.99859 12.6871C6.25856 12.7107 6.51029 12.7905 6.73632 12.9211C6.96235 13.0516 7.15728 13.2298 7.30759 13.4432C7.4579 13.6566 7.56 13.9002 7.6068 14.157L7.8813 15.6582C8.62169 15.7816 9.37741 15.7816 10.1178 15.6582L10.3923 14.1552C10.4392 13.8985 10.5414 13.655 10.6917 13.4417C10.8421 13.2284 11.0371 13.0503 11.2631 12.9199C11.4891 12.7894 11.7408 12.7096 12.0007 12.6861C12.2606 12.6626 12.5225 12.6958 12.7683 12.7836L14.2056 13.2975C14.6844 12.7188 15.0631 12.0642 15.3261 11.3607L14.1615 10.3725C13.9621 10.2037 13.8018 9.99346 13.6919 9.75643C13.582 9.51941 13.5251 9.26127 13.5251 9C13.5251 8.73873 13.582 8.4806 13.6919 8.24357C13.8018 8.00654 13.9621 7.79631 14.1615 7.6275L15.3261 6.6393C15.0631 5.93579 14.6844 5.28117 14.2056 4.7025L12.7692 5.2155C12.5234 5.30326 12.2615 5.33653 12.0016 5.313C11.7417 5.28947 11.49 5.20971 11.264 5.07923C11.0379 4.94876 10.843 4.7707 10.6926 4.55739C10.5423 4.34408 10.4401 4.10063 10.3932 3.8439L10.1178 2.3418C9.37741 2.21836 8.62169 2.21836 7.8813 2.3418L7.6077 3.8439C7.5609 4.10071 7.4588 4.34426 7.30849 4.55767C7.15818 4.77109 6.96325 4.94925 6.73722 5.07982C6.51119 5.21039 6.25946 5.29024 5.99949 5.31382C5.73953 5.3374 5.47754 5.30416 5.2317 5.2164L3.7944 4.7025C3.31562 5.28118 2.93691 5.93579 2.6739 6.6393V6.6393ZM6.75 9C6.75 8.40326 6.98705 7.83097 7.40901 7.40901C7.83097 6.98705 8.40326 6.75 9 6.75C9.59674 6.75 10.169 6.98705 10.591 7.40901C11.0129 7.83097 11.25 8.40326 11.25 9C11.25 9.59674 11.0129 10.169 10.591 10.591C10.169 11.0129 9.59674 11.25 9 11.25C8.40326 11.25 7.83097 11.0129 7.40901 10.591C6.98705 10.169 6.75 9.59674 6.75 9ZM7.65 9C7.65 9.35804 7.79223 9.70142 8.04541 9.9546C8.29858 10.2078 8.64196 10.35 9 10.35C9.35804 10.35 9.70142 10.2078 9.95459 9.9546C10.2078 9.70142 10.35 9.35804 10.35 9C10.35 8.64196 10.2078 8.29858 9.95459 8.04541C9.70142 7.79223 9.35804 7.65 9 7.65C8.64196 7.65 8.29858 7.79223 8.04541 8.04541C7.79223 8.29858 7.65 8.64196 7.65 9V9Z" fill="black"/>
                                </svg></i>
                         <span>Pengaturan</span></a>
                        </li>
                        <li class="d-mobile-show <?php echo strtolower($this->uri->segments[2]) == 'news' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('logout') ?>"><!-- <i class="fas fa-sign-out-alt"></i> --> 
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M3 9C3 9.19891 3.07902 9.38968 3.21967 9.53033C3.36032 9.67098 3.55109 9.75 3.75 9.75H9.4425L7.7175 11.4675C7.6472 11.5372 7.59141 11.6202 7.55333 11.7116C7.51526 11.803 7.49565 11.901 7.49565 12C7.49565 12.099 7.51526 12.197 7.55333 12.2884C7.59141 12.3798 7.6472 12.4628 7.7175 12.5325C7.78722 12.6028 7.87017 12.6586 7.96157 12.6967C8.05296 12.7347 8.15099 12.7543 8.25 12.7543C8.34901 12.7543 8.44704 12.7347 8.53843 12.6967C8.62983 12.6586 8.71278 12.6028 8.7825 12.5325L11.7825 9.5325C11.8508 9.46117 11.9043 9.37706 11.94 9.285C12.015 9.1024 12.015 8.8976 11.94 8.715C11.9043 8.62294 11.8508 8.53883 11.7825 8.4675L8.7825 5.4675C8.71257 5.39757 8.62955 5.3421 8.53819 5.30426C8.44682 5.26641 8.34889 5.24693 8.25 5.24693C8.15111 5.24693 8.05318 5.26641 7.96181 5.30426C7.87045 5.3421 7.78743 5.39757 7.7175 5.4675C7.64757 5.53743 7.5921 5.62045 7.55426 5.71181C7.51641 5.80318 7.49693 5.90111 7.49693 6C7.49693 6.09889 7.51641 6.19682 7.55426 6.28819C7.5921 6.37955 7.64757 6.46257 7.7175 6.5325L9.4425 8.25H3.75C3.55109 8.25 3.36032 8.32902 3.21967 8.46967C3.07902 8.61032 3 8.80109 3 9V9ZM12.75 1.5H5.25C4.65326 1.5 4.08097 1.73705 3.65901 2.15901C3.23705 2.58097 3 3.15326 3 3.75V6C3 6.19891 3.07902 6.38968 3.21967 6.53033C3.36032 6.67098 3.55109 6.75 3.75 6.75C3.94891 6.75 4.13968 6.67098 4.28033 6.53033C4.42098 6.38968 4.5 6.19891 4.5 6V3.75C4.5 3.55109 4.57902 3.36032 4.71967 3.21967C4.86032 3.07902 5.05109 3 5.25 3H12.75C12.9489 3 13.1397 3.07902 13.2803 3.21967C13.421 3.36032 13.5 3.55109 13.5 3.75V14.25C13.5 14.4489 13.421 14.6397 13.2803 14.7803C13.1397 14.921 12.9489 15 12.75 15H5.25C5.05109 15 4.86032 14.921 4.71967 14.7803C4.57902 14.6397 4.5 14.4489 4.5 14.25V12C4.5 11.8011 4.42098 11.6103 4.28033 11.4697C4.13968 11.329 3.94891 11.25 3.75 11.25C3.55109 11.25 3.36032 11.329 3.21967 11.4697C3.07902 11.6103 3 11.8011 3 12V14.25C3 14.8467 3.23705 15.419 3.65901 15.841C4.08097 16.2629 4.65326 16.5 5.25 16.5H12.75C13.3467 16.5 13.919 16.2629 14.341 15.841C14.7629 15.419 15 14.8467 15 14.25V3.75C15 3.15326 14.7629 2.58097 14.341 2.15901C13.919 1.73705 13.3467 1.5 12.75 1.5Z" fill="black"/>
                                    </svg></i>
                                <span>Keluar</span></a>
                        </li>
                        <!-- <li class="<?php if (!isset($this->uri->segments[3])) {
                                        echo strtolower($this->uri->segments[2]) == 'pengirimanobat' ? 'active' : '';
                                    } ?>">
                            <a href="<?php echo base_url('admin/PengirimanObat') ?>"><i class="fas fa-file-invoice-dollar"></i> <span>Biaya Pengiriman Obat</span></a>
                        </li> -->
                        <!-- <li class="submenu <?php echo strtolower($this->uri->segments[2]) == 'obat' || strtolower($this->uri->segments[2]) == 'kategoriobat' ? 'active' : ''; ?>">
                                <a href="#"><i class="fa fa-plus-circle"></i> <span> Obat </span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li class="<?php if (isset($this->uri->segments[3])) {
                                                    echo strtolower($this->uri->segments[3]) == 'manage_obat' ? 'active' : '';
                                                } ?>">
                                        <a href="<?php echo base_url('admin/Obat/manage_obat') ?>">Obat</a>
                                    </li class="<?php if (isset($this->uri->segments[2])) {
                                                    echo strtolower($this->uri->segments[2]) == 'kategoriobat' ? 'active' : '';
                                                } ?>">
                                    <li><a href="<?php echo base_url('admin/KategoriObat') ?>">Kategori Obat</a></li>
                                </ul>
                            </li> -->
                        
                        <!-- <li class="<?php if (isset($this->uri->segments[3])) {
                                        echo strtolower($this->uri->segments[3]) == 'jadwal_dokter' ? 'active' : '';
                                    } ?>">
                            <a href="<?php echo base_url('admin/dokter/jadwal_dokter') ?>"><i class="fa fa-calendar-check-o"></i> <span>Jadwal Dokter</span></a>
                        </li> -->
                        <!-- <li class="<?php echo strtolower($this->uri->segments[2]) == 'selfassesment' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('admin/selfAssesment') ?>"><i class="fa fa-check-square"></i> <span>Assesment Pasien</span></a>
                        </li> -->
                        <!-- <li class="<?php echo strtolower($this->uri->segments[2]) == 'teleconsultasi' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('admin/teleconsultasi') ?>"><i class="fa fa-calendar-check-o"></i> <span>Jadwal Telekonsultasi</span></a>
                        </li> -->
                        
                        <!-- <li class="submenu">
                            <a href="#" class="<?php echo strtolower($this->uri->segments[2]) == 'invoice' ? 'active' : ''; ?>"><i class="fas fa-file-invoice"></i> <span>Laporan</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li class="<?php if (isset($this->uri->segments[3])) {
                                                echo strtolower($this->uri->segments[3]) == 'invoice_diagnosa_terbanyak' ? 'active' : '';
                                            } ?>">
                                    <a href="<?php echo base_url('admin/Invoice/invoice_diagnosa_terbanyak') ?>"><span>Diagnosa Terbanyak</span></a>
                                </li>
                                <li class="<?php if (isset($this->uri->segments[3])) {
                                                echo strtolower($this->uri->segments[3]) == 'invoice_telekonsultasi' ? 'active' : '';
                                            } ?>">
                                    <a href="<?php echo base_url('admin/Invoice/invoice_telekonsultasi') ?>"><span>Telekonsultasi</span></a>
                                </li>
                                <li class="<?php if (isset($this->uri->segments[3])) {
                                                echo strtolower($this->uri->segments[3]) == 'invoice_owlexa_konsultasi' ? 'active' : '';
                                            } ?>">
                                    <a href="<?php echo base_url('admin/Invoice/invoice_owlexa_konsultasi') ?>"><span>Owlexa Telekonsultasi</span></a>
                                </li>
                                <li class="<?php if (isset($this->uri->segments[3])) {
                                                echo strtolower($this->uri->segments[3]) == 'invoice_owlexa_obat' ? 'active' : '';
                                            } ?>">
                                    <a href="<?php echo base_url('admin/Invoice/invoice_owlexa_obat') ?>"><span>Owlexa Obat</span></a>
                                </li>
                            </ul>
                        </li> -->
                        <!-- <li class="<?php echo strtolower($this->uri->segments[2]) == 'logactivity' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('admin/LogActivity') ?>"><i class="fa fa-cog"></i> <span>Log Activity</span></a>
                        </li> -->
                        <!-- <li class="mb-3<?php echo strtolower($this->uri->segments[2]) == 'pengaturanweb' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('admin/PengaturanWeb') ?>"><i class="fa fa-wrench"></i> <span>Pengaturan Web</span></a>
                        </li> -->
                        <!-- <li class="mb-5 <?php echo strtolower($this->uri->segments[2]) == 'reminder' ? 'active' : ''; ?>">
                                <a href="<?php echo base_url('admin/Reminder') ?>"><i class="fa fa-clock"></i> <span>Pengingat Jadwal</span></a>
                            </li> -->
                     <?php } else { ?>
                        <li class="<?php echo strtolower($this->uri->segments[2]) == 'farmasiverifikasiobat' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('admin/FarmasiVerifikasiObat') ?>">
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M12.45 8.16L11.385 7.095L8.20499 10.2825L6.61499 8.685L5.54999 9.75L8.20499 12.405L12.45 8.16Z" fill="black"/>
                                <path d="M14.25 3H3.75C3.35218 3 2.97064 3.15804 2.68934 3.43934C2.40804 3.72064 2.25 4.10218 2.25 4.5V13.5C2.25 13.8978 2.40804 14.2794 2.68934 14.5607C2.97064 14.842 3.35218 15 3.75 15H14.25C15.075 15 15.75 14.325 15.75 13.5V4.5C15.75 4.10218 15.592 3.72064 15.3107 3.43934C15.0294 3.15804 14.6478 3 14.25 3ZM14.25 13.5H3.75V6H14.25V13.5Z" fill="black"/>
                                </svg></i> 
                                    <span>Verifikasi Resep</span></a>
                        </li>
                        <li class="<?php echo strtolower($this->uri->segments[2]) == 'homecare' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('admin/homecare/FarmasiVerifikasiObat') ?>">
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M12.45 8.16L11.385 7.095L8.20499 10.2825L6.61499 8.685L5.54999 9.75L8.20499 12.405L12.45 8.16Z" fill="black"/>
                                <path d="M14.25 3H3.75C3.35218 3 2.97064 3.15804 2.68934 3.43934C2.40804 3.72064 2.25 4.10218 2.25 4.5V13.5C2.25 13.8978 2.40804 14.2794 2.68934 14.5607C2.97064 14.842 3.35218 15 3.75 15H14.25C15.075 15 15.75 14.325 15.75 13.5V4.5C15.75 4.10218 15.592 3.72064 15.3107 3.43934C15.0294 3.15804 14.6478 3 14.25 3ZM14.25 13.5H3.75V6H14.25V13.5Z" fill="black"/>
                                </svg></i> 
                                    <span>Verifikasi Resep Homecare</span></a>
                        </li>
                        <li class="d-mobile-show">
                        <a href="<?php echo base_url('admin/Profil'); ?>"><!-- <i class="fas fa-cog"></i> -->
                            <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M1.719 6.6447C2.05155 5.61787 2.59784 4.67314 3.3219 3.8727C3.38175 3.80656 3.4599 3.7597 3.54643 3.73807C3.63296 3.71644 3.72397 3.72101 3.8079 3.7512L5.5341 4.3686C5.65699 4.41248 5.78795 4.42912 5.9179 4.41735C6.04786 4.40559 6.17371 4.3657 6.28671 4.30047C6.39972 4.23523 6.4972 4.1462 6.57238 4.03954C6.64755 3.93289 6.69864 3.81116 6.7221 3.6828L7.0506 1.8774C7.06651 1.78951 7.10821 1.70835 7.1704 1.64424C7.23258 1.58013 7.31244 1.53598 7.3998 1.5174C8.45447 1.29275 9.54463 1.29275 10.5993 1.5174C10.6867 1.53598 10.7665 1.58013 10.8287 1.64424C10.8909 1.70835 10.9326 1.78951 10.9485 1.8774L11.2779 3.6828C11.3014 3.81116 11.3524 3.93289 11.4276 4.03954C11.5028 4.1462 11.6003 4.23523 11.7133 4.30047C11.8263 4.3657 11.9521 4.40559 12.0821 4.41735C12.2121 4.42912 12.343 4.41248 12.4659 4.3686L14.193 3.7512C14.2769 3.72131 14.3678 3.71698 14.4541 3.73877C14.5405 3.76056 14.6184 3.80748 14.6781 3.8736C15.4017 4.67386 15.9477 5.61827 16.2801 6.6447C16.3075 6.72949 16.3092 6.82051 16.2848 6.90623C16.2605 6.99195 16.2112 7.06851 16.1433 7.1262L14.7438 8.3142C14.6444 8.39869 14.5645 8.50378 14.5098 8.6222C14.455 8.74062 14.4266 8.86953 14.4266 9C14.4266 9.13047 14.455 9.25938 14.5098 9.3778C14.5645 9.49622 14.6444 9.60131 14.7438 9.6858L16.1433 10.8738C16.2112 10.9315 16.2605 11.0081 16.2848 11.0938C16.3092 11.1795 16.3075 11.2705 16.2801 11.3553C15.9478 12.3821 15.4018 13.3268 14.6781 14.1273C14.6183 14.1934 14.5401 14.2403 14.4536 14.2619C14.367 14.2836 14.276 14.279 14.1921 14.2488L12.4659 13.6314C12.343 13.5875 12.2121 13.5709 12.0821 13.5826C11.9521 13.5944 11.8263 13.6343 11.7133 13.6995C11.6003 13.7648 11.5028 13.8538 11.4276 13.9605C11.3524 14.0671 11.3014 14.1888 11.2779 14.3172L10.9476 16.1235C10.9316 16.2111 10.8899 16.292 10.8279 16.3559C10.7659 16.4198 10.6864 16.4639 10.5993 16.4826C9.54464 16.7073 8.45446 16.7073 7.3998 16.4826C7.31244 16.464 7.23258 16.4199 7.1704 16.3558C7.10821 16.2917 7.06651 16.2105 7.0506 16.1226L6.7221 14.3172C6.69864 14.1888 6.64755 14.0671 6.57238 13.9605C6.4972 13.8538 6.39972 13.7648 6.28671 13.6995C6.17371 13.6343 6.04786 13.5944 5.9179 13.5826C5.78795 13.5709 5.65699 13.5875 5.5341 13.6314L3.807 14.2488C3.7231 14.2787 3.63223 14.283 3.54587 14.2612C3.45952 14.2394 3.38157 14.1925 3.3219 14.1264C2.59825 13.3262 2.05227 12.3817 1.7199 11.3553C1.69246 11.2705 1.69082 11.1795 1.71517 11.0938C1.73953 11.0081 1.78878 10.9315 1.8567 10.8738L3.2562 9.6858C3.35562 9.60131 3.43548 9.49622 3.49025 9.3778C3.54501 9.25938 3.57338 9.13047 3.57338 9C3.57338 8.86953 3.54501 8.74062 3.49025 8.6222C3.43548 8.50378 3.35562 8.39869 3.2562 8.3142L1.8567 7.1262C1.78878 7.06851 1.73953 6.99195 1.71517 6.90623C1.69082 6.82051 1.69246 6.72949 1.7199 6.6447H1.719ZM2.6739 6.6393L3.8385 7.6275C4.03764 7.79648 4.19763 8.00677 4.30736 8.24377C4.41709 8.48078 4.47392 8.73883 4.47392 9C4.47392 9.26118 4.41709 9.51922 4.30736 9.75623C4.19763 9.99323 4.03764 10.2035 3.8385 10.3725L2.6739 11.3607C2.9367 12.0645 3.3165 12.7197 3.7944 13.2975L5.2308 12.7845C5.47664 12.6967 5.73862 12.6635 5.99859 12.6871C6.25856 12.7107 6.51029 12.7905 6.73632 12.9211C6.96235 13.0516 7.15728 13.2298 7.30759 13.4432C7.4579 13.6566 7.56 13.9002 7.6068 14.157L7.8813 15.6582C8.62169 15.7816 9.37741 15.7816 10.1178 15.6582L10.3923 14.1552C10.4392 13.8985 10.5414 13.655 10.6917 13.4417C10.8421 13.2284 11.0371 13.0503 11.2631 12.9199C11.4891 12.7894 11.7408 12.7096 12.0007 12.6861C12.2606 12.6626 12.5225 12.6958 12.7683 12.7836L14.2056 13.2975C14.6844 12.7188 15.0631 12.0642 15.3261 11.3607L14.1615 10.3725C13.9621 10.2037 13.8018 9.99346 13.6919 9.75643C13.582 9.51941 13.5251 9.26127 13.5251 9C13.5251 8.73873 13.582 8.4806 13.6919 8.24357C13.8018 8.00654 13.9621 7.79631 14.1615 7.6275L15.3261 6.6393C15.0631 5.93579 14.6844 5.28117 14.2056 4.7025L12.7692 5.2155C12.5234 5.30326 12.2615 5.33653 12.0016 5.313C11.7417 5.28947 11.49 5.20971 11.264 5.07923C11.0379 4.94876 10.843 4.7707 10.6926 4.55739C10.5423 4.34408 10.4401 4.10063 10.3932 3.8439L10.1178 2.3418C9.37741 2.21836 8.62169 2.21836 7.8813 2.3418L7.6077 3.8439C7.5609 4.10071 7.4588 4.34426 7.30849 4.55767C7.15818 4.77109 6.96325 4.94925 6.73722 5.07982C6.51119 5.21039 6.25946 5.29024 5.99949 5.31382C5.73953 5.3374 5.47754 5.30416 5.2317 5.2164L3.7944 4.7025C3.31562 5.28118 2.93691 5.93579 2.6739 6.6393V6.6393ZM6.75 9C6.75 8.40326 6.98705 7.83097 7.40901 7.40901C7.83097 6.98705 8.40326 6.75 9 6.75C9.59674 6.75 10.169 6.98705 10.591 7.40901C11.0129 7.83097 11.25 8.40326 11.25 9C11.25 9.59674 11.0129 10.169 10.591 10.591C10.169 11.0129 9.59674 11.25 9 11.25C8.40326 11.25 7.83097 11.0129 7.40901 10.591C6.98705 10.169 6.75 9.59674 6.75 9ZM7.65 9C7.65 9.35804 7.79223 9.70142 8.04541 9.9546C8.29858 10.2078 8.64196 10.35 9 10.35C9.35804 10.35 9.70142 10.2078 9.95459 9.9546C10.2078 9.70142 10.35 9.35804 10.35 9C10.35 8.64196 10.2078 8.29858 9.95459 8.04541C9.70142 7.79223 9.35804 7.65 9 7.65C8.64196 7.65 8.29858 7.79223 8.04541 8.04541C7.79223 8.29858 7.65 8.64196 7.65 9V9Z" fill="black"/>
                                </svg></i>
                         <span>Pengaturan</span></a>
                        </li>
                        <li class="d-mobile-show">
                            <a href="<?php echo base_url('logout') ?>"><!-- <i class="fas fa-sign-out-alt"></i> --> 
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M3 9C3 9.19891 3.07902 9.38968 3.21967 9.53033C3.36032 9.67098 3.55109 9.75 3.75 9.75H9.4425L7.7175 11.4675C7.6472 11.5372 7.59141 11.6202 7.55333 11.7116C7.51526 11.803 7.49565 11.901 7.49565 12C7.49565 12.099 7.51526 12.197 7.55333 12.2884C7.59141 12.3798 7.6472 12.4628 7.7175 12.5325C7.78722 12.6028 7.87017 12.6586 7.96157 12.6967C8.05296 12.7347 8.15099 12.7543 8.25 12.7543C8.34901 12.7543 8.44704 12.7347 8.53843 12.6967C8.62983 12.6586 8.71278 12.6028 8.7825 12.5325L11.7825 9.5325C11.8508 9.46117 11.9043 9.37706 11.94 9.285C12.015 9.1024 12.015 8.8976 11.94 8.715C11.9043 8.62294 11.8508 8.53883 11.7825 8.4675L8.7825 5.4675C8.71257 5.39757 8.62955 5.3421 8.53819 5.30426C8.44682 5.26641 8.34889 5.24693 8.25 5.24693C8.15111 5.24693 8.05318 5.26641 7.96181 5.30426C7.87045 5.3421 7.78743 5.39757 7.7175 5.4675C7.64757 5.53743 7.5921 5.62045 7.55426 5.71181C7.51641 5.80318 7.49693 5.90111 7.49693 6C7.49693 6.09889 7.51641 6.19682 7.55426 6.28819C7.5921 6.37955 7.64757 6.46257 7.7175 6.5325L9.4425 8.25H3.75C3.55109 8.25 3.36032 8.32902 3.21967 8.46967C3.07902 8.61032 3 8.80109 3 9V9ZM12.75 1.5H5.25C4.65326 1.5 4.08097 1.73705 3.65901 2.15901C3.23705 2.58097 3 3.15326 3 3.75V6C3 6.19891 3.07902 6.38968 3.21967 6.53033C3.36032 6.67098 3.55109 6.75 3.75 6.75C3.94891 6.75 4.13968 6.67098 4.28033 6.53033C4.42098 6.38968 4.5 6.19891 4.5 6V3.75C4.5 3.55109 4.57902 3.36032 4.71967 3.21967C4.86032 3.07902 5.05109 3 5.25 3H12.75C12.9489 3 13.1397 3.07902 13.2803 3.21967C13.421 3.36032 13.5 3.55109 13.5 3.75V14.25C13.5 14.4489 13.421 14.6397 13.2803 14.7803C13.1397 14.921 12.9489 15 12.75 15H5.25C5.05109 15 4.86032 14.921 4.71967 14.7803C4.57902 14.6397 4.5 14.4489 4.5 14.25V12C4.5 11.8011 4.42098 11.6103 4.28033 11.4697C4.13968 11.329 3.94891 11.25 3.75 11.25C3.55109 11.25 3.36032 11.329 3.21967 11.4697C3.07902 11.6103 3 11.8011 3 12V14.25C3 14.8467 3.23705 15.419 3.65901 15.841C4.08097 16.2629 4.65326 16.5 5.25 16.5H12.75C13.3467 16.5 13.919 16.2629 14.341 15.841C14.7629 15.419 15 14.8467 15 14.25V3.75C15 3.15326 14.7629 2.58097 14.341 2.15901C13.919 1.73705 13.3467 1.5 12.75 1.5Z" fill="black"/>
                                    </svg></i>
                                <span>Keluar</span></a>
                        </li>
                    <?php } ?>
                    <!-- <div class="border-5 mx-3"></div>
                    <li class="pt-3">
                        <?php
                            if (strtolower($this->uri->segments[1]) == 'pasien') {
                              $profil_url = base_url('pasien/Profile');
                              $settings_url = base_url('pasien/KonfigurasiAkun');
                            } else if (strtolower($this->uri->segments[1]) == 'dokter') {
                              $profil_url = base_url('dokter/Profile');
                              $settings_url = base_url('dokter/KonfigurasiAkun');
                            } else {
                              $profil_url = base_url('admin/Profil');
                              $settings_url = base_url('admin/KonfigurasiAkun');
                            }
                        ?>
                         <a href="<?php echo $profil_url ?>"><i class="fas fa-cog"></i> <span>Pengaturan</span></a>
                    </li>
                    <li class="mb-5">
                         <a href="<?php echo base_url('logout') ?>"><i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a>
                    </li> -->
                    
                    
                </ul>
            </div>
        </div>

                    
        <div class="sidebar-footer">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <div class="pt-3"></div>
                    <hr class="mx-3" color="white">
                    <li class="pt-0">
                        <a href="<?php echo base_url('admin/Profil'); ?>"><!-- <i class="fas fa-cog"></i> -->
                            <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M1.719 6.6447C2.05155 5.61787 2.59784 4.67314 3.3219 3.8727C3.38175 3.80656 3.4599 3.7597 3.54643 3.73807C3.63296 3.71644 3.72397 3.72101 3.8079 3.7512L5.5341 4.3686C5.65699 4.41248 5.78795 4.42912 5.9179 4.41735C6.04786 4.40559 6.17371 4.3657 6.28671 4.30047C6.39972 4.23523 6.4972 4.1462 6.57238 4.03954C6.64755 3.93289 6.69864 3.81116 6.7221 3.6828L7.0506 1.8774C7.06651 1.78951 7.10821 1.70835 7.1704 1.64424C7.23258 1.58013 7.31244 1.53598 7.3998 1.5174C8.45447 1.29275 9.54463 1.29275 10.5993 1.5174C10.6867 1.53598 10.7665 1.58013 10.8287 1.64424C10.8909 1.70835 10.9326 1.78951 10.9485 1.8774L11.2779 3.6828C11.3014 3.81116 11.3524 3.93289 11.4276 4.03954C11.5028 4.1462 11.6003 4.23523 11.7133 4.30047C11.8263 4.3657 11.9521 4.40559 12.0821 4.41735C12.2121 4.42912 12.343 4.41248 12.4659 4.3686L14.193 3.7512C14.2769 3.72131 14.3678 3.71698 14.4541 3.73877C14.5405 3.76056 14.6184 3.80748 14.6781 3.8736C15.4017 4.67386 15.9477 5.61827 16.2801 6.6447C16.3075 6.72949 16.3092 6.82051 16.2848 6.90623C16.2605 6.99195 16.2112 7.06851 16.1433 7.1262L14.7438 8.3142C14.6444 8.39869 14.5645 8.50378 14.5098 8.6222C14.455 8.74062 14.4266 8.86953 14.4266 9C14.4266 9.13047 14.455 9.25938 14.5098 9.3778C14.5645 9.49622 14.6444 9.60131 14.7438 9.6858L16.1433 10.8738C16.2112 10.9315 16.2605 11.0081 16.2848 11.0938C16.3092 11.1795 16.3075 11.2705 16.2801 11.3553C15.9478 12.3821 15.4018 13.3268 14.6781 14.1273C14.6183 14.1934 14.5401 14.2403 14.4536 14.2619C14.367 14.2836 14.276 14.279 14.1921 14.2488L12.4659 13.6314C12.343 13.5875 12.2121 13.5709 12.0821 13.5826C11.9521 13.5944 11.8263 13.6343 11.7133 13.6995C11.6003 13.7648 11.5028 13.8538 11.4276 13.9605C11.3524 14.0671 11.3014 14.1888 11.2779 14.3172L10.9476 16.1235C10.9316 16.2111 10.8899 16.292 10.8279 16.3559C10.7659 16.4198 10.6864 16.4639 10.5993 16.4826C9.54464 16.7073 8.45446 16.7073 7.3998 16.4826C7.31244 16.464 7.23258 16.4199 7.1704 16.3558C7.10821 16.2917 7.06651 16.2105 7.0506 16.1226L6.7221 14.3172C6.69864 14.1888 6.64755 14.0671 6.57238 13.9605C6.4972 13.8538 6.39972 13.7648 6.28671 13.6995C6.17371 13.6343 6.04786 13.5944 5.9179 13.5826C5.78795 13.5709 5.65699 13.5875 5.5341 13.6314L3.807 14.2488C3.7231 14.2787 3.63223 14.283 3.54587 14.2612C3.45952 14.2394 3.38157 14.1925 3.3219 14.1264C2.59825 13.3262 2.05227 12.3817 1.7199 11.3553C1.69246 11.2705 1.69082 11.1795 1.71517 11.0938C1.73953 11.0081 1.78878 10.9315 1.8567 10.8738L3.2562 9.6858C3.35562 9.60131 3.43548 9.49622 3.49025 9.3778C3.54501 9.25938 3.57338 9.13047 3.57338 9C3.57338 8.86953 3.54501 8.74062 3.49025 8.6222C3.43548 8.50378 3.35562 8.39869 3.2562 8.3142L1.8567 7.1262C1.78878 7.06851 1.73953 6.99195 1.71517 6.90623C1.69082 6.82051 1.69246 6.72949 1.7199 6.6447H1.719ZM2.6739 6.6393L3.8385 7.6275C4.03764 7.79648 4.19763 8.00677 4.30736 8.24377C4.41709 8.48078 4.47392 8.73883 4.47392 9C4.47392 9.26118 4.41709 9.51922 4.30736 9.75623C4.19763 9.99323 4.03764 10.2035 3.8385 10.3725L2.6739 11.3607C2.9367 12.0645 3.3165 12.7197 3.7944 13.2975L5.2308 12.7845C5.47664 12.6967 5.73862 12.6635 5.99859 12.6871C6.25856 12.7107 6.51029 12.7905 6.73632 12.9211C6.96235 13.0516 7.15728 13.2298 7.30759 13.4432C7.4579 13.6566 7.56 13.9002 7.6068 14.157L7.8813 15.6582C8.62169 15.7816 9.37741 15.7816 10.1178 15.6582L10.3923 14.1552C10.4392 13.8985 10.5414 13.655 10.6917 13.4417C10.8421 13.2284 11.0371 13.0503 11.2631 12.9199C11.4891 12.7894 11.7408 12.7096 12.0007 12.6861C12.2606 12.6626 12.5225 12.6958 12.7683 12.7836L14.2056 13.2975C14.6844 12.7188 15.0631 12.0642 15.3261 11.3607L14.1615 10.3725C13.9621 10.2037 13.8018 9.99346 13.6919 9.75643C13.582 9.51941 13.5251 9.26127 13.5251 9C13.5251 8.73873 13.582 8.4806 13.6919 8.24357C13.8018 8.00654 13.9621 7.79631 14.1615 7.6275L15.3261 6.6393C15.0631 5.93579 14.6844 5.28117 14.2056 4.7025L12.7692 5.2155C12.5234 5.30326 12.2615 5.33653 12.0016 5.313C11.7417 5.28947 11.49 5.20971 11.264 5.07923C11.0379 4.94876 10.843 4.7707 10.6926 4.55739C10.5423 4.34408 10.4401 4.10063 10.3932 3.8439L10.1178 2.3418C9.37741 2.21836 8.62169 2.21836 7.8813 2.3418L7.6077 3.8439C7.5609 4.10071 7.4588 4.34426 7.30849 4.55767C7.15818 4.77109 6.96325 4.94925 6.73722 5.07982C6.51119 5.21039 6.25946 5.29024 5.99949 5.31382C5.73953 5.3374 5.47754 5.30416 5.2317 5.2164L3.7944 4.7025C3.31562 5.28118 2.93691 5.93579 2.6739 6.6393V6.6393ZM6.75 9C6.75 8.40326 6.98705 7.83097 7.40901 7.40901C7.83097 6.98705 8.40326 6.75 9 6.75C9.59674 6.75 10.169 6.98705 10.591 7.40901C11.0129 7.83097 11.25 8.40326 11.25 9C11.25 9.59674 11.0129 10.169 10.591 10.591C10.169 11.0129 9.59674 11.25 9 11.25C8.40326 11.25 7.83097 11.0129 7.40901 10.591C6.98705 10.169 6.75 9.59674 6.75 9ZM7.65 9C7.65 9.35804 7.79223 9.70142 8.04541 9.9546C8.29858 10.2078 8.64196 10.35 9 10.35C9.35804 10.35 9.70142 10.2078 9.95459 9.9546C10.2078 9.70142 10.35 9.35804 10.35 9C10.35 8.64196 10.2078 8.29858 9.95459 8.04541C9.70142 7.79223 9.35804 7.65 9 7.65C8.64196 7.65 8.29858 7.79223 8.04541 8.04541C7.79223 8.29858 7.65 8.64196 7.65 9V9Z" fill="black"/>
                                </svg></i>
                         <span>Pengaturan</span></a>
                    </li>
                    <li class="mb-5 pb-5">
                        <a href="<?php echo base_url('logout') ?>"><!-- <i class="fas fa-sign-out-alt"></i> -->
                            <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M3 9C3 9.19891 3.07902 9.38968 3.21967 9.53033C3.36032 9.67098 3.55109 9.75 3.75 9.75H9.4425L7.7175 11.4675C7.6472 11.5372 7.59141 11.6202 7.55333 11.7116C7.51526 11.803 7.49565 11.901 7.49565 12C7.49565 12.099 7.51526 12.197 7.55333 12.2884C7.59141 12.3798 7.6472 12.4628 7.7175 12.5325C7.78722 12.6028 7.87017 12.6586 7.96157 12.6967C8.05296 12.7347 8.15099 12.7543 8.25 12.7543C8.34901 12.7543 8.44704 12.7347 8.53843 12.6967C8.62983 12.6586 8.71278 12.6028 8.7825 12.5325L11.7825 9.5325C11.8508 9.46117 11.9043 9.37706 11.94 9.285C12.015 9.1024 12.015 8.8976 11.94 8.715C11.9043 8.62294 11.8508 8.53883 11.7825 8.4675L8.7825 5.4675C8.71257 5.39757 8.62955 5.3421 8.53819 5.30426C8.44682 5.26641 8.34889 5.24693 8.25 5.24693C8.15111 5.24693 8.05318 5.26641 7.96181 5.30426C7.87045 5.3421 7.78743 5.39757 7.7175 5.4675C7.64757 5.53743 7.5921 5.62045 7.55426 5.71181C7.51641 5.80318 7.49693 5.90111 7.49693 6C7.49693 6.09889 7.51641 6.19682 7.55426 6.28819C7.5921 6.37955 7.64757 6.46257 7.7175 6.5325L9.4425 8.25H3.75C3.55109 8.25 3.36032 8.32902 3.21967 8.46967C3.07902 8.61032 3 8.80109 3 9V9ZM12.75 1.5H5.25C4.65326 1.5 4.08097 1.73705 3.65901 2.15901C3.23705 2.58097 3 3.15326 3 3.75V6C3 6.19891 3.07902 6.38968 3.21967 6.53033C3.36032 6.67098 3.55109 6.75 3.75 6.75C3.94891 6.75 4.13968 6.67098 4.28033 6.53033C4.42098 6.38968 4.5 6.19891 4.5 6V3.75C4.5 3.55109 4.57902 3.36032 4.71967 3.21967C4.86032 3.07902 5.05109 3 5.25 3H12.75C12.9489 3 13.1397 3.07902 13.2803 3.21967C13.421 3.36032 13.5 3.55109 13.5 3.75V14.25C13.5 14.4489 13.421 14.6397 13.2803 14.7803C13.1397 14.921 12.9489 15 12.75 15H5.25C5.05109 15 4.86032 14.921 4.71967 14.7803C4.57902 14.6397 4.5 14.4489 4.5 14.25V12C4.5 11.8011 4.42098 11.6103 4.28033 11.4697C4.13968 11.329 3.94891 11.25 3.75 11.25C3.55109 11.25 3.36032 11.329 3.21967 11.4697C3.07902 11.6103 3 11.8011 3 12V14.25C3 14.8467 3.23705 15.419 3.65901 15.841C4.08097 16.2629 4.65326 16.5 5.25 16.5H12.75C13.3467 16.5 13.919 16.2629 14.341 15.841C14.7629 15.419 15 14.8467 15 14.25V3.75C15 3.15326 14.7629 2.58097 14.341 2.15901C13.919 1.73705 13.3467 1.5 12.75 1.5Z" fill="black"/>
                                </svg></i>
                         <span>Keluar</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<style>
    hr{
        height: 8px;
        border: 0;
        box-shadow: 0 10px 10px -10px #fff inset;
    }
</style>