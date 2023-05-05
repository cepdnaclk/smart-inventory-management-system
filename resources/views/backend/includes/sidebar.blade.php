<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <!-- <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
        <use xlink:href="{{ asset('img/brand/coreui.svg#full') }}"></use>
    </svg>
    <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
    <use xlink:href="{{ asset('img/brand/coreui.svg#signet') }}"></use>
</svg> -->
    </div>
    <!--c-sidebar-brand-->

    <ul class="c-sidebar-nav">

        @if ($logged_in_user->isUser())
            <li class="c-sidebar-nav-item">
                <x-utils.link
                        class="c-sidebar-nav-link"
                        :href="route('frontend.user.dashboard')"
                        :active="activeClass(Route::is('frontend.user.dashboard'), 'c-active')"
                        icon="c-sidebar-nav-icon cil-speedometer"
                        :text="__('Dashboard')"></x-utils.link>
            </li>
        
        @else
            <li class="c-sidebar-nav-item">
                <x-utils.link
                        class="c-sidebar-nav-link"
                        :href="route('admin.dashboard')"
                        :active="activeClass(Route::is('admin.dashboard'), 'c-active')"
                        icon="c-sidebar-nav-icon cil-speedometer"
                        :text="__('Dashboard')"></x-utils.link>
            </li>

        @endif


        <!-- User  -->
        @if ($logged_in_user->isUser())
            <li class="c-sidebar-nav-item">
                <x-utils.link
                        class="c-sidebar-nav-link"
                        :href="route('frontend.user.account')"
                        :active="activeClass(Route::is('frontend.user.account'), 'c-active')"
                        icon="c-sidebar-nav-icon cil-user"
                        :text="__('Account')"></x-utils.link>
            </li>

            <li class="c-sidebar-nav-item">
                <x-utils.link
                        class="c-sidebar-nav-link"
                        :href="route('frontend.user.products')"
                        :active="activeClass(Route::is('frontend.user.products'), 'c-active')"
                        icon="c-sidebar-nav-icon cil-blur"
                        :text="__('Components')"></x-utils.link>
            </li>

            <li class="c-sidebar-nav-item">
                <x-utils.link
                        class="c-sidebar-nav-link"
                        :href="route('frontend.user.cart')"
                        :active="activeClass(Route::is('frontend.user.cart'), 'c-active')"
                        icon="c-sidebar-nav-icon cil-cart"
                        :text="__('Cart')"></x-utils.link>
            </li>

            <li class="c-sidebar-nav-item">
                <x-utils.link
                        class="c-sidebar-nav-link"
                        :href="route('frontend.user.orders.index')"
                        :active="activeClass(Route::is('frontend.user.orders.index'), 'c-active')"
                        icon="c-sidebar-nav-icon cil-description"
                        :text="__('My orders')"></x-utils.link>
            </li>

            

        @endif


           

        @if (
            $logged_in_user->hasAllAccess() ||
                ($logged_in_user->can('admin.access.user.list') ||
                    $logged_in_user->can('admin.access.user.deactivate') ||
                    $logged_in_user->can('admin.access.user.reactivate') ||
                    $logged_in_user->can('admin.access.user.clear-session') ||
                    $logged_in_user->can('admin.access.user.impersonate') ||
                    $logged_in_user->can('admin.access.user.change-password')))
            <li class="c-sidebar-nav-title">@lang('System')</li>

            <li
                class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.auth.user.*') || Route::is('admin.auth.role.*'), 'c-open c-show') }}">
                <x-utils.link href="#" icon="c-sidebar-nav-icon cil-user" class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Access')"></x-utils.link>

                <ul class="c-sidebar-nav-dropdown-items">
                    @if (
                        $logged_in_user->hasAllAccess() ||
                            ($logged_in_user->can('admin.access.user.list') ||
                                $logged_in_user->can('admin.access.user.deactivate') ||
                                $logged_in_user->can('admin.access.user.reactivate') ||
                                $logged_in_user->can('admin.access.user.clear-session') ||
                                $logged_in_user->can('admin.access.user.impersonate') ||
                                $logged_in_user->can('admin.access.user.change-password')))
                        <li class="c-sidebar-nav-item">
                            <x-utils.link :href="route('admin.auth.user.index')" class="c-sidebar-nav-link" :text="__('User Management')"
                                :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')"></x-utils.link>
                        </li>
                    @endif

                    @if ($logged_in_user->hasAllAccess())
                        <li class="c-sidebar-nav-item">
                            <x-utils.link :href="route('admin.auth.role.index')" class="c-sidebar-nav-link" :text="__('Role Management')"
                                :active="activeClass(Route::is('admin.auth.role.*'), 'c-active')"></x-utils.link>
                        </li>
                    @endif
                </ul>
            </li>
        @endif


        @if ($logged_in_user->hasAllAccess())
            {{-- Annuncements --}}
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link href="#" icon="c-sidebar-nav-icon cil-list" class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Annuncements')"></x-utils.link>

                <ul class="c-sidebar-nav-dropdown-items">
                     <li class="c-sidebar-nav-item">
                            <x-utils.link :href="route('admin.announcements.index')" class="c-sidebar-nav-link" :text="__('Manage')"
                                :active="activeClass(Route::is('admin.announcements.*'), 'c-active')"></x-utils.link>
                        </li>
                </ul>
            </li>
        @endif

        @if ($logged_in_user->hasInventoryAccess())
            {{-- Equipment --}}
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link href="#" icon="c-sidebar-nav-icon cil-list" class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Equipment')"></x-utils.link>

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('admin.equipment.items.index')" class="c-sidebar-nav-link" :text="__('Items')"></x-utils.link>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('admin.equipment.types.index')" class="c-sidebar-nav-link" :text="__('Types')"></x-utils.link>
                    </li>
                </ul>
            </li>

            {{-- Components --}}
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link href="#" icon="c-sidebar-nav-icon cil-list" class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Components')"></x-utils.link>

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('admin.component.items.index')" class="c-sidebar-nav-link" :text="__('Items')"></x-utils.link>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('admin.component.types.index')" class="c-sidebar-nav-link" :text="__('Types')"></x-utils.link>
                    </li>
                </ul>
            </li>

            {{-- Consumables --}}
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link href="#" icon="c-sidebar-nav-icon cil-list" class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Consumables')"></x-utils.link>

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('admin.consumable.items.index')" class="c-sidebar-nav-link" :text="__('Items')"></x-utils.link>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('admin.consumable.types.index')" class="c-sidebar-nav-link" :text="__('Types')"></x-utils.link>
                    </li>

                </ul>
            </li>
        @endif



        {{-- Fabrication Requests --}}
        <li class="c-sidebar-nav-dropdown">
            <x-utils.link href="#" icon="c-sidebar-nav-icon cil-list" class="c-sidebar-nav-dropdown-toggle"
                :text="__('Fabrication Requests')"></x-utils.link>

            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('admin.jobs.student.index')" class="c-sidebar-nav-link" :text="__('Fabrication - User')"></x-utils.link>
                </li>

                @if ($logged_in_user->isLecturer() || $logged_in_user->isAdmin())
                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('admin.jobs.supervisor.index')" class="c-sidebar-nav-link" :text="__('Fabrication - Supervisor')"></x-utils.link>
                    </li>
                @endif

                @if ($logged_in_user->isTechOfficer() || $logged_in_user->isAdmin())
                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('admin.jobs.officer.index')" class="c-sidebar-nav-link" :text="__('Fabrication - Technical Officer')"></x-utils.link>
                    </li>
                @endif

                @if ($logged_in_user->hasInventoryAccess())
                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('admin.machines.index')" class="c-sidebar-nav-link" :text="__('Machines')"></x-utils.link>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('admin.raw_materials.index')" class="c-sidebar-nav-link" :text="__('Raw Materials')"></x-utils.link>
                    </li>
                @endif
            </ul>
        </li>

        {{-- Stations --}}
        <li class="c-sidebar-nav-dropdown">
            <x-utils.link href="#" icon="c-sidebar-nav-icon cil-list" class="c-sidebar-nav-dropdown-toggle"
                :text="__('Stations')"></x-utils.link>

            <ul class="c-sidebar-nav-dropdown-items">


                @if ($logged_in_user->isMaintainer() || $logged_in_user->isAdmin() || $logged_in_user->isTechOfficer())
                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('admin.station.index')" class="c-sidebar-nav-link" :text="__('Stations')"></x-utils.link>
                    </li>

                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('admin.reservation.index')" class="c-sidebar-nav-link" :text="__('Reservations - Maintainer')"></x-utils.link>
                    </li>

                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('frontend.reservation.index')" class="c-sidebar-nav-link" :text="__('Reservations - User')"></x-utils.link>
                    </li>
                @else
                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('frontend.stations.list')" class="c-sidebar-nav-link" :text="__('Stations')"></x-utils.link>
                    </li>

                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('frontend.reservation.index')" class="c-sidebar-nav-link" :text="__('Reservations - User')"></x-utils.link>
                    </li>
                @endif

            </ul>
        </li>

        {{-- Search --}}

        {{-- Order Requests --}}
        @if ($logged_in_user->isLecturer() || $logged_in_user->isTechOfficer() || $logged_in_user->isAdmin())
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link
                        href="#"
                        icon="c-sidebar-nav-icon cil-list"
                        class="c-sidebar-nav-dropdown-toggle"
                        :text="__('Order Requests')"></x-utils.link>
                  

                <ul class="c-sidebar-nav-dropdown-items">
                    

                    @if ($logged_in_user->isAdmin())
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                        
                                    :href="route('admin.orders.index')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Orders')"></x-utils.link>
                        </li>
                    @endif

                    @if ($logged_in_user->isLecturer() || $logged_in_user->isAdmin())
                        @if ($logged_in_user->isHOD() )
                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                :href="route('admin.orders.h_o_d.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Request-Lecturer')"></x-utils.link>
                    </li>  
                        @else
                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                                :href="route('admin.orders.lecturer.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Request-Lecturer')"></x-utils.link>
                    </li>
                        @endif
                    @endif
                    
                    

                    
                    @if ($logged_in_user->isLecturer() || $logged_in_user->isAdmin())
                        @if ($logged_in_user->isHOD())
                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                             
                                    :href="route('admin.orders.h_o_d.accepted.index')"
                    
                                    class="c-sidebar-nav-link"
                                    :text="__('Accepted - Lecturer')"></x-utils.link>
                            </li> 
                        @else
                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                             
                                    :href="route('admin.orders.lecturer.accepted.index')"
                    
                                    class="c-sidebar-nav-link"
                                    :text="__('Accepted - Lecturer')"></x-utils.link>
                            </li> 
                        @endif
                    
                    @endif

                 

            
                    
                    @if ($logged_in_user->isTechOfficer() || $logged_in_user->isAdmin())
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                    :href="route('admin.orders.officer.approved.index')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Approved - Technical Officer')"></x-utils.link>
                        </li>
                    @endif

                    @if ($logged_in_user->isTechOfficer() || $logged_in_user->isAdmin())
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                    :href="route('admin.orders.officer.ready.index')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Ready - Technical Officer')"></x-utils.link>
                        </li>
                    @endif

                    @if ($logged_in_user->isTechOfficer() || $logged_in_user->isAdmin())
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                    :href="route('admin.orders.officer.picked.index')"
                                    class="c-sidebar-nav-link"
                                    :text="__('Picked - Technical Officer')"></x-utils.link>
                        </li>
                    @endif

                    @if ($logged_in_user->isLecturer() || $logged_in_user->isAdmin())
                        @if ($logged_in_user->isHOD())
                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                         
                                    :href="route('admin.orders.h_o_d.rejected.index')"
                
                                    class="c-sidebar-nav-link"
                                    :text="__('Rejected - Lecturer')"></x-utils.link>
                            </li>  
                        @else
                            <li class="c-sidebar-nav-item">
                                <x-utils.link
                         
                                    :href="route('admin.orders.lecturer.rejected.index')"
                
                                    class="c-sidebar-nav-link"
                                    :text="__('Rejected - Lecturer')"></x-utils.link>
                            </li>
                        @endif
                    @endif
                </ul>
            </li>
        @endif

        <li class="c-sidebar-nav-dropdown">
            <x-utils.link href="#" icon="c-sidebar-nav-icon cil-list" class="c-sidebar-nav-dropdown-toggle"
                :text="__('Location Service')"></x-utils.link>

            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('admin.locations.index')" class="c-sidebar-nav-link" :text="__('Locations')"></x-utils.link>
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('admin.search.index')" class="c-sidebar-nav-link" :text="__('Search by item')"></x-utils.link>
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('admin.search.reverse')" class="c-sidebar-nav-link" :text="__('Search by location')"></x-utils.link>
                </li>
                {{--                    <li class="c-sidebar-nav-item"> --}}
                {{--                        <x-utils.link --}}
                {{--                                :href="route('admin.component.types.index')" --}}
                {{--                                class="c-sidebar-nav-link" --}}
                {{--                                :text="__('Types')"></x-utils.link> --}}
                {{--                    </li> --}}
            </ul>
        </li>
        
        {{-- Lockers --}}
        @if ($logged_in_user->isTechOfficer() || $logged_in_user->isAdmin())
        <li class="c-sidebar-nav-dropdown">
            <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-list"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Locker')"></x-utils.link>

            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                            :href="route('admin.locker.details.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Locker Details')"></x-utils.link>
                </li>
            </ul>
        </li>
        @endif
        

        @if ($logged_in_user->hasAllAccess())
            {{-- Logs and Reports --}}
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link href="#" icon="c-sidebar-nav-icon cil-list" class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Logs')"></x-utils.link>

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('log-viewer::dashboard')" class="c-sidebar-nav-link" :text="__('Dashboard')"></x-utils.link>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link :href="route('log-viewer::logs.list')" class="c-sidebar-nav-link" :text="__('Logs')"></x-utils.link>
                    </li>
                </ul>
            </li>
        @endif

        
    </ul>

    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>
</div>
<!--sidebar-->
