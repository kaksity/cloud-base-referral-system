import PersonalInformationModal from '@/components/system-admin/organization-admin/about/modal/personal-information-modal';
import { Label } from '@/components/ui/label';
import { Pencil } from 'lucide-react';
import { useState } from 'react';

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

export default function PersonalInformation({
    personalInformation,
    organizationAdminId,
}: {
    organizationAdminId: string;
    personalInformation: PersonalInformation;
}) {
    const [showPersonalInformationModal, setShowPersonalInformationModal] = useState(false);

    return (
        <div className="rounded-lg border p-6 lg:col-span-3">
            <div className="mb-2 flex items-start justify-between">
                <div>
                    <h3 className="text-lg font-semibold">Personal Information</h3>
                    <p className="mt-1 text-sm text-gray-500">Employee’s personal details such as name, email and contact.</p>
                </div>
                <button onClick={() => setShowPersonalInformationModal(true)} className="mt-1">
                    <Pencil className="h-4 w-4 text-gray-500" />
                </button>
            </div>

            <div className="grid grid-cols-1 gap-4 md:grid-cols-4">
                <div>
                    <Label htmlFor="name" className="mb-2 block">
                        First Name
                    </Label>
                    <Label htmlFor="name" className="mb-2 block">
                        {personalInformation.first_name}
                    </Label>
                </div>

                <div>
                    <Label htmlFor="name" className="mb-2 block">
                        Middle Name
                    </Label>
                    <Label htmlFor="name" className="mb-2 block">
                        {personalInformation.middle_name}
                    </Label>
                </div>

                <div>
                    <Label htmlFor="name" className="mb-2 block">
                        Middle Name
                    </Label>
                    <Label htmlFor="name" className="mb-2 block">
                        {personalInformation.last_name}
                    </Label>
                </div>

                <div>
                    <Label htmlFor="acronym" className="mb-2 block">
                        Mobile Number
                    </Label>
                    <Label htmlFor="acronym" className="mb-2 block">
                        {personalInformation.mobile_number}
                    </Label>
                </div>

                <div>
                    <Label htmlFor="official_email" className="mb-2 block">
                        Email
                    </Label>
                    <Label htmlFor="official_email" className="mb-2 block">
                        {personalInformation.email}
                    </Label>
                </div>

                <div>
                    <Label htmlFor="created_at" className="mb-2 block">
                        Created At
                    </Label>
                    <Label htmlFor="created_at" className="mb-2 block">
                        {personalInformation.created_at}
                    </Label>
                </div>

                <div className="md:col-span-2">
                    <Label htmlFor="added_by" className="mb-2 block">
                        Added By
                    </Label>
                    <Label htmlFor="added_by" className="mb-2 block">
                        {`${personalInformation.added_by_system_admin.first_name} ${personalInformation.added_by_system_admin.last_name}`}
                    </Label>
                </div>
            </div>

            <PersonalInformationModal
                show={showPersonalInformationModal}
                organizationAdminId={organizationAdminId}
                onClose={() => setShowPersonalInformationModal(false)}
                onSave={() => setShowPersonalInformationModal(false)}
                personalInformation={personalInformation}
            />
        </div>
    );
}
