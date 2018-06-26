    <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div id="sidebar-header" class="sidebar-header">
                <h3>Admin's Navigation Panel</h3>
            </div>

            <ul class="list-unstyled components">
                <h4>Admin's Table</h4>
                <hr class="sideNavHeading">
                
                <li>
                  <a href="<?php echo base_url();?>adminHomeController/viewMainPage">Homepage</a>
                </li>
                <li>
                  <a href="<?php echo base_url();?>adminHomeController/viewUserPage">User Table</a>
                </li>
                <li>
                  <a href="<?php echo base_url();?>adminHomeController/viewTaskLocationPage">Task Location Table</a>
                </li>
                <li>
                  <a href="<?php echo base_url();?>adminHomeController/viewSubTaskPage">Sub Task Table</a>
                </li>
                <li>
                  <a href="<?php echo base_url();?>adminHomeController/viewDutyPage">Duty Table</a>
                </li>
                <li>
                  <a href="<?php echo base_url();?>adminHomeController/viewMorningSchedulePage">Morning Schedule Table</a>
                </li>
                <li>
                  <a href="<?php echo base_url();?>adminHomeController/viewAfternoonSchedulePage">Afternoon Schedule Table</a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>adminHomeController/viewPendingDutyPage">Pending Duty Table</a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>adminHomeController/viewCompleteDutyPage">Complete Duty Table</a>
                </li>
				<li>
                    <a href="<?php echo base_url();?>adminHomeController/viewSpecialDutyPage">Special Duty Table</a>
                </li>
            </ul>
        </nav>

