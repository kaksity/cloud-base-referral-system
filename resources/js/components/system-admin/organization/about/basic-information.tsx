import BasicInformationModal from '@/components/system-admin/organization/about/modal/basic-information-modal';
import { Label } from '@/components/ui/label';
import { Pencil } from 'lucide-react';
import { useState } from 'react';

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

export default function BasicInformation({ basicInformation, organizationId }: { organizationId: string; basicInformation: BasicInformation }) {
    const [showBasicInformationModal, setShowBasicInformationModal] = useState(false);

    return (
        <div className="rounded-lg border p-6 lg:col-span-3">
            <div className="mb-2 flex items-start justify-between">
                <div>
                    <h3 className="text-lg font-semibold">Personal Information</h3>
                    <p className="mt-1 text-sm text-gray-500">Employee’s personal details such as name, email and contact.</p>
                </div>
                <button onClick={() => setShowBasicInformationModal(true)} className="mt-1">
                    <Pencil className="h-4 w-4 text-gray-500" />
                </button>
            </div>

            <div className="grid grid-cols-1 gap-4 md:grid-cols-4">
                <div>
                    <Label htmlFor="name" className="mb-2 block">
                        Name
                    </Label>
                    <Label htmlFor="name" className="mb-2 block">
                        {basicInformation.name}
                    </Label>
                </div>

                <div>
                    <Label htmlFor="acronym" className="mb-2 block">
                        Acronym
                    </Label>
                    <Label htmlFor="acronym" className="mb-2 block">
                        {basicInformation.acronym}
                    </Label>
                </div>

                <div>
                    <Label htmlFor="official_email" className="mb-2 block">
                        Official Email
                    </Label>
                    <Label htmlFor="official_email" className="mb-2 block">
                        {basicInformation.official_email}
                    </Label>
                </div>

                <div>
                    <Label htmlFor="created_at" className="mb-2 block">
                        Created At
                    </Label>
                    <Label htmlFor="created_at" className="mb-2 block">
                        {basicInformation.created_at}
                    </Label>
                </div>

                <div className="md:col-span-2">
                    <Label htmlFor="office_address" className="mb-2 block">
                        Office Address
                    </Label>
                    <Label htmlFor="office_address" className="mb-2 block">
                        {basicInformation.office_address}
                    </Label>
                </div>

                <div className="md:col-span-2">
                    <Label htmlFor="description" className="mb-2 block">
                        Description
                    </Label>
                    <Label htmlFor="description" className="mb-2 block">
                        {basicInformation.description}
                    </Label>
                </div>

                <div className="md:col-span-2">
                    <Label htmlFor="added_by" className="mb-2 block">
                        Added By
                    </Label>
                    <Label htmlFor="added_by" className="mb-2 block">
                        {`${basicInformation.added_by_system_admin.first_name} ${basicInformation.added_by_system_admin.last_name}`}
                    </Label>
                </div>
            </div>

            <BasicInformationModal
                show={showBasicInformationModal}
                organizationId={organizationId}
                onClose={() => setShowBasicInformationModal(false)}
                onSave={() => setShowBasicInformationModal(false)}
                basicInformation={basicInformation}
            />
        </div>
    );
}
