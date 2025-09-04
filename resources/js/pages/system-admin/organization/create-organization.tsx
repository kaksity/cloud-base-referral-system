import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import { type BreadcrumbItem, } from '@/types';
import { Transition } from '@headlessui/react';
import { Form, Head } from '@inertiajs/react';

import HeadingSmall from '@/components/heading-small';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { edit } from '@/routes/profile';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Organization',
        href: edit().url,
    },
];

export default function CreateOrganization() {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Organization" />

            <div className="max-w-3xl space-y-10 p-6">
                {/* Organization section */}
                <HeadingSmall
                    title="Organization Information"
                    description="Provide the details of the organization you want to create."
                />

                <Form
                    {...ProfileController.update.form()}
                    options={{
                        preserveScroll: true,
                    }}
                    className="space-y-8"
                >
                    {({ processing, recentlySuccessful, errors }) => (
                        <>
                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="organization_name">Organization Name</Label>
                                <Input
                                    id="organization_name"
                                    name="organization_name"
                                    required
                                    placeholder="Acme Corporation"
                                />
                                <InputError message={errors.organization_name} />
                            </div>

                            <div className="space-y-6">
                                <HeadingSmall
                                    title="Contact Person (Admin)"
                                    description="Enter the details of the person who will manage this organization."
                                />

                                <div className="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    {/* First name */}
                                    <div className="flex flex-col space-y-1.5">
                                        <Label htmlFor="first_name">First Name</Label>
                                        <Input id="first_name" name="first_name" required placeholder="John" />
                                        <InputError message={errors.first_name} />
                                    </div>

                                    {/* Middle name */}
                                    <div className="flex flex-col space-y-1.5">
                                        <Label htmlFor="middle_name">Middle Name</Label>
                                        <Input id="middle_name" name="middle_name" placeholder="A." />
                                        <InputError message={errors.middle_name} />
                                    </div>

                                    {/* Last name */}
                                    <div className="flex flex-col space-y-1.5">
                                        <Label htmlFor="last_name">Last Name</Label>
                                        <Input id="last_name" name="last_name" required placeholder="Doe" />
                                        <InputError message={errors.last_name} />
                                    </div>

                                    {/* Email */}
                                    <div className="flex flex-col space-y-1.5">
                                        <Label htmlFor="email">Email Address</Label>
                                        <Input
                                            id="email"
                                            type="email"
                                            name="email"
                                            required
                                            placeholder="admin@acme.org"
                                        />
                                        <InputError message={errors.email} />
                                    </div>
                                </div>
                            </div>

                            <div className="flex items-center justify-between border-t border-neutral-200 pt-4">
                                <Button disabled={processing}>Create Organization</Button>

                                <Transition
                                    show={recentlySuccessful}
                                    enter="transition-opacity duration-300"
                                    enterFrom="opacity-0"
                                    leave="transition-opacity duration-500"
                                    leaveTo="opacity-0"
                                >
                                    <p className="text-sm font-medium text-green-600">✓ Saved</p>
                                </Transition>
                            </div>
                        </>
                    )}
                </Form>
            </div>
        </AppLayout>
    );
}
