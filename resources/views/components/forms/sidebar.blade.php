<div class="position-sticky pt-3">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Menu</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="/" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            @foreach($dashboard as $key => $subItem)
                                <li class="w-100">
                                    <a href="{{ route($subItem['route']) }}" class="nav-link px-0"> <span class="d-none d-sm-inline">{{$subItem['title']}}</span> </a>
                                </li>
                            @endforeach                             
                        </ul>
                    </li>
                    <li>
                        <a href="#submenuorders" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Orders</span>
                        </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenuorders" data-bs-parent="#menu">
                            @foreach($consultas as $key => $subItem)
                                <li class="w-100">
                                    <a href="{{ route($subItem['route']) }}" class="nav-link px-0"> <span class="d-none d-sm-inline">{{$subItem['title']}}</span> </a>
                                </li>
                            @endforeach                             
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1">loser</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
</div>
                                      