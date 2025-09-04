import { type BreadcrumbItem } from '@/types';
import { Form, Head } from '@inertiajs/react';
import HeadingSmall from '@/components/heading-small';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/components/ui/collapsible';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { displayOrganizationsView } from '@/routes/web/system-admin/organization';
import { Link } from '@inertiajs/react';
import { ChevronDown } from 'lucide-react';
import ProcessCreateOrganizationController from '@/actions/App/Http/Controllers/Web/SystemAdmin/Organization/ProcessCreateOrganizationController';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Organization',
        href: displayOrganizationsView().url,
    },
];

export default function CreateOrganization() {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Organization" />

            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <HeadingSmall title="Organization Information" description="Provide the details of the organization you want to create." />

                <Form {...ProcessCreateOrganizationController.form()} options={{ preserveScroll: true }} className="space-y-8">
                    {({ processing, errors }) => (
                        <>
                            <Collapsible defaultOpen className="w-full rounded-lg border shadow-sm">
                                <CollapsibleTrigger asChild>
                                    <button
                                        type="button"
                                        className="flex w-full items-center justify-between border-b px-6 py-4 text-left transition-colors hover:bg-gray-50 dark:hover:bg-gray-800"
                                    >
                                        <div>
                                            <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100">Basic Information</h3>
                                            <p className="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                General details about the organization such as name, acronym, description, and contact details.
                                            </p>
                                        </div>
                                        <ChevronDown className="h-5 w-5 transition-transform duration-200 data-[state=open]:rotate-180" />
                                    </button>
                                </CollapsibleTrigger>

                                <CollapsibleContent className="w-full px-6 pt-4 pb-6">
                                    <div className="grid grid-cols-1 gap-6 md:grid-cols-2">
                                        <div className="flex flex-col space-y-1.5">
                                            <Label htmlFor="organization.name">Organization Name</Label>
                                            <Input id="organization.name" name="organization.name" placeholder="Acme Corporation" />
                                            <InputError message={errors['organization.name']} />
                                        </div>

                                        <div className="flex flex-col space-y-1.5">
                                            <Label htmlFor="organization.acronym">Organization Acronym</Label>
                                            <Input id="organization.acronym" name="organization.acronym" placeholder="ACME" />
                                            <InputError message={errors['organization.acronym']} />
                                        </div>

                                        <div className="flex flex-col space-y-1.5 md:col-span-2">
                                            <Label htmlFor="organization.description">Organization Description / Mission</Label>
                                            <Input id="organization.description" name="organization.description" placeholder="Our mission is to..." />
                                            <InputError message={errors['organization.description']} />
                                        </div>

                                        <div className="flex flex-col space-y-1.5">
                                            <Label htmlFor="organization.office_address">Office Address</Label>
                                            <Input
                                                id="organization.office_address"
                                                name="organization.office_address"
                                                placeholder="123 Main Street"
                                            />
                                            <InputError message={errors['organization.office_address']} />
                                        </div>

                                        <div className="flex flex-col space-y-1.5">
                                            <Label htmlFor="organization.official_email">Official Email</Label>
                                            <Input
                                                id="organization.official_email"
                                                name="organization.official_email"
                                                type="email"
                                                placeholder="info@acme.org"
                                            />
                                            <InputError message={errors['organization.official_email']} />
                                        </div>
                                    </div>
                                </CollapsibleContent>
                            </Collapsible>

                            <Collapsible defaultOpen className="w-full rounded-lg border shadow-sm">
                                <CollapsibleTrigger asChild>
                                    <button
                                        type="button"
                                        className="flex w-full items-center justify-between border-b px-6 py-4 text-left transition-colors hover:bg-gray-50 dark:hover:bg-gray-800"
                                    >
                                        <div>
                                            <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100">Organization Admin Information</h3>
                                            <p className="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                This will create the admin account for the organization.
                                            </p>
                                        </div>
                                        <ChevronDown className="h-5 w-5 transition-transform duration-200 data-[state=open]:rotate-180" />
                                    </button>
                                </CollapsibleTrigger>

                                <CollapsibleContent className="w-full px-6 pt-4 pb-6">
                                    <div className="grid grid-cols-1 gap-6 md:grid-cols-2">
                                        <div className="flex flex-col space-y-1.5">
                                            <Label htmlFor="organization_admin.first_name">First Name</Label>
                                            <Input id="organization_admin.first_name" name="organization_admin.first_name" placeholder="John" />
                                            <InputError message={errors['organization_admin.first_name']} />
                                        </div>

                                        <div className="flex flex-col space-y-1.5">
                                            <Label htmlFor="organization_admin.last_name">Last Name</Label>
                                            <Input id="organization_admin.last_name" name="organization_admin.last_name" placeholder="Doe" />
                                            <InputError message={errors['organization_admin.last_name']} />
                                        </div>

                                        <div className="flex flex-col space-y-1.5">
                                            <Label htmlFor="organization_admin.middle_name">Middle Name</Label>
                                            <Input id="organization_admin.middle_name" name="organization_admin.middle_name" placeholder="M." />
                                            <InputError message={errors['organization_admin.middle_name']} />
                                        </div>

                                        <div className="flex flex-col space-y-1.5">
                                            <Label htmlFor="organization_admin.email">Admin Email</Label>
                                            <Input
                                                id="organization_admin.email"
                                                name="organization_admin.email"
                                                type="email"
                                                placeholder="admin@acme.org"
                                            />
                                            <InputError message={errors['organization_admin.email']} />
                                        </div>

                                        <div className="flex flex-col space-y-1.5">
                                            <Label htmlFor="organization_admin.mobile_number">Admin Phone</Label>
                                            <Input
                                                id="organization_admin.mobile_number"
                                                name="organization_admin.mobile_number"
                                                placeholder="+234 801 234 5678"
                                            />
                                            <InputError message={errors['organization_admin.mobile_number']} />
                                        </div>
                                    </div>
                                </CollapsibleContent>
                            </Collapsible>

                            <div className="mt-4 flex items-center justify-end gap-4">
                                <Button type="submit" disabled={processing}>
                                    Save
                                </Button>
                                <Link
                                    href={displayOrganizationsView().url}
                                    className="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50 dark:hover:bg-gray-800"
                                >
                                    Cancel
                                </Link>
                            </div>
                        </>
                    )}
                </Form>
            </div>
        </AppLayout>
    );
}
