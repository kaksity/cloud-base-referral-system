import Avatar from '@/components/system-admin/organization-admin/about/avatar';
import PersonalInformation from '@/components/system-admin/organization-admin/about/personal-information';
import OrganizationInformation from './about/organization-information';
interface PersonalInformation {
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
}

interface Organization {
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
}

export default function AboutOrganizationAdminTabPane({
    organizationAdminId,
    personalInformation,
    organization,
}: {
    organizationAdminId: string;
    organization: Organization;
    personalInformation: PersonalInformation;
}) {
    return (
        <div className="rounded-lg p-4">
            <div className="flex flex-1 flex-col gap-6 p-4">
                <div className="grid grid-cols-1 gap-6 lg:grid-cols-4">
                    {/* Avatar (1 column) */}
                    <div className="lg:col-span-1">
                        <Avatar
                            avatar={{
                                id: organizationAdminId,
                                first_name: personalInformation.first_name,
                                last_name: personalInformation.last_name,
                                middle_name: personalInformation.middle_name,
                            }}
                        />
                    </div>

                    <div className="lg:col-span-3">
                        <PersonalInformation organizationAdminId={organizationAdminId} personalInformation={personalInformation} />
                    </div>

                    <div className="lg:col-span-3 lg:col-start-2">
                        <OrganizationInformation organizationInformation={organization} />
                    </div>
                </div>
            </div>
        </div>
    );
}
