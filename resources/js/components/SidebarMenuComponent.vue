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
      <li class="nav-item">
        <a class="nav-link" href="#category-menus" data-toggle="collapse" aria-expanded="false" aria-controls="category-menus">
          <i class="mdi mdi-view-list menu-icon"></i>
          <span class="menu-title">Product Categories</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="category-menus" style="">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <router-link class="nav-link" to="/product-categories">Categories Master</router-link></li>
            <li class="nav-item"> <router-link class="nav-link" to="/product-child-categories">Categories Child</router-link></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/products">
          <i class="mdi mdi-dropbox menu-icon"></i>
          <span class="menu-title">Products</span>
        </router-link>

      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/promotion">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Promotion</span>
        </router-link>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#system" data-toggle="collapse" aria-expanded="false" aria-controls="system">
          <i class="mdi mdi-select-inverse menu-icon"></i>
          <span class="menu-title">Integration</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="system" style="">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <router-link class="nav-link" to="/integration/backend">Backend</router-link></li>
            <li class="nav-item"> <router-link class="nav-link" to="/integration/frontend">Frontend</router-link></li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
</template>
