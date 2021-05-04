<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav sidebar-dark">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image">
                <img src="{{asset('melody/images/wheel.ico')}}" alt="image"/>
              </div>
              <div class="profile-name">
                <p class="name">
                  Bienvenido {{ Auth::user()->name }}
                </p>
                <p class="designation">
                  
                </p>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">
              <i class="fa fa-home menu-icon"></i>
              <span class="menu-title" style="color: white;">Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('categories.index')}}"> 
              <i class="fas fa-tags menu-icon"></i>
              <span class="menu-title" style="color: white;">Categorías</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('units.index')}}"> 
              <i class="fab fa-product-hunt menu-icon"></i>
              <span class="menu-title" style="color: white;">Unidades Medidas</span>
            </a>
          </li>

<!--           <li class="nav-item">
            <a class="nav-link" href="{{route('categorieswork.index')}}"> 
              <i class="fas fa-car menu-icon"></i>
              <span class="menu-title" style="color: white;">Categorías Taller</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('workshops.index')}}"> 
              <i class="fas fa-store menu-icon"></i>
              <span class="menu-title" style="color: white;">Servicios Taller</span>
            </a>
          </li> -->

          <li class="nav-item">
            <a class="nav-link" href="{{route('providers.index')}}"> 
              <i class="fas fa-shipping-fast menu-icon"></i>
              <span class="menu-title" style="color: white;">Proveedores</span>
            </a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" href="{{route('products.index')}}"> 
              <i class="fas fa-boxes menu-icon"></i>
              <span class="menu-title" style="color: white;">Productos</span>
            </a>
          </li>

                
          <li class="nav-item">
            <a class="nav-link" href="{{route('clients.index')}}"> 
              <i class="fas fa-users menu-icon"></i>
              <span class="menu-title" style="color: white;">Clientes</span>
            </a>
          </li>

                   
          <li class="nav-item">
            <a class="nav-link" href="{{route('purchases.index')}}"> 
              <i class="fas fa-cart-plus menu-icon"></i>
              <span class="menu-title" style="color: white;">Compras</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('sales.index')}}"> 
              <i class="fas fa-shopping-cart menu-icon"></i>
              <span class="menu-title" style="color: white;">Ventas</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('users.index')}}">
                <i class="fas fa-user-tag menu-icon"></i>
                <span class="menu-title" style="color: white;">Usuarios</span>
            </a>
        </li>



        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-taller" aria-expanded="false"
                aria-controls="page-layouts">
                <i class="fas fa-car menu-icon"></i>
                <span class="menu-title" style="color: white;">Taller </span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-taller">
                <ul class="nav flex-column sub-menu">

                 <!-- Categorias taller !-->
            <li class="nav-item">
            <a class="nav-link" href="{{route('categorieswork.index')}}"> 
             
              <span class="menu-title" style="color: white;">Categorías Taller</span>
            </a>


          </li>


          <!-- Servicios taller !-->
          <li class="nav-item">
            <a class="nav-link" href="{{route('workshops.index')}}"> 
              
              <span class="menu-title" style="color: white;">Servicios Taller</span>
            </a>
          </li>

           <!-- Vehiculos taller !-->
                <li class="nav-item">
            <a class="nav-link" href="{{route('cars.index')}}"> 
              
              <span class="menu-title" style="color: white;">Vehículos</span>
            </a>
          </li>

              <!-- Gastos  taller !-->
              <li class="nav-item">
            <a class="nav-link" href="{{route('expenseshop.index')}}"> 
              
              <span class="menu-title" style="color: white;">Gastos</span>
            </a>
          </li>

            <!-- Cotizacion taller !-->
                     <li class="nav-item">
            <a class="nav-link" href="{{route('cotizacions.index')}}"> 
              
              <span class="menu-title" style="color: white;">Cotización</span>
            </a>
          </li>
          

                   
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('roles.index')}}">
                <i class="fas fa-user-cog menu-icon"></i>
                <span class="menu-title" style="color: white;">Roles</span>
            </a>

            <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-layouts1" aria-expanded="false"
                aria-controls="page-layouts">
                <i class="fas fa-chart-line menu-icon"></i>
                <span class="menu-title" style="color: white;">Reportes</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-layouts1">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link" style="color: white;" href="{{route('reports.day')}}">Reportes por día</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: white;" href="{{route('reports.date')}}">Reportes por fecha</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" style="color: white;" href="{{route('report.expense')}}">Gastos Taller</a>
                    </li>
                    
                </ul>
            </div>
        </li>
        
        
         
            <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false"
                aria-controls="page-layouts">
                <i class="fas fa-cogs menu-icon"></i>
                <span class="menu-title" style="color: white;">Configuración</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-layouts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link" style="color: white;" href="{{route('business.index')}}">Empresa</a>
                    </li>
                   
                </ul>
            </div>
        </li>


        </ul>
      </nav>
