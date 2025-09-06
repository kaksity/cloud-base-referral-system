import CreateSectorModal from '@/components/system-admin/settings/sector/modal/create-sector-modal';
import EditSectorModal from '@/components/system-admin/settings/sector/modal/edit-sector-modal';
import SectorTable from '@/components/system-admin/settings/sector/sector-table';
import { Button } from '@/components/ui/button';
import SettingsLayout from '@/layouts/settings-layout';
import { displayProfileView } from '@/routes/web/system-admin/settings/profile';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { useState } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Profile settings',
        href: displayProfileView().url,
    },
];

interface Sector {
    id: string;
    name: string;
}

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

export default function ViewSectors({
    sectors,
    paginationPayload,
}: {
    sectors: Sector[];
    paginationPayload: {
        meta: PaginationMeta;
        links: PaginationLinks;
    };
}) {
    const [showCreateSectorModal, setShowCreateSectorModal] = useState(false);
    const [showEditSectorModal, setShowEditSectorModal] = useState(false);
    const [selectedSector, setSelectedSector] = useState<Sector | null>(null);

    function handleEditSectorClicked(sector: Sector) {
        setSelectedSector(sector);
        setShowEditSectorModal(true);
    }

    return (
        <SettingsLayout breadcrumbs={breadcrumbs}>
            <Head title="Sector" />

            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between px-2 py-5">
                    <div>
                        <h1 className="text-xl font-semibold">Sector</h1>
                        <p className="text-gray-600">Manage your manage your sectors here.</p>
                    </div>

                    <div className="flex gap-2">
                        <Button onClick={() => setShowCreateSectorModal(true)}>Add Sector</Button>
                    </div>
                </div>

                <div className="rounded-md">
                    <SectorTable sectors={sectors} paginationPayload={paginationPayload} onEditSectorClicked={handleEditSectorClicked} />
                </div>
            </div>
            <CreateSectorModal
                show={showCreateSectorModal}
                onClose={() => setShowCreateSectorModal(false)}
                onSave={() => setShowCreateSectorModal(false)}
            />
            {selectedSector && (
                <EditSectorModal
                    show={showEditSectorModal}
                    sector={selectedSector}
                    onClose={() => setShowEditSectorModal(false)}
                    onSave={() => setShowEditSectorModal(false)}
                />
            )}
        </SettingsLayout>
    );
}
