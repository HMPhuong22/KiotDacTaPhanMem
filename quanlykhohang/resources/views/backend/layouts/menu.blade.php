  <!-- Sidebar Start -->
  <aside class="left-sidebar bg-success">
      <!-- Sidebar scroll-->
      <div>
          <div class="brand-logo d-flex align-items-center justify-content-between">
              {{-- <a href="./index.html" class="text-nowrap logo-img">
                  <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" />
              </a> --}}
              <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                  <i class="ti ti-x fs-8"></i>
              </div>
          </div>
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
              <ul id="sidebarnav">
                  <li class="nav-small-cap">
                      <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                      <span class="hide-menu">Home</span>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="/admin/doanhthu" aria-expanded="false">
                          <span>
                              <i class="ti ti-layout-dashboard"></i>
                          </span>
                          <span class="hide-menu">Dashboard</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('dashboard.index') }}" aria-expanded="false">
                          <span>
                              <i class="ti ti-layout-dashboard"></i>
                          </span>
                          <span class="hide-menu">Report-Statistical</span>
                      </a>
                  </li>
                  {{-- <li class="nav-small-cap">
                      <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                      <span class="hide-menu">Quản Lý</span>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('product.index') }}" aria-expanded="false">
                          <span>
                              <i class="ti ti-article"></i>
                          </span>
                          <span class="hide-menu">Sản Phẩm</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('warehouse.index') }}" aria-expanded="false">
                          <span>
                              <i class="ti ti-article"></i>
                          </span>
                          <span class="hide-menu"> Kho Hàng</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('export.index') }}" aria-expanded="false">
                          <span>
                              <i class="ti ti-article"></i>
                          </span>
                          <span class="hide-menu">Xuất Kho</span>
                      </a>
                  </li> --}}
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('employees.index') }}" aria-expanded="false">
                          <span>
                              <i class="ti ti-user-circle"></i>
                          </span>
                          <span class="hide-menu">Employees</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('warehouse.index') }}" aria-expanded="false">
                          <span>
                              <i class="ti ti-home-question"></i>
                          </span>
                          <span class="hide-menu"> WareHouses</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('products.index') }}" aria-expanded="false">
                          <span>
                              <i class="ti ti-brand-producthunt"></i>
                          </span>
                          <span class="hide-menu">Products</span>
                      </a>
                  </li>

                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('suppliers.index') }}" aria-expanded="false">
                          <span>
                              <i class="ti ti-360-view"></i>
                          </span>
                          <span class="hide-menu">Suppliers</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('customers.index') }}" aria-expanded="false">
                          <span>
                              <i class="ti ti-article"></i>
                          </span>
                          <span class="hide-menu">Customers</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('categorys.index') }}" aria-expanded="false">
                          <span>
                              <i class="ti ti-article"></i>
                          </span>
                          <span class="hide-menu">Category</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('stockins.index') }}" aria-expanded="false">
                          <span>
                              <i class="ti ti-shopping-cart"></i>
                          </span>
                          <span class="hide-menu">Stockins</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('stockouts.index') }}" aria-expanded="false">
                          <span>
                              <i class="ti ti-shopping-cart"></i>
                          </span>
                          <span class="hide-menu">Stockouts</span>
                      </a>
                  </li>
              </ul>

          </nav>
          <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
  </aside>
  <!--  Sidebar End -->
