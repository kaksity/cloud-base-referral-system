import Avatar from '@/components/system-admin/organization/about/avatar';
import BasicInformation from '@/components/system-admin/organization/about/basic-information';
interface BasicInformation {
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

export default function AboutOrganizationTabPane({
    organizationId,
    basicInformation,
}: {
    organizationId: string;
    basicInformation: BasicInformation;
}) {
    console.log(basicInformation);
    return (
        <div className="rounded-lg border p-4 shadow">
            <div className="flex flex-1 flex-col gap-6 p-4">
                <div className="grid grid-cols-1 gap-6 lg:grid-cols-4">
                    <Avatar avatar={{ id: organizationId, name: basicInformation.name }} />
                    <BasicInformation organizationId={organizationId} basicInformation={basicInformation} />
                </div>
            </div>
        </div>
    );
}
