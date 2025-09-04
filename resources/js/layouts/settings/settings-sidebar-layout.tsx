import { SettingsContent } from '@/components/settings-content';
import { SettingsShell } from '@/components/settings-shell';
import { SettingsSidebar } from '@/components/settings-sidebar';
import { SettingsSidebarHeader } from '@/components/settings-sidebar-header';
import { type BreadcrumbItem } from '@/types';
import { type PropsWithChildren } from 'react';

export default function SettingsSidebarLayout({ children, breadcrumbs = [] }: PropsWithChildren<{ breadcrumbs?: BreadcrumbItem[] }>) {
    return (
        <SettingsShell variant="sidebar">
            <SettingsSidebar />
            <SettingsContent variant="sidebar" className="overflow-x-hidden">
                <SettingsSidebarHeader breadcrumbs={breadcrumbs} />
                {children}
            </SettingsContent>
        </SettingsShell>
    );
}
