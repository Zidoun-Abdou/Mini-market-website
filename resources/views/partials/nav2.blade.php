<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{URL::to('/admin')}}">
                <i class="ti-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="ti-clipboard menu-icon"></i>
                <span class="menu-title">Creation</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{URL::to('/ajoutercategorie')}}">Add category</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{URL::to('/ajouterproduit')}}">Add product</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{URL::to('/ajouterslider')}}">Add slider</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="ti-layout menu-icon"></i>
                <span class="menu-title">Displays</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{URL::to('/categories')}}">All categories </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{URL::to('/produits')}}">All products</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{URL::to('/sliders')}}">All sliders</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{URL::to('/commandes')}}">Commandes</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
<!-- partial -->
