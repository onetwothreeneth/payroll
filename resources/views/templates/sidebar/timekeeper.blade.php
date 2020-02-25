<?php    

    $sidebar = array(
        array(
            'type'    => '1', 
            'url'     => 'login', 
            'icon'    => 'home', 
            'name'    => 'Dashboard', 
            'active'  => 'dashboard', 
        ),
        array(
            'type'    => '1', 
            'url'     => 'audit_trail', 
            'icon'    => 'chain-broken', 
            'name'    => 'Audit Trail', 
            'active'  => 'audittrail', 
        ),  
        array(
            'type'    => '2', 
            'icon'    => 'clock-o', 
            'name'    => 'Timekeeping', 
            'active'  => 'timekeeping', 
            'data'    => array(
                array( 
                    'url'     => 'timekeeping', 
                    'name'    => 'Records'
                ),
                array( 
                    'url'     => 'timekeeping_add', 
                    'name'    => 'Add new'
                ) 
            ) 
        ),
        array(
            'type'    => '2', 
            'icon'    => 'cogs', 
            'name'    => 'Settings', 
            'active'  => 'settings', 
            'data'    => array(
                array( 
                    'url'     => 'login', 
                    'name'    => 'Company Setup'
                ),
                array( 
                    'url'     => 'login', 
                    'name'    => 'Account Settings'
                ) 
            ) 
        ),
        array(
            'type'    => '1', 
            'confirm' => 'confirm', 
            'url'     => 'logout', 
            'icon'    => 'sign-in', 
            'name'    => 'Logout', 
            'active'  => 'logout', 
        )
    );
?>
<div class="o-page__sidebar js-page-sidebar">
    <div class="c-sidebar">
        <a class="c-sidebar__brand"> 
            <img class="c-sidebar__brand-img" src="{{ URL::asset('assets/logo.png') }}" alt="Logo" style="width: 50%; margin-left: 15%;"> 
        </a>
        
        <h4 class="c-sidebar__title">Dashboard</h4>
        <ul class="c-sidebar__list"> 
            @foreach($sidebar as  $i => $v)
                @if($v['type'] == 1) 
                    @if($active == $v['active'])
                        <li class="c-sidebar__item active">
                            <a class="c-sidebar__link" href="{{ URL::route(''.$v['url'].'') }}">
                                <i class="fa fa-{{ $v['icon'] }} u-mr-xsmall"></i>
                                {{ $v['name'] }}
                            </a>
                        </li> 
                    @else
                        @if(@$v['confirm'])
                            <li class="c-sidebar__item">
                                <a class="c-sidebar__link confirm" href="{{ URL::route(''.$v['url'].'') }}">
                                    <i class="fa fa-{{ $v['icon'] }} u-mr-xsmall"></i>
                                    {{ $v['name'] }}
                                </a>
                            </li> 
                        @else
                            <li class="c-sidebar__item">
                                <a class="c-sidebar__link" href="{{ URL::route(''.$v['url'].'') }}">
                                    <i class="fa fa-{{ $v['icon'] }} u-mr-xsmall"></i>
                                    {{ $v['name'] }}
                                </a>
                            </li> 
                        @endif 
                    @endif
                @else
                    @if($active == $v['active'])
                        <li class="c-sidebar__item has-submenu is-open">
                            <a class="c-sidebar__link active" data-toggle="collapse" href="#sidebar-submenu" aria-expanded="true" aria-controls="sidebar-submenu">
                                <i class="fa fa-{{ $v['icon'] }} u-mr-xsmall"></i> {{ $v['name'] }}
                            </a>
                            <ul class="c-sidebar__submenu collapse show" id="sidebar-submenu">
                                @foreach($v['data'] as $k)
                                    @if(@$k['data'])
                                        <li><a class="c-sidebar__link" href="{{ URL::route(''.$k['url'].'',$k['data']) }}">{{ $k['name'] }}</a></li> 
                                    @else
                                        <li><a class="c-sidebar__link" href="{{ URL::route(''.$k['url'].'') }}">{{ $k['name'] }}</a></li> 
                                    @endif
                                @endforeach 
                            </ul>
                        </li> 
                    @else
                        <li class="c-sidebar__item has-submenu">
                            <a class="c-sidebar__link" data-toggle="collapse" href="#sidebar-submenu_{{ $i }}" aria-expanded="false" aria-controls="sidebar-submenu_{{ $i }}">
                                <i class="fa fa-{{ $v['icon'] }} u-mr-xsmall"></i> {{ $v['name'] }}
                            </a>
                            <ul class="c-sidebar__submenu collapse" id="sidebar-submenu_{{ $i }}">
                                @foreach($v['data'] as $k)
                                    @if(@$k['data'])
                                        <li><a class="c-sidebar__link" href="{{ URL::route(''.$k['url'].'',$k['data']) }}">{{ $k['name'] }}</a></li> 
                                    @else
                                        <li><a class="c-sidebar__link" href="{{ URL::route(''.$k['url'].'') }}">{{ $k['name'] }}</a></li> 
                                    @endif
                                @endforeach 
                            </ul>
                        </li> 
                    @endif
                @endif
            @endforeach  
        </ul>  
    </div> 
</div> 