import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { displayDashboardView } from '@/routes/web/system-admin/dashboard';
import { displayOrganizationsView } from '@/routes/web/system-admin/organization';
import { displayOrganizationAdminsView } from '@/routes/web/system-admin/organization-admin';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/react';
import { Building, LayoutGrid, User } from 'lucide-react';
import AppLogo from './app-logo';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: displayDashboardView(),
        icon: LayoutGrid,
    },
    {
        title: 'Organization',
        href: displayOrganizationsView(),
        icon: Building,
    },
    {
        title: 'Organization Admin',
        href: displayOrganizationAdminsView(),
        icon: User,
    },
];

const footerNavItems: NavItem[] = [];

export function AppSidebar() {
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
