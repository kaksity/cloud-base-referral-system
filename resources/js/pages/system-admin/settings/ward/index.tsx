import CreateWardModal from '@/components/system-admin/settings/ward/modal/create-ward-modal';
import EditWardModal from '@/components/system-admin/settings/ward/modal/edit-ward-modal';
import Ward from '@/components/system-admin/settings/ward/ward-table';
import { Button } from '@/components/ui/button';
import SettingsLayout from '@/layouts/settings-layout';
import { displayProfileView } from '@/routes/web/system-admin/settings/profile';
import { type BreadcrumbItem } from '@/types';
import { Country } from '@/types/country';
import { LocalGovernmentArea } from '@/types/local-government-area';
import { State } from '@/types/state';
import { ExtendWard } from '@/types/ward';
import { Head } from '@inertiajs/react';
import { useState } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Profile settings',
        href: displayProfileView().url,
    },
];

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

export default function ViewWards({
    localGovernmentAreas,
    wards,
    states,
    countries,
    paginationPayload,
}: {
    countries: Country[];
    states: State[];
    localGovernmentAreas: LocalGovernmentArea[];
    wards: ExtendWard[];
    paginationPayload: {
        meta: PaginationMeta;
        links: PaginationLinks;
    };
}) {
    const [showCreateWardModal, setShowCreateWardModal] = useState(false);
    const [showEditWardModal, setShowEditWardModal] = useState(false);
    const [selectedWard, setSelectedWard] = useState<ExtendWard | null>(null);

    function handleEditWardClicked(state: ExtendWard) {
        setSelectedWard(state);
        setShowEditWardModal(true);
    }

    return (
        <SettingsLayout breadcrumbs={breadcrumbs}>
            <Head title="Ward" />

            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between px-2 py-5">
                    <div>
                        <h1 className="text-xl font-semibold">Ward</h1>
                        <p className="text-gray-600">Manage your manage your wards here.</p>
                    </div>

                    <div className="flex gap-2">
                        <Button onClick={() => setShowCreateWardModal(true)}>Add Ward</Button>
                    </div>
                </div>

                <div className="rounded-md">
                    <Ward wards={wards} paginationPayload={paginationPayload} onEditWardClicked={handleEditWardClicked} />
                </div>
            </div>
            <CreateWardModal
                show={showCreateWardModal}
                countries={countries}
                states={states}
                localGovernmentAreas={localGovernmentAreas}
                onClose={() => setShowCreateWardModal(false)}
                onSave={() => setShowCreateWardModal(false)}
            />
            {selectedWard && (
                <EditWardModal
                    show={showEditWardModal}
                    localGovernmentAreas={localGovernmentAreas}
                    ward={selectedWard}
                    states={states}
                    countries={countries}
                    onClose={() => setShowEditWardModal(false)}
                    onSave={() => setShowEditWardModal(false)}
                />
            )}
        </SettingsLayout>
    );
}
