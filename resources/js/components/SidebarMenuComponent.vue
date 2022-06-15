<template>
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <router-link class="nav-link" to="/">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </router-link>

      </li>
      <li class="nav-item">
        <a class="nav-link" href="#users-menus" data-toggle="collapse" aria-expanded="false" aria-controls="users-menus">
          <i class="mdi mdi-account-outline menu-icon"></i>
          <span class="menu-title">Users</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="users-menus" style="">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <router-link class="nav-link" to="/users">Admin User</router-link></li>
            <li class="nav-item"> <router-link class="nav-link" to="/client">Client User</router-link></li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
</template>
