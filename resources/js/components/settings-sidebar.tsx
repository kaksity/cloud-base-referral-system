import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/react';
import { User, Lock, ArrowLeft, ScreenShare } from 'lucide-react';
import AppLogo from './app-logo';
import { displayProfileView } from '@/routes/web/system-admin/settings/profile';
import { displayChangePasswordView } from '@/routes/web/system-admin/settings/password';
import { displayAppearanceView } from '@/routes/web/system-admin/settings/appearance';
import { displayDashboardView } from '@/routes/web/system-admin/dashboard';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: displayDashboardView().url,
        icon: ArrowLeft,
    },
    {
        title: 'Profile',
        href: displayProfileView(),
        icon: User,
    },
    {
        title: 'Password',
        href: displayChangePasswordView(),
        icon: Lock,
    },
    {
        title: 'Appearance',
        href: displayAppearanceView(),
        icon: ScreenShare,
    },
];

const footerNavItems: NavItem[] = [];

export function SettingsSidebar() {
    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href={displayDashboardView()} prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
