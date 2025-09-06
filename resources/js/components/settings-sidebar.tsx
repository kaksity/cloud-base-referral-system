import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { displayDashboardView } from '@/routes/web/system-admin/dashboard';
import { displayAppearanceView } from '@/routes/web/system-admin/settings/appearance';
import { displayChangePasswordView } from '@/routes/web/system-admin/settings/password';
import { displayProfileView } from '@/routes/web/system-admin/settings/profile';
import { displaySectorsView } from '@/routes/web/system-admin/settings/sector';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/react';
import { ArrowLeft, Lock, ScreenShare, User } from 'lucide-react';
import AppLogo from './app-logo';

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
        title: 'Sector',
        href: displaySectorsView(),
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
