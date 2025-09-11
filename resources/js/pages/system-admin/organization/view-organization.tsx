import Avatar from '@/components/system-admin/organization/about/avatar';
import BasicInformation from '@/components/system-admin/organization/about/basic-information';
import AppLayout from '@/layouts/app-layout';
import OrganizationLayout from '@/layouts/custom/view-organization-layout';
import { displayDashboardView } from '@/routes/web/system-admin/dashboard';
import { displayOrganizationsView, displayOrganizationView } from '@/routes/web/system-admin/organization';
import { Head } from '@inertiajs/react';
import { useEffect, useState } from 'react';

interface BreadcrumbItem {
    title: string;
    href: string;
}

interface Organization {
    id: string;
    basic_information: {
        added_by_system_admin: {
            first_name: string;
            last_name: string;
        };
        name: string;
        acronym: string;
        created_at: string;
        description: string;
        office_address: string;
        official_email: string;
    };
}

interface Props {
    organization: Organization;
}

export default function EditEmployeeView({ organization }: Props) {
    const [showActionDropdown, setShowActionDropdown] = useState(false);

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: displayDashboardView().url,
        },
        {
            title: 'Organizations',
            href: displayOrganizationsView().url,
        },
        {
            title: 'About',
            href: displayOrganizationView({ organizationId: organization.id }).url,
        },
    ];

    useEffect(() => {
        function handleClickOutside(event: MouseEvent) {
            if (showActionDropdown && !(event.target as HTMLElement).closest('.action-dropdown-container')) {
                setShowActionDropdown(false);
            }
        }

        document.addEventListener('click', handleClickOutside);
        return () => document.removeEventListener('click', handleClickOutside);
    }, [showActionDropdown]);

    return (
        <>
            <Head title={`Edit Organization: ${organization.basic_information.name}`} />
            <AppLayout breadcrumbs={breadcrumbs}>
                <OrganizationLayout organization={organization} activeTab="about">
                    <div className="flex flex-1 flex-col gap-6 p-4">
                        <div className="grid grid-cols-1 gap-6 lg:grid-cols-4">
                            <Avatar avatar={{ id: organization.id, name: organization.basic_information.name }} />
                            <BasicInformation organizationId={organization.id} basicInformation={organization.basic_information} />
                        </div>
                    </div>
                </OrganizationLayout>
            </AppLayout>
        </>
    );
}
