import OrganizationTable from '@/components/system-admin/organization/organization-table';
import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import { displayCreateOrganizationView } from '@/routes/web/system-admin/organization';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

interface Organization {
    id: string;
    added_by_system_admin: {
        first_name: string;
        last_name: string;
    };
    name: string;
    acronym: string;
    created_at: string;
    official_email: string;
}

interface PaginationMeta {
    current_page: number;
    from: number;
    last_page: number;
    path: string;
    per_page: number;
    to: number;
    total: number;
}

interface PaginationLinks {
    first: string;
    last: string;
    prev: string | null;
    next: string | null;
}

export default function ViewOrganizations({
    organizations,
    paginationPayload,
}: {
    organizations: Organization[];
    paginationPayload: {
        meta: PaginationMeta;
        links: PaginationLinks;
    };
}) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Organizations" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between px-2 py-5">
                    <div>
                        <h1 className="text-xl font-semibold">Organizations</h1>
                        <p className="text-gray-600">Manage your organizations here.</p>
                    </div>

                    <div className="flex gap-2">
                        <Link
                            href={displayCreateOrganizationView()}
                            className="inline-flex h-9 w-full shrink-0 items-center justify-center gap-2 rounded-md bg-primary px-4 py-2 text-sm font-medium whitespace-nowrap text-primary-foreground shadow-xs transition-all outline-none hover:bg-primary/90 focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50 has-[>svg]:px-3 aria-invalid:border-destructive aria-invalid:ring-destructive/20 md:w-auto dark:aria-invalid:ring-destructive/40 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4"
                        >
                            Add Organization
                        </Link>
                        <Link
                            href="#"
                            className="inline-flex h-9 w-full shrink-0 items-center justify-center gap-2 rounded-md bg-primary px-4 py-2 text-sm font-medium whitespace-nowrap text-primary-foreground shadow-xs transition-all outline-none hover:bg-primary/90 focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50 has-[>svg]:px-3 aria-invalid:border-destructive aria-invalid:ring-destructive/20 md:w-auto dark:aria-invalid:ring-destructive/40 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4"
                        >
                            Import Organization
                        </Link>
                    </div>
                </div>

                <div className="rounded-md">
                    <OrganizationTable organizations={organizations} paginationPayload={paginationPayload} />
                </div>
            </div>
        </AppLayout>
    );
}
