import OrganizationAdminTable from '@/components/system-admin/organization-admin/organization-admin-table';
import AppLayout from '@/layouts/app-layout';
import { displayCreateOrganizationAdminView } from '@/routes/web/system-admin/organization-admin';
import { type BreadcrumbItem } from '@/types';
import { OrganizationAdmin } from '@/types/organization-admin';
import { PaginationPayload } from '@/types/pagination';
import { Head, Link } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: displayCreateOrganizationAdminView().url,
    },
];

export default function ViewOrganizations({
    organizationAdmins,
    paginationPayload,
}: {
    organizationAdmins: OrganizationAdmin[];
    paginationPayload: PaginationPayload;
}) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Organizations" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between px-2 py-5">
                    <div>
                        <h1 className="text-xl font-semibold">Organization Admins</h1>
                        <p className="text-gray-600">Manage your organization admins here.</p>
                    </div>

                    <div className="flex gap-2">
                        <Link
                            href={displayCreateOrganizationAdminView()}
                            className="inline-flex h-9 w-full shrink-0 items-center justify-center gap-2 rounded-md bg-primary px-4 py-2 text-sm font-medium whitespace-nowrap text-primary-foreground shadow-xs transition-all outline-none hover:bg-primary/90 focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50 has-[>svg]:px-3 aria-invalid:border-destructive aria-invalid:ring-destructive/20 md:w-auto dark:aria-invalid:ring-destructive/40 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4"
                        >
                            Add Organization Admin
                        </Link>
                    </div>
                </div>

                <div className="rounded-md">
                    <OrganizationAdminTable organizationAdmins={organizationAdmins} paginationPayload={paginationPayload} />
                </div>
            </div>
        </AppLayout>
    );
}
