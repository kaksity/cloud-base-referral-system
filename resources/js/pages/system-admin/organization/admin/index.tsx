import OrganizationAdminTable from '@/components/system-admin/organization-admin/organization-admin-table';
import CreateAdminModal from '@/components/system-admin/organization/admin/modal/create-admin-modal';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import OrganizationLayout from '@/layouts/custom/view-organization-layout';
import { displayDashboardView } from '@/routes/web/system-admin/dashboard';
import { displayOrganizationsView } from '@/routes/web/system-admin/organization';
import { displayOrganizationAdminsView } from '@/routes/web/system-admin/organization/admin';
import { OrganizationAdmin } from '@/types/organization-admin';
import { PaginationPayload } from '@/types/pagination';
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
    organizationAdmins: OrganizationAdmin[];
    paginationPayload: PaginationPayload;
}

export default function EditEmployeeView({ organization, organizationAdmins, paginationPayload }: Props) {
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
            title: 'Admin',
            href: displayOrganizationAdminsView({ organizationId: organization.id }).url,
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

    const [showCreateAdminModal, setShowCreateAdminModal] = useState<boolean>(false);

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <OrganizationLayout
                organization={organization}
                activeTab="admin"
                headerAction={<Button onClick={() => setShowCreateAdminModal(true)}>Add Admin</Button>}
            >
                <OrganizationAdminTable organizationAdmins={organizationAdmins} paginationPayload={paginationPayload} />
                <CreateAdminModal
                    show={showCreateAdminModal}
                    onSave={() => setShowCreateAdminModal(false)}
                    onClose={() => setShowCreateAdminModal(false)}
                    organizationId={organization.id}
                />
            </OrganizationLayout>
        </AppLayout>
    );
}
