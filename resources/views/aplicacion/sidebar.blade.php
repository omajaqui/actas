<!-- Sidebar -->
<div class="sidebar">
     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->          
         <li @click="menu=0" class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-edit"></i>
             <p>
               Nueva Acta de Visita
               <!-- <span class="right badge badge-danger">New</span> -->
             </p>
           </a>
         </li>
         <li @click="menu=1" class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-copy"></i>
             <p>
               Consultas
             </p>
           </a>
         </li>
         <li @click="menu=2" class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-book"></i>
             <p>
               Pendientes
             </p>
           </a>
         </li>
         <li @click="menu=3" class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-bug"></i>
             <p>
               Reportes
             </p>
           </a>
         </li>
         <li @click="menu=4" class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-question"></i>
             <p>
               Ayuda
             </p>
           </a>
         </li>
       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->