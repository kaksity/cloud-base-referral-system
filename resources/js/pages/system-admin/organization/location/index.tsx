import CreateLocationModal from '@/components/system-admin/organization/location/modal/create-location-modal';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import OrganizationLayout from '@/layouts/custom/view-organization-layout';
import { displayDashboardView } from '@/routes/web/system-admin/dashboard';
import { displayOrganizationsView } from '@/routes/web/system-admin/organization';
import { displayOrganizationAdminsView } from '@/routes/web/system-admin/organization/admin';
import { Country } from '@/types/country';
import { LocalGovernmentArea } from '@/types/local-government-area';
import { ExtendLocation } from '@/types/location';
import { PaginationPayload } from '@/types/pagination';
import { State } from '@/types/state';
import { Ward } from '@/types/ward';
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
    locations: ExtendLocation[];
    countries: Country[];
    states: State[];
    localGovernmentAreas: LocalGovernmentArea[];
    wards: Ward[];
    paginationPayload: PaginationPayload;
}

export default function EditEmployeeView({ organization, locations, wards, localGovernmentAreas, countries, states, paginationPayload }: Props) {
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

    const [showCreateLocationModal, setShowCreateLocationModal] = useState<boolean>(false);

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <OrganizationLayout
                organization={organization}
                activeTab="location"
                headerAction={<Button onClick={() => setShowCreateLocationModal(true)}>Add Location</Button>}
            >
                <CreateLocationModal
                    organizationId={organization.id}
                    countries={countries}
                    states={states}
                    localGovernmentAreas={localGovernmentAreas}
                    wards={wards}
                    onSave={() => setShowCreateLocationModal(false)}
                    onClose={() => setShowCreateLocationModal(false)}
                    show={showCreateLocationModal}
                />
            </OrganizationLayout>
        </AppLayout>
    );
}
