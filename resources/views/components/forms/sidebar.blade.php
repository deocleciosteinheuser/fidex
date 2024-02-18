                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="/" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle" aria-expanded="false">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            @foreach($consultas as $key => $subItem)
                                <li class="w-100">
                                    <a href="{{ route('card.' . $subItem['route']) }}" class="nav-link px-0"> <span class="d-none d-sm-inline">{{$subItem['title']}}</span> </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="#submenuorders" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Orders</span>
                        </a>
                        <ul class="collapse nav flex-column ms-1" id="submenuorders" data-bs-parent="#menu">
                            @foreach($consultas as $key => $subItem)
                                <li class="w-100">
                                    <a href="{{ route('consultas.' . $subItem['route']) }}" class="nav-link px-0"> <span class="d-none d-sm-inline">{{$subItem['title']}}</span> </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="#submenucustomers" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span>
                        </a>
                        <ul class="collapse nav flex-column ms-1" id="submenucustomers" data-bs-parent="#menu">
                            @foreach($customers as $key => $subItem)
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">{{$subItem->nome}}</span> </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
