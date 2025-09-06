import CreateStateModal from '@/components/system-admin/settings/state/modal/create-state-modal';
import EditStateModal from '@/components/system-admin/settings/state/modal/edit-state-modal';
import StateTable from '@/components/system-admin/settings/state/state-table';
import { Button } from '@/components/ui/button';
import SettingsLayout from '@/layouts/settings-layout';
import { displayProfileView } from '@/routes/web/system-admin/settings/profile';
import { type BreadcrumbItem } from '@/types';
import { Country } from '@/types/country';
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

type ExtendedState = State & {
    country: {
        id: string;
        name: string;
    };
};

export default function ViewStates({
    states,
    countries,
    paginationPayload,
}: {
    countries: Country[];
    states: ExtendedState[];
    paginationPayload: {
        meta: PaginationMeta;
        links: PaginationLinks;
    };
}) {
    const [showCreateStateModal, setShowCreateStateModal] = useState(false);
    const [showEditStateModal, setShowEditStateModal] = useState(false);
    const [selectedState, setSelectedState] = useState<ExtendedState | null>(null);

    function handleEditStateClicked(state: ExtendedState) {
        setSelectedState(state);
        setShowEditStateModal(true);
    }

    return (
        <SettingsLayout breadcrumbs={breadcrumbs}>
            <Head title="State" />

            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between px-2 py-5">
                    <div>
                        <h1 className="text-xl font-semibold">State</h1>
                        <p className="text-gray-600">Manage your manage your states here.</p>
                    </div>

                    <div className="flex gap-2">
                        <Button onClick={() => setShowCreateStateModal(true)}>Add State</Button>
                    </div>
                </div>

                <div className="rounded-md">
                    <StateTable states={states} paginationPayload={paginationPayload} onEditStateClicked={handleEditStateClicked} />
                </div>
            </div>
            <CreateStateModal
                show={showCreateStateModal}
                countries={countries}
                onClose={() => setShowCreateStateModal(false)}
                onSave={() => setShowCreateStateModal(false)}
            />
            {selectedState && (
                <EditStateModal
                    show={showEditStateModal}
                    state={selectedState}
                    countries={countries}
                    onClose={() => setShowEditStateModal(false)}
                    onSave={() => setShowEditStateModal(false)}
                />
            )}
        </SettingsLayout>
    );
}
