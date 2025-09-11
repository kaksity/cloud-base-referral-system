import { displayOrganizationsView, displayOrganizationView } from '@/routes/web/system-admin/organization';
import { displayOrganizationAdminsView } from '@/routes/web/system-admin/organization/admin';
import { displayLocationsView } from '@/routes/web/system-admin/organization/location';
import { Link } from '@inertiajs/react';
import { ChevronLeft } from 'lucide-react';
import { ReactNode } from 'react';

interface OrganizationLayoutProps {
    organization: {
        id: string;
        basic_information: {
            name: string;
            acronym: string;
        };
    };
    activeTab: 'about' | 'admin' | 'caseWorker' | 'location' | 'beneficiary' | 'referral';
    headerAction?: ReactNode;
    children: ReactNode;
}

export default function OrganizationLayout({ organization, activeTab, headerAction, children }: OrganizationLayoutProps) {
    return (
        <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            {/* Header */}
            <div className="flex items-center justify-between px-2 py-5">
                <div className="flex items-center gap-4">
                    <Link
                        href={displayOrganizationsView().url}
                        className="inline-flex items-center rounded-full bg-white px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none dark:border-neutral-600 dark:bg-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-600"
                    >
                        <ChevronLeft className="mr-1 h-4 w-4" />
                        Back
                    </Link>

                    <h1 className="text-xl font-semibold text-gray-900 dark:text-white">
                        {organization.basic_information.name} -
                        <span className="text-base font-normal text-gray-600 dark:text-gray-400">{organization.basic_information.acronym}</span>
                    </h1>
                </div>

                {/* 👇 slot for Add button or any header action */}
                {headerAction}
            </div>

            {/* Tabs */}
            <div className="flex gap-6 border-b border-border">
                <Link
                    href={displayOrganizationView({ organizationId: organization.id })}
                    className={`pb-2 text-sm transition hover:text-foreground ${
                        activeTab === 'about' ? 'border-b-2 border-primary font-medium text-muted-foreground' : 'text-muted-foreground'
                    }`}
                >
                    About
                </Link>

                <Link
                    href={displayOrganizationAdminsView({ organizationId: organization.id })}
                    className={`pb-2 text-sm transition hover:text-foreground ${
                        activeTab === 'admin' ? 'border-b-2 border-primary font-medium text-muted-foreground' : 'text-muted-foreground'
                    }`}
                >
                    Admin
                </Link>

                <Link
                    href={displayLocationsView.url({ organizationId: organization.id })}
                    className={`pb-2 text-sm transition hover:text-foreground ${
                        activeTab === 'location' ? 'border-b-2 border-primary font-medium text-muted-foreground' : 'text-muted-foreground'
                    }`}
                >
                    Location
                </Link>

                <Link
                    href="#"
                    className={`pb-2 text-sm transition hover:text-foreground ${
                        activeTab === 'caseWorker' ? 'border-b-2 border-primary font-medium text-muted-foreground' : 'text-muted-foreground'
                    }`}
                >
                    Case Worker
                </Link>

                <Link
                    href="#"
                    className={`pb-2 text-sm transition hover:text-foreground ${
                        activeTab === 'beneficiary' ? 'border-b-2 border-primary font-medium text-muted-foreground' : 'text-muted-foreground'
                    }`}
                >
                    Beneficiary
                </Link>

                <Link
                    href="#"
                    className={`pb-2 text-sm transition hover:text-foreground ${
                        activeTab === 'referral' ? 'border-b-2 border-primary font-medium text-muted-foreground' : 'text-muted-foreground'
                    }`}
                >
                    Referral
                </Link>
            </div>

            {/* Page Content */}
            <div className="rounded-md">{children}</div>
        </div>
    );
}
