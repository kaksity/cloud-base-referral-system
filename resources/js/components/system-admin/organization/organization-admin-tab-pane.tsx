import OrganizationAdminTable from '@/components/system-admin/organization-admin/organization-admin-table';
import { OrganizationAdmin } from '@/types/organization-admin';
import { PaginationPayload } from '@/types/pagination';

export default function OrganizationAdminTabPane({
    organizationAdminPayload,
}: {
    organizationAdminPayload: {
        organizationAdmins: OrganizationAdmin[];
        paginationPayload: PaginationPayload;
    };
}) {
    const { organizationAdmins, paginationPayload } = organizationAdminPayload;

    return (
        <div className="rounded-md">
            <OrganizationAdminTable organizationAdmins={organizationAdmins} paginationPayload={paginationPayload} />
        </div>
    );
}
