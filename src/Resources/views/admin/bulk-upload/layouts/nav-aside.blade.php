<div class="navbar-left" v-bind:class="{'open': isMenuOpen}">
    <ul class="menubar">
        @foreach ($menu->items as $menuItem)
            <li class="menu-item {{ $menu->getActive($menuItem) }}">
                <a class="menubar-anchor" href="{{ $menuItem['url'] }}">
                    <span class="icon-menu icon {{ $menuItem['icon-class'] }}"></span>

                    <span class="menu-label">{{ trans($menuItem['name']) }}</span>

                    @if (count($menuItem['children']) || $menuItem['key'] == 'configuration')
                        <span
                            class="icon arrow-icon {{ $menu->getActive($menuItem) == 'active' ? 'rotate-arrow-icon' : '' }} {{ core()->getCurrentLocale() && core()->getCurrentLocale()->direction == 'rtl' ? 'arrow-icon-right' : 'arrow-icon-left' }}"></span>
                    @endif
                </a>
                @if ($menuItem['key'] != 'configuration')
                    @if (count($menuItem['children']))
                        <ul class="sub-menubar">
                            @foreach ($menuItem['children'] as $subMenuItem)
                                @if (!core()->getConfigData('bulkupload.settings.general.status') && $subMenuItem['key'] == 'catalog.bulkupload')
                                    <?php continue; ?>
                                @endif
                                <li class="sub-menu-item {{ $menu->getActive($subMenuItem) }}">
                                    <a
                                        href="{{ count($subMenuItem['children']) ? current($subMenuItem['children'])['url'] : $subMenuItem['url'] }}">
                                        <span class="menu-label">{{ trans($subMenuItem['name']) }}</span>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    @endif
                @else
                    <ul class="sub-menubar">
                        @foreach ($config->items as $key => $item)
                            <li class="sub-menu-item {{ $item['key'] == request()->route('slug') ? 'active' : '' }}">
                                <a href="{{ route('admin.configuration.index', $item['key']) }}">
                                    <span class="menu-label">
                                        {{ isset($item['name']) ? trans($item['name']) : '' }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>

    <nav-slide-button id="nav-expand-button" icon-class="accordian-right-icon"></nav-slide-button>
</div>