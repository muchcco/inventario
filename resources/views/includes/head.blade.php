<!-- begin:: Header Topbar -->
<div class="kt-header__topbar">
                    <!--begin: User Bar -->
                    <div class="kt-header__topbar-item kt-header__topbar-item--user">
                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                            <div class="kt-header__topbar-user">
                                <span class="kt-header__topbar-welcome kt-hidden-mobile">Hola, </span>
                                <span class="kt-header__topbar-username kt-hidden-mobile">{{ Auth::user()->name }} </span>
                                <img class="kt-hidden" alt="Pic" src="{{ asset('assets/media/users/300_25.jpg')}}" />
                                <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                <span
                                    class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ substr(Auth::user()->name,0,1) }}
                                </span>
                            </div>
                        </div>

                        <div
                            class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
                            <!--begin: Head -->
                            <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
                                style="background-image: url({{ asset('assets/media/misc/bg-1.jpg)')}}">
                                <div class="kt-user-card__avatar">
                                    <img class="kt-hidden" alt="Pic"
                                        src="{{ asset('assets/media/users/300_25.jpg')}}" />
                                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                    <span
                                        class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{ substr(Auth::user()->name,0,1) }}
                                    </span>
                                </div>
                                <div class="kt-user-card__name">
                                    {{ Auth::user()->name }}
                                </div>
                            </div>
                            <!--end: Head -->
                            <!--begin: Navigation -->
                            <div class="kt-notification">
                                <a
                                    class="kt-notification__item quitar_after" style="">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-calendar-3 kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            Nombre
                                        </div>
                                        <div class="kt-notification__item-time ">
                                            {{ Auth::user()->name }}
                                        </div>
                                    </div>
                                </a>
                                <a class="kt-notification__item quitar_after">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-mail kt-font-warning"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            Correo
                                        </div>
                                        <div class="kt-notification__item-time">
                                            {{ Auth::user()->email }}
                                        </div>
                                    </div>
                                </a>
                                <a  class="kt-notification__item quitar_after" >
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-rocket-1 kt-font-danger"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            Dependencia
                                        </div>
                                        <div class="kt-notification__item-time">
                                            {{ Auth::user()->dependencias->Nombre }}
                                        </div>
                                    </div>
                                </a>
                                <a  class="kt-notification__item quitar_after">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-hourglass kt-font-brand"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            Rol
                                        </div>
                                        <div class="kt-notification__item-time">
                                            {{ Auth::user()->role->nombre }}
                                        </div>
                                    </div>
                                </a>
                                <div class="kt-notification__custom kt-space-between">
                                    <a href="{{ route('logout') }}"
                                        class="btn btn-label btn-label-brand btn-sm btn-bold">Cerrar sesion</a>
                                </div>
                            </div>
                            <!--end: Navigation -->

                        </div>
                    </div>
                    <!--end: User Bar -->
                </div>
<style>
    .kt-notification .quitar_after:after{
        content: none !important;
    }
</style>
