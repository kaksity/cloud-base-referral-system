import OrganizationAdminTable from '@/components/system-admin/organization-admin/organization-admin-table';
import CreateAdminModal from '@/components/system-admin/organization/admin/modal/create-admin-modal';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { displayDashboardView } from '@/routes/web/system-admin/dashboard';
import { displayOrganizationsView, displayOrganizationView } from '@/routes/web/system-admin/organization';
import { displayOrganizationAdminsView } from '@/routes/web/system-admin/organization/admin';
import { OrganizationAdmin } from '@/types/organization-admin';
import { PaginationPayload } from '@/types/pagination';
import { Head, Link } from '@inertiajs/react';
import { ChevronLeft } from 'lucide-react';
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
        <>
            <Head title={`Edit Organization: ${organization.basic_information.name}`} />
            <AppLayout breadcrumbs={breadcrumbs}>
                <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                    <div className="flex items-center justify-between px-2 py-5">
                        {/* Left side */}
                        <div className="flex items-center gap-4">
                            <Link
                                href={displayOrganizationsView().url}
                                className="inline-flex items-center rounded-full bg-white px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none dark:border-neutral-600 dark:bg-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-600"
                            >
                                <ChevronLeft className="mr-1 h-4 w-4" />
                                Back
                            </Link>

                            <div>
                                <h1 className="text-xl font-semibold text-gray-900 dark:text-white">
                                    {organization.basic_information.name} -
                                    <span className="text-base font-normal text-gray-600 dark:text-gray-400">
                                        {organization.basic_information.acronym}
                                    </span>
                                </h1>
                            </div>
                        </div>

                        <div>
                            <Button onClick={() => setShowCreateAdminModal(true)}>Add Admin</Button>
                        </div>
                    </div>

                    <div className="flex gap-6 border-b border-border">
                        <Link
                            href={displayOrganizationView({ organizationId: organization.id })}
                            className="pb-2 text-sm text-muted-foreground transition hover:text-foreground"
                        >
                            About
                        </Link>
                        <Link
                            href={displayOrganizationAdminsView({ organizationId: organization.id })}
                            className="border-b-2 border-primary pb-2 text-sm font-medium text-muted-foreground transition hover:text-foreground"
                        >
                            Admin
                        </Link>
                        <Link className="pb-2 text-sm text-muted-foreground transition hover:text-foreground">Case Worker</Link>
                        <Link className="pb-2 text-sm text-muted-foreground transition hover:text-foreground">Location</Link>
                        <Link className="pb-2 text-sm text-muted-foreground transition hover:text-foreground">Beneficiary</Link>
                        <Link className="pb-2 text-sm text-muted-foreground transition hover:text-foreground">Referral</Link>
                    </div>

                    <div className="rounded-md">
                        <OrganizationAdminTable organizationAdmins={organizationAdmins} paginationPayload={paginationPayload} />
                    </div>
                    <CreateAdminModal
                        show={showCreateAdminModal}
                        onSave={() => setShowCreateAdminModal(false)}
                        onClose={() => setShowCreateAdminModal(false)}
                        organizationId={organization.id}
                    />
                </div>
            </AppLayout>
        </>
    );
}
