import LocalGovernmentArea from '@/components/system-admin/settings/local-government-area/local-government-area-table';
import CreateLocalGovernmentAreaModal from '@/components/system-admin/settings/local-government-area/modal/create-local-government-area-modal';
import EditLocalGovernmentAreaModal from '@/components/system-admin/settings/local-government-area/modal/edit-local-government-area-modal';
import { Button } from '@/components/ui/button';
import SettingsLayout from '@/layouts/settings-layout';
import { displayProfileView } from '@/routes/web/system-admin/settings/profile';
import { type BreadcrumbItem } from '@/types';
import { Country } from '@/types/country';
import { ExtendLocalGovernmentArea } from '@/types/local-government-area';
import { State } from '@/types/state';
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

export default function ViewLocalGovernmentAreas({
    localGovernmentAreas,
    states,
    countries,
    paginationPayload,
}: {
    countries: Country[];
    states: State[];
    localGovernmentAreas: ExtendLocalGovernmentArea[];
    paginationPayload: {
        meta: PaginationMeta;
        links: PaginationLinks;
    };
}) {
    const [showCreateLocalGovernmentAreaModal, setShowCreateLocalGovernmentAreaModal] = useState(false);
    const [showEditLocalGovernmentAreaModal, setShowEditLocalGovernmentAreaModal] = useState(false);
    const [selectedLocalGovernmentArea, setSelectedLocalGovernmentArea] = useState<ExtendLocalGovernmentArea | null>(null);

    function handleEditLocalGovernmentAreaClicked(state: ExtendLocalGovernmentArea) {
        setSelectedLocalGovernmentArea(state);
        setShowEditLocalGovernmentAreaModal(true);
    }

    return (
        <SettingsLayout breadcrumbs={breadcrumbs}>
            <Head title="Local Government Area" />

            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between px-2 py-5">
                    <div>
                        <h1 className="text-xl font-semibold">Local Government Area</h1>
                        <p className="text-gray-600">Manage your manage your local government areas here.</p>
                    </div>

                    <div className="flex gap-2">
                        <Button onClick={() => setShowCreateLocalGovernmentAreaModal(true)}>Add Local Government Area</Button>
                    </div>
                </div>

                <div className="rounded-md">
                    <LocalGovernmentArea
                        localGovernmentAreas={localGovernmentAreas}
                        paginationPayload={paginationPayload}
                        onEditLocalGovernmentAreaClicked={handleEditLocalGovernmentAreaClicked}
                    />
                </div>
            </div>
            <CreateLocalGovernmentAreaModal
                show={showCreateLocalGovernmentAreaModal}
                countries={countries}
                states={states}
                onClose={() => setShowCreateLocalGovernmentAreaModal(false)}
                onSave={() => setShowCreateLocalGovernmentAreaModal(false)}
            />
            {selectedLocalGovernmentArea && (
                <EditLocalGovernmentAreaModal
                    show={showEditLocalGovernmentAreaModal}
                    localGovernmentArea={selectedLocalGovernmentArea}
                    states={states}
                    countries={countries}
                    onClose={() => setShowEditLocalGovernmentAreaModal(false)}
                    onSave={() => setShowEditLocalGovernmentAreaModal(false)}
                />
            )}
        </SettingsLayout>
    );
}
