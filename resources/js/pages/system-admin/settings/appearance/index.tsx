import { Head } from '@inertiajs/react';

import AppearanceTabs from '@/components/appearance-tabs';
import HeadingSmall from '@/components/heading-small';
import { type BreadcrumbItem } from '@/types';

import SettingsLayout from '@/layouts/settings-layout';
import { displayAppearanceView } from '@/routes/web/system-admin/settings/appearance';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Appearance settings',
        href: displayAppearanceView().url,
    },
];

export default function Appearance() {
    return (
        <SettingsLayout breadcrumbs={breadcrumbs}>
            <Head title="Appearance settings" />
                <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                    <HeadingSmall title="Appearance settings" description="Update your account's appearance settings" />
                    <AppearanceTabs />
                </div>
            
        </SettingsLayout>
    );
}
