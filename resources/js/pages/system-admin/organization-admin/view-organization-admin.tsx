import AboutOrganizationAdminTabPane from '@/components/system-admin/organization-admin/about-organization-admin-tab-pane';
import Tab from '@/components/ui/tab';
import AppLayout from '@/layouts/app-layout';
import { displayOrganizationAdminsView } from '@/routes/web/system-admin/organization-admin';
import { Head, Link } from '@inertiajs/react';
import { ChevronLeft } from 'lucide-react';
import { useEffect, useState } from 'react';

interface BreadcrumbItem {
    title: string;
    href: string;
}

interface OrganizationAdmin {
    id: string;
    organization: {
        id: string;
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
    personal_information: {
        added_by_system_admin: {
            first_name: string;
            last_name: string;
        };
        first_name: string;
        middle_name: string;
        last_name: string;
        mobile_number: string;
        email: string;
        created_at: string;
    };
}

interface Props {
    organizationAdmin: OrganizationAdmin;
}

export default function EditEmployeeView({ organizationAdmin }: Props) {
    const [showActionDropdown, setShowActionDropdown] = useState(false);

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: '/dashboard',
        },
    ];

    const currentTab = new URLSearchParams(window.location.search).get('tab') || 'personal-information';

    const organizationAdminTabs = [
        {
            value: 'personal-information',
            label: 'Personal Information',
            link: '#',
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
            <Head title={`Edit Organization Admin: ${organizationAdmin.personal_information.first_name}`} />
            <AppLayout breadcrumbs={breadcrumbs}>
                <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                    <div className="flex items-center justify-between px-2 py-5">
                        <div className="flex items-center gap-4">
                            <Link
                                href={displayOrganizationAdminsView()}
                                className="inline-flex items-center rounded-full bg-white px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none dark:border-neutral-600 dark:bg-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-600"
                            >
                                <ChevronLeft className="mr-1 h-4 w-4" />
                                Back
                            </Link>

                            <div>
                                <h1 className="text-xl font-semibold text-gray-900 dark:text-white">
                                    {organizationAdmin.personal_information.first_name} {organizationAdmin.personal_information.middle_name}{' '}
                                    {organizationAdmin.personal_information.last_name}
                                </h1>
                            </div>
                        </div>
                    </div>

                    <Tab tabs={organizationAdminTabs} defaultValue={currentTab}>
                        <div data-tab="personal-information">
                            <AboutOrganizationAdminTabPane
                                personalInformation={organizationAdmin.personal_information}
                                organization={organizationAdmin.organization}
                                organizationAdminId={organizationAdmin.id}
                            />
                        </div>
                    </Tab>
                </div>
            </AppLayout>
        </>
    );
}
