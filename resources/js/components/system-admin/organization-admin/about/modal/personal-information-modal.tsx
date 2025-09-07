import ProcessUpdatePersonalInformationController from '@/actions/App/Http/Controllers/Web/SystemAdmin/OrganizationAdmin/About/ProcessUpdatePersonalInformationController';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Form } from '@inertiajs/react';
import { X } from 'lucide-react';

interface PersonalInformationModalProps {
    show: boolean;
    organizationAdminId: string;
    personalInformation: {
        added_by_system_admin: {
            first_name: string;
            last_name: string;
        };
        first_name: string;
        middle_name: string;
        last_name: string;
        mobile_number: string;
        email: string;
    };
    onSave: () => void;
    onClose: () => void;
}

export default function PersonalInformationModal({ show, organizationAdminId, personalInformation, onClose, onSave }: PersonalInformationModalProps) {
    if (!show) return null;

    return (
        <div className="bg-opacity-10 fixed inset-0 z-50 flex items-center justify-center" onClick={(e) => e.target === e.currentTarget && onClose()}>
            <div className="relative max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-xl bg-white p-6 shadow-lg dark:bg-neutral-900">
                <div className="mb-4 flex items-center justify-between">
                    <h2 className="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Basic Information</h2>
                    <button onClick={onClose}>
                        <X className="h-4 w-4 text-gray-500" />
                    </button>
                </div>
                <Form
                    {...ProcessUpdatePersonalInformationController.form(organizationAdminId)}
                    className="grid grid-cols-1 gap-4 text-sm md:grid-cols-2"
                    onSuccess={() => {
                        onSave();
                    }}
                >
                    {({ processing, errors }) => (
                        <>
                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="personalInformation.first_name">First Name</Label>
                                <Input
                                    id="personalInformation.first_name"
                                    defaultValue={personalInformation.first_name}
                                    name="first_name"
                                    placeholder="John"
                                />
                                <InputError message={errors['first_name']} />
                            </div>

                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="personalInformation.last_name">Last Name</Label>
                                <Input
                                    id="personalInformation.last_name"
                                    defaultValue={personalInformation.last_name}
                                    name="last_name"
                                    placeholder="Doe"
                                />
                                <InputError message={errors['last_name']} />
                            </div>

                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="personalInformation.middle_name">Middle Name</Label>
                                <Input
                                    id="personalInformation.middle_name"
                                    defaultValue={personalInformation.middle_name}
                                    name="middle_name"
                                    placeholder="M."
                                />
                                <InputError message={errors['middle_name']} />
                            </div>

                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="personalInformation.email">Admin Email</Label>
                                <Input
                                    id="personalInformation.email"
                                    defaultValue={personalInformation.email}
                                    name="email"
                                    type="email"
                                    placeholder="admin@acme.org"
                                />
                                <InputError message={errors['email']} />
                            </div>

                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="personalInformation.mobile_number">Admin Phone</Label>
                                <Input
                                    id="personalInformation.mobile_number"
                                    name="mobile_number"
                                    defaultValue={personalInformation.mobile_number}
                                    placeholder="+234 801 234 5678"
                                />
                                <InputError message={errors['mobile_number']} />
                            </div>

                            <div className="md:col-span-2">
                                <Button type="submit" className="mt-2 w-full" disabled={processing}>
                                    Save Personal Data
                                </Button>
                            </div>
                        </>
                    )}
                </Form>
            </div>
        </div>
    );
}
