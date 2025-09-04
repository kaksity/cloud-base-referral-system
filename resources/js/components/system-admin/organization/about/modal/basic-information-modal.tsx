import ProcessUpdateOrganizationBasicInformationController from '@/actions/App/Http/Controllers/Web/SystemAdmin/Organization/About/ProcessUpdateOrganizationBasicInformationController';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Form } from '@inertiajs/react';
import { X } from 'lucide-react';

interface PersonalInformationModalProps {
    show: boolean;
    organizationId: string;
    basicInformation: {
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
    onSave: () => void;
    onClose: () => void;
}

export default function BasicInformationModal({ show, organizationId, basicInformation, onClose, onSave }: PersonalInformationModalProps) {
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
                    {...ProcessUpdateOrganizationBasicInformationController.form(organizationId)}
                    className="grid grid-cols-1 gap-4 text-sm md:grid-cols-2" onSuccess={() => {
                        onSave()
                    }}
                >
                    {({ processing, errors }) => (
                        <>
                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="basicInformation.name">Organization Name</Label>
                                <Input id="basicInformation.name" defaultValue={basicInformation.name} name="name" placeholder="Acme Corporation" />
                                <InputError message={errors['name']} />
                            </div>

                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="basicInformation.acronym">Organization Acronym</Label>
                                <Input id="basicInformation.acronym" name="acronym" placeholder="ACME" defaultValue={basicInformation.acronym} />
                                <InputError message={errors['acronym']} />
                            </div>

                            <div className="flex flex-col space-y-1.5 md:col-span-2">
                                <Label htmlFor="basicInformation.description">Organization Description / Mission</Label>
                                <Input
                                    id="basicInformation.description"
                                    name="description"
                                    placeholder="Our mission is to..."
                                    defaultValue={basicInformation.description}
                                />
                                <InputError message={errors['description']} />
                            </div>

                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="basicInformation.office_address">Office Address</Label>
                                <Input
                                    id="basicInformation.office_address"
                                    name="office_address"
                                    placeholder="123 Main Street"
                                    defaultValue={basicInformation.office_address}
                                />
                                <InputError message={errors['office_address']} />
                            </div>

                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="basicInformation.official_email">Official Email</Label>
                                <Input
                                    id="basicInformation.official_email"
                                    name="official_email"
                                    type="email"
                                    placeholder="info@acme.org"
                                    defaultValue={basicInformation.official_email}
                                />
                                <InputError message={errors['official_email']} />
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
